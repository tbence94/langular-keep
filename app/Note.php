<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];

    protected $appends = ['date'];

    public function getDateAttribute()
    {
        return strtotime($this->created_at) * 1000;
    }
}