<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefTab extends Model
{
    use HasFactory;
    protected $table = 'deftab';
    protected $dates = [];
    public $timestamps = false;
}
