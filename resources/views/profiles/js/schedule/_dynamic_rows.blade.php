// Add rows
$(document).on('click', '#addRow', function(){

    var rows = container.children();
    var totalRows = rows.length;
    var maxRows = days.length;

    if(totalRows < maxRows)
    {
        addRow(container, counter)
            .find('button').removeAttr('id').addClass('btn-remove').end()
            .find('.fa').removeClass('fa-plus').addClass('fa-remove');
    }
});

//Remove rows
$(document).on('click', '.btn-remove', function() {
    removeRow($(this));
});