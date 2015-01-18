@extends('layouts.default')
<div class="container">
    <div>
     <h1>Profile</h1>
        @if(Auth::check())
            <p>Welcome to your profile page {{Auth::user()->first_name}}</p>

        @endif
    </div>
</div>
<br /><br />
