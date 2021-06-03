@extends('layout.layout')
@section('title', 'Vote Centre')

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
                                    <div class="progress-bar text-start"
                                        style="width:100%; background-color:rgb(189, 189, 189)">
                                        <form action="{{ route('vote.poll', $candidate->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-link text-decoration-none text-dark fw-bold"
                                                type="submit">{{ $candidate->candidate }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="d-inline-block text-end" style="width: 15%">
                                <h6 class='' style="height: 30px">
                                    0%</h6>
                            </div>
                        </div>
                    @endforeach

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
