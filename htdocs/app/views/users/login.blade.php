@extends('layouts.default')
@section('body')
{{ Form::open(array('url' => 'login', 'method' => 'post', 'class' => 'form-signin')) }}
<p>Please sign in to modify your preferences</p>
<ul>
@foreach ($errors->all() as $message)
<li>{{$message}}</li>
@endforeach
</ul>
{{Form::label('email','Email')}}
{{Form::text('email', null,array('class' => 'form-control'))}}
{{Form::label('password','Password')}}
{{Form::password('password',array('class' => 'form-control'))}}
{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}


@stop
