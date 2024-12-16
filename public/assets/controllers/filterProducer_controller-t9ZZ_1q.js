import { Controller } from '@hotwired/stimulus';

let filterCheckboxes;
let filterInputSearch;

export default class extends Controller {
    connect() {
        console.log('filterProduct_controller connected');
        filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterInputSearch = document.querySelectorAll('.filter-input-search');
    }

    reloadProducts(event) {
        const frame = document.getElementById('products-frame');
        const url = frame.getAttribute("datasrc");

        let filterValues = this.extractFilterValues();
        let filterSearchValue = this.extractFilterSearchValue();

        frame.src = url + '?filterSearch=' + filterSearchValue + '&filterProducer=' + JSON.stringify(filterValues);
    }

    extractFilterValues() {
        let filterValues = [];

        for (let i = 0; i < filterCheckboxes.length; i++) {
            if (!filterCheckboxes[i].checked) {
                continue;
            }
            if (filterCheckboxes[i].classList.contains('filter-checkbox-producer')) {
                filterValues.push(filterCheckboxes[i].getAttribute('id'));
            }
        }
        return filterValues;
    }

    extractFilterSearchValue() {
        return filterInputSearch[0].value;
    }

    toggleFilterVisibility(event) {
        const filter = document.getElementById('filter-producer-frame');
        filter.classList.toggle('d-none');
    }
}