document.addEventListener("DOMContentLoaded", () => init());

function init() {
    const indefiniteEl = document.getElementById('indefinite');
    indefiniteEl.addEventListener('click', indefiniteOnClick);
    // console.log(indefiniteEl);
}

function indefiniteOnClick() {
    // console.log(this);
    // const indefiniteEl = document.getElementById('indefinite');
    const contractToEl = document.getElementById('contract_to');
    // console.log(contractToEl.parentElement.parentElement);
    const formGroup = contractToEl.parentElement.parentElement;
    const label = formGroup.childNodes[1];
    const div = formGroup.childNodes[3];

    // console.log(indefiniteEl.checked)
    if (this.checked === true) {
        // formGroup.style.display = "none";
        label.style.display = "none";
        div.style.display = "none";
        // console.log(contractToEl.value)
        contractToEl.value = '';
        // div.style.display = "none";
    } else {
        label.style.display = "block";
        div.style.display = "block";
    }
    // formGroup.style.display = "block";
    // console.log(formGroup);  // .childNodes[1]
    
    // console.log(label);
    // label.style.display = "block";
    // div.style.display = "block";
    // formGroup.childNodes.style.display = "block";
    /*
    const equivalentAmountElement = document.getElementById('equivalent-amount-group');
    const equivalentAmountGroup = equivalentAmountElement.childNodes;

    const label = equivalentAmountGroup[1];
    const div = equivalentAmountGroup[3];
    */
}