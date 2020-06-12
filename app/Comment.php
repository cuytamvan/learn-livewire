<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'body',
        'image',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
