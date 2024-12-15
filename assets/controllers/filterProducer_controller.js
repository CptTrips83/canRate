import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        console.log('filterProduct_controller connected');
    }

    change(event) {
        const frame = document.getElementById('products-frame');

        frame.src = window.location + '?producer[]=' + event.target.value;
    }
}