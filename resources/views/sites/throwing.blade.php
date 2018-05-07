@extends('layouts.app')

@section('content')
  <div class="container" style="margin-top: 72px;">
        <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card" style="border: 0;">
                  <div class="card-header" style="background-color:#111111; color: lightgray;">{{ __('Throw smoke') }}</div>

                  <div class="card-body" style="background-color:#222222; color: lightgray;">
                    <form method="POST" action="{{ route('sites.throwsmoke') }}"  enctype="multipart/form-data">


                        <input name="_token" value="{{csrf_token()}}" type="hidden">

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" maxlength="50" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right"><a style="color: dodgerblue;">{{ __('Type (important!)') }}</a></label>

                            <div class="col-md-6">
                                <select name="type" class="form-control">
                                    		@foreach ($types as $type)
                                          <option>{{$type->type}}</option>
                                        @endforeach
	                             </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select name="category" class="form-control">
                                    		@foreach ($categories as $category)
                                          <option>{{$category->category}}</option>
                                        @endforeach
	                             </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" placeholder="#dance, #xd, #party" name="tags" maxlength="50" required autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Smoke here') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="meme312" multiple>
                            </div>
                        </div>


                        <div class="col-md-8 offset-md-4">
                            <button type="submit" style="background-color: #ddb500; color: #222222; border:0;" class="btn btn-primary">
                                {{ __('Throw') }}
                            </button>
                        </div>



                      </form>




                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
