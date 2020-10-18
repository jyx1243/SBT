const dashBtns = document.getElementsByName('dashBtn');
const plusBtns = document.getElementsByName('plusBtn');
const quantityInputs = document.getElementsByName('quantity[]');

const unitSelects = document.getElementsByName('unit[]');
const unitDropdownItems = document.getElementById('unitDropdownMenu').getElementsByClassName('dropdown-item');

function checkQuantity(i) {
    if (quantityInputs[i].value === '1') {
        dashBtns[i].setAttribute('disabled', true);
    } else {
        dashBtns[i].removeAttribute('disabled');
    }
}

for (let i = 0; i < unitDropdownItems.length; i++) {
    unitDropdownItems[i].addEventListener('click', function(event) {
        for (let j = 0; j < unitSelects.length; j++) {
            let unitOptions = unitSelects[j].getElementsByTagName('option');
            for (let k = 0; k < unitOptions.length; k++) {
                if (unitOptions[k].value === event.target.id) {
                    unitOptions[k].setAttribute('selected', true);
                } else {
                    unitOptions[k].removeAttribute('selected');
                }
            }
        }
    });
}

for (let i = 0; i < quantityInputs.length; i++) {
    quantityInputs[i].value = '1';
    dashBtns[i].setAttribute('disabled', true);

    dashBtns[i].addEventListener('click', function() {
        quantityInputs[i].value = String(Number(quantityInputs[i].value)-1);
        checkQuantity(i);
    });

    plusBtns[i].addEventListener('click', function() {
        quantityInputs[i].value = String(Number(quantityInputs[i].value)+1);
        checkQuantity(i);
    });

    quantityInputs[i].addEventListener('change', function() {
        checkQuantity(i);
    });
}