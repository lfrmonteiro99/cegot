@extends('private._layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <table id="users_list" class="table table-striped" style="width:100%">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created at</th>
                            <th><a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create new user" href="{{url('/private/user/create')}}"><i class="material-icons">add</i></a></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

    let table;
    $(function() {
        table = $('#users_list').DataTable({
            language: {
                url: 'en',
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route("private.userList") !!}',
            columns: [{
                    data: 'id',
                    name: 'number',
                    width: "20px"
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    width: "10%"
                },
            ],
            order: [
                ['2', 'asc']
            ]
        });
    });

    function removeConfirmation(id) {
        bootbox.confirm("Are you sure you want to remove this user?", function(result) {
            if (result) {
                $.ajax({
                    url: "/private/user/delete/" + id,
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            table.ajax.reload()
                            toastr.success('User deleted successfully!', {
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
                        }

                    },
                    error: function(error) {
                        toastr.error('User delete unsuccessful!', {
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
                        });
                    }
                });
            }
        });
    }
</script>
@endsection