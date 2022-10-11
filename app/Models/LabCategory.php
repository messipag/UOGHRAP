<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCategory extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'cat_name',   
        'create_by',
        'update_by',
    ];

    // public function Interpretation()
    // {
    //     return $this->hasMany(Interpretation::class, 'cat_id', 'id');
    // }
}
