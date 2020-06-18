<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'question'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
