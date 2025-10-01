<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    protected $table = 'master_page_detail';
        protected $guarded = [];
    use HasFactory;

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'page_datail_id')
                ->where('status', 1)
                ->whereNotNull('image')
                ->where('image', '!=', '');
        // return $this->hasMany(Facility::class, 'page_datail_id');
    }
    
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'page_datail_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'page_datail_id');
    }
}
