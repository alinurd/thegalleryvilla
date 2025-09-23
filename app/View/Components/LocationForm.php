<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LocationForm extends Component
{
   public $provinces, $regency, $district, $village, $postal, $field;

    public function __construct(
        $provinces = [], $regency = [], $district = [],
        $village = [], $postal = [], $field = []
    ) {
        $this->provinces = $provinces;
        $this->regency   = $regency;
        $this->district  = $district;
        $this->village   = $village;
        $this->postal    = $postal;
        $this->field     = $field;
    }
 

    public function render()
    {
        return view('components.location-form');
    }
}
