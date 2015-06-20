@extends('app')
@section('content')
    <div class="container">
    <div class="col-md-4">

            <h1>{{$user->username}} is been followed by:</h1>
            <br/>
            @if ($user->followers->count()>=1)
                    @foreach($user->followers as $follow)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                {{$follow->getFollower()->username}}
                            </div>
                            <div class="barra">&nbsp;&nbsp;<a href="/{{$follow->getFollower()->username}}">{{ '@' . $follow->getFollower()->username}}</a></div>
                        </div>
                    @endforeach
                @else
                <h2>Nobody xD</h2>
            @endif
        </div>
    </div>

@endsection