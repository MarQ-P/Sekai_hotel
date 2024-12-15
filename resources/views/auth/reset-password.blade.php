@extends('frontend.main_master')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
            
                        <li><i class='bx bx-chevron-right'></i></li>
                    
                    </ul>
                    <h3>Reset Password</h3>
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
                          
                         
                                <form method="POST" action="{{ route('password.store') }}" class="p-4 mx-auto rounded-3 shadow-lg bg-white" style="max-width: 500px;">
                                    @csrf
                            
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            
                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" class="form-label fw-bold" style="color: #668355" />
                                        <x-text-input 
                                            id="email" 
                                            class="form-control shadow-sm rounded-3" 
                                            type="email" 
                                            name="email" 
                                            :value="old('email', $request->email)" 
                                            required autofocus autocomplete="username" 
                                        />
                                        <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                                    </div>
                            
                                    <!-- Password -->
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" class="form-label fw-bold" style="color: #668355" />
                                        <x-text-input 
                                            id="password" 
                                            class="form-control shadow-sm rounded-3" 
                                            type="password" 
                                            name="password" 
                                            required autocomplete="new-password" 
                                        />
                                        <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
                                    </div>
                            
                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label fw-bold" style="color: #668355"  />
                                        <x-text-input 
                                            id="password_confirmation" 
                                            class="form-control shadow-sm rounded-3" 
                                            type="password" 
                                            name="password_confirmation" 
                                            required autocomplete="new-password" 
                                            
                                        />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
                                    </div>
                            
                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <x-primary-button class="btn btn-bg-one text-light px-4 py-2 rounded-3 shadow-sm fw-semibold">
                                            {{ __('Reset Password') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In Area End -->

@endsection