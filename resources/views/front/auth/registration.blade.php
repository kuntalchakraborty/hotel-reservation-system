@extends('front.layouts.frontlayout')

@section('adminContent')
<div class="log-in-holder" style="background-image: url({{ asset('public/front/images/login-bg.jpg') }});">
    <div class="log-in-content">
        <div class="logo-img"><a href=""><img src="{{ asset('public/front/images/big-logo.png') }}" alt=""></a></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('user-register') }}" method="POST">
            @csrf
            <h2>Sign Up</h2>
            <h3>Welcome to Lotus Hotel</h3>
            <div class="input-wrapper">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" id="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-wrapper">
                <label for="email">Email</label>
                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" >
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-wrapper">
                <label for="phone">Phone Number</label>
                <input type="number" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" >
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-wrapper">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="userpassword" value="{{old('password')}}">
                <i class="fa fa-eye eye-icon" id="togglePassword"></i>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-wrapper">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="password_confirmation" id="confirm_password" value="{{ old('password_confirmation') }}">
                <i class="fa fa-eye eye-icon" id="toggleconPassword"></i>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-wrapper">
                <input type="submit" value="Sign Up">
            </div>

            <div class="end-msg">
                <p>Already have an account? <a href="{{ route('user-login') }}">Sign In</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
