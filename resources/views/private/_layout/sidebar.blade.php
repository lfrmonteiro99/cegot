<div class="sidebar" data-active-color="primary" data-background-color="black" data-image="https://source.unsplash.com/1600x900/weekly?nature">
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            C
        </a>
        <a href="/" class="simple-text logo-normal">
            CEGOT
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="https://admin.cegot.pt/img/default_avatar.png">
            </div>
            <div class="info">
                <a data-toggle="collapse" class="collapsed" aria-expanded="false">
                    <span>
                        {{GET_USER_NAME()}}
                    </span>
                </a>
                <div class="clearfix"></div>
                
            </div>
        </div>
        <ul class="nav">
            <li style="width: 100%">
                <a href="{{url('private/user/index')}}">
                    <i class="material-icons"> supervisor_account </i>
                    <p> Users </p>
                </a>
            </li>
            <li style="width: 100%">
                <a href="{{url('private/files/index')}}">
                    <i class="material-icons"> insert_drive_file </i>
                    <p> Files </p>
                </a>
            </li>
        </ul>
    </div>
</div>