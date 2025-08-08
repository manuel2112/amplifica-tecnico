@extends('../layouts.login')
@section('title', 'Login')
@section('content')

    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Registro</h1>
                            <x-flash />
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('img/logo.jpg') }}" alt=""
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form action="{{ route('register_index_post') }}" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="nombre">Nombre: </label>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="correo">E-Mail: </label>
                                            <input type="text" name="correo" id="correo" class="form-control"
                                                value="{{ old('correo') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Contraseña: </label>
                                            <input type="password" name="password" id="password" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Repetir Contraseña: </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" />
                                        </div>
                                        <hr>
                                        <input type="submit" value="Registrarme" class="btn btn-primary" />
                                    </form>
                                </div>
                                <a href="{{ route('login_index') }}" title="Registrarme">
                                    Login
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
