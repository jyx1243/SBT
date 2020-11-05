const optionDivs = document.getElementsByName('optionDiv');

for (let optionDiv of optionDivs) {
    const listAddBtns = optionDiv.getElementsByClassName('listAddBtn');
    const listDeleteBtns = optionDiv.getElementsByClassName('listDeleteBtn');

    for (let i = 0; i < listAddBtns.length; i++) {
        listAddBtns[i].addEventListener('click', function() {
            listAddBtns[i].setAttribute('disabled', true);
            $.ajax({
                type: 'post',
                url: '/list/option-'+optionDiv.dataset.id,
                success: function (response) {
                    console.log(response)
                    listAddBtns[i].removeAttribute('disabled');
                    listAddBtns[i].classList.add('d-none');
                    listDeleteBtns[i].classList.remove('d-none');
    
                    modifyCount(1);
                }
            });
        });
    
        listDeleteBtns[i].addEventListener('click', function() {
            listDeleteBtns[i].setAttribute('disabled', true);
            $.ajax({
                type: 'delete',
                url: '/list/option-'+optionDiv.dataset.id,
                success: function (response) {
                    console.log(response)
                    listDeleteBtns[i].removeAttribute('disabled');
                    listDeleteBtns[i].classList.add('d-none');
                    listAddBtns[i].classList.remove('d-none');
    
                    modifyCount(-1);
                }
            });
        });
    }
}