@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 72px;">
  <div style="width: 100%; text-align:center;"><span style="font-size: 26px; color: dodgerblue;width: 100%; margin-left:auto; margin-right:auto;">Check the reports here!</span></div><br>
  <div class="row justify-content-center" style="">
  @foreach($reports as $report)
    @if($report->type == "Meme")
    <div class="col-md-8" style="">
    <div class="row justify-content-center" style="">
        <div class="card" style="border:0; width: 100%; margin-bottom: 50px;">
            <div class="card-header" style="background-color: black; color:white; padding-left: 30px;">{{$report->author}}</div>

            <div class="card-body" id="{{$report->id}}" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 10px; padding-right: 10px; padding-top: 15px;">

                <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
                <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $report->id])}}' style="font-size: 22px; color:lightgray; display:inline-block; width: 87%;">{{$report->title}}</a>
                  </div>
                <a  class="category" style="color: #FFD700">{{$report->category}}</a>

                <span class="tags" style="margin-left: 20px; font-size: 12px;">
                  @foreach (explode(',', $report->tags) as $tag)

                  <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                  @endforeach
                </span>

                <div class="mem" style="margin-top: 10px;">
                  <a><img src="{{Asset('storage/images/'.$report->meme)}}" width="100%;"></a>
                </div><br>
                <div style="width: 100%; border: 1px solid #dbc000;border-radius: 4px; padding: 4px; font-size: 22px; font-family: 'Open Sans', sans-serif; background-color: #111111;">
                  <span>{{$report->category}}</span>
                </div>
                <div style="width: 100%; border: 1px solid #dbc000;border-radius: 4px; padding: 4px; font-size: 18px; font-family: 'Open Sans', sans-serif; background-color: #333333; margin-bottom: 20px; border-top:0;">
                  <span>{{$report->reporttext}}</span>
                </div>
                <form method="POST" action="{{Route('sites.reportdeleting')}}">
                  @csrf
                  <input type="hidden" value="{{$report->id}}" name="id">

                  <button class="btn-primary" style="border:0; cursor:pointer; width: 20%; border-radius: 3px; padding:5px; font-size: 16px; margin-left: 15%;float: left;background-color: dodgerblue">Delete Report</button>
                </form>


                <form method="POST" action="{{Route('sites.reportdeletingmem')}}">
                  @csrf
                  <input type="hidden" value="{{$report->id}}" name="id">
                  <input type="hidden" value="{{$report->memeid}}" name="memeid">

                  <button class="btn-primary" style="border:0; cursor:pointer; width: 20%; border-radius: 3px; padding:5px; font-size: 16px; margin-left: 30%;float: left;background-color: crimson">Delete Mem</button>
                </form>


                </div>
              </div>
            </div>
          </div>

        @endif











        @if($report->type == "Video")
        <div class="col-md-8" style="">
        <div class="row justify-content-center" style="">
            <div class="card" style="border:0; width: 100%; margin-bottom: 50px;">
                <div class="card-header" style="background-color: black; color:white; padding-left: 30px;">{{$report->author}}</div>

                <div class="card-body" id="{{$report->id}}" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 10px; padding-right: 10px; padding-top: 15px;">

                    <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
                    <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $report->id])}}' style="font-size: 22px; color:lightgray; display:inline-block; width: 87%;">{{$report->title}}</a>
                      </div>
                    <a  class="category" style="color: #FFD700">{{$report->category}}</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      @foreach (explode(',', $report->tags) as $tag)

                      <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                      @endforeach
                    </span>

                    <div class="mem" style="margin-top: 10px;">
                      <a>
                        <video controls style="width: 100%;">
                          <source src="{{Asset('storage/images/'.$report->meme)}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>

                        </video>
                      </a>
                    </div><br>

                    <div style="width: 100%; border: 1px solid #dbc000;border-radius: 4px; padding: 4px; font-size: 22px; font-family: 'Open Sans', sans-serif; background-color: #111111;">
                      <span>{{$report->category}}</span>
                    </div>
                    <div style="width: 100%; border: 1px solid #dbc000;border-radius: 4px; padding: 4px; font-size: 18px; font-family: 'Open Sans', sans-serif; background-color: #333333; margin-bottom: 20px; border-top:0;">
                      <span>{{$report->reporttext}}</span>
                    </div>

                    <form method="POST" action="{{Route('sites.reportdeleting')}}">
                      @csrf
                      <input type="hidden" value="{{$report->id}}" name="id">

                      <button class="btn-primary" style="border:0; cursor:pointer; width: 20%; border-radius: 3px; padding:5px; font-size: 16px; margin-left: 15%;float: left;background-color: dodgerblue">Delete Report</button>
                    </form>


                    <form method="POST" action="{{Route('sites.reportdeletingmem')}}">
                      @csrf
                      <input type="hidden" value="{{$report->id}}" name="id">
                      <input type="hidden" value="{{$report->memeid}}" name="memeid">

                      <button class="btn-primary" style="border:0; cursor:pointer; width: 20%; border-radius: 3px; padding:5px; font-size: 16px; margin-left: 30%;float: left;background-color: crimson">Delete Mem</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>

            @endif
  @endforeach
</div>
@endsection
