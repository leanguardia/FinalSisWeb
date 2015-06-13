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
            <strong style="color: #0083b3">&nbsp;{{ $tweets->count() }}</strong>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            FOLLOWING
            <br>
            <strong style="color: #0083b3">&nbsp;{{ $user->following->count() }}</strong>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-3">
            FOLLOWERS
            <br>
            <strong style="color: #0083b3">&nbsp;{{ $user->followers->count() }}</strong>
        </div>
    </div>
</div>

{{--<div class="col-md-1">--}}

</div>

<div class="col-md-4" style="background-color: #FFFFFF; border-radius: 10px;">
    <br>
    @if(Auth::check() and $user->id == Auth::id())
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => '/'.$user->username]) !!}
                <div class="form-group">
                    {!! Form::text('content', '', array('class' => 'form-control', 'placeholder' => "What's happening?")) !!}
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
                </form>
            </div>
        </div>
    @endif

    @foreach($tweets as $tweet)
        <div class="panel panel-default">
            {{--<div class="panel-heading">Tweet</div>--}}
            <div class="panel-body">
                <text>{{ $tweet->content }}</text>
            </div>
            <div style="background-color: rgba(0, 131, 179, 0.38); overflow: hidden">&nbsp;&nbsp;{{ '@' . $tweet->user->username }}</div>
            <ul class="horizontal">
                <li>
                    {!! Form::open(['url'=>'likes']) !!}
                    {!! Form::hidden('tweet_id',$tweet->id) !!}
                    {!! Form::hidden('user_id',Auth::user()->id) !!}

                    <button type="submit" class="btn btn-default">{!!FA::icon('star')!!}</button>
                    {!! Form::close() !!}
                </li>
                <li>{{$tweet->likes->count() }}</li>

            </ul>

        </div>
    @endforeach
</div>

<div class="col-md-1" style="padding: 20px">
    @if(Auth::check() && Auth::id() != $user->id)
        {!! Form::open() !!}
            <button type="submit" class="btn btn-lg btn-default"><i class="fa fa-user"></i>&nbsp;&nbsp;Follow</button>
        {!! Form::close() !!}
    @endif
</div>
<div class="col-md-2"></div>
<div class="col-md-1"></div>

@endsection