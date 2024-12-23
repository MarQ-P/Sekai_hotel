<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					{{-- <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon"> --}}
				</div>
				<div>
					<h4 class="logo-text">Sekai Hotel</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			 </div>
			<!--navigation-->
			<ul class="metismenu" id="menu">

			<li>
					<a href="{{route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>


				@if(Auth::user()->can('team.menu'))
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Manage Team</div>
					</a>
					<ul>
						@if(Auth::user()->can('team.all'))
						<li> <a href="{{route('all.team')}}"><i class='bx bx-radio-circle'></i>All team</a>
						</li>
						@endif
					</ul>
						
					<ul>
						@if(Auth::user()->can('team.add'))
						<li> <a href="{{route('add.team')}}"><i class='bx bx-radio-circle'></i>Add Team</a>
						</li>
						@endif
					</ul>
				
					<ul>
						<li> <a href="{{route('archieve.team')}}"><i class='bx bx-radio-circle'></i>Archieve Team</a>
						</li>
					</ul>

				</li>
				@endif


				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						
						<div class="menu-title">Manage Quick Booking</div>
					</a>
					<ul>
						
						<li> <a href="{{route('quickBooking')}}"><i class='bx bx-radio-circle'></i>Update Quick Booking</a>
						</li>	
						
					</ul>
				
				</li>
			
				
				@if(Auth::user()->can('	room.type.menu'))
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Manage Room Type</div>
					</a>
					<ul>
						<li> <a href="{{route('room.type.list')}}"><i class='bx bx-radio-circle'></i>Room Type</a>
						</li>

					
					</ul>
				</li>
				@endif

				<li class="menu-label">Booking Manage</li>
			
				@if(Auth::user()->can('booking.menu'))
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Booking</div>
					</a>
					<ul>
						<li> <a href="{{route('booking.list')}}"><i class='bx bx-radio-circle'></i>Booking List</a>
						</li>
						<li> <a href="{{ route('add.room.list') }}"><i class='bx bx-radio-circle'></i>Add Booking </a>
						</li>
					

					</ul>
				</li>
				@endif


				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Manage Room List</div>
					</a>
					<ul>
						<li> <a href="{{route('view.room.list')}}"><i class='bx bx-radio-circle'></i>Room List</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Setting</div>
					</a>
					<ul>
						<li> <a href="{{route('smtp.setting')}}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
						</li>
						
					</ul>
				</li>

				@if(Auth::user()->can('testimonial.menu'))
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Tesimonial</div>
					</a>
					<ul>
						<li> <a href="{{ route('all.testimonial') }}"><i class='bx bx-radio-circle'></i>All Testimonial</a>
						</li>
						<li> <a href="{{ route('add.testimonial') }}"><i class='bx bx-radio-circle'></i>Add Testimonial</a>
						</li>
						<li> <a href="{{ route('archieve.testimonial') }}"><i class='bx bx-radio-circle'></i>Archieve Testimonial</a>
						</li>
						
						 
					</ul>
				</li>
				@endif


				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
						</div>
						<div class="menu-title">Booking Report</div>
					</a>
					<ul>
						<li> <a href="{{ route('booking.report') }}"><i class='bx bx-radio-circle'></i>Booking Report</a>
						</li>
					</ul>
				</li>

				</li>
	
				@if(Auth::user()->can('role.permission.menu'))
				<li class="menu-label">Others</li>

				
				<li class="menu-label">Role & Permission </li>

				<li>
					<a href="{{route('all.permission')}}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">All permission</div>
					</a>
				</li>
				<li>
					<a href="{{ route('all.roles') }}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">All Roles</div>
					</a>
				</li>

				<li>
					<a href="{{ route('add.roles.permission') }}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Role In Permission</div>
					</a>
				</li>

				<li>
					<a href="{{ route('all.roles.permission') }}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">All Role In Permission</div>
					</a>
				</li>

				<li>
					<a href="{{ route('all.admin') }}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">All Admin</div>
					</a>
				</li>

				<li>
					<a href="{{ route('add.admin') }}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Add Admin</div>
					</a>
				</li>

				<li>
					<a href="{{route('archieve.admin')}}" >
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Archieve Admin</div>
					</a>
				</li>
				@endif

			</ul>
			<!--end navigation-->
		</div>