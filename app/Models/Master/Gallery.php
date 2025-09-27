<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'master_gallery';
        protected $guarded = [];
    use HasFactory;

    public function pageDetail()
    {
        return $this->belongsTo(PageDetail::class, 'page_datail_id', 'id');
    }
}
