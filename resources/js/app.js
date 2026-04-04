import './bootstrap';
import { initBrandRepeaters } from './brands-repeater';

function bootUi() {
    initBrandRepeaters();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootUi);
} else {
    bootUi();
}
