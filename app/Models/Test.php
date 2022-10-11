<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'tes_name',  
        'cat_id', 
        'price',
        'create_by',
        'update_by',
    ];

    public function labCategory()
    { 
        return $this->belongsTo(LabCategory::class, 'cat_id', 'id');
    }
    public function referenceRange(){ 
        return $this->hasMany(ReferenceRange::class, 'tes_id', 'id');
    }
}
