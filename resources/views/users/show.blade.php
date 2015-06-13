@extends('app')
@section('content')

<div class="col-md-1"></div>
<div class="col-md-3 profile-box" style="height: 140px; background-color: rgba(0, 131, 179, 0.48); border-radius: 9px; border: solid; overflow: hidden; border-color: #b7c2d6">
    <h3>{{ $user->name . ' ' . $user->last_name }}</h3>
    <h4><a href="/{{ $user->username }}">{{ '@' . $user->username }}</a></h4>
    <div class="row" style="background-color: #f3f3f3; padding: 5px;">
        <div class="col-md-2">
            TWEETS
            <br>
            <strong style="color: #0083b3" ><p id="tweet-count">{{ $tweets->count() }}</p></strong>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            FOLLOWING
            <br>
            <strong style="color: #0083b3" ><p id="following-count">{{ $user->following->count() }}</p></strong>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3">
            FOLLOWERS
            <br>
            <strong style="color: #0083b3" ><p id="followers-count">{{ $user->followers->count() }}</p></strong>
        </div>
    </div>
</div>

{{--<div class="col-md-1">--}}

{{--</div>--}}

<div class="col-md-4" style="background-color: #FFFFFF; border-radius: 10px;">
    <br>
    @if(Auth::check() and $user->id == Auth::id())
        <div class="panel panel-default">
            <div class="panel-body" id="tweet-form">
                {!! Form::open(['url' => '/'.$user->username]) !!}
                <div class="form-group">
                    {!! Form::text('content', '', array('class' => 'form-control', 'placeholder' => "What's happening?", 'id' => 'tweetfield')) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('user_id', Auth::id()) !!}
                </div>

                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        {{--{!! Form::submit('Tweet', ['class' => 'btn btn-primary form-control']) !!}--}}
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-pencil-square-o" style="margin-top: 4px; margin-left:-4px; float: left;"></i>&nbsp;Tweet</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif
    <div id="tweets-panel">
        @foreach($tweets as $tweet)
            <div class="panel panel-default">
                {{--<div class="panel-heading">Tweet</div>--}}
                <div class="panel-body">
                    <text>{{ $tweet->content }}</text>
                </div>

                <div class="barra">&nbsp;&nbsp;{{ '@' . $tweet->user->username }}</div>
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
</div>

<div class="col-md-1" class="pad20">
    <div id="follow-form">
        @if(Auth::check() && Auth::id() != $user->id && !Auth::user()->following()->where('following', $user->id)->first() )
            {!! Form::open([ 'url' => '/follow/' . $user->username ]) !!}
            {!! Form::hidden('follower', Auth::id()) !!}
            {!! Form::hidden('user_id', $user->id) !!}
                <button type="submit" class="btn btn-lg btn-default"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
            {!! Form::close() !!}
        @endif
    </div>
</div>
<div class="col-md-2"></div>
<div class="col-md-1">
    <script type="text/javascript">
        $(document).ready(function(){

            $('#tweet-form').on('submit', function(e){
                e.preventDefault();
                var content = $(this).find('input[name=content]').val();
                var user_id = $(this).find('input[name=user_id]').val();
                $.ajax({
                    type : 'POST',
                    url : '/tweet',
                    data : { content : content, user_id : user_id },
                    success: function(msg){
                        var tweet = '<div class="panel panel-default"><div class="panel-body"><text>'+ msg.content +'</text></div><div class="barra">&nbsp;&nbsp;{{ "@" . $user->username }}</div>@if (Auth::check() && Auth::id() != $tweet->user_id)@if  (!$tweet->hasLikeFrom(Auth::id())){!! Form::open(["url"=>"likes"]) !!}{!! Form::hidden("tweet_id",$tweet->id) !!}{!! Form::hidden("user_id",Auth::user()->id) !!}<button type="submit" class="marg btn btn-default">{!!FA::icon("star")!!} &nbsp{{$tweet->likes->count() }}</button>{!! Form::close() !!} @else <button class="btn-like marg btn btn-default">{!!FA::icon("star")!!} &nbsp{{$tweet->likes->count() }}</button> @endif @endif</div>';
                        $('#tweets-panel').append(tweet);
                    }
                });
            });

            $('#follow-form').on('submit', function(e){
                e.preventDefault();
                var follower = $(this).find('input[name=follower]').val();
                var user_id = $(this).find('input[name=user_id]').val();
                $.ajax({
                    type : 'POST',
                    url : '/follow/' + '{{ $user->username }}',
                    data : { follower : follower, user_id : user_id },
                    success: function(msg){
                        $('#follow-button').css('display', 'none');
                        var obj = $('#following-count');
                        obj.text((parseInt(obj.text()) + 1));
                    }
                });
            });
        });
    </script>
</div>

@endsection