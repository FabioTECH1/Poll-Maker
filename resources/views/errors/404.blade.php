@extends('layout.layout')
@section('title', 'Not Found')

@section('content')


    <div class="container-fluid bg-white text-center">
        <div class="row">
            <div class="col-1 col-md-4"></div>
            <div class="col-10 col-md-4">
                <div class="text-center p-3 pt-0 mt-5">
                    <h1 class="text-danger">ERROR 404</h1>
                    <h4 class="text-secondary">Oops! Page not found</h4>
                </div>

                <div class="p-4 mb-lg-4 mb-xs-4 text-center">
                    <p>The page you are looking for doesn't exist or an error occured.</p>
                    <a href="{{ route('login') }}"><button type="submit"
                            class="btn btn-outline-primary shadow-none my-2 p-2">Go
                            back
                            home</button></a>
                </div>
            </div>
            <div class="col-1 col-md-4"></div>
        </div>
    </div>
@endsection
