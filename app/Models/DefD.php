<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefD extends Model
{
    use HasFactory;
    protected $table = 'formanage';

    public function getDefD () {
        return [$this->defy, $this->defm];
    }
}
