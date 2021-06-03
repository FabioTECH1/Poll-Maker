@extends('layout.layout')
@section('title', 'Poll Result')

@section('content')

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div>
                @foreach ($polls as $poll)
                    <h5 class="text-secondary text-center text-uppercase my-4">{{ $poll->title }}</h5>

                    @foreach ($poll->candidates as $candidate)
                        <div class="">
                            <div class="d-inline-block" style="width: 80%">
                                <div class="progress my-1" style="height: 30px">
                                    <div class="progress-bar text-start @if ($candidate->percent ==
                                    0) bg-secondary @elseif ($candidate->percent != $maxVote) bg-info @endif"
                                        style="width: @if ($candidate->percent == 0)
                                            100%
                                        @else {{ $candidate->percent }}% @endif">
                                            <h6 class="my-2 p-2 text-dark">{{ $candidate->candidate }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-inline-block text-end" style="width: 15%">
                                <h6 class=' @if ($candidate->percent == $maxVote) fw-bolder @else fw-light @endif'
                                    style="height: 30px">
                                    {{ $candidate->percent }}%</h6>
                            </div>
                        </div>
                    @endforeach
                    <h6 class="my-2 text-primary">{{ $votersNo }} @if ($votersNo > 1)
                        votes @else vote @endif
                        @if ($poll->status == 2)
                            <span class="text-muted">Final Result</span>
                            <span class="fst-italic text-muted"> -poll closed</span>
                        @else
                            <span class="fst-italic text-muted"> -poll still open</span>
                        @endif
                    </h6>
                    @guest
                        <h6 class="text-center my-5"><a class="text-decoration-none" href="{{ route('register') }}">
                                Register and create your poll
                                <a></h6>
                    @endguest
                @endforeach
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

@endsection
