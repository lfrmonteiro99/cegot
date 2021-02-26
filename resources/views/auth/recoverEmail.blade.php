@extends('layout.index')

@section('content')
<div class="container login-container login-page" style="z-index: 100000000; height: 100%">
    <div class="row" style="height: 100%">
        <div class="col-12" style="height: 100%">
            <div class="container" style="height: 100%">
                <div class="row" style="height: 100%">
                    <div class="col-sm-5 col-12 mx-auto my-auto justify-content-center" style="z-index: 99999999">
                        <form action="{{route('submitEmailRecovery')}}" method="post">
                            @csrf
                            <div class="card card-login login-form">
                                <div class="card-header text-center" data-background-color="primary">
                                    <h4 class="card-title">Recuperação de password</h4>
                                </div>
                                <div class="card-content">
                                    @if(Session::has('message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{Session::get("message")}}
                                    </div>
                                    @endif
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                        <div class="form-group label-floating is-empty">
                                            <input class="form-control" type="email" placeholder="Email" required name="email" id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">
                                        Enviar
                                    </button>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('login')}}"><span class="fas fa-arrow-left" style="margin-right: 8px"></span>Voltar atrás</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('auth.slideshow')
@endsection