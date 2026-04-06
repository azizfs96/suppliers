const TYPES_WITH_OPTIONAL_NOTE = ['erp', 'cloud', 'accounting', 'other'];

function isInventoryTypeRadio(el) {
    return el instanceof HTMLInputElement && el.name === 'inventory_system_type' && el.type === 'radio';
}

export function initInventorySystemFields() {
    const root = document.querySelector('[data-inventory-system]');
    if (!root) {
        return;
    }

    const radiosBox = root.querySelector('[data-inventory-radios]');
    const noteWrap = root.querySelector('[data-inventory-note-wrap]');
    const noteInput = root.querySelector('[data-inventory-note]');

    const sync = () => {
        const checked = root.querySelector('input[name="inventory_system_type"]:checked');
        const value = checked instanceof HTMLInputElement ? checked.value : '';
        const show = TYPES_WITH_OPTIONAL_NOTE.includes(value);

        if (noteWrap instanceof HTMLElement) {
            noteWrap.hidden = !show;
            if (show) {
                requestAnimationFrame(() => {
                    noteWrap.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                });
            }
        }

        if (!show && noteInput instanceof HTMLInputElement) {
            noteInput.value = '';
        }
    };

    const onRadioEvent = (e) => {
        if (isInventoryTypeRadio(e.target)) {
            requestAnimationFrame(sync);
        }
    };

    root.addEventListener('change', onRadioEvent);
    root.addEventListener('input', onRadioEvent);

    if (radiosBox instanceof HTMLElement) {
        radiosBox.addEventListener('pointerup', (e) => {
            if (e.target instanceof Node && radiosBox.contains(e.target)) {
                setTimeout(sync, 0);
            }
        }, { passive: true });
    }

    sync();
}
