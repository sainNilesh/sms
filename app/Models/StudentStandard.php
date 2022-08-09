<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStandard extends Model
{
    use HasFactory;
    public $table='student_standard';
    protected $guarded = [];
}
