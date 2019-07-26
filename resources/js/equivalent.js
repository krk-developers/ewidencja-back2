document.addEventListener("DOMContentLoaded", () => init());

function init() {
    const equivalentElement = document.getElementById('equivalent');
    const equivalentAmountElement = document.getElementById('equivalent-amount-group');
    const equivalentAmountGroup = equivalentAmountElement.childNodes;
    const label = equivalentAmountGroup[1];
    const div = equivalentAmountGroup[3];
    const equivalentAmountInputText = document.getElementById('equivalent_amount');

    if (equivalentElement.selectedIndex == 0) {  // equivalent == Nie
        setDisplayToNone(label);
        setDisplayToNone(div);
        setValueToZero(equivalentAmountInputText);
    }
    
    equivalentElement.addEventListener('change', () => {
        equivalentOnChange(equivalentElement, label, div, equivalentAmountInputText);
    });
}

function equivalentOnChange(self, label, div, input) {    
    if (self.selectedIndex == 0) {
        setDisplayToNone(label);
        setDisplayToNone(div);
        setValueToZero(input);
    }

    if (self.selectedIndex == 1) {
        setDisplayToBlock(label);
        setDisplayToBlock(div);
    }
}

function setDisplayToNone(element) {
    element.style.display = "none";
}

function setDisplayToBlock(element) {
    element.style.display = "block";
}

function setValueToZero(element) {
    element.value = 0;
}