<?php

namespace App\Http\Controllers;

use App\Models\album;

use App\Models\photo;

use App\Http\Requests\updateAlbum;
use App\Http\Requests\CreateAlbum;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all albums with users

        $counts  = album::count();

        if ($counts > 0) {
            $albums = album::with('user')->get();


            return view('albums.index',compact('albums'));
        }
        else
        {

            $empty = 'لا يوجد بيانات لعرضا';
            return view('albums.index',compact('empty'));

        }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlbum $request)
    {
        //

        album::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>auth()->user()->id,
        ]);

        session()->flash('success', 'تمت الاضافة بنجاح.');
        return redirect()->route('album.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $photos = photo::where('album_id',$id)->get();

        
        $count =  $photos->count();

        if ($count>0) {
            return view('photos.show',compact('photos'));
        }
        else
        {
            
            $empty = 'لا يوجد بيانات لعرضها';
            
            return view('photos.index',compact('empty'));
        }



       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AlbumsData = album::findorfail($id);

        return view('albums.edit',compact('AlbumsData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(updateAlbum $request)
    {
        //


        $update = album::findorfail($request->id);
      
        $update->update($request->except(['_token','_method']));

        session()->flash('edit', ' تمت  التعديل. بنجاح');

        return redirect()->route('album.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {

        $delete_album = album::findOrfail($request->id);

        $delete_album->delete();

       
        session()->flash('delete', ' تمت  الحذف. بنجاح');
        return redirect()->route('album.index');
    }


    public function deleteAll(Request $request)
    {
       $pictures_id = $request->id;

       $pictures = photo::where('album_id',$pictures_id)->get();


       foreach($pictures as $p)
       {
            $delete_picture = photo::where('id',$p->id);

            $delete_picture->delete();
       }


       session()->flash('delete', ' تمت  الحذف. بنجاح');
       return redirect()->route('album.index');
    }
}
