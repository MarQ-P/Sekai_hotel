@extends('admin.admin_dashboard')
@section('admin')



<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
            </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('add.room.type')}}" class="btn btn-primary px-5">Add Room type</a>
            </div>
        </div>

    </div>
  
    <!--end breadcrumb-->

    
    <h6 class="mb-0 text-uppercase">Room Type List</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl_#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allData as $key=> $archived_team )

                        @php
                            
                        $rooms = App\Models\Room::where('roomtype_id', $item->id)->get();

                        @endphp
                            
                        <tr>
    <td>{{$key+1}}</td>
    <td> <img src="{{(!empty($item->rooms->image))? url('upload/roomImg/'. $item->rooms->image): url ('upload/no_image.jpg')}}" alt="" style="width: 50px; height: 30px;"> </td>
    <td>{{$item->name}}</td>
    <td>

        {{-- room data --}}
@foreach($rooms as $room )
        <a href="{{route('edit.room', $room->id)}}" class="btn btn-warning px-3 radius-30" >Edit</a>
        <a href="{{route('delete.room', $room->id)}}" class="btn btn-danger px-3 radius-30" id="confirmation" >Delete</a>
        @endforeach


    </td>
                        </tr>

                        @endforeach
                        
                    </tbody>
  
                </table>
            </div>
        </div>
    </div>

    <hr/>

</div>


@endsection