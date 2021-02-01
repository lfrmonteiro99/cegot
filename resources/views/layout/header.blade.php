<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @php
                $user = Auth::user();
                @endphp
                @if(!isset($user))
                <a class="btn btn-primary" href="{{ url('login') }}">
                    Login
</a>
@endif
            </div>
        </div>
    </div>
</header>