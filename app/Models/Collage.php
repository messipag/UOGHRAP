<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    use HasFactory;

    protected $fillable = [
        'collage_name', 'created_by', 'updated_by'
    ];
}
