@extends('layout.layout')
@section('title', 'Control Center')

@section('content')

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div>
                @foreach ($polls as $poll)
                    <h5 class="text-secondary text-center text-uppercase my-4">{{ $poll->title }}</h5>
                    <ol class="list-group list-group-numbered" style="list-style-type: lower-alpha">
                        @foreach ($poll->candidates as $candidate)
                            <li class="list-group-item">{{ $candidate->candidate }}</li>
                        @endforeach
                    </ol>
                @endforeach
            </div>
            @foreach ($polls as $poll)
                <div style="text-align: center">
                    @if ($poll->status == 0)
                        <form action="{{ route('publish.poll', $poll->id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary my-2 shadow-none" type="submit">Publish Poll</button>
                        </form>
                    @elseif($poll->status == 1)
                        <form action="{{ route('end.poll', $poll->id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary my-2 shadow-none" type="submit">End Poll</button>
                            <h5><a href="{{ route('poll.result', $poll->id) }}">View Result</a></h5>
                        </form>
                        <div class="text-muted">
                            <p>Visit and share <a class="text-decoration-none" target="_blank"
                                    href="{{ route('get.email', $poll->id) }}"><code>{{ route('get.email', $poll->id) }}
                                    </code></a>to
                                commence voting
                            </p>
                        </div>
                    @else
                        <div>
                            <h4 class="text-info my-3">Poll Ended</h4>
                            <h5><a href="{{ route('poll.result', $poll->id) }}">View Result</a></h5>

                            <form action="{{ route('delete.poll', $poll->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-primary my-2 shadow-none" type="submit">Delete Poll</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
