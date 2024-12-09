@php
    
$rooms =  App\Models\Room::latest()->limit(4)->get();

@endphp

<div class="room-area pt-100 pb-70 section-bg" style="background-color:#ffffff">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms & Rates</h2>
        </div>
        <div class="row pt-45">

            @foreach ($rooms as $room )
                

            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="{{route('room.details', $room->id)}}">
                                    <img src="{{asset('upload/roomImg/'.$room->image)}}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                 <h3>
                                    {{-- //naka establish naman ila relation sa room and roomtypes --}}
                                     <a href="{{route('room.details', $room->id)}}">{{$room['roomtype']['name']}}</a>
                                </h3>
                                <span>{{$room->price}} / Per Night </span>
                           
                                <p>{{$room->short_desc}}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i>{{$room->room_capacity}}</li>
                                    <li><i class='bx bx-expand'></i> {{$room->size}}</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> {{$room->view}}</li>
                                    <li><i class='bx bxs-hotel'></i> {{$room->bed_style}}</li>
                                </ul>
                                
                                <a class="book-more-btn" id="scrollToTopBtn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
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