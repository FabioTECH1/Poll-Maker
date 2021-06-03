@extends('layout.layout')
@section('title', 'Home')

@section('content')

    <div class="row">
        <div class="col-sm-4"></div>
        @if (session('msge-2'))
            <div class="col-sm-4 alert alert-success alert-dismissible text-center my-2">
                <h5>{{ session('msge-2') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
            </div>
        @endif
        <div class="col-sm-4"></div>
    </div>
    <div class="row text-center my-5" id="add-catogory">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form action="{{ route('no.candidate') }}" method="post">
                <div class="input-group mb-3">
                    @csrf
                    <input type="text" class="form-control shadow-none" name="candidate-no"
                        placeholder="Enter No. of Candidates ( Min of 2, Max of 4 )">
                    <button class="btn btn-outline-secondary shadow-none" type="submit" id="button-addon2">Proceed</button>
                </div>
                @error('candidate-no')<p class="text-danger my-2">{{ $message }}</p>@enderror
            </form>
        </div>
        @error('attendee')<p class="text-danger">{{ $message }}</p>@enderror
        @if (session('msge-3'))
            <p class="text-danger text-center">{{ session('msge-3') }} </p>
        @endif
        <div class="col-sm-4"></div>
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        @if (session('2-can'))
            <div class="col-sm-4 text-center my-2">
                <form action='{{ route('add.can2') }}' method="post">
                    @csrf
                    <input class="form-control my-3 shadow-none" placeholder="Title of poll" type="text" name="title">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 1" type="text" name="can-1">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 2" type="text" name="can-2">
                    <button class="btn btn-primary my-2 shadow-none" type="submit">Add</button>
                </form>
            </div>
        @endif
        @if (session('3-can'))
            <div class="col-sm-4 text-center my-2">
                <form action='{{ route('add.can3') }}' method="post">
                    @csrf
                    <input class="form-control my-3 shadow-none" placeholder="Title of poll" type="text" name="title">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 1" type="text" name="can-1">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 2" type="text" name="can-2">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 3" type="text" name="can-3">
                    <button class="btn btn-primary my-2 shadow-none" type="submit">Add</button>
                </form>
            </div>
        @endif
        @if (session('4-can'))
            <div class="col-sm-4  text-center my-2">
                <form action='{{ route('add.can4') }}' method="post">
                    @csrf
                    <input class="form-control my-3 shadow-none" placeholder="Title of poll" type="text" name="title">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 1" type="text" name="can-1">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 2" type="text" name="can-2">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 3" type="text" name="can-3">
                    <input class="form-control my-3 shadow-none" placeholder="Candidate 4" type="text" name="can-4">
                    <button class="btn btn-primary my-2 shadow-none" type="submit">Add</button>
                </form>
            </div>
        @endif
        <div class="col-sm-4"></div>
    </div>
    @if ($checkpoll->count() > 0)
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
                <h4 class="text-secondary my-3 text-decoration-underline">Past Polls</h4>
                @foreach ($checkpoll as $polltitle)
                    <a href="{{ route('control', $polltitle->id) }}" class="text-decoration-none text-capitalize">
                        <h5>{{ $polltitle->title }}
                            @if ($polltitle->status == 1)
                                <span class="text-primary">(Active)</span>
                            @elseif($polltitle->status == 0)
                                <span class="text-muted">(Not Published)</span>
                            @else
                                <span class="text-muted">(Ended)</span>
                            @endif
                        </h5>
                    </a>
                @endforeach
            </div>
            <div class="col-sm-4"></div>
        </div>
    @endif

@endsection
