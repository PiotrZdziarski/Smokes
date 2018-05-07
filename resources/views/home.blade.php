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
  <div class="row justify-content-left" style="">
        <div class="col-md-8" style="margin-bottom: 50px;">

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

            <div class="card" style="border:0;">
                <div class="card-header" style="background-color: black; color:white; padding-left: 30px;">Pietras</div>

                <div class="card-body"   style="background-color: #222222; color: #cccccc; padding-left:50px;">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="title" style="font-size: 26px; width:81%; display: inline-block;">Najlepiejwtwetrnweotbewitboewtou</a>
                      <a class="comments" href="#" style="margin-left: 0%; color:white; text-decoration: none;"><img  src="http://chittagongit.com/images/white-chat-icon/white-chat-icon-27.jpg" width="30" height="30" style="margin-right: 10px;">41</a><br>
                    <a  class="category" style="color: #FFD700">Humor</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      <a style="margin-left: 7px;">#jd</a>
                      <a style="margin-left: 7px;">#zabawowo</a>
                    </span>

                    <div class="mem" style="margin-top: 10px;">
                      <a class="col-md-8"><img class="col-md-20" required autofocus src="http://www.thisiscolossal.com/wp-content/uploads/2014/03/120430.gif" width="90%"></a>
                    </div><br>

                    <a href="#" class="linking"><span style="background-color: #444444; width: 30px; border-radius: 4px; height: 23px;float:left; text-align: center; font-size: 18px;">+</span></a>
                    <a href="#" class="linking"><span style="background-color: #444444; width: 30px; border-radius: 4px; float:left; margin-left: 5px;  height: 23px;float:left; text-align: center; font-size: 16px;">-</span></a>

                    <a href="#" class="linking" style="font-size: 13px; margin-left: 60%; color: lightgray;">Report</a>
                </div>
            </div>
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
                    <a  class="category" style="color: #FFD700">{{$meme->category}}</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      @foreach (explode(',', $meme->tags) as $tag)

                      <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                      @endforeach
                    </span>

                    <div class="mem" style="margin-top: 10px;">
                      <a><img src="{{Asset('storage/images/'.$meme->meme)}}" width="100%;"></a>
                    </div><br>




                    <!-- LIKES AND DISLIKEs -->


                    @if(isset(Auth::user()->name) && $meme->id != session('status'))
                      <form method="post" action="{{Route('sites.liking')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->likes}}" name="likes">
                        <input type="hidden" value="{{$meme->id}}" name="likeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      </form>


                      <form method="post" action="{{Route('sites.disliking')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->dislikes}}" name="dislikes">
                        <input type="hidden" value="{{$meme->id}}" name="dislikeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
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
                    <a  class="category" style="color: #FFD700">{{$meme->category}}</a>

                    <span class="tags" style="margin-left: 20px; font-size: 12px;">
                      @foreach (explode(',', $meme->tags) as $tag)

                      <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

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
                      <form method="post" action="{{Route('sites.liking')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->likes}}" name="likes">
                        <input type="hidden" value="{{$meme->id}}" name="likeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                        <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$meme->likes}}</button>
                      </form>


                      <form method="post" action="{{Route('sites.disliking')}}">
                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$meme->dislikes}}" name="dislikes">
                        <input type="hidden" value="{{$meme->id}}" name="dislikeid">
                        <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
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
@endsection
