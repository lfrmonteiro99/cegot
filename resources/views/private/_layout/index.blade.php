<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/style1.css">
    <link rel="stylesheet" href="/css/style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/17923f3e88.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/ju/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>


    <link rel="stylesheet" href="/css/toastr/toastr.min.css">
    <script type="text/javascript" src="/js/toastr/toastr.min.js"></script>


    @yield('header_scripts')
    @yield('header_styles')
</head>

<body class="">
    @include('private._layout.header')
    @include('private._layout.sidebar')


    <div class="main-panel" style="">
        <div class="container-fluid">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon pull-left">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
            <div class="dropdown pull-right icon-right-backoffice">
            <a href="#" class="icon-right-backoffice-link"><i class="material-icons">person</i></a>
            <ul class="dropdown-menu logout-menu mt-3">
                        <li>
                            <a href="https://admin.cegot.pt/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            <div class="ripple-container"></div></a>

                            <form id="logout-form" action="https://admin.cegot.pt/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="dTOIyfjp66nf1N4ICjpCrwthLWFK3DeWPSMy9yHC">
                            </form>
                        </li>

                    </ul>
            </div>

        </div>
    @yield('content')
    </div>

    </div>
    @yield('scripts')
    <script>
        $(document).on('click', '#minimizeSidebar', function() {
            if (!$('body').hasClass('sidebar-mini'))
                $('body').addClass('sidebar-mini')
            else
                $('body').removeClass('sidebar-mini')
        })

        $(document).on('click', '.icon-right-backoffice', function(){
            if(!$(".logout-menu").hasClass('visible'))
            $(".logout-menu").addClass('visible');
            else
            $(".logout-menu").removeClass('visible');
        })
    </script>
</body>

</html>
