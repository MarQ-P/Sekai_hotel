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
            <li class="breadcrumb-item active" aria-current="page">All Archieve Team</li>
        </ol>
        </nav>
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

                        @foreach ($team as $key => $archived_team)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ asset($archived_team->image) }}" alt="" style="width:70px; height:40px;">
                            </td>
                            <td>{{ $archived_team->name }}</td>
                            <td>{{ $archived_team->position }}</td>
                            <td>
                                <a href="{{ route('restore.team', $archived_team->team_id) }}" class="btn btn-success px-3 radius-30">Restore</a>
                                <a href="{{ route('forceDelete.team', $archived_team->team_id) }}" class="btn btn-danger px-3 radius-30" id="confirmation">Permanently Delete</a>
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