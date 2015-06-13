@extends('app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

                @if (Auth::check())
                    <div class="col-md-6 contenTweets">
                        <br/>
                        <div class="panel panel-heading">
                            Tweets
                        </div>
                        @foreach($tweets as $tweet)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <text>{{ $tweet->content }}</text>
                                </div>
                                <div class="barra">&nbsp;&nbsp;<a href="/{{$tweet->user->username}}">{{ '@' . $tweet->user->username }}</a></div>
                                @if (Auth::check() && Auth::id() != $tweet->user_id)
                                    @if  (!$tweet->hasLikeFrom(Auth::id()))
                                        {!! Form::open(['url'=>'likes']) !!}
                                        {!! Form::hidden('tweet_id',$tweet->id) !!}
                                        {!! Form::hidden('user_id',Auth::user()->id) !!}
                                        <button type="submit" class="marg btn btn-default">{!!FA::icon('star')!!} &nbsp{{$tweet->likes->count() }}</button>
                                        {!! Form::close() !!}
                                    @else
                                        <button class="btn-like marg btn btn-default">{!!FA::icon('star')!!} &nbsp{{$tweet->likes->count() }}</button>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="col-md-4">
                    <div class="panel panel-heading">
                        Users
                    </div>
                    @foreach($users as $user)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <text>{{ $user->name .' '. $user->last_name}}</text>
                            </div>
                            <div class="barra">&nbsp;&nbsp;<a href="/{{$user->username}}">{{ '@' . $user->username }}</a></div>
                        </div>
                    @endforeach
                </div>

		</div>
	</div>
</div>
@endsection
