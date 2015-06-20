@extends('app')
@section('content')
    <div class="container">
        <h1>Search Results</h1>

        @if($users->count()==0 && $tweets->count()==0)
            <h3>No results found.</h3>
        @else
            @if ($users->count()!=0)
                <div class="col-md-5")>
                    <h2>Users</h2>
                    @foreach($users as $user)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <text>{{ $user->name .' '. $user->last_name}}</text>
                            </div>
                            <div class="barra">&nbsp;&nbsp;<a href="/{{$user->username}}">{{ '@' . $user->username }}</a></div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if($tweets->count()!=0)
                <div class="col-md-5")>
                    <h2>Tweets</h2>
                    @foreach($tweets as $tweet)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <text>{{ $tweet->content }}</text>
                            </div>
                            @if (!$tweet->tweet_id)
                                <div class="barra">&nbsp;&nbsp;{{ '@' . $tweet->user->username }}</div>
                            @else
                                <div class="barra">&nbsp;&nbsp;{!!FA::icon('retweet')!!}<a href="/{{$tweet->getWriter()}}">&nbsp;{{'@'.$tweet->getWriter()}}</a> </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        @endif

    </div>

@endsection