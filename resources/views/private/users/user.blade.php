@extends('private._layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="primary">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">
                            @if(isset($show))
                            Show User Information
                            @elseif(isset($create))
                            Create User
                            @endif
                        </h4>
                        @if(isset($user))
                        <form action='{{ route("private.userUpdate", ["id" => $user->id])}}' method="POST">
                            @else
                            <form action='/private/user/store' method="POST">
                                @endif
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput0" class="form-label">Name</label>
                                    <input type="text" required name="name" class="form-control px-3" id="name" @if(isset($user)) value="{{$user->name}}" @endif>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" name="email" required class="form-control px-3" id="exampleFormControlInput1" @if(isset($user)) value="{{$user->email}}" @endif >
                                </div>

                                <div class="form-group mb-3">

                                    <label for="role" class="form-label">Type/Role of User</label>
                                    <select class="form-control" name="role" id="role">
                                        <option disabled @if(!isset($user->role)) selected @endif>-- Select Option --</option>
                                        <option @if(isset($user) && $user->role == 'user') selected @endif value="user">User</option>
                                        <option @if(isset($user) && $user->role == 'admin') selected @endif value="admin">Admin</option>
                                    </select>
                                    
                                    @if(isset($create))
                                    <button class="btn btn-primary pull-right">Create</button>
                                    @endif
                                    @if(isset($show))
                                    <button class="btn btn-primary pull-right">Update</button>

                                    @endif
                                    <a href="/private/user/index" class="btn btn-danger pull-right">Cancelar</a>
                                    @if(!isset($show))
                            </form>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
@if(Session::has('message'))

<script>
    toastr.success('{{Session::get("message")}}', {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    })
</script>
@endif
@endsection