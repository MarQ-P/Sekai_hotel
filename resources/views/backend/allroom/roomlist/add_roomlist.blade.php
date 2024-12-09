@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Room List</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Room List</li>
							</ol>
						</nav>
					</div>
					 
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
						 
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-4">
                 
                
                <form method="POST" action="{{ route('store.roomlist') }}" class="row g-3" id="bk_form">
                    @csrf

        <div class="col-md-4">
            <label for="roomtype_id" class="form-label">Room Type</label>
            <select id="room_id" name="room_id" class="form-select">
                <option selected="">Select Room Type </option>
                @foreach ($roomtype as $item) 
                <option value="{{ $item->room->id }}" data-total-adult="{{ $item->room->total_adult }}" {{ collect(old('roomtype_id'))->contains($item->id) ? 'selected' : '' }} >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="input2" class="form-label">Checkin</label>
            <input type="date" name="check_in" class="form-control" id="check_in" >
        </div>
        <div class="col-md-4">
            <label for="input2" class="form-label">CheckOut</label>
            <input type="date" name="check_out" class="form-control " id="check_out" >
        </div>
        <div class="col-md-4">
            <label for="roomtype_id" class="form-label">Room</label>
            <input type="number" name="number_of_room" class="form-control" id="room_id" >

            <input type="hidden" name="available_room" id="available_room" class="form-control" >
            
            <div class="mt-2">
                <label for="">Availability: <span class="text-success availability"></span></label>
            </div>

        </div>
        <div class="col-md-4">
            <label for="input4" class="form-label">Guest</label>
            <input type="number" name="number_of_person" class="form-control" id="number_person" >

            <input type="hidden" id="total_adult" value="0">
        </div>

        

        <h3 class="mt-3 mb-3 text-center">Customer Information</h3>

        <div class="col-md-6">
            <label for="input5" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="input5" placeholder="name"  value="{{old('name')}}">
        </div>
      
        <div class="col-md-6">
            <label for="input8" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="input8" placeholder="Email" value="{{old('email')}}">
        </div>

        <div class="col-md-6">
            <label for="input5" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="input5" placeholder="Phone" value="{{old('phone')}}">
        </div>
      
        <div class="col-md-6">
            <label for="input8" class="form-label">Region</label>
            <input type="text" name="Region" class="form-control" id="input8" placeholder="Region" value="{{old('Region')}}">
        </div>

        <div class="col-md-6">
            <label for="input8" class="form-label">Province</label>
            <input type="text"  name="Province" class="form-control" id="input8" placeholder="Province" value="{{old('Province')}}">
        </div>

        <div class="col-md-6">
            <label for="input8" class="form-label">Zip</label>
            <input type="text" name="Zip" class="form-control" id="input8" placeholder="Zip" value="{{old('Zip')}}">
        </div>
       
        <div class="col-md-6">
            <label for="input8" class="form-label">City Municipality</label>
            <input type="text" name="City_Municipality" class="form-control" id="input8" placeholder="City Municipality" value="{{old('City_Municipality')}}">
        </div>

        <h3 class="mt-3 mb-3 text-center">Guests</h3>

        <div class="guests-container">
            @for ($i = 0; $i < 1; $i++)
            <div class="guest-row mb-3" data-guest-index="{{ $i }}">
                <div class="row">
                    <div class="col-md-8">
                        <label class="form-label">Name</label>
                        <input type="text" name="guests[{{ $i }}][name]" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Age</label>
                        <input type="number" name="guests[{{ $i }}][age]" class="form-control" placeholder="Age">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gender</label>
                        <select name="guests[{{ $i }}][gender]" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            @endfor
        </div>

        <div class="col-md-12 mt-1">
            <button type="button" id="add-guest" class="btn btn-warning" style="height: 50px; width: 80px; margin-top:-10px">
                <i class="lni lni-circle-plus"></i>
            </button>
        </div>

        <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3" style="float:right">
                <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
        
    </form>

            </div>
        </div>
    </div>
						</div>
					</div>
				</div>
			</div>
 
            <script>
                $(document).ready(function (){
                    $("#room_id").on('change', function (){
                        $("#check_in").val('');
                        $("#check_out").val('');
                        $(".availability").text(0);
                        $("#available_room").val(0); 

                        var totalAdult = $(this).find(":selected").data("total-adult");

// Set the total_adult value in the hidden field
                    $("#total_adult").val(totalAdult);

                    });
                    $("#check_out").on('change', function() {
                        getAvaility();
                    });
                });

                function getAvaility(){
                    var check_in = $('#check_in').val();
                    var check_out = $('#check_out').val();
                    var room_id = $("#room_id").val();
                    var startDate = new Date(check_in);
                    var endDate = new Date(check_out); 
                    if (startDate > endDate) {
                        alert('Invalid Date');
                        $("#check_out").val('');
                        return false;
                    }
                    if (check_in != '' && check_out != '' && room_id != '') {
                    $.ajax({
                    url: "{{ route('check_room_availability') }}",
                    data: {room_id:room_id, check_in:check_in, check_out:check_out},
                    success: function(data){
                        $(".availability").text(data['available_room']);
                        $("#available_room").val(data['available_room']);
                     }
                    }); 
                        
             
                  }else{
                    alert('Field must be not empty')
                  } 
                }
    
                let guestIndex = 1;
                const maxGuests = 10;

    $("#add-guest").on('click', function() {
        if (guestIndex >= maxGuests) {
            alert(`Maximum of ${maxGuests} guests allowed`);
            return;
        }

        // Create a new guest row with unique indexed name attributes
        const newGuestRow = `
            <div class="guest-row mb-3" data-guest-index="${guestIndex}">
                <div class="row">
                    <div class="col-md-8">
                        <label class="form-label">Name</label>
                        <input type="text" name="guests[${guestIndex}][name]" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Age</label>
                        <input type="number" name="guests[${guestIndex}][age]" class="form-control" placeholder="Age">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Gender</label>
                        <select name="guests[${guestIndex}][gender]" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="button" class="btn btn-danger btn-sm remove-guest">Remove</button>
                    </div>
                </div>
            </div>
        `;

        // Append the new guest row
        $(".guests-container").append(newGuestRow);
        
        // Increment guest index
        guestIndex++;
    });

    // Delegate event for removing guests
    $(".guests-container").on('click', '.remove-guest', function() {
        // Remove the entire guest row
        $(this).closest('.guest-row').remove();
        
        // Decrement guest index if needed
        guestIndex--;
        reindexGuests(); 
    });

    $("#bk_form").on('submit', function () {

    var number_person = $("#number_person").val();
       var total_adult = $("#total_adult").val();
        
       if (parseInt(number_person) > parseInt(total_adult)) {
        var proceed = confirm('Sorry, you selected more than the maximum number of allowed persons. Additional charges may apply. Do you want to proceed?');
        if (!proceed) {
            return false; // Cancel the submission if the user chooses not to proceed
        }
    }

    // If all validations pass or the user chooses to proceed, submit the form
    this.submit();
    })

            </script>
        
@endsection