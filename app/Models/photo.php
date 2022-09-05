<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    use HasFactory;

    protected $fillable =['name','photo','user_id','album_id'];


    public function album()
    {
        return $this->belongsTo(album::class);
    }

}
