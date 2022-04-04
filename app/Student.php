<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'sname','fname', 'class','phnum','email','course_id','branch_id','image',
    ];
}
