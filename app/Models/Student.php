<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'student_id',
        'address',
        'class_id',
        'section_id',
    ];

    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
