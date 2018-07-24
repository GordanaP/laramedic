function getJsonErrors(response) {

    var errors = response.responseJSON.errors;

    return errors;
}

function formattedErrorResponse(errors) {

    for(error in errors) {

        var formattedError = error.replace(/\./g , "-");

        $('span.'+formattedError).text(errors[error][0]).show();
    }

    removeErrorOnNewInput();
}


function getSelectsValues(selectName)
{
    var selects = $( "select[name*='"+ selectName +"']" );

    var selectsValues = getValuesArray(selects);

    return selectsValues;
}


function getInputsValues(inputName)
{
    var inputs = $( "input[name*='"+ inputName +"']" );

    var inputValues = getValuesArray(inputs);

    return inputValues;
}

function getValuesArray(array)
{
    var tempArray = [];

    $.each(array, function(index, item)
    {
        tempArray.push(item.value);
    });

    return tempArray;
}

function getIdsArray(array)
{
    var tempArray = []

    $.each(array, function(index, item) {

        tempArray.push(item.id);

        tempArray.sort();
    });

    return tempArray;
}

function removeRow(button)
{
    button.parents().eq(2).remove();

    $('fieldset').each(function(i) {
        $(this).attr('id', i)
        .find('.day-label').text('Day #'+(i+1)).end()
        .find("select").each(function(){
            this.name = replaceValue(this.name, i)
        }).end()
        .find(':input').each(function() {
            this.name = replaceValue(this.name, i)
        }).end()
        .find('.day').removeClass('day-'+(i+1)).addClass('day-'+ i).end()
        .find('.start').removeClass('start-'+ (i+1)).addClass('start-'+ i).end()
        .find('.end').removeClass('end-'+ (i+1)).addClass('end-'+ i)
    });
}

function addRow(container, counter)
{
    var rows = container.children();
    var template = rows.first();
    var dynamicRows = rows.not(":first");
    var dynamicRowsIds = getIdsArray(dynamicRows);
    var index = getMissingValue(dynamicRowsIds);
    counter++;

    var addedRow = cloneTemplate(template, container, index);

    return addedRow;
}

function cloneTemplate(template, container, index)
{
    var cloned = template.clone()
        .attr('id', index)
        .find('.day-label').text('Day #'+(index+1)).end()
        .find("select").each(function(){
            this.name = replaceValue(this.name, index)
        }).end()
        .find(':input').each(function(){
            this.value = '';
            this.name = replaceValue(this.name, index)
        }).end()
        .find('.invalid-feedback').text("").end()
        .find('.day').removeClass("day-0").addClass("day-" + index).end()
        .find('.start').removeClass("start-0").addClass("start-"+ index).end()
        .find('.end').removeClass("end-0").addClass("end-"+ index).end()
        .appendTo(container);

    return cloned;
}


function replaceValue(oldValue, newValue) {

    return oldValue.replace(/\d+/, newValue);
}


function getMissingValue(array)
{
    var missing;

    for(var i=1; i<=array.length; i++)
    {
       if(array[i-1] != i) {

          missing = i;
          break;
       }
    }

    return i;
}