@extends('frontend.main_master')
@section('main')


 <!-- Inner Banner -->
 <div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href=    "{{url('/')}}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Room Details </li>
            </ul>
            <h3>{{$roomdetails->roomtype->name}}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->
<!-- Room Details Area End -->
<div class="room-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form action="{{url('/')}}">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="text" required name="check_in" class="form-control dt_picker" placeholder="yyy/mm/dd" disabled> 
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="text" required name="check_out" class="form-control dt_picker" placeholder="yyy/mm/dd" disabled>
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control" name="person" id="number_person" disabled>
                                         
                                         @for ($i = 1; $i <= 4; $i++)
                                         <option value="0{{$i}}" {{ old('person') == "0{$i}" ? 'selected' : '' }}>0{{$i}}</option>
                                         @endfor
                                           
                                        </select>	
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                   <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control number_of_room" name="number_of_room" id="select_room" disabled>
                                            @for ($i = 1; $i <= 5; $i++)
                                            <option value="0{{$i}}">0{{$i}}</option>
                                            @endfor
                                        </select>	
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">                                
                                        Check Availability                         
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                  
                </div>
            </div>
            <div class="col-lg-8">
                <div class="room-details-article">
                    <div class="room-details-slider owl-carousel owl-theme">
                        
                        @foreach ( $multiImage as $m_image )
                            

                        <div class="room-details-item">
                            <img src="{{asset('upload/roomImg/multiImg/'. $m_image->multi_img)}}" alt="Images">
                        </div>

                        @endforeach


                    </div>
                    <div class="room-details-title">
                        <h2>{{$roomdetails->roomtype->name}}</h2>
                        <ul>
                            
                            <li>
                               <b> Basic : ${{$roomdetails->price}}/Night/Room</b>
                            </li> 
                         
                        </ul>
                    </div>
                    <div class="room-details-content">
                        <p>
                            {{ $roomdetails->description }}
                        </p>
<div class="side-bar-plan">
                        <h3>Basic Plan Facilities</h3>
                        <ul>
                            @foreach ( $facility as $facilities )
                                
                            <li><a href="#">{{$facilities->facility_name}}</a></li>

                            @endforeach

                        </ul>
                        
                    </div>
<div class="row"> 
<div class="col-lg-6">
<div class="services-bar-widget">
                        <h3 class="title">Room Details</h3>
<div class="side-bar-list">
    <ul>
       <li>
            <a href="#"> <b>Capacity : </b> {{ $roomdetails->room_capacity }} Person <i class='bx bxs-cloud-download'></i></a>
        </li>
        <li>
             <a href="#"> <b>Size : </b>{{ $roomdetails->size }}<i class='bx bxs-cloud-download'></i></a>
        </li>
       
       
    </ul>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="services-bar-widget">
<h3 class="title">Room Details</h3>
<div class="side-bar-list">
    <ul>
       <li>
            <a href="#"> <b>View : </b> {{ $roomdetails->view }} <i class='bx bxs-cloud-download'></i></a>
        </li>
        <li>
             <a href="#"> <b>Bad Style : </b>{{ $roomdetails->bed_style }} <i class='bx bxs-cloud-download'></i></a>
        </li>
         
    </ul>
</div>
</div> 
            </div> 
                </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details Area End -->
<!-- Room Details Other -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Other Rooms</h2>
        </div>

        <div class="row ">

            @foreach ($otherRooms as $item)             

            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                    <img src="{{ asset( 'upload/roomImg/'.$item->image ) }}" alt="Images">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                    <h6><a href="{{route('room.details', $item->id)}}">{{ $item['roomtype']['name'] }}</a></h6>
                                </h3>
                                <span>{{ $item->price }} / Per Night </span>
                               
                                <p>{{ $item->short_desc }}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> {{ $item->room_capacity }} Person</li>
                                    <li><i class='bx bx-expand'></i> {{ $item->size }}ft2</li>
                                </ul>
                                <ul>
                                    <li><i class='bx bx-show-alt'></i>{{ $item->view }}</li>
                                    <li><i class='bx bxs-hotel'></i> {{ $item->bed_style }}</li>
                                </ul>
                                
                                <a href="{{url('/')}}" class="book-more-btn">
                                    Check Availability
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
        </div>
    </div>
</div>
<!-- Room Details Other End -->


@endsection