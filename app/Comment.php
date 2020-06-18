<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'body',
        'image',
        'support_ticket_id'
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImagePathAttribute(){
        return asset('storage/comments/'.$this->image);
    }
}
