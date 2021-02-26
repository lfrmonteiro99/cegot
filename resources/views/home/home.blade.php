@extends('layout.index')

@section('content')
<div class="container-fluid" style="height: 70%">
    <div class="row">
        <div class="col-6">
            <div class="d-flex">
                <a class="hamburger-bar"><i class="fas fa-bars fa-2x"></i></a>
            </div>
        </div>
        <div class="col-6">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-dropdown-user btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{GET_USER_NAME()}}
                    </button>
                    <ul class="dropdown-menu">
                        @if(IS_ADMIN())
                        <li><a href="/private">Administração</a></li>
                        @endif
                        <li><a href="/logout">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="container-fluid">
                <div class="row files-folder pt-5" style="background: white;">
                    @php
                    try{
                    $currentPath = storage_path().'/app/public';

                    $directories = scandir($currentPath);
                    @endphp

                    @foreach($directories as $i => $directory)
                    @if($directory != '.' && $directory != '..' && $directory != '.gitignore' && $directory != 'download.zip')
                    @if(is_dir($currentPath."/".$directory) && $directory != '.' && $directory != '..' && $directory != '.gitignore')
                    <div class="col-sm-3 col-12">
                        <div class="folder" data-current="{{$currentPath}}" data-path="{{$currentPath}}/{{$directory}}">
                            <span><i class="far fa-folder fa-2x"></i></span>
                            <p>{{$directory}}</p>
                        </div>
                    </div>
                    @else
                    <?php
                    $explode = explode(".", $directory);
                    $extension = end($explode);
                    ?>
                    <div class="col-sm-3 col-12">
                        <div class="file" data-name="{{$directory}}" data-path="{{$currentPath}}/{{$directory}}">
                            <?php
                            $url = $currentPath . "/" . $directory;
                            ?>
                            @if($extension == 'doc' || $extension == 'docx')
                            <span><i class="far fa-file-word fa-2x"></i></span>
                            @elseif($extension == 'pdf')
                            <span><i class="far fa-file-pdf fa-2x"></i></span>
                            @elseif($extension == 'xls' || $extension == 'xlsx' || $extension == 'xls' || $extension == 'csv')
                            <span><i class="far fa-file-excel fa-2x"></i></span>
                            @else
                            <span><i class="far fa-file fa-2x"></i></span>
                            @endif
                            <p>{{$directory}}</p>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                    @php
                    }catch(\Exception $e){
                    dd($e->getMessage(), $e->getLine());
                    }
                    @endphp
                </div>
            </div>

        </div>

    </div>

</div>




<div class="data-to-download">
    <i class="far fa-window-close pull-right"></i>
    <h3>Ficheiros seleccionados</h3>
    <div class="list-downloads mt-3"></div>
</div>

<div style="box-shadow: 0 10px 30px -12px rgba(0,0,0,.42),0 4px 25px 0 rgba(0,0,0,.12),0 8px 10px -5px rgba(0,0,0,.2); text-align: center; position: fixed; bottom: 0; height: 25%; background: white; width: 100%">
    <h3>Ficheiros para descarregar</h3>
    <div class="downloads mt-3"></div>
    <p class="open-panel hidden">Para listar os ficheiros seleccionados, clique <a class="open-panel-link">aqui</a>.</p>
    <div class=""><button class="btn btn-download">Descarregar ficheiros</button></div>
</div>
@endsection

