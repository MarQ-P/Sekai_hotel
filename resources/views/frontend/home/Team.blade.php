@php
    
$team = App\Models\Team::latest()->get();

@endphp

<div class="team-area-three pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">TEAM</span>
            <h2>Let's Meet Up With Our Special Team Members</h2>
        </div>
        <div class="team-slider-two owl-carousel owl-theme pt-45">
@foreach ( $team as $item )
  
            <div class="team-item">
                <a href="team.html">
                    <img src="{{asset($item->image)}}" alt="Images">
                </a>
                <div class="content">
                    <h3><a href="team.html">{{$item->name}}</a></h3>
                    <span>{{$item->position}}</span>

                </div>
            </div>     
          
@endforeach

</div>

    </div>
</div>