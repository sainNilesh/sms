<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardSubject extends Model
{
    use HasFactory;
    public $table='standard_subject';
    protected $guarded = [];
}
