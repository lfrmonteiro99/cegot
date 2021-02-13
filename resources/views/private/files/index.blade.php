@extends('private._layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <table id="files_list" class="table table-striped" style="width:100%">
                        <thead>
                            <th>Name</th>
                            <th><a data-bs-toggle="tooltip" id="open-modal" data-bs-placement="bottom" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor: pointer" title="Upload new file"><i class="material-icons">add</i></a></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form action="/private/file/uploadFile" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card p-5">
                            <input type="file" id="doc" name="doc" />
                        </div>
                        <button class="btn btn-primary pull-right">Submit</button>
                        <a class="btn btn-danger pull-right" data-bs-dismiss="modal">Close</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    @if(Session::has('message'))
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
    @endif

    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    })


    $("#open-modal").click(function() {
        myModal.show();
    })
    let table;
    $(function() {
        table = $('#files_list').DataTable({
            language: {
                url: 'en',
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route("private.files.getIndexTable") !!}',
            columns: [{
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    width: "5%"
                },
            ],
            order: [
                ['0', 'asc']
            ]
        });
    });

    function removeConfirmation(path) {
        alert(1);
        bootbox.confirm("Are you sure you want to remove this file?", function(result) {
            if (result) {
                $.ajax({
                    url: "/private/file/delete",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        path
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            table.ajax.reload()
                            toastr.success('File deleted successfully!', {
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
                        toastr.error('File delete unsuccessful!', {
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