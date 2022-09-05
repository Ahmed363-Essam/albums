@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        
                    <a class="btn btn-primary" type="button" href="{{ route('photos.create') }}">Create</a>

                    <a class="btn btn-primary" type="button" href="{{ route('album.index') }}"> view All Album</a>
                  </div>



                  <form method="post" action="{{ route('photos.store')}}" enctype="multipart/form-data">

                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"> Select Album</label>
                      <select class="form-select" name="album" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach ($albums as $album)

                            <option value="{{ $album->id }}"> {{ $album->name }} </option>
                            
                        @endforeach
                      </select>
                      @error('album') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> Add Photo </label>
                        <input type="text" name='name' class="form-control" id="exampleInputEmail1" >
                        @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
                      </div>



                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label"> upload image   </label>
                        <input class="form-control" name="file" type="file" id="formFileMultiple" multiple>

                        @error('file') <span class="error" style="color: red">{{ $message }}</span> @enderror
                      </div>




                    <input type="submit" class="btn btn-info" value="Store">
                    
   
                
                  </form>
                  
            </div>

        </div>
    </div>
@endsection
