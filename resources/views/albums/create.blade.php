@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        
                    <a class="btn btn-primary" type="button" href="{{ route('album.create') }}">Create</a>
                  </div>



                  <form method="post" action="{{ route('album.store')}}">

                    @csrf
                    @method('POST')
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"> Add Album Name</label>
                      <input type="text" name='name' class="form-control" id="exampleInputEmail1" >
                      @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label"> Add Album Description</label>
                      <div class="form-floating">
                        <textarea class="form-control" name='description'     id="floatingTextarea2" style="height: 100px"></textarea>
                        @error('description') <span class="error" style="color: red">{{ $message }}</span> @enderror
                      </div>

                    </div>

                    <input type="submit" class="btn btn-info" value="Store">
                    
   
                
                  </form>
                  
            </div>

        </div>
    </div>
@endsection
