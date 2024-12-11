@extends('frontend.main_master')
@section('main')

<!-- Inner Banner -->
<div class="inner-banner inner-bg7">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li> Check Out</li>
            </ul>
            <h3> Check Out</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->
<!-- Checkout Area -->
<section class="checkout-area pt-100 pb-70">
    <div class="container">

        <form method="post" role="form" action="{{ route('checkout.store', $id) }}" >
            @csrf
    

            <div class="row">
                <div class="col-lg-8">
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                               
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name<span class="required">*</span></label>
                                    <input type="text"  name ="name" class="form-control" value="{{\Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email<span class="required">*</span></label>
                                    <input type="text" name ="email" class="form-control" value="{{\Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name ="phone" class="form-control" value="{{\Auth::user()->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Region <span class="required">*</span></label>
                                    <input type="text" name ="region" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name ="address" class="form-control" value="{{\Auth::user()->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Province <span class="required">*</span></label>
                                    <input type="text"  name ="province" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>City/Municipality<span class="required">*</span></label>
                                    <input type="text"  name ="city_municipality" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>ZipCode<span class="required">*</span></label>
                                    <input type="text" name =" zip"  class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Baranggay<span class="required">*</span></label>
                                    <input type="text" name="baranggay" class="form-control">
                                </div>
                            </div>

{{-- <p>Session Value: {{json_encode(session('book_date')) }}</p> --}}

                
                        </div>
                    </div>
                </div>

                
                
                
                <div class="col-lg-4">
                    <section class="checkout-area pb-70">
                        <div class="card-body">
                              <div class="billing-details">
                                    <h3 class="title">Booking Summary</h3>
                                    <hr>
      
<div style="display: flex">
        <img style="height:100px; width:120px;object-fit: cover" src=" {{(!empty($room->image)) ? url ('upload/roomImg/'. $room->image) : url('u pload/no_image.jpg')}}" alt="Images" alt="Images">
        <div style="padding-left: 10px;">
            <a href=" " style="font-size: 20px; color: #595959;font-weight: bold">{{$room->roomtype->name}}</a>
            <p><b>{{$room->price}}/ Night</b></p>
        </div>

</div>
      
                                    <br>
      
                                    <table class="table" style="width: 100%">
                                    

                                        @php
                                            
                                                    $subtotal = $room->price * $nights * $book_data['number_of_room'];
                                                    $discount = ($room->discount / 100) * $subtotal;

                                                    $additional_fee_per_person = 50;

                                                    $extra_persons = $book_data['person'] - $room->total_adult;


                                                    $additional_fees = ($extra_persons > 0) ? $extra_persons * $additional_fee_per_person : 0;

                                                    $subtotal += $additional_fees;

                                                    $final_total = $subtotal - $discount;
                                        @endphp
                                        
                                        
                                          <tr>
                                                <td><p>Total Night <br> <b>  ({{$book_data['check_in']}} - {{$book_data['check_out']}}) </b></p></td>
                                                <td style="text-align: right"><p>{{$nights}} Days</p></td>
                                          </tr>
                                          <tr>
                                                <td><p>Total Room</p></td>
                                                <td style="text-align: right"><p>{{$book_data['number_of_room']}}</p></td>
                                          </tr>
                                          <tr>
                                            <td><p>Pre-Total</p></td>
                                            <td style="text-align:right"> <p>{{$room->price * $nights}}</p></td>
                                          </tr>
                                          <tr>
                                            <td><p>Additional Charges</p></td>
                                            <td style="text-align:right"> <p>{{ $book_data['person'] > $room->total_adult ? '' . $additional_fees : '₱0'}}</p></td>
                                          </tr>
                                          <tr>
                                                <td><p>Subtotal</p></td>
                                                <td style="text-align: right"><p>{{$subtotal}}</p></td>
                                          </tr>
                                          <tr>
                                                <td><p>Discount</p></td>
                                                <td style="text-align:right"> <p>{{$discount}}</p></td>
                                          </tr>
                                          <tr>
                                                <td><p>Total</p></td>
                                                <td style="text-align:right"> <p>{{$final_total}}</p></td>
                                          </tr>
                                    </table>
      
                              </div>
                        </div>
                  </section>
                </div>

              

                <div class="col-lg-8">
                    <div class="billing-details">
                        <h3 class="title">Guest Details</h3>
                        
                        @for ($i = 1; $i <= $book_data['person']; $i++) 
                        <div class="row mb-3">
                            <div class="col-lg-8 col-sm-8">
                                <div class="form-group">
                                    <label><span class="required">*</span></label>
                                    <input type="guest" name="guests[{{$i}}][name]" class="form-control" placeholder="Enter guest name">
                                </div>
                            </div>
                
                            <div class="col-lg-2 col-sm-2">
                                <div class="form-group">
                                    <label><span class="required">*</span></label>
                                    <input type="guest" name="guests[{{$i}}][age]" class="form-control" placeholder="Enter age">
                                </div>
                            </div>
                
                            <div class="col-lg-2 col-sm-2">
                                <div class="form-group">
                                    <label><span class="required">*</span></label>
                                    <select name="guests[{{$i}}][gender]" class="form-select">
                                        <option selected disabled>Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endfor
                
                    </div>
                </div>


                <div class="col-lg-8 col-md-12">
                    <div class="payment-box">
                        <div class="payment-method">
                            <p>
                                <input type="checkbox" id="cash-on-delivery" name="payment_method" value="PATH">
                                <label for="cash-on-delivery">Pay at the Hotel</label>
                            </p>
                        </div>

                        <button type="submit" class="order-btn three">Place to Order</button>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Area End --> 

@endsection