@extends('app')
@section('content')

<div class="container">
	<div class="row">

        <div class="panel panel-heading">
            <h2>Frequently used words</h2>
            <ul class="list-inline">
                @foreach($words as $key => $value)
                    <li>{{$mykey = $key}}</li>
                @endforeach
            </ul>
        </div>
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
                            <div class="panel-footer">
                                @if(Auth::check() && Auth::id() != $user->id && !Auth::user()->following()->where('following', $user->id)->first() )
                                    <div class="follow-form">
                                        {!! Form::open([ 'url' => '/follow/' . $user->username ]) !!}
                                        {!! Form::hidden('follower', Auth::id()) !!}
                                        {!! Form::hidden('username', $user->username) !!}
                                        {!! Form::hidden('user_id', $user->id) !!}
                                        <button type="submit" class="btn btn-sm btn-default" id="{{ 'follow'.$user->username }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
                                        {!! Form::close() !!}
                                    </div>

                                    <div class="unfollow-form" style="display: none">
                                        {!! Form::open([ 'url' => '/unfollow/' . $user->username ]) !!}
                                        {!! Form::hidden('follower', Auth::id()) !!}
                                        {!! Form::hidden('username', $user->username) !!}
                                        {!! Form::hidden('user_id', $user->id) !!}
                                        <button type="submit" class="btn btn-sm btn-default" id="{{ 'unfollow'.$user->username }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Unfollow</button>
                                        {!! Form::close() !!}
                                    </div>
                                @else
                                    @if(Auth::id() != $user->id)
                                        <div class="follow-form" style="display: none">
                                            {!! Form::open([ 'url' => '/follow/' . $user->username ]) !!}
                                            {!! Form::hidden('follower', Auth::id()) !!}
                                            {!! Form::hidden('username', $user->username) !!}
                                            {!! Form::hidden('user_id', $user->id) !!}
                                            <button type="submit" class="btn btn-sm btn-default" id="{{ 'follow'.$user->username }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
                                            {!! Form::close() !!}
                                        </div>

                                        <div class="unfollow-form">
                                            {!! Form::open([ 'url' => '/unfollow/' . $user->username ]) !!}
                                            {!! Form::hidden('follower', Auth::id()) !!}
                                            {!! Form::hidden('username', $user->username) !!}
                                            {!! Form::hidden('user_id', $user->id) !!}
                                            <button type="submit" class="btn btn-sm btn-default" id="{{ 'unfollow'.$user->username }}"><i class="fa fa-user"></i>&nbsp;&nbsp;Unfollow</button>
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

		</div>
	</div>
</div>
<br/>
@endsection
