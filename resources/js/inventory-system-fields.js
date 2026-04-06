const TYPES_WITH_OPTIONAL_NOTE = ['erp', 'cloud', 'accounting', 'other'];

export function initInventorySystemFields() {
    const root = document.querySelector('[data-inventory-system]');
    if (!root) {
        return;
    }

    const noteWrap = root.querySelector('[data-inventory-note-wrap]');
    const noteInput = root.querySelector('[data-inventory-note]');
    const radios = root.querySelectorAll('input[name="inventory_system_type"]');

    const sync = () => {
        const checked = root.querySelector('input[name="inventory_system_type"]:checked');
        const value = checked ? checked.value : '';
        const show = TYPES_WITH_OPTIONAL_NOTE.includes(value);
        if (noteWrap) {
            noteWrap.classList.toggle('hidden', !show);
        }
        if (!show && noteInput) {
            noteInput.value = '';
        }
    };

    radios.forEach((radio) => radio.addEventListener('change', sync));
    sync();
}
