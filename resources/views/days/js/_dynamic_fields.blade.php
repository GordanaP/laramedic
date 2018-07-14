// Add fields dynamically
$(document).on('click', '#addMore', function() {

    var sections = $('.section');
    var totalSections = sections.length;
    var maxSections = @json($days).length;
    var fields = $('.field')
    var dinamicFields = makeNewArray(fields)
    var index = findMissingValue(dinamicFields)

    sectionsCount++;

    if (totalSections < maxSections) {

        cloneScheduleTemplate(template, templateHolder, index)
            .find('button').removeAttr('id').addClass('btn-remove').end()
            .find($(".fa")).removeClass('fa-plus').addClass('fa-remove');
    }
});

// Remove fields
$(document).on('click', '.btn-remove', function(){
    $(this).parents().eq(3).remove()
});
