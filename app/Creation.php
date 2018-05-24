<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    protected $fillable = ['title', 'body', 'type', 'user_id'];
}
