@extends('layout.layout')
@section('title', 'Register')

@section('content')

    <div class="container-fluid my-3 bg-white p-4" style="width: 35%;">
        <form action="{{ route('user.register') }}" method="post" class="row gx-3 gy-2 align-items-center">
            @csrf
            <input type="email" name="email" class="form-control my-2 shadow-none @error('email') border-danger @enderror"
                id="" placeholder="Email" value="{{ old('email') }}">
            <input type="password" name="password"
                class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                placeholder="Password">
            <input type="password" name="password_confirmation"
                class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                placeholder="Repeat Password">

            <button type="submit" class="btn btn-primary shadow-none">Sign Up</button>
        </form>
        @if (session('email_check'))
            <p class="text-danger text-center my-3">{{ session('email_check') }} </p>
        @endif
    </div>
    <div class="container-fluid my-5 text-center ">
        <h5 class="">Already Registered ?</h5>
        <h6> <a class="text-decoration-none" href="{{ route('login') }}">Sign In<a></h6>
    </div>
@endsection
