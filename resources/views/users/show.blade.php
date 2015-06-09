@extends('app')
@section('content')

<div class="col-md-1"></div>
<div class="col-md-2">
    <h3>{{ $user->name . ' ' . $user->last_name }}</h3>
    <h4><a href="/{{ $user->username }}">{{ '@' . $user->username }}</a></h4>
</div>
<div class="col-md-6">
</div>
<div class="col-md-3"></div>
@endsection