@extends('layout.index')

@section('content')
<div class="container login-container" style="z-index: 100000000">
<div class="row">
<div class="col-12">
<div class="container">
<div class="row">
<div class="col-4 mx-auto justify-content-center">
<form action="{{url('verifyLogin')}}" method="post">
@csrf 
    <div class="login-form">
<div class="form-group">
<label for="email">Email</label>
<input class="form-control" type="email" required name="email" id="email">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" id="password">
</div>
<div class="form-group mt-3">
    <button class="btn btn-success" style="width: 100%">
        Login
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
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" style="max-height: 100vh">
    <div class="carousel-item active">
      <img height="100%" src="/images/letras_coimbra.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/letras_coimbra.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/letras_coimbra.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>


@endsection