@extends('main')

@section('body')
<div class="container login-container">
    <h2>Register Your Session</h2>
    <form action="/register-session" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input id="form_name" class="form-control" type="text" name="name" value="" placeholder="Your Name" />
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
    </form>
</div>
@endsection
