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
  <div class="container"  style="padding:0;">
    @foreach ($meme as $mem)
      @if($mem->type == 'Meme')
      <div class="col-md-8" style="padding:0; margin-left:auto; margin-right:auto;">
        <div class="card" style="border: 0;width: 100%;">
            <div class="card-header" style="background-color: black; color:white; padding-left: 4%;">{{$mem->author}}</div>

            <div class="card-body" id="{{$mem->id}}" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 10px; padding-right: 10px; padding-top: 15px;">

            <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
              <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $mem->id])}}' style="font-size: 22px; color: lightgray; display:inline-block; width: 87%;">{{$mem->title}}</a>
              <a class="comments" class="linking" href='{{Route('sites.mem', ['id' => $mem->id])}}' style="margin-left: 0%; margin-left: 0px; margin-top: 8px; padding: 0; display: inline-block; position: static;color:white; text-decoration: none;"><img src="{{Asset('storage/images/comment.jpg')}}" width="30" height="30" style="">{{$mem->comment_number}}</a><br></div>
              <a  class="category" style="color: #FFD700">{{$mem->category}}</a>

              <span class="tags" style="margin-left: 20px; font-size: 12px;">
                @foreach (explode(',', $mem->tags) as $tag)

                 <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                @endforeach
              </span>

              <div class="mem" style="margin-top: 10px;">
                <a><img src="{{Asset('storage/images/'.$mem->meme)}}" width="100%;"></a>
              </div><br>

              <!-- LIKES AND DISLIKEs -->

              @if(isset(Auth::user()->name) && $mem->id != session('status'))
                <form method="post" action="{{Route('sites.likingmem')}}">
                  <input name="_token" value="{{csrf_token()}}" type="hidden">
                  <input type="hidden" value="{{$mem->likes}}" name="likes">
                  <input type="hidden" value="{{$mem->id}}" name="likeid">
                  <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                  <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
                </form>


                <form method="post" action="{{Route('sites.dislikingmem')}}">
                 <input name="_token" value="{{csrf_token()}}" type="hidden">
                 <input type="hidden" value="{{$mem->dislikes}}" name="dislikes">
                 <input type="hidden" value="{{$mem->id}}" name="dislikeid">
                 <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                 <button class="linking" style="border: 0;background-color: crimson;  width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>
                </form>

               <!-- REPORTING -->
               <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                 <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                   @csrf
                   <input type="hidden" value="{{$mem->id}}" name="id">
                   <input type="hidden" value="{{$mem->meme}}" name="meme">
                   <input type="hidden" value="{{$mem->title}}" name="title">
                   <input type="hidden" value="{{$mem->category}}" name="memecategory">
                   <input type="hidden" value="{{$mem->tags}}" name="tags">
                   <input type="hidden" value="{{$mem->type}}" name="type">
                   <input type="hidden" value="{{$mem->author}}" name="author">

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
               <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
               <button class="linking" style="border: 0;background-color: crimson; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>

               <!-- REPORTING -->
               <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                 <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                   @csrf
                   <input type="hidden" value="{{$mem->id}}" name="id">
                   <input type="hidden" value="{{$mem->meme}}" name="meme">
                   <input type="hidden" value="{{$mem->title}}" name="title">
                   <input type="hidden" value="{{$mem->category}}" name="memecategory">
                   <input type="hidden" value="{{$mem->tags}}" name="tags">
                   <input type="hidden" value="{{$mem->type}}" name="type">
                   <input type="hidden" value="{{$mem->author}}" name="author">

                   <div style="width: 100%;">
                     <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                       <button style="border:0; background-color: transparent;color:lightgray;">
                         <a style="cursor:pointer;">Report</a>
                       </button>
                     </div>
                   </div>

                 </form>
               </div>
                <span style="font-size:13px; position: absolute;">Log in to rate!</span>
               <div class="form-group row" style="padding: 0; margin-bottom: 0;">
              @endif






              @if(isset(Auth::user()->name) && $mem->id == session('status'))
               <button class="linking" style="border: 0;background-color: #777FA1; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
               <button class="linking" style="border: 0;background-color: #B54E64; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>

               <!-- REPORTING -->
               <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                 <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                   @csrf
                   <input type="hidden" value="{{$mem->id}}" name="id">
                   <input type="hidden" value="{{$mem->meme}}" name="meme">
                   <input type="hidden" value="{{$mem->title}}" name="title">
                   <input type="hidden" value="{{$mem->category}}" name="memecategory">
                   <input type="hidden" value="{{$mem->tags}}" name="tags">
                   <input type="hidden" value="{{$mem->type}}" name="type">
                   <input type="hidden" value="{{$mem->author}}" name="author">

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
       @endif








       @if($mem->type == 'Video')
       <div class="col-md-8" style="padding:0; margin-left:auto; margin-right:auto;">
         <div class="card" style="border: 0;width: 100%;">
             <div class="card-header" style="background-color: black; color:white; padding-left: 4%;">{{$mem->author}}</div>

             <div class="card-body" id="{{$mem->id}}" style="background-color: #222222; color: #cccccc; @if(!isset(Auth::user()->name)) padding-bottom: 26px;@endif @if(isset(Auth::user()->name)) padding-bottom: 15px;@endif padding-left: 10px; padding-right: 10px; padding-top: 15px;">

             <div class="form-group row" style="margin-left: 1%;padding: 0; margin-bottom: 0; margin-right: 0px;">
               <a class="title" class="linking" href='{{Route('sites.mem', ['id' => $mem->id])}}' style="font-size: 22px; color: lightgray; display:inline-block; width: 87%;">{{$mem->title}}</a>
               <a class="comments" class="linking" href='{{Route('sites.mem', ['id' => $mem->id])}}' style="margin-left: 0%; margin-left: 0px; margin-top: 8px; padding: 0; display: inline-block; position: static;color:white; text-decoration: none;"><img src="{{Asset('storage/images/comment.jpg')}}" width="30" height="30" style="">{{$mem->comment_number}}</a><br></div>
               <a  class="category" style="color: #FFD700">{{$mem->category}}</a>

               <span class="tags" style="margin-left: 20px; font-size: 12px;">
                 @foreach (explode(',', $mem->tags) as $tag)

                  <a href="#" class="linking" style="margin-left: 7px; color: gray;">{{$tag}}</a>

                 @endforeach
               </span>

               <div class="mem" style="margin-top: 10px;">
                 <a>
                   <video controls style="width: 100%;">
                   <source src="{{Asset('storage/images/'.$mem->meme)}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>

                 </video>
               </a>
               </div><br>

               <!-- LIKES AND DISLIKEs -->

               @if(isset(Auth::user()->name) && $mem->id != session('status'))
                 <form method="post" action="{{Route('sites.likingmem')}}">
                   <input name="_token" value="{{csrf_token()}}" type="hidden">
                   <input type="hidden" value="{{$mem->likes}}" name="likes">
                   <input type="hidden" value="{{$mem->id}}" name="likeid">
                   <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                   <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
                 </form>


                 <form method="post" action="{{Route('sites.dislikingmem')}}">
                  <input name="_token" value="{{csrf_token()}}" type="hidden">
                  <input type="hidden" value="{{$mem->dislikes}}" name="dislikes">
                  <input type="hidden" value="{{$mem->id}}" name="dislikeid">
                  <input type="hidden" value="{{Auth::user()->name}}" name="sendeduser">
                  <button class="linking" style="border: 0;background-color: crimson;  width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>
                 </form>

                <!-- REPORTING -->
                <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                  <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                    @csrf
                    <input type="hidden" value="{{$mem->id}}" name="id">
                    <input type="hidden" value="{{$mem->meme}}" name="meme">
                    <input type="hidden" value="{{$mem->title}}" name="title">
                    <input type="hidden" value="{{$mem->category}}" name="memecategory">
                    <input type="hidden" value="{{$mem->tags}}" name="tags">
                    <input type="hidden" value="{{$mem->type}}" name="type">
                    <input type="hidden" value="{{$mem->author}}" name="author">

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
                <button class="linking" style="border: 0;background-color: dodgerblue; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
                <button class="linking" style="border: 0;background-color: crimson; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>

                <!-- REPORTING -->
                <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                  <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                    @csrf
                    <input type="hidden" value="{{$mem->id}}" name="id">
                    <input type="hidden" value="{{$mem->meme}}" name="meme">
                    <input type="hidden" value="{{$mem->title}}" name="title">
                    <input type="hidden" value="{{$mem->category}}" name="memecategory">
                    <input type="hidden" value="{{$mem->tags}}" name="tags">
                    <input type="hidden" value="{{$mem->type}}" name="type">
                    <input type="hidden" value="{{$mem->author}}" name="author">

                    <div style="width: 100%;">
                      <div class="form-control" style="font-size: 13px; border: 0; background-color: transparent;width: 35%; margin-left:65%; text-align: right; color: lightgray;">
                        <button style="border:0; background-color: transparent;color:lightgray;">
                          <a style="cursor:pointer;">Report</a>
                        </button>
                      </div>
                    </div>

                  </form>
                </div>
                 <span style="font-size:13px; position: absolute;">Log in to rate!</span>
                <div class="form-group row" style="padding: 0; margin-bottom: 0;">
               @endif






               @if(isset(Auth::user()->name) && $mem->id == session('status'))
                <button class="linking" style="border: 0;background-color: #777FA1; width: 50px; border-radius: 4px; height: 27px;float:left; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">+ {{$mem->likes}}</button>
                <button class="linking" style="border: 0;background-color: #B54E64; width: 50px; border-radius: 4px; float:left; margin-left: 5px;  height: 27px; text-align: center; font-size: 18px; font-family: 'Open Sans', sans-serif;">- {{$mem->dislikes}}</button>

                <!-- REPORTING -->
                <div class="form-group row" style="padding: 0; margin-bottom: 0; text-align:right;">
                  <form method="post" action = "{{Route('sites.reporting')}}" style="width: 100%;">
                    @csrf
                    <input type="hidden" value="{{$mem->id}}" name="id">
                    <input type="hidden" value="{{$mem->meme}}" name="meme">
                    <input type="hidden" value="{{$mem->title}}" name="title">
                    <input type="hidden" value="{{$mem->category}}" name="memecategory">
                    <input type="hidden" value="{{$mem->tags}}" name="tags">
                    <input type="hidden" value="{{$mem->type}}" name="type">
                    <input type="hidden" value="{{$mem->author}}" name="author">

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
        @endif



    @endforeach


    <div class="col-md-8" style="padding:0; margin-top: 50px; margin-left:auto; margin-right:auto;">
      <div class="card" style="border: 0; width: 95%; margin-left:auto; margin-right:auto;">
        <div class="card-header" style="background-color: black; font-size: 16px; color:#ddb500; padding-left: 20px;">Comments</div>

        <div class="card-body" id="" style="background-color: #222222; color: #cccccc; padding-left: 10px; padding-right: 10px; padding-top: 15px;">


        @if(isset(Auth::user()->name))
          <form method="post" action="{{Route('sites.addcomment')}}">
            <input name="_token" value="{{csrf_token()}}" type="hidden">
            <input type="hidden" value="{{Auth::user()->name}}" name="commentauthor">
            @foreach($meme as $mem)
            <input type="hidden" value="{{$mem->id}}" name="memid">
            @endforeach
          <div class="form-group row" style="margin: 0;">
            <span class="author" style="margin-left:.5%; color:white; font-size: 20px;font-family: 'Open Sans', sans-serif;">{{Auth::user()->name}}</span>
            </div>

            <div class="form-group" style="width: 100%; border-bottom: 1px solid #cca400; padding-bottom: 10px;">
              <textarea class="form-control" name="comment" class="comment" style="margin-left: .3%;"></textarea>
              <button type="submit" style="background-color: #ddb500; color: #222222; width: 17%; border:0; margin-top: 10px; margin-left: 83%;" class="btn btn-primary">
                  {{ __('Send') }}
              </button>
            </div>
          <div class="form-group row">
          </div>
        </form>
      @endif


      @if(!isset(Auth::user()->name))

        <div class="form-group row" style="width: 100%; border-bottom: 1px dashed #cccccc; padding-bottom: 10px; color:#ddb500; margin:0; font-size: 18px; font-family: 'Open Sans', sans-serif; margin-bottom: 20px;">
          <a id="goldhover" href="{{Route('login')}}" style="color:#ddb500;">Log in to comment!</a>
        </div>

      @endif

          @foreach($comments as $comment)
          <div class="form-group row" style="margin: 0;">
            <span class="author" style="margin-left:0; color:white; font-size: 20px;font-family: 'Open Sans', sans-serif;">{{$comment->authorcomment}}</span>
            <span class="date" style="color: gray; margin-left: 1%; margin-top: 5px;">{{$comment->date}}</span></div>

            <div style="width: 100%; border-bottom: 1px solid #cca400; padding-bottom: 10px;">
              <span class="comment" style="margin-left: .3%;">{{$comment->comment}}</span>
              @if(isset(Auth::user()->name))
                @if($comment->authorcomment == Auth::user()->name)
                  <br><form method="post" action="{{Route('sites.commentdelete')}}">
                    @csrf
                    <input type="hidden" value="{{$comment->id}}" name="commentid">
                      @foreach($meme as $mem)
                        <input type="hidden" value="{{$mem->id}}" name="memeid">
                      @endforeach
                    <button type="submit" style="border:0;background-color: transparent; color: crimson; cursor: pointer;padding:0; width:15%; margin-left: 85%;">{{ __('Delete') }}</button>
                  </form>
                @endif


                @foreach($users as $user)
                  @if($user->admin == 1)
                    <br><form method="post" action="{{Route('sites.commentdelete')}}">
                      @csrf
                      <input type="hidden" value="{{$comment->id}}" name="commentid">
                        @foreach($meme as $mem)
                          <input type="hidden" value="{{$mem->id}}" name="memeid">
                        @endforeach
                      <button type="submit" style="border:0;background-color: transparent; color: crimson; cursor: pointer;padding:0; width:15%; margin-left: 85%;">{{ __('Delete') }}</button>
                    </form>
                  @endif
                @endforeach
              @endif

            </div>
          <div class="form-group row">
          </div>


        @endforeach
        </div>
      </div>
    </div>

   </div>
@endsection
