@extends('layouts.auth')
@section('content')


<div class="col-md-6 m-auto mt-4" style="height: 80vh">
    <div class="card p-5" style="margin-top: 150px">

        <div class="mb-4 text-sm text-gray-600">
            <div class="m-3 d-flex items-center justify-center">
                <a class="header-logo logo2 m-auto pb-4" href="{{ route('welcome')}}"><img src=" {{ asset('images/newlogo.svg')}}" alt="Header Logo"
                    style="width: 150px;"></a>
            </div>
            
            <p style="font-weight: 600">
                {{ __('Forgot your password? No problem. Just let us know your email address and reset your password') }}
            </p>

        </div>
    
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
    
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" class="block mt-1 w-full form-control form-control-lg" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password" class="block mt-1 w-full form-control form-control-lg" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <input id="password_confirmation" class="block mt-1 w-full form-control form-control-lg"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <button class="ud-btn ms-2"   style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;" type="submit">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    
    </div>
      
</div>








@endsection
@section('footer_script')

@endsection