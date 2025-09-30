<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
        protected $table = 'master_banner';
        protected $guarded = [];
        // public $timestamps = false;
    
    use HasFactory;
}
