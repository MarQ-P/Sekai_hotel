@extends('frontend.main_master')
@section('main')

<!-- Banner Area -->
 <div class="banner-area" style="height: 480px;">
    <div class="container">
        <div class="banner-content">
            <h1>Discover a Hotel & Resort to Book a Suitable Room</h1>
            
             
        </div>
    </div>
</div>
<!-- Banner Area End -->

<!-- Banner Form Area -->
<div class="banner-form-area">
    <div class="container">
        <div class="banner-form">
            <form method="get" action="{{route('booking.search') }}">

                
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK IN TIME</label>
                            <div class="input-group">
                                
<input autocomplete="off" type="text" required name="check_in" class="form-control dt_picker" placeholder="yyy/mm/dd">

                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK OUT TIME</label>
                            <div class="input-group">

<input autocomplete="off" type="text" required name="check_out" class="form-control dt_picker" placeholder="yyy/mm/dd">

                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label>GUESTS</label>
                            <select name="person" class="form-control">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                            </select>	
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <button type="submit" class="default-btn btn-bg-one border-radius-5">
                            Check Availability
                        </button>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- Banner Form Area End -->

<!-- Room Area -->
@include('frontend.home.room_area')
<!-- Room Area End -->

<!-- Book Area Two-->
@include('frontend.home.room_area_two')
<!-- Book Area Two End -->

<!-- Services Area Three -->
@include('frontend.home.services')
<!-- Services Area Three End -->

<!-- Team Area Three -->
@include('frontend.home.Team')
<!-- Team Area Three End -->

<!-- Testimonials Area Three -->
@include('frontend.home.testimonials')
<!-- Testimonials Area Three End -->

<!-- FAQ Area -->
@include('frontend.home.faq')
<!-- FAQ Area End -->

{{-- <!-- Blog Area -->
<div class="blog-area pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">BLOGS</span>
            <h2>Our Latest Blogs to the Intranational Journal at a Glance</h2>
        </div>
        <div class="row pt-45">
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <a href="blog-details.html">
                        <img src="assets/img/blog/blog-item-img1.jpg" alt="Images">
                    </a>
                    <div class="content">
                        <ul>
                            <li>October 01, 2020</li>
                            <li><i class='bx bx-user'></i>29K</li>
                            <li><i class='bx bx-message-alt-dots'></i>15K</li>
                        </ul>
                        <h3>
                            <a href="blog-details.html">Hotel Management is the Best Policy</a>
                        </h3>
                        <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                        <a href="blog-details.html" class="read-btn">
                            Read More
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <a href="blog-details.html">
                        <img src="assets/img/blog/blog-item-img2.jpg" alt="Images">
                    </a>
                    <div class="content">
                        <ul>
                            <li>October 07, 2020</li>
                            <li><i class='bx bx-user'></i>22K</li>
                            <li><i class='bx bx-message-alt-dots'></i>24K</li>
                        </ul>
                        <h3>
                            <a href="blog-details.html">3d Hotel Models Have an Important Model</a>
                        </h3>
                        <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                        <a href="blog-details.html" class="read-btn">
                            Read More
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3">
                <div class="blog-item">
                    <a href="blog-details.html">
                        <img src="assets/img/blog/blog-item-img3.jpg" alt="Images">
                    </a>
                    <div class="content">
                        <ul>
                            <li>October 17, 2020</li>
                            <li><i class='bx bx-user'></i>27K</li>
                            <li><i class='bx bx-message-alt-dots'></i>39K</li>
                        </ul>
                        <h3>
                            <a href="blog-details.html">Hotel Management Has a Good Future Era</a>
                        </h3>
                        <p>This is one of the best & quality full hotels in the world that will help you to make an excellent study market.</p>
                        <a href="blog-details.html" class="read-btn">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area End --> --}}
@endsection