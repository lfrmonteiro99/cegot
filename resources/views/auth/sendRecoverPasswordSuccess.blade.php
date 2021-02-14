@extends('layout.index')

@section('content')
<div class="container login-container login-page" style="z-index: 100000000; height: 100%">
  <div class="row" style="height: 100%">
    <div class="col-12" style="height: 100%">
      <div class="container" style="height: 100%">
        <div class="row" style="height: 100%">
          <div class="col-sm-5 col-12 mx-auto my-auto justify-content-center" style="z-index: 99999999">
            <div class="card">
                <div class="my-auto">
                    You will receive an email with instructions to recover your password.
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