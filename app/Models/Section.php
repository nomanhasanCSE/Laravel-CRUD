<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class_id'];

    // Define the relationship with the ClassName model
    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }
}
