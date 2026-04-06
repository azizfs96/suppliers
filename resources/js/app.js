import './bootstrap';
import { initBrandRepeaters } from './brands-repeater';
import { initInventorySystemFields } from './inventory-system-fields';

function bootUi() {
    initBrandRepeaters();
    initInventorySystemFields();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootUi);
} else {
    bootUi();
}
