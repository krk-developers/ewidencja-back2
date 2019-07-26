document.addEventListener("DOMContentLoaded", () => init());

function init() {
    const indefiniteEl = document.getElementById('indefinite');
    indefiniteEl.addEventListener('click', indefiniteOnClick);
}

function indefiniteOnClick() {
    const contractToEl = document.getElementById('contract_to');    
    const formGroup = contractToEl.parentElement.parentElement;
    const label = formGroup.childNodes[1];
    const div = formGroup.childNodes[3];

    if (this.checked === true) {
        label.style.display = "none";
        div.style.display = "none";
        contractToEl.value = '';
    } else {
        label.style.display = "block";
        div.style.display = "block";
    }
}