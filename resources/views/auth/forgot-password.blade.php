@extends('frontend.main_master')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
            
                        <li><i class='bx bx-chevron-right'></i></li>
                    
                    </ul>
                    <h3>Forget Password</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Sign In Area -->
        <div class="sign-in-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-all-form">
                            <div class="contact-form">
                         

                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                            
                                    <!-- Email Address -->
                               <!-- Email Address -->
<!-- Email Address -->
<div class="mb-3">
    <label for="email" class="form-label fw-bold text-secondary">Email</label>
    <input 
        id="email" 
        type="email" 
        name="email" 
        class="form-control shadow-sm p-2 rounded-3 border-primary" 
        placeholder="Enter your email address"
        value="{{ old('email') }}" 
        required 
        autofocus 
    />
    @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- Reset Password Button -->
<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-bg-one text-light px-4 py-2 fw-semibold shadow-sm rounded-3">
        Email Password Reset Link
    </button>
</div>


                                </form>
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In Area End -->

@endsection