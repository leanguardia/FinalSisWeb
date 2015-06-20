@extends('app')
@section('content')

    <div class="col-md-1">
    </div>
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

    <div class="col-md-4 contenTweets">
        <br>
        @if(Auth::check() and $user->id == Auth::id())
            <div class="panel panel-default">
                <div class="panel-body" id="tweet-form">
                    {!! Form::open(['url' => '/'.$user->username]) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', '', array('class' => 'form-control', 'placeholder' => "What's happening?", 'id' => 'tweetfield')) !!}
                        <p id="charNum">140</p>
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
                    @if ($tweet->reply)
                        <div class="panel-body">
                            <text>{{$tweet->getRepliedTweet()->content}}</text>
                        </div>

                        <div class="barra"><a href="/{{$tweet->getRepliedTweet()->user->username}}">&nbsp;&nbsp;{{'@'.$tweet->getRepliedTweet()->user->username}}</a></div>
                    @endif
                    <div class="panel-body">
                        <text>{{ $tweet->content }}</text>
                    </div>
                    @if (!$tweet->tweet_id )
                        <div class="barra">&nbsp;&nbsp;{{ '@' . $tweet->user->username }}</div>
                    @else
                        @if($tweet->reply)
                                <div class="barra">&nbsp;&nbsp;{!!FA::icon('reply')!!} {{ '@' . $tweet->user->username }} </div>
                        @else
                                <div class="barra">&nbsp;&nbsp;{!!FA::icon('retweet')!!} <a href="/{{$tweet->getRepliedTweet()->user->username}}">{{'@'.$tweet->getWriter()}}</a></div>
                        @endif
                    @endif
                    @if (Auth::check() && Auth::id() != $tweet->user_id)
                        <div class="panel-footer">
                            <div class="form-inline">

                                @if  (!$tweet->hasLikeFrom(Auth::id()))
                                    {!! Form::open(['url'=>'likes']) !!}
                                    {!! Form::hidden('tweet_id',$tweet->id) !!}
                                    {!! Form::hidden('user_id',Auth::user()->id) !!}
                                     <button style="float: left ;" type="submit" class="marg btn btn-default">{!!FA::icon('star')!!} &nbsp;{{$tweet->likes->count() }}</button>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(array('route' => array('likes.destroy', $tweet->getLikeId(Auth::user()->id)), 'method' => 'delete')) !!}
                                    <button class="marg btn btn-default" type="submit">Dislike&nbsp;{{$tweet->likes->count()}}</button>
                                    {!! Form::close() !!}
                                @endif
                                <div class="repost-form">
                                    @if  (!Auth::user()->hasRetwitted($tweet->id))
                                            {!! Form::open(['url'=> 'retweet/' ]) !!}
                                            {!! Form::hidden('tweet_id',$tweet->id) !!}
                                            {!! Form::hidden('user_id',Auth::user()->id) !!}
                                            {!! Form::hidden('content',$tweet->content) !!}
                                             <button style="float: left ;" type="submit" class="marg btn btn-default retweet-count">{!!FA::icon('retweet')!!}&nbsp;{{$tweet->getRTT() }}</button>
                                            {!! Form::close() !!}
                                    @else
                                             <button style="float: left ;" class="btn-rt marg btn btn-default disabled retweet-count">{!!FA::icon('retweet')!!}&nbsp;{{$tweet->getRTT() }}</button>
                                    @endif
                                </div>
                                <div class="input-group input-group-sm">
                                    {!!Form::open(['url'=>'reply'])!!}
                                    {!!Form::text('content',null,['placeholder'=>'@'.$tweet->user->username,'class'=>'marg form-control'])!!}
                                    {!!Form::hidden('user_id',Auth::user()->id)!!}
                                    {!!Form::hidden('tweet_id',$tweet->id) !!}
                                    {!!Form::hidden('reply',true)!!}
                                    <button type="submit" class="marg btn btn-default">{!!FA::icon('reply')!!}&nbsp;</button>
                                    {!!Form::close()!!}
                                </div>

                             </div>

                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-1" class="pad20">

            @if(Auth::check() && Auth::id() != $user->id && !Auth::user()->following()->where('following', $user->id)->first() )
                <div id="follow-form">
                    {!! Form::open([ 'url' => '/follow/' . $user->username ]) !!}
                    {!! Form::hidden('follower', Auth::id()) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    <button type="submit" class="btn btn-lg btn-default" id="follow-button"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
                    {!! Form::close() !!}
                </div>

                <div id="unfollow-form" style="display: none">
                    {!! Form::open([ 'url' => '/unfollow/' . $user->username ]) !!}
                    {!! Form::hidden('follower', Auth::id()) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    <button type="submit" class="btn btn-lg btn-default" id="follow-button"><i class="fa fa-user"></i>&nbsp;&nbsp;Unfollow</button>
                    {!! Form::close() !!}
                </div>
            @else
                @if(Auth::id() != $user->id)
                    <div id="follow-form" style="display: none">
                        {!! Form::open([ 'url' => '/follow/' . $user->username ]) !!}
                        {!! Form::hidden('follower', Auth::id()) !!}
                        {!! Form::hidden('user_id', $user->id) !!}
                        <button type="submit" class="btn btn-lg btn-default" id="follow-button"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
                        {!! Form::close() !!}
                    </div>

                    <div id="unfollow-form">
                        {!! Form::open([ 'url' => '/unfollow/' . $user->username ]) !!}
                        {!! Form::hidden('follower', Auth::id()) !!}
                        {!! Form::hidden('user_id', $user->id) !!}
                        <button type="submit" class="btn btn-lg btn-default" id="follow-button"><i class="fa fa-user"></i>&nbsp;&nbsp;Unfollow</button>
                        {!! Form::close() !!}
                    </div>
                @endif
            @endif

    </div>
    <div class="col-md-2">
        <a href="/{{$user->username}}/followers" class="btn btn-lg btn-default">Followers</a>
        <a href="/{{$user->username}}/following" class="btn btn-lg btn-default">Following</a>
    </div>
    <div class="col-md-1">
        <script type="text/javascript">
            $('#unfollow-form').on('submit', function(e){
                e.preventDefault();
                var follower = $(this).find('input[name=follower]').val();
                var user_id = $(this).find('input[name=user_id]').val();
                $.ajax({
                    type : 'POST',
                    url : '/unfollow/' + '{{ $user->username }}',
                    data : { follower : follower, user_id : user_id },
                    success: function(msg){
                        $('#follow-button').css('display', 'block');
                        $('#unfollow-form').css('display', 'none');
                        var obj = $('#followers-count');
                        obj.text((parseInt(obj.text()) - 1));
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
                        $('#unfollow-form').css('display', 'block');
                        var obj = $('#followers-count');
                        obj.text((parseInt(obj.text()) + 1));
                    }
                });
            });
        </script>
    </div>

@endsection