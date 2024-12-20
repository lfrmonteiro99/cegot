@extends('layout.index')

@section('content')
<div class="container login-container login-page" style="z-index: 100000000; height: 100%">
    <div class="row" style="height: 100%">
        <div class="col-12" style="height: 100%">
            <div class="container" style="height: 100%">
                <div class="row" style="height: 100%">
                    <div class="col-sm-5 col-12 mx-auto my-auto justify-content-center" style="z-index: 99999999">
                        <form action="{{url('/recovery-password')}}" method="post">
                            @csrf
                            <input type="hidden" name="code" value="{{$user->recovery_code}}" />

                            <div class="card card-login login-form">
                                <div class="card-header text-center" data-background-color="primary">
                                    <h4 class="card-title">Recuperação de password</h4>
                                </div>
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                                        <div class="form-group label-floating is-empty">
                                            <input class="form-control" type="password" placeholder="Password" required name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                                        <div class="form-group label-floating is-empty">
                                            <input class="form-control" type="password" placeholder="Confirm Password" required name="confirm_password" id="confirm_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">
                                        Submeter
                                    </button>
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

@section('scripts')
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords não coincidem");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
@endsection
