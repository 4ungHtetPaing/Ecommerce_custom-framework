<div class="container-fluid bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark px-5">
    <a class="navbar-brand text-white" href="{{url('/')}}">MY E-Commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link text-white" href="{{url('/admin')}}">Admin</a>
                    <a class="nav-item nav-link text-white" href="{{url('/cart')}}">Cart 
                        <span class="badge badge-danger badge-pill" style="position:relative;top:-6px;left:-3px" id="cart_count">0</span></a>
                    <a class="nav-item nav-link text-white" href="#">Contact</a>
                     <div class="dropdown">
                        <a class="nav-item nav-link text-white dropdown-toggle" href="#" id="" data-toggle="dropdown">
                            @if (\App\Classes\Auth::check("user_id"))
                                {{\App\Classes\Auth::user("user_name")}}
                            @else
                               SingUp
                            @endif
                        
                        </a>
                        <div class="dropdown-menu">
                            @if (\App\Classes\Auth::check("user_id"))
                                 <a class="dropdown-item" href="{{url('/user/logout')}}">LogOut</a>
                            @else
                                <a class="dropdown-item" href="{{url('/user/login')}}">Login</a>
                                <a class="dropdown-item" href="{{url('/user/register')}}">Register</a>
                            @endif
                       
                        </div>
                    </div>
                </div>
               
            </div>    </nav>
</div>