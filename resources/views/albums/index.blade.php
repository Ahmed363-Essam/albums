@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                    <a class="btn btn-primary" type="button" href="{{ route('album.create') }}">Create</a>
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
                            <th scope="col">Description</th>
                            <th scope="col">User name</th>
                            <th scope="col"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($albums))
                            @foreach ($albums as $album)
                                <tr>
                                    <th scope="row">{{ $album->id }}</th>
                                    <td> <a href="{{ route('album.show', $album->id) }}"> {{ $album->name }} </a> </td>
                                    <td>{{ $album->description }}</td>
                                    <td>{{ $album->user->name }}</td>
                                    <td>

                                        <form action="{{ route('album.destroy', 'test') }}" method="post"
                                            style="display: inline-block">


                                            {{ method_field('Delete') }}
                                            @csrf

                                            <input type="hidden" value="{{ $album->id }}" name="id">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete Album</button>
                                        </form>


                                        <form action="{{ route('deleteAll', 'test') }}" method="post"
                                            style="display: inline-block">


                                            {{ method_field('POST') }}
                                            @csrf

                                            <input type="hidden" value="{{ $album->id }}" name="id">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete All Picture</button>
                                        </form>



                                        <a type="button" href='{{ route('album.edit', $album->id) }}'
                                            class="btn btn-info btn-sm">Edit Album</a>


                                            <a type="button" href='{{route('album.show', $album->id) }}'
                                                class="btn btn-info btn-sm">Add picture</a>

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
