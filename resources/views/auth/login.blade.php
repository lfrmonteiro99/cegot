@extends('layout.index')

@section('content')
<div class="container login-container login-page" style="z-index: 100000000; height: 100%">
  <div class="row" style="height: 100%">
    <div class="col-12" style="height: 100%">
      <div class="container" style="height: 100%">
        <div class="row" style="height: 100%">
          <div class="col-sm-5 col-12 mx-auto my-auto justify-content-center" style="z-index: 99999999">
            <form action="{{url('verifyLogin')}}" method="post">
              @csrf
              <div class="card card-login login-form">
                <div class="card-header text-center" data-background-color="primary">
                  <h4 class="card-title">Login</h4>
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
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                    <div class="form-group label-floating is-empty">
                      <input class="form-control" type="password" placeholder="Password" required name="password" id="password">
                    </div>
                  </div>
                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">
                    Log in
                  </button>
                </div>
                <div class="card-footer text-center">
                  <a href="{{route('password-recover-page')}}" type="submit" class="btn btn-default btn-simple btn-wd btn-sm">
                    Password Recovery
                    <div class="ripple-container"></div>
                  </a>
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