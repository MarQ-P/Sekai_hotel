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
                    <li class="breadcrumb-item active" aria-current="page">All Testimonial</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>City</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($testimonial as $key=> $archieve_test ) 
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ asset($archieve_test->image) }}" alt="" style="width:70px; height:40px;" > </td>
                            <td>{{ $archieve_test->name }}</td>
                            <td>{{ $archieve_test->city }}</td> 
                            <td>

    <a href="{{ route('restore.testimonial',$archieve_test->id) }}" class="btn btn-success px-3 radius-30"> restore</a>
    <a href="{{ route('forcedelete.testimonial',$archieve_test->id) }}" class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>

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