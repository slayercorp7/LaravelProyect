<?php

namespace App\Http\Controllers;

use App\Models\CategoriaCurso;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CursoController extends Controller
{


    //constructor
        public function __construct()
        {
            $this->middleware('auth', ['except'=>'show']);
        }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $usuario=Auth::user();
        $usuario=Auth::user()->id;
        $userCursos=Curso::where('user_id' ,$usuario)->paginate(2);
      
        $iLikes=Auth::user()->ilike;
        return view('cursos.index')->with('userCursos',$userCursos)
                                     ->with('iLikes', $iLikes)
                                     ->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //sin modelo
        //$categorias=DB::table('categorias_recetas')->get()->pluck('nombre','id');

        // con modelo
        $categorias=CategoriaCurso::all(['id','nombre']);
        return view('cursos.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        

        $data=$request->validate([

            'nombre'=>'required|min:6',
            'categoria'=> 'required',
            'descripcion'=>'required',
            'contenido'=>'required' ,
            'imagen'=> 'required|image',         


        ]);

        $ruta_imagen=$request['imagen']->store('upload-cursos','public');
        $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(700,400);
        $img->save();

     

        // Insertar con Modelo

        Auth::user()->userCursos()->create([

            'nombre'=>$data['nombre'],
            'descripcion'=>$data['descripcion'],
            'contenido'=>$data['contenido'],
            'imagen'=>$ruta_imagen,
            'categoria_id'=>$data['categoria'],

        ]);



        //redieccionar 
        return redirect()->action([CursoController::class, 'index']);
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //Si el usuario autentificado ld dio like 
        $like=(Auth::user()) ? Auth::user()->iLike->contains($curso->id) : false;

        //Cantidad de Likes 
        $likes=$curso->likes()->count();
        return view('cursos.show')->with('curso',$curso)
                                   ->with('like',$like)
                                   ->with('likes',$likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        //Verficacion de Policy
        $this->authorize('view',$curso);
        $categorias=CategoriaCurso::all(['id','nombre']);
        return view('cursos.edit')->with('categorias',$categorias)
                                   ->with('curso', $curso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {

        //Verficacion de Policy
        $this->authorize('update',$curso);

        $data=$request->validate([

            'nombre'=>'required|min:6',
            'categoria'=> 'required',
            'descripcion'=>'required',
            'contenido'=>'required' ,
                   
        ]);

            //Asignar valores 
            $curso->nombre=$data['nombre'];
            $curso->categoria_id=$data['categoria'];
            $curso->descripcion=$data['descripcion'];
            $curso->contenido=$data['contenido'];

            //Nueva imagen

            if(request('imagen')){
                // Guardar la imagen en nuestro store
                $ruta_imagen=($request['imagen']->store('upload-cursos','public'));
                //Despues aplicamos el estilo
                $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
                $img->save();
                $curso->imagen=$ruta_imagen ; 

            }
            // Guardar informacion
            $curso->save(); 

            
            //redieccionar 
            return redirect()->action([CursoController::class, 'index']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
         //Verficacion de Policy
         $this->authorize('delete',$curso);
       // return "desde el elimar";

        //Agregar Metodo Eliminar
        $curso->delete();
        return redirect()->action([CursoController::class, 'index']);
    }
}
