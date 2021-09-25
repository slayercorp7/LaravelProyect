 @extends('layouts.app')

 @section('content')

    <div  class="container">
        <div class="row" >
            <div class="cold-md-5 " >
                <img  src="/cursos/storage/app/public/{{$perfil->imagen}}" class="w-50 rounded-circle" alt="imagen"> 
            </div>
            <div class="cold-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary">{{$perfil->perfilUser->name}}</h2>
                <h2>Usted tiene : {{count($userCursos)}} Cursos Creados</h2>
                <a href="{{$perfil->perfilUser->url}}"><h2>Visitar Sitio Web</h2></a>
                <div class="biografia">
                    <h3>{!!$perfil->biografia!!}</h3>
                </div>
                
            </div>
        </div>
    
    </div>
    <h2 class="text-center my-5"> cursos credos por : {{$perfil->perfilUser->name}}</h2>
    <div class="container">
        <div class="row mx-auto bg-white p-4">
            {{--veerificar informacion de las recetas--}}
            @if(count($userCursos)>0)
               @foreach($userCursos as $userCurso)
                    <div class="col-md-4 mb-4">
                         <div class="card">

                            <img src="/cursos/storage/app/public/{{$userCurso->imagen}}" class="card-img-top" alt="imagen Curso"> 
                            <div class="card-body">
                              <h3>{{$userCurso->nombre}}</h3>
                              <a href="{{route('cursos.show', ['curso'=>$userCurso->id])}}" class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">Ver curso</a>
                            </div>
                        </div>
                    </div>
               @endforeach
            @else   
              <p class="text-center w-100">No existe  cursos aún ... </p>
            @endif
                
        </div>

            <div class="d-flex justify-content-center">
                  {{$userCursos}}
            </div>
    </div>
              
 @endsection