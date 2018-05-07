@extends('layouts.app')
@section('content')
  <div class="container" style="margin-top: 72px;">
        <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card" style="border: 0;">
                  <div class="card-header" style="background-color:#111111; color: lightgray;">{{ __('Report') }}</div>

                  <div class="card-body" style="background-color:#222222; color: lightgray;">
                    <form method="POST" action="{{ route('sites.reportingmethod') }}">


                        <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <input type="hidden" value="{{$id}}" name="memeid">
                        <input type="hidden" value="{{$title}}" name="title">
                        <input type="hidden" value="{{$meme}}" name="meme">
                        <input type="hidden" value="{{$memecategory}}" name="memecategory">
                        <input type="hidden" value="{{$tags}}" name="tags">
                        <input type="hidden" value="{{$type}}" name="type">
                        <input type="hidden" value="{{$author}}" name="author">
                        <input type="hidden" value="{{$pageid}}" name="pageid">

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select name="category" class="form-control">
                                        @foreach ($reportcategories as $category)
                                          <option>{{$category->category}}</option>
                                        @endforeach
                               </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Comment, reason') }}</label>

                            <div class="col-md-6">
                                <textarea rows="3" class="form-control" name="reporttext" required autofocus></textarea>
                            </div>
                        </div>

                        <div class="col-md-8 offset-md-4">
                            <button type="submit" style="background-color: #ddb500; color: #222222; border:0;" class="btn btn-primary">
                                {{ __('Report') }}
                            </button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
