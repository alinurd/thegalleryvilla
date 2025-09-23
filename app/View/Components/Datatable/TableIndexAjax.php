<?php

namespace App\View\Components\Datatable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class TableIndexAjax extends Component
{
    public $id;
    public $ajax;
    public $columns;
    public $headers;
    public $exportColumns;

    public function __construct($id, $ajax, $columns, $headers = [], $exportColumns = null)
    {
        $this->id = $id;
        $this->ajax = $ajax;
        $this->columns = $columns;
        $this->headers = $headers;
        $this->exportColumns = $exportColumns ?? '[1, 2, 3]';
    }

    public function render()
    {
        return view('components.datatable.table-index-ajax');
    }
}
