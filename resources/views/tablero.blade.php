@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
@endsection
@section('content')

@switch(Auth::user()->rol)
    @case( 'Supervisor' )
    <div class="card-columns">
        <div class="card">
          <a href="/Usuarios">
            <img class="card-img-top" src="/fotos/usuarios.png" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Usuarios registrados</h5>
              <p class="card-text">Clientes: {{$clientes ?? ''}} </p>
              <p class="card-text">Empleados: {{$empleados}}</p>
            </div>
        </div>

        <div class="card">
          <a href="/Productos">
            <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Productos</h5>
              <p class="card-text">Registrados: {{$productos}}</p>
              <p class="card-text">Concesionados: {{$concesionados}}</p>
            </div>
          </div>

          <div class="card">
            <a href="/Categorias">
            <img class="card-img-top" src="/secciones/categorias.png"  height="300" alt="Card image cap">
            </a>
            <div class="card-body">
              <h5 class="card-title">Categorias</h5>
              <p class="card-text">Registradas: {{$categorias}} </p>
            </div>
          </div>
      </div>
        @break
    @case('Encargado')
    <div class="card-columns">
      <div class="card">
        <a href="/Revisiones">
          <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Propuestas</h5>
            <p class="card-text">
              A revisar: {{$propuestas ?? ''}}
            </p>
          </div>
      </div>

      <div class="card">
        <a href="/Preguntas">
          <img class="card-img-top" src="/prods/preguntas.png"  height="300" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Dudas</h5>
            <p class="card-text">
              Preguntas por revisar: {{$preguntas ?? '' ?? ''}}
            </p>
            <p class="card-text">
              Respuestas por revisar: {{$respuestas ?? ''}}
            </p>
          </div>
      </div>

    </div>
      @break
    @case('Contador')
        dash del Contador    
        @break
    @case('Cliente')
    <div class="card-columns">

      <div class="card">
        <a href="/Productos">
          <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Productos</h5>
            <p class="card-text">Registrados: {{$productos ?? ''}}</p>
            <p class="card-text">Concesionados: {{$concesionados ?? ''}}</p>
          </div>
        </div>

        <div class="card">
          <a href="/Preguntas">
            <img class="card-img-top" src="/prods/preguntas.png"  height="300" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Dudas</h5>
              <p class="card-text">
                Preguntas por contestar: {{$preguntas ?? ''}}
              </p>
              <p class="card-text">
                Respuestas recibidas: {{$respuestas ?? ''}}
              </p>
            </div>
        </div>
  
        
    </div>
      @break
    
@endswitch

        

@endsection