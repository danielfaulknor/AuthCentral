@extends('layouts.default')
@section('body')
<div class="container">
  <h1>Set up Authy</h1>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <p>Please provide your cell phone number in international format in the appropriate boxes (+64 27 123 5555)</p>
      {{ Form::open(array('url' => '/settings/authy/register',  'method' => 'post', 'class'=>"form-signin")) }}
      <ul>
        @foreach ($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
      </ul>
      <div class="form-group">
        {{Form::label('country','Country Code')}}
        {{Form::text('country', null,array('class' => 'form-control'))}}
        {{Form::label('phone','Phone Number')}}
        {{Form::text('phone', null,array('class' => 'form-control'))}}
      </div>
      {{Form::submit('Register', array('class' => 'btn btn-primary'))}}
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection
