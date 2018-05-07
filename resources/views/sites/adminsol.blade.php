@extends('layouts.app')
@section('content')
  <div class="container" style="width: 100%; margin-top: 72px;">
    <div class="col-md-8" style="margin-left:auto; margin-right: auto;">
    <a href="{{Route('sites.checkingmemes')}}" style="color:#dddddd;">
      <div style="margin-bottom: 20px; width: 100%; background-color: #6600cc;text-align:center; padding: 15px; border-radius: 5px; font-family: 'Open Sans', sans-serif; font-size: 16px; margin-left:auto; margin-right: auto;">
        Memes
      </div>
    </a>

    <a href="{{Route('sites.adminreports')}}" style="color:#dddddd;">
      <div style="margin-bottom: 20px; width: 100%; background-color: crimson;text-align:center; padding: 15px; border-radius: 5px; font-family: 'Open Sans', sans-serif; font-size: 16px; margin-left:auto; margin-right: auto;">
        Reports
      </div>
    </a>
  </div>
@endsection
