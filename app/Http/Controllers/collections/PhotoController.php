<?php

namespace App\Http\Controllers\collections;

use App\Http\Controllers\Controller;

use App\Models\album;
use App\Models\photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $photos = photo::get();

        
        $count =  $photos->count();

        if ($count>0) {
            return view('photos.index',compact('photos'));
        }
        else
        {
            
            $empty = 'لا يوجد بيانات لعرضها';
            
            return view('photos.index',compact('empty'));
        }


        return view('photos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $albums = album::all();
        return view('photos.create',compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //\

        $album_file = $request->file('file');
        
        $photo = $request->file('file')->getClientOriginalName();

        $user_id = auth()->user()->id;

        $album_file->storeAs('albums/' . $photo,$photo,'albums');


        photo::create([
            'name'=>$request->name,
            'user_id'=>$user_id,
            'album_id'=>$request->album,
            'photo'=>$photo,
        ]);

        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\collections\photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\collections\photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $albums = album::all();

        $album_name = photo::findOrfail($id);


        
       return view('photos.edit',compact('albums','album_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\collections\photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        $photo = photo::findOrFail($request->id);

        $photo->update(
            [
                'album_id'=>$request->album_id
            ]
            );

        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collections\photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        //

        $delete_photo = photo::findOrfail($request->id);

        $delete_photo->delete();

       
        session()->flash('delete', ' تمت  الحذف. بنجاح');
        return redirect()->route('photos.index');
    }
}
