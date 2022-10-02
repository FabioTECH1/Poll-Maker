@extends('layout.layout')
@section('title', 'Control Center')

@section('content')
    @foreach ($polls as $poll)
        @if ($poll->status == 2)
            <div class="row my-5">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <h4 class="text-info my-3">Poll Ended</h4>
                    <h5><a href="{{ route('poll.result', $poll->poll_id) }}">View Result</a></h5>
                </div>
                <div class="col-sm-4"></div>
            </div>
        @else
            <div class="row my-5">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <h5>Enter your email for verification to vote</h5>
                    <h6 class="bg-info p-2">{{ $poll->title }} ( -<span>
                            @foreach ($poll->candidates as $candidate)
                                {{ $candidate->candidate }} -
                            @endforeach
                            <span>)</h6>
                    <p class="text-muted">You can only use an email once</p>
                    <form action="{{ route('verify.email', $poll->poll_id) }}" method="post">
                        @csrf
                        <input class="form-control my-3 shadow-none" type="email" name="email"
                            placeholder="Enter a valid email">
                        <input class="btn btn-primary btn-sm shadow-none" type="submit" value="Submit">
                    </form>
                    @error('email')
                        <p class="text-center text-danger">Your email is required to vote</p>
                    @enderror
                    @if (Session::has('emailExists'))
                        <div class="my-4">
                            <p class="text-center text-info">You have already voted with this email</p>
                            <h5><a href="{{ route('poll.result', $poll->poll_id) }}">View Result</a></h5>
                        </div>
                    @endif
                </div>
                <div class="col-sm-4"></div>
            </div>
        @endif
    @endforeach

@endsection
