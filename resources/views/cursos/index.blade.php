@extends('layouts.app')

  @section('botones')
    @include('ui.navegacion')
  @endsection  
  @section('nav')
  @endsection
   
  @section('content')
  <h2 class="text-center mb-3">Administra tus Cursos</h2>

    
  <div class="cold-md-10 mx-auto bg-white p-3">
    <table class="table">
    
          <thead class="bg-primary text-light">

            <tr>
                <th scole="col"><i class="fas fa-file-signature fa-lg"></i>Nombre</td>
                <th scole="col"><i class="fas fa-certificate fa-lg"></i>Categoria</td>
                <th scole="col"><i class="fas fa-exclamation-circle fa-lg"></i>Acciones</td>
            
            </tr>
                    
          </thead>

          <tbody>

           @foreach($userCursos as $userCurso)

               <tr>
                  <td>{{$userCurso->nombre}}</td>
                  <td>{{$userCurso->categoriaCurso->nombre}}</td>
                  <td>
                    <a href="{{route('cursos.show',['curso'=>$userCurso->id])}}" class="btn btn-success d-block"> <i class="far fa-eye"></i> Ver</a>
                    <a href="{{route('cursos.edit',['curso'=>$userCurso->id])}}" class="btn btn-dark  d-block mt-1"> <i class="fas fa-edit"></i>Editar </a>                    
                    <eliminar-curso cursoId={{$userCurso->id}}><i class="far fa-trash-alt"></i></eliminar-curso>
                    
                    
                    
                  </td>
              
              </tr>
             
           @endforeach
             
          
          </tbody>
    
    </table>
    <div class="cold-12 mt-4 justify-content-center d-flex">
    
      {{$userCursos->links()}}
    </div>
   {{--}} {{Auth::user()->ilike}} --}}

    {{--{{$ilikes}} --}}
    @if(count($iLikes)>0)
          
      <h2 class="text-center my-5">Cursos que te gustan</h2>
      <div class="col-md-10 mx-auto bg-white p-3">
            <ul class="list-group">
                @foreach($iLikes as $cursoLike)
                  <li class="list-group-item d-flex justify-center-between align-items-center">
                    <p>{{$cursoLike->nombre}}</p>
                    <a  class ="btn btn-dark " href="{{route('cursos.show',['curso'=>$cursoLike->id])}}">Ver</a>
                  </li>
                @endforeach
            </ul>
      </div>

    @else
      <p class="text-center my-5 font-weight-bold"> Aun no tienes cursos que te gustan</p>
    @endif
 </div>
 

@endsection  