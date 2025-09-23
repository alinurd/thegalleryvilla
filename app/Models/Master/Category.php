<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        protected $table = 'master_categories';
        protected $guarded = [];
        // public $timestamps = false;
    
    use HasFactory;
}
