@extends('layout.layout')
@section('title', 'Welcome')

@section('content')

    <div class="container-fluid my-3 bg-white p-4" style="width: 35%;">
        @if (session('msge-1'))
            <p class="text-danger text-center">{{ session('msge-1') }} </p>
        @endif
        <form action="{{ route('user.login') }}" method="post" class="row gx-3 gy-2 align-items-center">
            @csrf
            <input type="email" name="email" class="form-control my-2 shadow-none @error('email') border-danger @enderror"
                id="" placeholder="Email" value="{{ old('email') }}">
            <input type="password" name="password"
                class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                placeholder="Password">
            <button type="submit" class="btn btn-primary shadow-none">Sign In</button>
        </form>
    </div>
    <div class="container-fluid my-5 text-center ">
        <h5 class="">New to the platform ?</h5>
        <h6> <a class="text-decoration-none" href="{{ route('register') }}">Register<a></h6>
    </div>
@endsection
