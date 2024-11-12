<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['region', 'location', 'url', 'price', 'title'];
}
