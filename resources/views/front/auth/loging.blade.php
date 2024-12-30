@extends('front.layouts.frontlayout')
@section('adminContent')
    <div class="log-in-holder" style="background-image: url({{ asset('public/front/images/login-bg.jpg') }});">
        <div class="log-in-content">
            <div class="logo-img"><a href=""><img src="{{ asset('public/front/images/big-logo.png') }}"
                        alt=""></a></div>
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
                        <form action="{{ route('user-login-post') }}" method="POST">
                            @csrf
                            <h2>Sign in</h2>
                            <h3>Welcome to Lotus Hotel</h3>
                            <div class="input-wrapper">
                                <label for="username">Email</label>
                                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" id="username" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-wrapper">
                                <label for="userpassword">Password</label>
                                <input type="password" placeholder="Password" value="{{ old('password') }}" name="password" id="userpassword" required>
                                <i class="fa fa-eye eye-icon" id="togglePassword"></i>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-wrapper">
                                <div class="check-box-sec-holder">
                                    <div class="check-box-sec">
                                        <input type="checkbox" id="remember-me" name="remember" />
                                        <label for="remember-me">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-wrapper">
                                <input type="submit" value="Sign in">
                            </div>
                            <div class="end-msg">
                                <p>Don’t have an account? <a href="{{ route('user-registration') }}">Sign up</a></p>
                            </div>
                        </form>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
