@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                    <a class="btn btn-primary" type="button" href="{{ route('photos.create') }}">Create</a>

                    <a class="btn btn-primary" type="button" href="{{ route('album.index') }}"> view All Album</a>
                </div>


                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('edit'))
                    <div class="alert alert-info">
                        {{ session('edit') }}
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif


                <table class="table table-striped">


                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">photo</th>
                            <th scope="col">Album name</th>
                            <th scope="col"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($photos))
                            @foreach ($photos as $photo)
                                <tr>
                                    <th scope="row">{{ $photo->id }}</th>
                                    <td> {{ $photo->name }}  </td>
                                    <td> {{ $photo->name }}  </td>
                                    <td> <img src="{{ asset('assets/albums/'.$photo->photo.'/'.$photo->photo) }}" alt="" style="width: 150px;height:150px;"> </td>
                                               <td>{{ $photo->album->name }}</td>

                                 

                                    <td>

                                        <form action="{{ route('photos.destroy', 'test') }}" method="post"
                                            style="display: inline-block">


                                            {{ method_field('Delete') }}
                                            @csrf

                                            <input type="hidden" value="{{ $photo->id }}" name="id">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete Photo</button>
                                        </form>

                                        <a type="button" href='{{ route('photos.edit', $photo->id) }}'
                                            class="btn btn-info btn-sm">Move To Another Album</a>


                     
                                    </td>
               

                                </tr>
                            @endforeach
                        @else
                            <tr>

                                <div class="alert alert-danger" role="alert">
                                    {{ $empty }}
                                </div>

                            </tr>
                        @endif




                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