@section('scripts')
<script>
    let current;

    let folders = $(".folder");
    let files = $(".file")

    let downloads = [];
    let downloadsPath = [];

    let total = 0;

    updateListToDownload();

    $(".hamburger-bar").click(function() {
        if ($(".data-to-download").hasClass('open')) {
            $(".data-to-download").removeClass('open')

        } else {
            $(".data-to-download").addClass('open')
            $(".data-to-download").css("left", 0);
            $(".fa-window-close").css('opcity', "1");
            $(".data-to-download").show()
        }
    })

    $(".open-panel-link").click(function() {
        $(".data-to-download").addClass('open')
        $(".data-to-download").css("left", 0);
        $(".fa-window-close").css('opcity', "1");
        $(".data-to-download").show()
    })

    $(".fa-window-close").click(function() {
        $(".data-to-download").removeClass('open')
        $(".data-to-download").css("left", -200)
        $(".data-to-download").hide()

    })

    $(document).on('click', '.file', function(e) {
        if (downloads.includes($(this).data('name'))) {
            $(this).find('.far').removeClass('selected')
            let index = downloads.indexOf($(this).data('name'));
            downloads.splice(index, 1);
            index = downloadsPath.indexOf($(this).data('path'));
            downloadsPath.splice(index, 1);
            total--;

            updateListToDownload();
            return;
        }
        total++;
        $(".open-panel").removeClass('hidden')
        downloads.push($(this).data('name'))

        downloadsPath.push($(this).data('path'))


        $(this).find('.far').addClass('selected')

        updateListToDownload();


    })



    function foo(path, current, callback) {
        $.ajax({
            url: "{{route('files')}}",
            method: 'post',
            myCallback: callback,
            data: {
                _token: "{{ csrf_token() }}",
                path,
                current
            },
            beforeSend: function() {},
            success: function(response) {
                let html = '';

                response.map(function(file) {
                    html += "<div class='col-3'>";
                    let pathToReturn = "'" + file.path + "'";
                    console.log(file);
                    if (file.folder && file.name != '.gitignore' && file.name != 'download.zip') {
                        console.log("um")
                        html += "<div class='folder' data-name='" + file.name + "' data-current='" + current + "' data-path='" + file.path + "'><span><i class='far fa-folder fa-2x'></i></span><p>" + file.name + "</p></div>";
                    } else {
                        console.log("dois")
                        if (file.name != '.gitignore' && file.name != 'download.zip') {
                            let splitted = file.name.split(".");
                            let className = "";
                            switch (splitted[1]) {
                                case 'docx':
                                    className = "far fa-file-word fa-2x";
                                    break;
                                case 'doc':
                                    className = "far fa-file-word fa-2x";
                                    break;
                                case 'xls':
                                    className = 'far fa-file-excel fa-2x';
                                    break;
                                case 'xlsx':
                                    className = 'far fa-file-excel fa-2x';
                                    break;
                                case 'xls':
                                    className = 'far fa-file-excel fa-2x';
                                    break;
                                case 'csv':
                                    className = 'far fa-file-excel fa-2x';
                                    break;
                                case 'pdf':
                                    className = 'far fa-file-pdf fa-2x';
                                    break;
                                default:
                                    className = 'far fa-file fa-2x';
                                    break;
                            }
                            html += "<div class='file' data-name='" + file.name + "' data-path='" + file.path + "'><span><i class='" + className + "'></i></span><p>" + file.name + "</p></div>";
                        }
                    }

                    html += "</div>";


                })
                this.myCallback(html)


            },
            error: function(error) {
                console.log(error)
            }
        });
    }



    $(document).on('click', '.folder', function(e) {
        let current = $(this).data('current')
        let path = $(this).data('path')

        foo(path, current, function(html) {
            console.log(html)
            console.log($(".folder"))

            $(".files-folder").html(html);

            folders = $(".folder")
            files = $(".file")

            console.log(folders);
        })

    });


    function clickFolder(current, path) {
        console.log(current, path);


    }

    function updateListToDownload() {
        let html = '';
        downloads.map(function(download) {
            html += "<p>" + download + "</p>";
        })

        $(".downloads").html(total + " files selected");

        $(".list-downloads").html(html)

        if (downloads.length === 0) {
            $(".downloads").html('Sem ficheiros seleccionados.')
            $(".list-downloads").html('Sem ficheiros seleccionados.')
            $(".open-panel").addClass('hidden')
        }
    }

    $(".btn-download").click(function() {
        if (total > 0) {
            $.ajax({
                url: "{{route('downloadFiles')}}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    downloadsPath
                },
                beforeSend: function() {},
                success: function(response) {


                    window.location = response;

                    downloads = [];
                    downloadsPath = [];
                    total = 0;

                    $(".files-folder").find('i').map(function(index, icon) {
                        $(icon).removeClass('selected');
                    })
                    updateListToDownload();

                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    })
</script>
@endsection