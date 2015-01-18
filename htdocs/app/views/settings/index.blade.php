@extends('layouts.default')
@section('body')
<div class="container">
<h1>User Settings</h1>
<h2>Profile</h2>
<h1>Security Settings</h1>
<h2>Password</h2>
<h2>2 Factor Authentication</h2>
@if (is_null($UserMethods))
  @foreach ($UserMethods as $UserMethod)
    <h1>{{$UserMethod->pivot->order}}. {{ $UserMethod->friendly_name}}</h1>
    @if ($UserMethod->pivot->order == count($UserMethods) || $UserMethod->pivot->order != 1)
      <a>Move Up</a>
    @endif
    @if ($UserMethod->pivot->order < count($UserMethods) || $UserMethod->pivot->order == 1)
    <a>Move Down</a>
    @endif
    <a>Disable</a>
  @endforeach
@else
  <ul>
  @foreach ($MultiFactorMethods as $MultiFactorMethod)
    <li><a href="{{ URL::to('settings/'.$MultiFactorMethod->name) }}">Enable {{$MultiFactorMethod->friendly_name}}</a></li>
  @endforeach
  </ul>
@endif
<h1>Connected Applications</h1>
</div>
@endsection
