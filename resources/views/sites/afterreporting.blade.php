@extends('layouts.app')

@section('content')
  <div class="container" style="margin-top: 72px;">
    <div class="justify-content-center">
      <div style="width: 100%; text-align:center; font-size: 26px; color: lightgray;"><span>Report sent!<br> We will consider it as fast as we can!</span>
        <br>
        <form method="POST" action="{{Route('sites.afterreportingmethod')}}">
          @csrf
          <input type="hidden" value="{{$pageid}}" name="pageid">
          <button style="border:0; cursor: pointer; color: #d5c000; background-color:transparent;">Return to home page</button>
      </div>
    </div>
  </div>
@endsection
