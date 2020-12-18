@extends('layout.general')

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/agregar" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del usuario:</label>
        <input id="nombre" type="text" name="nombre" class="form-control">
    </div>
    <div class="form-group">
        <label for="a_paterno">Apellido paterno del usuario:</label>
        <input id="a_paterno" type="text" name="a_paterno" class="form-control">
    </div>
    <div class="form-group">
        <label for="a_materno">Apellido materno del usuario:</label>
        <input id="a_materno" type="text" name="a_materno" class="form-control">
    </div>
    <div class="form-group">
        <label for="imagen">Imagen del usuario:</label>
        <input type="file" name="imagen" id="imagen">
    </div>
     <div class="form-group">
        <label for="email">Correo electronico:</label>
        <input type="email" name="email" id="email">
        <span id="error_email"></span>
    </div>
    <div class="form-group">
        <label for="password">Password del usuario:</label>
        <input id="password" type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password2">Repita el password:</label>
        <input id="password2" type="password" name="password2" class="form-control">
    </div>
    <input type="submit" class="btn btn-primary" value="Registrarse">    
</form>

<script>
    $(document).ready(function(){

    $('#email').blur(function(){
        var error_email = '';
        var email = $('#email').val();
        var _token = $('input[name="_token"]').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if($.trim(email).length > 0)
        {
            if(!filter.test(email))
            {
                $('#error_email').html('<label class="bg-danger text-white"><i class="fas fa-times"></i> Correo invalido.Ingrese un correo Valido</label>');
                $('#email').addClass('has-error');
                $('#register').attr('disabled', 'disabled');
            }
            else
            {
                $.ajax({
                    url:"{{route('register.check') }}",
                    method:"POST",
                    data:{email:email, _token:_token},
                    success:function(result)
                    {
                        if(result == 'unique')
                        {
                            $('#error_email').html('<label class="bg-success text-white"><i class="fas fa-check"></i>Quiero usar mi dirección actual de correo electrónico</label>');
                            $('#email').removeClass('has-error');
                            $('#register').attr('disabled', false);
                        }
                        else
                        {
                            $('#error_email').html('<label class="bg-danger text-white"><i class="fas fa-times"></i>Ya existe una cuenta de tienda ittg con esta dirección de correo electrónico</label>');
                            $('#email').addClass('has-error');
                            $('#register').attr('disabled', 'disabled');                        
                        }
                    }
                })
            }
        }
        else
        {
            $('#error_email').html('<label class="bg-warning text-dark"><i class="fas fa-times"></i>Este campo es obligatorio</label>');
            $('#email').addClass('has-error');
            $('#register').attr('disabled', 'disabled');               
        }
    }); 

    });
</script>

@endsection