@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        
                    <a class="btn btn-primary" type="button" href="{{ route('album.store') }}">Create</a>

                    <a class="btn btn-primary" type="button" href="{{ route('album.index') }}"> view All Album</a>
                  </div>



                  <form method="post" action="{{ route('photos.update','test')}}">

                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> Select Album</label>
                        <select class="form-select" name="album_id" aria-label="Default select example">
                          <option selected value="{{ $album_name->album_id }}">  {{ $album_name->album->name  }} </option>
                          @foreach ($albums as $album)
  
                              <option value="{{ $album->id }}"> {{ $album->name }} </option>
                              
                          @endforeach
                        </select>
                        @error('album') <span class="error" style="color: red">{{ $message }}</span> @enderror
                      </div>

                      <input type="hidden" name="id" value="{{ $album_name->id }}">

                      
                    <input type="submit" class="btn btn-info" value="update">
                    </div>

                    
   
                
                  </form>
                  
            </div>

        </div>
    </div>
@endsection
