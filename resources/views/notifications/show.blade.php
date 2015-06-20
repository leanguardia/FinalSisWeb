@extends('app')
@section('content')
    <div class="container">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h1>Post likes</h1>
            <div class="panel panel-body">
                @foreach($tweets as $tweet)
                    @if( $tweet->getLikes()->count() != 0 )
                        @foreach($tweet->getLikes() as $like)
                            <hr>
                            <a href="{{ $like->getUser()->username }}">{{ '@'.$like->getUser()->username }}</a> liked your tweet: {{ $like->getTweet()->content }}
                        @endforeach
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-5">
            <h1>Retweets and replies of my tweets</h1>
            <div class="panel panel-body">
                @foreach($tweets as $tweet)
                    @foreach($tweet->getTweets() as $rep)
                        @if($rep->tweet_id)
                            <hr>
                            Your tweet: "{{ $rep->content }}" has been
                            @if($rep->reply)
                                replied
                            @else
                                retweeted
                            @endif
                            by <a href="{{ $rep->getUser()->username }}">{{ '@'.$rep->getUser()->username }}</a>
                        @endif
                        <hr>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@endsection