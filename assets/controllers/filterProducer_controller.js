import { Controller } from '@hotwired/stimulus';

let filterCheckboxes;

export default class extends Controller {
    connect() {
        console.log('filterProduct_controller connected');
        filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    }

    reloadProducts(event) {
        const frame = document.getElementById('products-frame');

        let filterValues = [];

        for (let i = 0; i < filterCheckboxes.length; i++) {
            if (!filterCheckboxes[i].checked) {
                continue;
            }
            if (filterCheckboxes[i].classList.contains('filter-checkbox-producer')) {
                filterValues.push(filterCheckboxes[i].getAttribute('id'));
            }
        }

        frame.src = window.location + '?filterProducer=' + JSON.stringify(filterValues);
    }

    toggleFilterVisibility(event) {
        const filter = document.getElementById('filter-producer-frame');
        filter.classList.toggle('d-none');
    }
}