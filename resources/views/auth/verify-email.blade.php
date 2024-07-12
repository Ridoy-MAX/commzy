@extends('layouts.dashboard')
@section('content')

<div class="col-md-6 m-auto mt-4" style="height: 80vh">
    <div class="card p-5" style="margin-top: 150px">

        <div class="mb-4 text-sm text-gray-600">
            <div class="m-3 d-flex items-center justify-center">
                <a class="header-logo logo2 m-auto pb-4" href="{{ route('welcome')}}"><img src=" {{ asset('images/newlogo.svg')}}" alt="Header Logo"
                    style="width: 150px;"></a>
            </div>
            
            <p style="font-weight: 600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by
                clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

        </div>
    
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
    
        <div class="mt-4 d-flex items-center justify-between w-100">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
    
                <div>
                    <button class="ud-btn"   style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <button class="ud-btn ms-2"   style=" font-size: 16px;    border: 2px solid rgb(53, 53, 53);background:#fcf9f0ce;" type="submit">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    
    </div>
      
</div>




@endsection
@section('footer_script')

@endsection