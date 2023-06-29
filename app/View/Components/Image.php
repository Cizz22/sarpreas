<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name, $component_name, $img, $modelName;
    public function __construct($name, $img, $modelName = '', $customComponentName = '')
    {
        $this->name = $name;
        $this->component_name = $customComponentName != '' ? $customComponentName : str_replace(' ', '_', strtolower($name));
        $this->img = $img;
        $this->modelName = $modelName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.input.image');
    }
}
