function modifyCount(n){
    let count = document.getElementById('listOptionCount');
    count.textContent = String(Number(count.textContent)+n);

    if (count.textContent === '0') {
        count.classList.add('d-none');
    } else {
        count.classList.remove('d-none');
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});