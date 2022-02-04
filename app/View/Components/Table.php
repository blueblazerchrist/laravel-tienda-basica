<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $columns;
    public $data;
    public $actions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns, $data, $actions)
    {
        $this->columns = $columns;
        $this->data = $data;
        $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        $data = $this->data;
        $actions = $this->actions;
        return view('components.table', compact('data', 'actions'));
    }
}
