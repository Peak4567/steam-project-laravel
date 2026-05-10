var advisorSelect = new TomSelect("#advisors-select", {
    plugins: ['remove_button'],
    create: false,
    onChange: function (values) {
        const items = this.activeItems;
        if (values.length > 0) {
            const names = values.map(v => this.options[v].text.split(' (')[0]);
            document.getElementById('pv-advisor').innerText = names.join(', ');
        } else {
            document.getElementById('pv-advisor').innerText = 'รอระบุ';
        }
    }
});

const sync = (id, target) => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', e => {
            document.getElementById(target).innerText = e.target.value || '...';
        });
    }
};

sync('in-name', 'pv-name');
sync('in-team', 'pv-team');
sync('in-max', 'pv-max');

document.getElementById('in-img').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = f => {
            document.getElementById('pv-img').src = f.target.result;
            document.getElementById('pv-img').classList.remove('hidden');
            document.getElementById('pv-no-img').classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
});