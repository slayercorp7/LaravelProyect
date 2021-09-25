<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Curso;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'auth' ,['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $usuario=$perfil->user_id;
        $userCursos=Curso::where('user_id' ,$usuario)->paginate(3);
        return view('perfiles.show')->with('perfil',$perfil)
                                     ->with('userCursos', $userCursos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //Policy
        $this->authorize('view', $perfil);

        return view('perfiles.edit')->with('perfil',$perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {


        // Policy
        $this->authorize('update', $perfil);


        //dd($request['imagen']);
        //Validacion

            

            $data=request()->validate([
                'nombre'=> 'required',
                'url'=> 'required',
                'biografia'=> 'required'
            ]);

            //Verificar si el usuario sube una imagen

            if($request['imagen']){
                $ruta_imagen=($request['imagen']->store('upload-perfiles','public'));
                $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
                $img->save();

                //arreglo de imagnes 
                $array_image=['imagen'=>$ruta_imagen];
            }
            

           // dd($data); Verififcamos  la informacion enviada desde el html
            //Actualizar tabla user
            auth()->user()->name=$data['nombre'];
            auth()->user()->url=$data['url'];
            auth()->user()->save();

            //Eliminar url y name de data
            unset($data['nombre']);
            unset($data['url']);

           

            // Guardar Informacion tabla perfils

            auth()->user()->userPerfil()->update(
                array_merge(//dos parametros de tipo array
                    $data,
                    $array_image ?? [] // Almacenando la imagen
                )
                
            );

            

            //Redireccionar 
            return redirect()->action([CursoController::class, 'index']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }



}
