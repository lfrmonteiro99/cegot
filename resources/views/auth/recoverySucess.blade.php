@extends('layout.index')

@section('content')
<div class="container login-container login-page" style="z-index: 100000000; height: 100%">
    <div class="row" style="height: 100%">
        <div class="col-12" style="height: 100%">
            <div class="container" style="height: 100%">
                <div class="row" style="height: 100%">
                    <div class="col-sm-5 col-12 mx-auto my-auto justify-content-center" style="z-index: 99999999">
                        <div class="card card-login login-form">
                            <div class="card-header text-center" data-background-color="primary">
                                <h4 class="card-title">Recuperação de password</h4>
                            </div>
                            <div class="card-content">

                                <div class="input-group">
                                    <p>A sua password foi mudada com sucesso.</p>
<p>Caso queira aceder ao site do CEGOT, carregue <a target="_blank" href="https://www.cegot.pt">aqui</a></p>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('login')}}"><span class="fas fa-arrow-left" style="margin-right: 8px"></span>Efetuar login</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('auth.slideshow')
@endsection
