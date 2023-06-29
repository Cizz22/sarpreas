import './bootstrap';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.css'


import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'

Alpine.plugin(focus)
window.Alpine = Alpine

Alpine.start()
