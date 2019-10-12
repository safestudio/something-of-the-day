<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wotd extends Model
{
    protected $fillable = ['word', 'meaning', 'url', 'date'];
}
