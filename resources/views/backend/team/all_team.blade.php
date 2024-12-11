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
            <li class="breadcrumb-item active" aria-current="page">All Team</li>
        </ol>
        </nav>
    </div>

    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{route('add.team')}}" class="btn btn-primary px-5">Add Team</a>
        </div>
    </div>

</div>

<!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">All Team</h6>
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
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($team as $key=> $all_team_data )
                            
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> <img src="{{asset($all_team_data->image)}}" alt="" style="width:70px; height: 40px;" > </td>
                            <td>{{$all_team_data->name}}</td>
                            <td>{{$all_team_data->position}}</td>
                            <td>
                                @if(Auth::user()->can('team.edit'))
                                <a href="{{route('edit.team',$all_team_data->team_id)}}" class="btn btn-warning px-3 radius-30" >Edit</a>
                                @endif
                                @if(Auth::user()->can('team.delete'))
                                <a href="{{route('delete.team',$all_team_data->team_id)}}" class="btn btn-danger px-3 radius-30" id="confirmation" >Delete</a>
                                @endif

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