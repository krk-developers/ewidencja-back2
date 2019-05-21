document.addEventListener("DOMContentLoaded", () => init());

function init() {
    const equivalentElement = document.getElementById('equivalent');
    
    if (equivalentElement.selectedIndex == 0) {  // equivalent: No
        hideEquivalentAmount();
    }

    equivalentElement.addEventListener('change', equivalentOnChange);
}

function equivalentOnChange() {
    // TODO only one declaration
    const equivalentAmountElement = document.getElementById('equivalent-amount-group');
    const equivalentAmountGroup = equivalentAmountElement.childNodes;

    const label = equivalentAmountGroup[1];
    const div = equivalentAmountGroup[3];

    if (this.options.selectedIndex == 0) {
        const equivalentAmountInputText = document.getElementById('equivalent_amount');
        equivalentAmountInputText.value = 0;
        
        label.style.display = "none";
        div.style.display = "none";
    }

    if (this.options.selectedIndex == 1) {
        label.style.display = "block";
        div.style.display = "block";
    }
}

function hideEquivalentAmount() {
    const equivalentAmountElement = document.getElementById('equivalent-amount-group');
    const equivalentAmountGroup = equivalentAmountElement.childNodes;
    const label = equivalentAmountGroup[1];
    const div = equivalentAmountGroup[3];


    label.style.display = "none";
    div.style.display = "none";
}