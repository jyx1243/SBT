$('#destroyLocationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    //var recipient = button.data('location') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('刪除位置 ' + button.data('id'))
    modal.find('.modal-text').text('刪除後將無法復原，是否確定刪除?')
    modal.find('.destroy-form').attr('action', 'location/' + button.data('location'))
})