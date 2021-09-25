@extends('layouts.app')
@section('content')

    
        <article class="contenido-curso">
        <h1 class="text-center mb-4"> {{$curso->nombre}} </h1>
        <div class="imagen-curso">
            <img src="/cursos/storage/app/public/{{$curso->imagen}}" class="w-50"> 
        
        </div>
        <div class="curso-data">
            <p>
                <span class="font-weight-bold text-primary">Categoria: </span>    
                {{$curso->categoriaCurso->nombre}}
            </p>

             <p>
                <span class="font-weight-bold text-primary">Autor: </span>    
                {{$curso->autorCurso->name}}
            </p>

            <p>
                <span class="font-weight-bold text-primary">Fecha: </span>    
                {{date('d-m-Y', strtotime($curso->created_at))}} 
            </p>
        
        </div class="descripcion">
            <h2 class="my-3 text-primary">Descripci&oacute;n</h2>
            {!!$curso->descripcion!!}

        <div>

         </div class="contenido">
            <h2 class="my-3 text-primary">Contenido</h2>
            {!!$curso->contenido!!}

           <div>
               
        </div>
          <diV class="justify-content-center row text-center">
               <like-button curso-id="{{$curso->id}}" like="{{$like}}"  likes="{{$likes}}" ></like-button>
          </div> 
        {{-- {{$likes}} --}}
        </article>

@endsection