function cloneBrandRow(template) {
    const inner = template.content.querySelector('[data-brand-row]');
    if (!inner) {
        return null;
    }
    return inner.cloneNode(true);
}

function brandRowCount(list) {
    return list.querySelectorAll('[data-brand-row]').length;
}

export function initBrandRepeaters() {
    document.querySelectorAll('[data-brand-repeater]').forEach((root) => {
        const list = root.querySelector('[data-brand-rows]');
        const template = root.querySelector('[data-brand-row-template]');
        const addBtn = root.querySelector('[data-brand-add]');
        if (!list || !template || !addBtn) {
            return;
        }

        addBtn.addEventListener('click', () => {
            const row = cloneBrandRow(template);
            if (row) {
                list.appendChild(row);
            }
        });

        list.addEventListener('click', (e) => {
            const removeBtn = e.target.closest('[data-brand-remove]');
            if (!removeBtn) {
                return;
            }
            const row = removeBtn.closest('[data-brand-row]');
            if (!row) {
                return;
            }
            if (brandRowCount(list) <= 1) {
                const input = row.querySelector('input[name="brands[]"]');
                if (input) {
                    input.value = '';
                }
                return;
            }
            row.remove();
        });
    });
}
