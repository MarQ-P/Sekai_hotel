@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-4 border-info">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Booking Number</p>
									<h4 class="my-1 text-info">{{$editData->code}}</h4>
	
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
								</div>
							</div>
						</div>
					 </div>
				   </div>

				   <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-danger">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Booking Date</p>
								   <h4 class="my-1 text-danger">{{$editData->created_at->format('d/m/Y')}}</h4>
								
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
                  
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-success">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Payment Method</p>
								   <h5 class="my-1 text-success">{{$editData->payment->payment_method}}</h5>
								   <p class="mb-0 font-13">Pay at the Hotel</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>

				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-warning">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Payment Status</p>
								   <h4 class="my-1 text-warning">
                                    @if($editData->payment->payment_status == 1)
                                    <span class="text-success">Complete</span>
                                    @else
                                    <span class="text-danger">Pending</span>
                                    @endif
                                   </h4> 
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div> 

                  
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-4 border-warning">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Booking Status</p>
								   <h4 class="my-1 text-warning">
                                    
                                    @if($editData->status == 1)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-danger">Pending</span>
                                    @endif

                                   </h4>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div> 

				</div><!--end row-->

				<div class="row">
                   <div class="col-12 col-lg-12 d-flex">
                      <div class="card radius-10 w-100">
					
						  <div class="card-body">
                            <div class = "table responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Room Type</th>
                                            <th>Total Room</th>
                                            <th>Persons</th>
                                            <th>Price</th>
                                            <th>Check in</th>
                                            <th>Check out</th>
                                            <th>Total Nights</th>
                                            <th>Total</th>
                                            <th>Sub total</th>
                                            <th>Discount</th>
                                            <th>Grand Total</th>

                                        </tr>
                                    </thead>
                                        <tbody>       
                                      
                                            <tr>
                                                <td>{{$editData->room->roomtype->name}}</td>
                                                <td>{{$editData->number_of_room}}</td>
                                                <td>{{$editData->person}}</td>
                                                <td>P{{$editData->actual_price}}</td>
                                                <td><h6><span class="badge bg-primary ">{{$editData->check_in}}</span></h6></td>
                                                <td><h6><span class="badge bg-warning text-dark ">{{$editData->check_out}}</span></h6></td>
                                                <td>{{$editData->total_nights}}</td>
                                                <td>P{{$editData->actual_price * $editData->number_of_room}}</td>
                                                <td>P{{$editData->subtotal}}</td>
                                                <td>P{{$editData->discount}}</td>
                                                <td><h5><strong>P{{$editData->total_price}}</strong></h5></td>

                                            </tr>
                             
                                        </tbody>
                                </table>

                                <div style="clear: both"></div>
                                <div style="margin-top: 40px; margin-bottom:20px;">
                                <a href="javascript::void(0)" class="btn btn-primary assign_room"> Assign Room</a>
                                </div>


                                @php
                                    

                                $assign_rooms = App\Models\BookingRoomList::with('room_number')->where('booking_id', $editData->id)->get();

                                @endphp

                                       
<div class="row">
                                        <div class="col-md-10">
                                            @if(count($assign_rooms) > 0)
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($assign_rooms as $ass_room )
                                    <tr>
                                        <td class="badge bg-warning m-2 pb-1"><h6 class="text-dark">{{$ass_room->room_number->room_no}}</h6></td>
                                        <td>
                                            <a href="{{route('assign_room_delete', $ass_room->id)}}" id="delete" class=" btn btn-danger" >Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @else
                                <div class="alert alert-danger text-center text-light bg-danger">
                                    No Assign Room Found
                                </div>
                                        @endif
                                        </div>
