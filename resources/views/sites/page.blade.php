@extends('layouts.app')

@section('content')
  <div style="width: 100%; min-height: 60px; font-size: 22px; margin-top: 38px;padding-top: 11px;padding-right: 5%;text-align: center;padding-left: 5%;background-color: #333333; margin-bottom: 35px;">
    <ul style="margin:0;padding:0;">
      @foreach ($categories as $category)
        <li style="display: inline-block; margin-left: 3%;">
          <a href="{{Route('sites.categories', ['category' => $category->category])}}" style="color: #bbbbbb;">{{$category->category}}</a>
        </li>
      @endforeach
    </ul>
  </div>
<div class="container">
  <div class="row justify-content-left" style=" float:left;">
    <div media="(min-device-width: 640px)" style="width:25%; margin-left: 60%;height: 150px; position: absolute; margin-top: 30px;">
      <div style="border: 1px solid #333333; background-color: #111111; border-radius: 4px;padding: 15px; width: 100%; margin-left: 10%;">
        <a target="_blank" href="https://www.facebook.com/profile.php?id=100007072909482">
          <img src="{{Asset('storage/images/facebook.png')}}" style="width: 40%;height: 130px; margin-left: 1%;">
        </a>
        <a target="_blank" href="https://plus.google.com/u/0/114869168099549108892">
          <img src="{{Asset('storage/images/google.png')}}" style="width: 40%;margin-left: 17%;;height: 130px;">
        </a>
      </div>
    </div>
        <div class="col-md-8" style="margin-bottom: 20px;">

          @if(isset($users))
            @foreach($users as $user)
              @if($user->admin == 1)
                <a href="{{Route('sites.adminsol')}}" style="color:#dddddd;">
                  <div style="margin-bottom: 20px; background-color: #6600cc; width: 100%;text-align:center; padding: 3px; border-radius: 5px; font-family: 'Open Sans', sans-serif; font-size: 16px;">
                    Admin Panel
                  </div>
                </a>
              @endif
            @endforeach
          @endif
        </div>

