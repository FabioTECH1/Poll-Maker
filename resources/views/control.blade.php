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
                        <form action="{{ route('publish.poll', $poll->poll_id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary my-2 shadow-none" type="submit">Publish Poll</button>
                        </form>
                    @elseif($poll->status == 1)
                        <form action="{{ route('end.poll', $poll->poll_id) }}" method="post">
                            @csrf
                            <button class="btn btn-primary my-2 shadow-none" type="submit">End Poll</button>
                            <h5><a href="{{ route('poll.result', $poll->poll_id) }}">View Result</a></h5>
                        </form>
                        <div class="text-muted">
                            <p>Visit and share <a class="text-decoration-none" target="_blank"
                                    href="{{ route('get.email', $poll->poll_id) }}"><code
                                        id='voteLink'>{{ route('get.email', $poll->poll_id) }}
                                    </code></a><a href='' onclick="myFunction()" class="text-info"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                                        <path
                                            d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z" />
                                        <path
                                            d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5V6.5Z" />
                                    </svg></a>to commence voting
                            </p>
                        </div>
                    @else
                        <div>
                            <h4 class="text-info my-3">Poll Ended</h4>
                            <h5><a href="{{ route('poll.result', $poll->poll_id) }}">View Result</a></h5>

                            <form action="{{ route('delete.poll', $poll->poll_id) }}" method="post">
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
    <script>
        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }

        function myFunction() {
            var copyText = document.getElementById("voteLink");
            copyToClipboard(copyText.innerText);
        }
    </script>
@endsection
