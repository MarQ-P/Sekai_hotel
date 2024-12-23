@extends('frontend.main_master')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Sign In</li>
                    </ul>
                    <h3>Sign In</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Sign In Area -->
        <div class="sign-in-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-all-form">
                            <div class="contact-form">
                                <div class="section-title text-center">
                                    <span class="sp-color">Sign In</span>
                                    <h2>Sign In to Your Account!</h2>
                                </div>


                                  <form method="POST" action="{{ route('login') }}">
                                      @csrf

            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <input type="text" name="login" id="login" placeholder="Email/Phone/Username" class="form-control @error('login') is-invalid @enderror" 
                                                id="login" >
                                   @error('login')
                                        <span class="text-danger"> {{ $message }}  </span>
                                    @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>

                              
            
                                        <div class="col-lg-12 col-sm-6">
                                            <a class="forget" href="{{route ('password.request')}}">Forgot My Password?</a>
                                        </div>
        
                                        <div class="col-lg-12 col-md-12 text-center">
                                            <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                                Sign In Now
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <p class="account-desc">
                                                Not a Member?
                                                <a href="{{route('register')}}">Sign Up</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In Area End -->

@endsection