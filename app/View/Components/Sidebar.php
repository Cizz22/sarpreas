<?php

namespace App\View\Components;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

use function PHPSTORM_META\map;

class Sidebar extends Component
{
    public $general_menus = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        if (Auth::user()->roles == 'admin') {
            $this->adminSidebar();
        } else {
            $this->addGeneralSidebarMenu('Dashboard', route('dashboard.coordinator.index'));
        }
    }

    public function adminSidebar()
    {

        $this->addGeneralSidebarMenu('Dashboard', route('dashboard.admin.index'));
        $this->addGeneralSidebarMenu('Unit', route('dashboard.admin.unit'));
        $this->addGeneralSidebarMenu('Member', route('dashboard.admin.member'));
        $this->addGeneralSidebarMenu('Koordinator', route('dashboard.admin.coordinator'));
        $this->addGeneralSidebarMenu('Instrumen', route('dashboard.admin.instrument'));
    }


    public function addGeneralSidebarMenu(string $name, string $url)
    {
        array_push($this->general_menus, [
            'title' => $name,
            'url' => $url
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