@foreach ($memes as $meme)
  @if($meme->type == "Meme")
        <div class="col-md-8" style="">
          <div class="row justify-content-center" style="">
            <div class="card" style="border:0; width: 100%; margin-bottom: 50px;">
                <div class="card-header" id="{{$meme->id}}" style="background-color: black; color:white; padding-left: 4%;">{{$meme->author}}</div>

                <div class="card-body" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 2%; padding-right: 2%; padding-top: 15px;">

                    <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
                    <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $meme->id])}}' style="font-size: 22px; color:lightgray; display:inline-block; width: 87%;">{{$meme->title}}</a>
                      <a class="comments" href='{{Route('sites.mem', ['id' => $meme->id])}}' style="margin-left: 0%; padding: 0; margin-top: 8px; display: inline-block; position: static;color:white; text-decoration: none;"><img src="{{Asset('storage/images/comment.jpg')}}" width="30" height="30" style="">{{$meme->comment_number}}</a><br></div>
                    <a href='{{URL("/category/$meme->category")}}' class="category" style="color: #FFD700">{{$meme->category}}</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      @foreach (explode(',', $meme->tags) as $tag)

                      <a class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                      @endforeach
                    </span>

                    <div class="mem" style="margin-top: 10px;">
                      <a><img src="{{Asset('storage/images/'.$meme->meme)}}" width="100%;"></a>
                    </div><br>




                    <!-- LIKES AND DISLIKEs -->


                    @if(isset(Auth::user()->name) && $meme->id != session('status'))
                      <form method="post" action="{{Route('sites.likingonpage')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->likes}}" name="likes">
                        <input type="hidden" value="{{$meme->id}}" name="likeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <input type="hidden" value="{{$pageid}}" name="pageid">
                        <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      </form>


                      <form method="post" action="{{Route('sites.dislikingonpage')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->dislikes}}" name="dislikes">
                        <input type="hidden" value="{{$meme->id}}" name="dislikeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <input type="hidden" value="{{$pageid}}" name="pageid">
                      <button class="linking" style="border: 0;background-color: crimson;  width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>
                      </form>

                      <!-- REPORTING -->
                      <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                        <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                          @csrf
                          <input type="hidden" value="{{$meme->id}}" name="id">
                          <input type="hidden" value="{{$meme->meme}}" name="meme">
                          <input type="hidden" value="{{$meme->title}}" name="title">
                          <input type="hidden" value="{{$meme->category}}" name="memecategory">
                          <input type="hidden" value="{{$meme->tags}}" name="tags">
                          <input type="hidden" value="{{$meme->type}}" name="type">
                          <input type="hidden" value="{{$meme->author}}" name="author">
                          <input type="hidden" value="{{$pageid}}" name="pageid">

                          <div style="width: 100%;">
                            <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                              <button style="border:0; background-color: transparent;color:lightgray;">
                                <a style="cursor:pointer;">Report</a>
                              </button>
                            </div>
                          </div>

                        </form>

                    @endif




                    @if(!isset(Auth::user()->name))
                      <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      <button class="linking" style="border: 0;background-color: crimson; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>

                      <!-- REPORTING -->
                      <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                        <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                          @csrf
                          <input type="hidden" value="{{$meme->id}}" name="id">
                          <input type="hidden" value="{{$meme->meme}}" name="meme">
                          <input type="hidden" value="{{$meme->title}}" name="title">
                          <input type="hidden" value="{{$meme->category}}" name="memecategory">
                          <input type="hidden" value="{{$meme->tags}}" name="tags">
                          <input type="hidden" value="{{$meme->type}}" name="type">
                          <input type="hidden" value="{{$meme->author}}" name="author">
                          <input type="hidden" value="{{$pageid}}" name="pageid">

                          <div style="width: 100%;">
                            <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                              <button style="border:0; background-color: transparent;color:lightgray;">
                                <a style="cursor:pointer;">Report</a>
                              </button>
                            </div>
                          </div>

                        </form>
                      </div>
                        <span style="font-size:13px; position:absolute;">Log in to rate!</span>
                        <div class="form-group row" style="padding: 0; margin-bottom: 0;">


                    @endif






                  @if(isset(Auth::user()->name) && $meme->id == session('status'))
                    <button class="linking" style="border: 0;background-color: #777FA1; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                    <button class="linking" style="border: 0;background-color: #B54E64; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>

                    <!-- REPORTING -->
                    <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                      <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                        @csrf
                        <input type="hidden" value="{{$meme->id}}" name="id">
                        <input type="hidden" value="{{$meme->meme}}" name="meme">
                        <input type="hidden" value="{{$meme->title}}" name="title">
                        <input type="hidden" value="{{$meme->category}}" name="memecategory">
                        <input type="hidden" value="{{$meme->tags}}" name="tags">
                        <input type="hidden" value="{{$meme->type}}" name="type">
                        <input type="hidden" value="{{$meme->author}}" name="author">
                        <input type="hidden" value="{{$pageid}}" name="pageid">

                        <div style="width: 100%;">
                          <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                            <button style="border:0; background-color: transparent;color:lightgray;">
                              <a style="cursor:pointer;">Report</a>
                            </button>
                          </div>
                        </div>

                      </form>
                  @endif
                  </div>
                </div>
            </div>
        </div>
      </div>
  @endif










  @if($meme->type == "Video")
        <div class="col-md-8" style="">
          <div class="row justify-content-center" style="">
            <div class="card" style="border:0; width: 100%; margin-bottom: 50px;">
                <div class="card-header" id="{{$meme->id}}" style="background-color: black; color:white; padding-left: 4%;">{{$meme->author}}</div>

                <div class="card-body" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 2%; padding-right: 2%; padding-top: 15px;">

                    <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
                    <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $meme->id])}}' style="font-size: 22px; color:lightgray; display:inline-block; width: 87%;">{{$meme->title}}</a>
                      <a class="comments" href='{{Route('sites.mem', ['id' => $meme->id])}}' style="margin-left: 0%; margin-top: 8px;padding: 0; display: inline-block; position: static;color:white; text-decoration: none;"><img src="{{Asset('storage/images/comment.jpg')}}" width="30" height="30" style="">
                        {{$meme->comment_number}}</a><br></div>
                    <a href='{{URL("/category/$meme->category")}}' class="category" style="color: #FFD700">{{$meme->category}}</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      @foreach (explode(',', $meme->tags) as $tag)

                      <a class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                      @endforeach
                    </span>

                    <div class="mem" style="margin-top: 10px;">
                      <a>
                        <video controls style="width: 100%;">
                          <source src="{{Asset('storage/images/'.$meme->meme)}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>

                        </video>
                      </a>
                    </div><br>




                    <!-- LIKES AND DISLIKEs -->


                    @if(isset(Auth::user()->name) && $meme->id != session('status'))
                      <form method="post" action="{{Route('sites.likingonpage')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->likes}}" name="likes">
                        <input type="hidden" value="{{$meme->id}}" name="likeid">
                        <input type="hidden" value="{{$pageid}}" name="pageid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      </form>


                      <form method="post" action="{{Route('sites.dislikingonpage')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->dislikes}}" name="dislikes">
                        <input type="hidden" value="{{$meme->id}}" name="dislikeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <input type="hidden" value="{{$pageid}}" name="pageid">
                      <button class="linking" style="border: 0;background-color: crimson;  width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>
                      </form>

                      <!-- REPORTING -->
                      <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                        <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                          @csrf
                          <input type="hidden" value="{{$meme->id}}" name="id">
                          <input type="hidden" value="{{$meme->meme}}" name="meme">
                          <input type="hidden" value="{{$meme->title}}" name="title">
                          <input type="hidden" value="{{$meme->category}}" name="memecategory">
                          <input type="hidden" value="{{$meme->tags}}" name="tags">
                          <input type="hidden" value="{{$meme->type}}" name="type">
                          <input type="hidden" value="{{$meme->author}}" name="author">
                          <input type="hidden" value="{{$pageid}}" name="pageid">

                          <div style="width: 100%;">
                            <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                              <button style="border:0; background-color: transparent;color:lightgray;">
                                <a style="cursor:pointer;">Report</a>
                              </button>
                            </div>
                          </div>

                        </form>
                    @endif




                    @if(!isset(Auth::user()->name))
                      <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      <button class="linking" style="border: 0;background-color: crimson; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>

                      <!-- REPORTING -->
                      <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                        <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                          @csrf
                          <input type="hidden" value="{{$meme->id}}" name="id">
                          <input type="hidden" value="{{$meme->meme}}" name="meme">
                          <input type="hidden" value="{{$meme->title}}" name="title">
                          <input type="hidden" value="{{$meme->category}}" name="memecategory">
                          <input type="hidden" value="{{$meme->tags}}" name="tags">
                          <input type="hidden" value="{{$meme->type}}" name="type">
                          <input type="hidden" value="{{$meme->author}}" name="author">
                          <input type="hidden" value="{{$pageid}}" name="pageid">

                          <div style="width: 100%;">
                            <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                              <button style="border:0; background-color: transparent;color:lightgray;">
                                <a style="cursor:pointer;">Report</a>
                              </button>
                            </div>
                          </div>

                        </form>
                      </div>
                        <span style="font-size:13px; position:absolute;">Log in to rate!</span>
                        <div class="form-group row" style="padding: 0; margin-bottom: 0;">
                    @endif






                  @if(isset(Auth::user()->name) && $meme->id == session('status'))
                    <button class="linking" style="border: 0;background-color: #777FA1; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                    <button class="linking" style="border: 0;background-color: #B54E64; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$meme->dislikes}}</button>

                    <!-- REPORTING -->
                    <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                      <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                        @csrf
                        <input type="hidden" value="{{$meme->id}}" name="id">
                        <input type="hidden" value="{{$meme->meme}}" name="meme">
                        <input type="hidden" value="{{$meme->title}}" name="title">
                        <input type="hidden" value="{{$meme->category}}" name="memecategory">
                        <input type="hidden" value="{{$meme->tags}}" name="tags">
                        <input type="hidden" value="{{$meme->type}}" name="type">
                        <input type="hidden" value="{{$meme->author}}" name="author">
                        <input type="hidden" value="{{$pageid}}" name="pageid">

                        <div style="width: 100%;">
                          <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                            <button style="border:0; background-color: transparent;color:lightgray;">
                              <a style="cursor:pointer;">Report</a>
                            </button>
                          </div>
                        </div>

                      </form>
                  @endif
                  </div>
                </div>
            </div>
        </div>
      </div>
  @endif
