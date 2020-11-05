const unitDropdownItems = document.getElementById('unitDropdownMenu').getElementsByClassName('dropdown-item');

for (let unitDropdownItem of unitDropdownItems) {
    unitDropdownItem.addEventListener('click', function (event) {
        const unitSelects = document.getElementsByName('unit[]');

        for (let unitSelect of unitSelects) {
            const unitOptions = unitSelect.getElementsByTagName('option');
            for (let unitOption of unitOptions) {
                if (unitOption.value === event.target.dataset.id) {
                    unitOption.setAttribute('selected', true);
                } else {
                    unitOption.removeAttribute('selected');
                }
            }
        }
    });
}

const optionDivs = document.getElementsByName('optionDiv');

function modifyQuantity(optionDiv, n = 0) {
    const quantityInputs = optionDiv.getElementsByTagName('input');
    const unitSelects = optionDiv.getElementsByTagName('select');
    const dashBtns = optionDiv.getElementsByClassName('dashBtn');
    let quantity = String(Number(quantityInputs[0].value) + n);
    let unit = unitSelects[0].value;

    $.ajax({
        type: 'put',
        url: '/list/option-' + optionDiv.dataset.id,
        data: 'quantity=' + quantity + '&unit=' + unit,
        success: function (response) {
            console.log(response)
            for (let i = 0; i < quantityInputs.length; i++) {
                quantityInputs[i].value = quantity;

                if (quantityInputs[i].value === '1') {
                    dashBtns[i].setAttribute('disabled', true);
                } else {
                    dashBtns[i].removeAttribute('disabled');
                }
            }
        }
    });
}

for (let optionDiv of optionDivs) {
    const quantityInputs = optionDiv.getElementsByTagName('input');
    const dashBtns = optionDiv.getElementsByClassName('dashBtn');
    const plusBtns = optionDiv.getElementsByClassName('plusBtn');
    const listDeleteBtns = optionDiv.getElementsByClassName('listDeleteBtn');

    for (let i = 0; i < quantityInputs.length; i++) {
        dashBtns[i].addEventListener('click', function () { modifyQuantity(optionDiv, -1) });
        plusBtns[i].addEventListener('click', function () { modifyQuantity(optionDiv, 1) });
        //quantityInputs[i].addEventListener('change', function () { modifyQuantity(optionDiv) });

        listDeleteBtns[i].addEventListener('click', function () {
            $.ajax({
                type: 'delete',
                url: '/list/option-' + optionDiv.dataset.id,
                success: function (response) {
                    optionDiv.parentNode.removeChild(optionDiv);
                    modifyCount(-1);
                    document.getElementById('optionCount').textContent = '總計 ' + optionDivs.length;
                    if (optionDivs.length === 0) {
                        document.getElementById('emptyDiv').classList.remove('d-none');
                    }
                }
            });
        });
    }
}