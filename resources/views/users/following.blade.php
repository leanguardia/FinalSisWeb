@extends('app')
@section('content')
    <div class="container">
    <div class="col-md-4">

            <h1>{{$user->username}} is Following to:</h1>
            <br/>
            @if ($user->following->count()>=1)
                @foreach($user->following as $follow)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{$follow->getFollowing()->username}}
                        </div>
                        <div class="barra">&nbsp;&nbsp;<a href="/{{$follow->getFollowing()->username}}">{{ '@' . $follow->getFollowing()->username }}</a></div>
                    </div>
                @endforeach
            @else
                <h2>Nobody</h2>

            @endif
        </div>
    </div>

@endsection