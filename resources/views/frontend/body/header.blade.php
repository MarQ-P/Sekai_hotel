<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
       

            <div class="col-lg-9 col-md-10">
                <div class="header-right">
                    <ul>
                        <li>
                            <i class='bx bx-home-alt'></i>
                            <a href="#"> Blueberry St., Buhangin District, Davao City, Philippines</a>
                        </li>
                        <li>
                            <i class='bx bx-phone-call'></i>
                            <a href="tel:+1-(123)-456-7890">09127574250</a>
                        </li>
@auth
    
<li>
    <i class='bx bxs-user-pin'></i>
    <a href="{{route('dashboard')}}">Dashboard</a>
</li>
<li>
    <i class='bx bxs-user-rectangle'></i>
    <a href="{{route('user.logout')}}">LogOut</a>
</li>

@else

<li>
    <i class='bx bxs-user-pin'></i>
    <a href="{{route('login')}}">Login</a>
</li>
<li>
    <i class='bx bxs-user-rectangle'></i>
    <a href="{{route('register')}}">Register</a>
</li>

@endauth


                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>