@endforeach
<div class="col-md-8">
  <div class="row justify-content-center">
    <div style="height: 50px; width:100%; text-align: center; font-size: 24px; color: #cccccc; margin-top: -40px;  font-family: 'Open Sans', sans-serif;">Page - {{$pageid}}</div>
  </div>
</div>


<div class="col-md-8">
  <div class="row justify-content-center">


  @if($checkerbacker == "youcanback")
    <div style="height: 50px; width: 35%; margin-left: 5%;float:left;">
      <form method="POST" action="{{Route('sites.previouspage', ['pageid' => $pageid])}}">
        @csrf
        <input type="hidden" value="{{$pageid}}" name="pageid">
        <button style="width:100%; height: 40px; border:0; border-radius: 5px;cursor: pointer;font-size: 14px;background-color: #d5c000; font-family: 'Open Sans', sans-serif;">Prievious page</button>
      </form>
    </div>
  @endif

  @if($checkerbacker == "nobacking")
    <div style="height: 50px; margin-left: 5%; width: 35%;">
      <button style="width:100%; height: 40px; border:0; border-radius: 5px; font-size: 14px;background-color: #a29000; color: #222222; font-family: 'Open Sans', sans-serif;">Previous page</button>
    </div>
  @endif


  @if($pageid > 0)
    <div style="height: 50px; margin-left: 20%; width: 35%; margin-right: 5%;">
      <form method="POST" action="{{Route('sites.nextpage', ['pageid' => $pageid])}}">
        @csrf
        <input type="hidden" value="{{$pageid}}" name="pageid">
        <button style="width:100%; height: 40px; border:0; border-radius: 5px;cursor: pointer; font-size: 14px;background-color: #d5c000; font-family: 'Open Sans', sans-serif;">Next page</button>
      </form>
    </div>
  @endif

  @if($pageid == 0)
    <div style="height: 50px; margin-left: 20%; width: 35%; margin-right: 5%;">
      <button style="width:100%; height: 40px; border:0; border-radius: 5px; font-size: 14px;background-color: #a29000; color: #222222; font-family: 'Open Sans', sans-serif;">Next page</button>
    </div>
  @endif
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
