@extends('main')

@section('name')
    <h5 class="col-4 text-right">Welcome, {{ $user->name }}</h5>
@endsection

@section('body')
<div class="container message-container">
    <h2>Your Messages</h2>
    <p v-if="messages.length === 0">No messages have been received yet. Please wait...</p>
    <p v-for="message in messages" v-text="message"></p>
</div>
@endsection

@section('js')
<script type="text/javascript">
<!--
    window.userId = {{ $user->id }};
//-->
</script>
<script src="/js/client.js"></script>
@endsection
