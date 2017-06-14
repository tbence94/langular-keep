<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'description'];

    protected $appends = ['date'];

    public function getDateAttribute()
    {
        return strtotime($this->created_at) * 1000;
    }
}