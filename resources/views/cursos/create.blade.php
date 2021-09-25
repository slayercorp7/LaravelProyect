@extends('layouts.app')
 <!--Estilos--> 
 @section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" 
  integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

 @endsection
 

 @section('botones')
    @include('ui.listacurso')
  @endsection  

@section('content') 

    <h2 class="text-center mb-3">Crear nuevo Curso </h2>       
    <div  class="mt-5">
        <div class="cold-md-8">
            <form method="POST"  action={{route("cursos.store")}} enctype="multipart/form-data" novalidate>
            @csrf              


                <div class="form-group">
                    <label for="nombre">Nombre Curso</label>
                    <input type="text"  name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                    id="nombre" placeholder="Nombre Curso" value={{old('nombre')}}>
                    @error('nombre')

                       <span class="invalid-feeback d-block" role="alert">
                        <strong>{{$message}}</strong>
                       </span>    


                    @enderror
                </div>
                
                <div class='form-group'>
                    <label for="nombre">Categoria</label>
                    <select name= "categoria" class="form-control @error('categoria') is-invalid @enderror" id="categoria">
                        <option value="" disabled selected >--Seleccione--</option>
                    @foreach($categorias as  $categoria )
                        <option value={{$categoria->id}}  {{old('categoria')==$categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                    @endforeach
                                            
                    </select>

                     @error('categoria')

                       <span class="invalid-feeback d-block" role="alert">
                        <strong>{{$message}}</strong>
                       </span>    


                    @enderror
                </div>
                        <!--descripcion--> 
                    <div class="form-group mt-3" >
                        <label for="descripcion">Descripci&oacute;n</label>
                        <input id="descripcion" type="hidden" name="descripcion"  value={{old('descripcion')}}>
                        <trix-editor 
                        class="form-control @error('descripcion') is-invalid @enderror"
                         input="descripcion"></trix-editor>

                         @error('descripcion')

                            <span class="invalid-feeback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>    


                        @enderror

                    </div>    
                        <!--contenido--> 
                     <div class="form-group mt-3">
                        <label for="contenido">Contenido</label>
                        <input id="contenido" type="hidden" name="contenido"  value={{old('contenido')}}>
                        <trix-editor 
                        class="form-control @error('contenido') is-invalid @enderror"
                         input="contenido"></trix-editor>

                        @error('contenido')

                            <span class="invalid-feeback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>    


                        @enderror

                    </div>  
                            <!--Imagen--> 
                        <div class="form-group mt-3" >
                            <label for="imagen">Imagen</label>
                            <input id="imagen" type="file" class="form-control @error('contenido') is-invalid @enderror" name="imagen" >

                            @error('imagen')

                                <span class="invalid-feeback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>    


                             @enderror
                        </div>

                <div class="form-group">
                    
                    <input type="submit" class="btn btn-success" value="Agregar Curso" >
                </div>


            
            </form>
    
       </div>
    
    </div>
@endsection 

<!--Scrip--> 
 @section('script')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
  integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

 @endsection 