</div>
                             </div> {{-- end table responsive --}}


                             
                                <form action="{{route ('update.booking.status', $editData->id)}}" method="POST">

                                    @csrf

                                    <div class="row" style="margin-top: 40px; ">
                                        <div class="col-md-5">
                                            <label for=""> Payment Status</label>
                                            <select name="payment_status" class="form-select">
                                                <option selected="">Select Status...</option>
                                                <option value="0" {{$editData->payment->payment_status == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{$editData->payment->payment_status == 1 ? 'selected' : '' }}>Complete</option>
                                            </select>
                                            
                                        </div>

                                        <div class="col-md-5">
                                            <label for=""> Booking Status</label>
                        <select name="status" id="input7" class="form-select">
                            <option selected="">Select Status...</option>
                            <option value="0" {{$editData->status == 0  ? 'selected':''}} >Pending </option>
                            <option value="1" {{$editData->status == 1  ? 'selected':''}} >Complete </option>
                        </select>
                                        </div>


                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{route('download.invoice', $editData->id)}}" class="btn btn-warning px-3 radius-25">Download Invoice</a>
                                        </div>

                                    </div>

                                </form>

					     </div>
					  </div>
				   </div>

				   <div class="col-12 col-lg-4">
                       <div class="card radius-10 w-100">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Manage room and Date</h6>
								</div>
						
							</div>
						</div>
						   <div class="card-body">
                            <form action="{{route('update.booking', $editData->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="">CheckIn</label>
                                        <input type="date" required name="check_in" id="check_in" class="form-control" value="{{ $editData->check_in }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="">CheckOut</label>
                                        <input type="date" required name="check_out"  id="check_out" class="form-control" value="{{ $editData->check_out }}">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="">Room</label>
                                        <input type="number" required name="number_of_room" class="form-control" value="{{ $editData->number_of_room }}">
                                    </div>

                                    <input type="hidden" name="available_room" id="available_room" class="form-control">
                                    {{-- <input type="hidden" name="available_room" id="available_room" class="form-control" value="{{$editData->number_of_room}}"> --}}


                                    <div class="col-md-12 mb-2">
                                    <label for="">Availability: <span class="text-success availability"></span> </label> 
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Update </button>
                                    </div>
                                </div>
                            </form>
						   </div>
	
					   </div>

				   </div>

                   <div class="col-12 col-lg-4">
                   <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Customer Information</h6>
                            </div>
                    
                        </div>
                    </div>
                       <div class="card-body">
                        <label for="">Name: {{$editData->name}} </label><br>
                        <label for="" class="my-2">Email: {{$editData->email}}</label><br>
                        <label for="" class="my-2">Phone: {{$editData->phone}}</label><br>
                        <label for="" class="my-2">Region: {{$editData->Region}}</label><br>
                        <label for="" class="my-2">Province: {{$editData->Province}}</label><br>
                        <label for="" class="my-2">Zip: {{$editData->Zip}}</label><br>
                        <label for="" class="my-2">City / Municipality: {{$editData->City_Municipality}}</label><br>
                        <label for="" class="my-2">Baranggay: {{$editData->Baranggay}}</label><br>
                        </div>
                    </div>
                    {{-- end card radius --}}
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card radius-10 w-100">
                     <div class="card-header">
                         <div class="d-flex align-items-center">
                             <div>
                                 <h6 class="mb-0">Guest </h6>
                             </div>
                     
                         </div>
                     </div>
                        <div class="card-body">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>

                                    </tr>
                                </thead>
                                    <tbody>       
                                        @foreach ($editData->guests as $key => $guest)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$guest->name}}</td>
                                            <td>{{$guest->age}}</td>
                                            <td>{{$guest->gender}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                         
                         </div>
                     </div>
                     {{-- end card radius --}}
                 </div>


				</div><!--end row-->


                <!-- Modal -->
    <div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     </div>
                
            </div>
        </div>
    </div>
                <!-- Modal -->


                <script>
                    $(document).ready(function (){
                       getAvaility();

                       $(".assign_room").on('click', function(){
            $.ajax({
                url: "{{ route('assign_room',$editData->id) }}",
                success: function(data){
                    $('.myModal .modal-body').html(data);
                    $('.myModal').modal('show');
                }
            });
            return false;
        });

                    });
                   function getAvaility(){
                       var check_in = $('#check_in').val();
                       var check_out = $('#check_out').val();
                       var room_id = "{{ $editData->rooms_id }}";
                       $.ajax({
                        url: "{{ route('check_room_availability') }}",
                        data: {room_id:room_id, check_in:check_in, check_out:check_out},
                        success: function(data){
                           $(".availability").text(data['available_room']);
                           $("#available_room").val(data['available_room']);
                        }
                     }); 
                   }
                  
               </script>

            @endsection