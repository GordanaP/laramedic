/**
 * Remove error on inserting the new value.
 *
 * @return void
 */
function removeErrorOnNewInput()
{
    $("input, textarea").on('keydown', function() {

        $(this).removeClass('is-invalid');
        $(this).siblings(".invalid-feedback").hide().text('');
    });

    $("select").on('change', function () {

        $(this).removeClass('is-invalid');
        $(this).siblings(".invalid-feedback").hide().text('');
    });
}

/**
 * Get the roles names.
 *
 * @param  {array} roles
 * @return {array}
 */
function roleNames(roles)
{
    var tempArray = [];

    $.each(roles, function(key, role) {

        tempArray.push(role.name);
    })

    return tempArray;
}

function getAdminRoleId(roles)
{
  var roleId;

  $.each(roles, function(key, role) {

    if (role.name == 'admin') {
      roleId = role.id;
    }
  })

  return roleId;
}

/**
 * Determine if the user has admin privileges.
 *
 * @param  {array}  roles
 * @return {Boolean}
 */
function hasAdminPrivileges(roles)
{
    var tempVar;

    $.each(roles, function(key, role) {
         tempVar = role.name == 'admin' || role.name == 'superadmin';
    });

    return tempVar;
}

/**
 * A link to revoke the admin or superadmin role.
 *
 * @param  {array} roles
 * @param  {int} userId
 * @param  {string} userName
 * @return {string}
 */
function revokeLinkIfAdmin(roles, html)
{
    return hasAdminPrivileges(roles) ? html : ''
}

/**
 * Determine if the user is verified.
 *
 * @param  {string} verified
 * @return {string}
 */
function accountStatus(verified, html1, html2)
{
    return verified == true ? html1 : html2;
}


/**
 * Format the date.
 *
 * @param  {string} date
 * @return {string}
 */
function formattedDate(date)
{
    var d = new Date(date);

    var date = d.getDate();
    var month = monthsNames()[d.getMonth()];
    var year = d.getFullYear();

    return date +  " " + month + " " + year;
}

/**
 * Get the months names.
 *
 * @return {array}
 */
function monthsNames()
{
    return [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
}

/**
 * Set datatable counter column
 *
 * @param {string} datatable
 * @param {string} table
 * @return {void}
 */
function datatableIndexColumn(dataTable, table)
{
    dataTable.on( 'draw.dt', function () {

        // Display numbers on every page
        var PageInfo = table.DataTable().page.info();

        dataTable.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

/**
 * Set modal autofocus field
 *
 * @param {string} field
 * @return {void}
 */
$.fn.setAutofocus = function(field)
{
    $(this).on('shown.bs.modal', function () {
        $(this).find(field).focus();
    });
}

/**
 * Empty the modal upon close.
 *
 * @param  {array} fields
 * @param  {string} checked_filed
 * @param  {string} hidden_filed
 * @return {void}
 */
 $.fn.emptyModal = function(fields, checked_field, hidden_field) {

    $(this).on("hidden.bs.modal", function() {

        // Remove form values
        clearForm(this, checked_field, hidden_field)

        // Remove server side errors
        clearServerErrors(fields)
     });
 }

/**
 * Clear the form values.
 *
 * @param  {string} modal
 * @param  {string} checked-field
 * @param  {string} hidden-field
 * @return {void}
 */
 function clearForm(modal, checked_field=null, hidden_field=null)
  {
     $(modal)
         .find('form').trigger('reset').end()

         .find("select").val(null).trigger('change').end()

         .find("input:checkbox, input:radio").prop("checked", false).end()

         .find(checked_field).prop('checked', true)

     hidden_field ? hidden_field.hide() : ''
  }

 /**
  * Remove all server side errors.
  *
  * @param  {array} fields
  * @return void
  */
 function clearServerErrors(fields)
 {
     $.each(fields, function (index, name) {

       clearError(name);
     });
 }

 /**
  * Determine how to create the password.
  *
  * @param  {string} field
  * @return {string}
  */
 function generatePassword(field, passwordLength=7)
 {
     var autoPassword = randomString(passwordLength);
     var manualPassword = $('input[type=password]').val();

     return isChecked(field) ? autoPassword : manualPassword;
 }

 /**
  * Generate random string
  *
  * @param  {int} length
  * @return string
  */
 function randomString(length)
 {
     return Math.random().toString(36).substring(length);
 }


 /**
  * Determine if the field is checked.
  *
  * @param  {string}  field
  * @return {Boolean}
  */
 function isChecked(field)
 {
     return field[0].checked;
 }

 /**
  * Success ajax response.
  *
  * @param  {string} modal
  * @param  {string} message
  * @return {void}
  */
 function successResponse(modal, message)
 {
     userNotification(message);
     modal.modal("hide");
 }

 /**
  * Ajax error response
  *
  * @param  {array} errors
  * @param  {string} modal
  * @return {[void]}
  */
 function errorResponse(modal, errors)
 {
     if(errors) {
         displayErrors(errors);
         removeErrorOnNewInput();
     }
     else {
         userNotification("This action is unauthorized", "error");
         modal.modal("hide");
     }
 }

/**
 * Get JSON errors
 *
 * @param  {array} response
 * @return {array}
 */
 function jsonErrors(response)
 {
     return response.responseJSON.errors;
 }

 /**
  * Display validation error messages for all form fields.
  *
  * @param  {array} errors
  * @return void
  */
 function displayErrors(errors)
 {
     for (error in errors)
     {
         var formattedError = error.replace(/\./g , "-");

         var field = $("."+formattedError);
         var feedback = $("span."+formattedError).show();

         // var field = $("."+error)
         // var feedback = $("span."+error).show()

         // Attach server side validation
         displayServerError(field, feedback, errors[error][0]);
     }
 }

 /**
  * Notify user about a successful action
  *
  * @param  {string} message
  * @param  {string} type
  * @return {mixed}
  */
 function userNotification(message, type="success")
 {
     return $.notify(message, type);
 }

 /**
  * Display server error.
  *
  * @param  {string} field
  * @param  {string} feedback
  * @param  {string} error
  * @return {void}
  */
 function displayServerError(field, feedback, error)
 {
     field.addClass('is-invalid');
     feedback.text(error);
 }

 /**
  * Remove the server side error for a specified field.
  *
  * @param  {string} name
  * @return void
  */
 function clearError(name)
 {
     var field = $("."+name);
     var feedback = $("span."+name).hide();

     field.removeClass('is-invalid');
     feedback.text('');
 }

 /**
  * Toggle hidden field by changing the radio field value.
  *
  * @param  {string} checked
  * @param  {string} hidden
  * @return {void}
  */
 function toggleHiddenFieldWithRadio(checked, hidden)
 {
     $('input:radio').on('change', function() {

         var value = this.value;

         value == checked.val() ? hidden.show() : hidden.hide().val('')
     });
 }


 /**
  * Change a hidden field visibility by using checkbox
  *
  * @param  {string} checked
  * @param  {string} hidden
  * @return {void}
  */
 function toggleHiddenFieldWithCheckbox(hidden)
 {
     $('input:checkbox').on('change', function() {

         this.checked ? hidden.hide().val('') : hidden.show();

     });
 }

 /**
  * Get the user roles.
  *
  * @param  {array} roles
  * @return {array}
  */
 function getUserRoles(roles)
 {
     var roleIds = []

     $.each(roles, function(key, role) {
         roleIds.push(role.id)
     })

     return roleIds
 }

 /**
  * Change password
  *
  * @return {string}
  */
 function changePassword(checkedRadio, checkedManual, checkedAuto, profilePassword)
 {
     var auto_password = randomString(6)
     var manual_password = profilePassword

     if(checkedRadio == checkedManual)
     {
         var password = manual_password
     }
     else if(checkedRadio == checkedAuto)
     {
         var password = auto_password
     }

     return password;
 }

/**
 * Remove navigation if only one page
 *
 * @param  {object} datatable
 * @return {void}
 */
function removeNavigationIfOnlyOnePage (datatable) {

    datatable.on( 'draw.dt', function () {

        var pageInfo = datatable.page.info();
        var currentPage = pageInfo.page;
        var totalPages = pageInfo.pages;
        var totalRecords = pageInfo.recordsTotal;

        totalPages == 1 ? $('#accountsTable_previous, #accountsTable_next').remove() : '';

        currentPage == 0 ? $('#accountsTable_previous').remove() : '';

        currentPage == totalPages - 1 ? $('#accountsTable_next').remove() : '';

        totalRecords == 0 ? $('#accountsTable_next').remove() : '';

    });
}

/**
 * Alert the user on deletion
 *
 * @param  {string} name
 * @param  {string} url
 * @return void
 */
function swalDelete(url, name, datatable, field)
{
    swal({
        title: 'Are you sure?',
        text: 'You will not be able to recover the '+ name + '!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url : url,
                type : "DELETE",
                success : function(response) {

                    datatable ? datatable.ajax.reload() : ''
                    field ? $(field).load(location.href + ' ' + field) : ''

                    userNotification(response.message)
                },
                error: function(response) {
                    userNotification("This action is unauthorized", "error")
                    modal.modal("hide")
                }
            })
        }
    })
}

/**
 * Replace one selected option with another one
 *
 * @param  {int} selected
 * @param  {int} lastSelected
 * @param  {array} roles
 * @return {void}
 */
function replaceSelectedOption(selected, lastSelected, roles)
{
    if(selected == roles['doctor'] && lastSelected == roles['nurse']) {
        $("select option[value=" + selected +"]").prop("selected", false).parent().trigger("change");
    }

    if(selected == roles['doctor'] && lastSelected == roles['doctor']) {
        $("select option[value="+ roles['nurse'] +"]").prop("selected", false).parent().trigger("change");
    }
}

/**
 * Get selected role
 *
 * @param  {array} roleIds
 * @param  {int} roleToRemove
 * @return {array}
 */
function getFirstRoleId(roleIds, roleToRemove)
{
    if (roleIds.length == 1 && roleIds ==  roleToRemove ) {
      var roleId = roleToRemove;
    }
    else {
      var roleId = $.grep(roleIds, function( val, index ) {
        return val < roleToRemove;
      });
    }

    return roleId;
}

/**
 * Get role id.
 *
 * @param  {int} selected
 * @param  {int} lastSelected
 * @param  {array} allSelected
 * @param  {arry} roles
 * @return {int}
 */
function getRoleId(selected, lastSelected, allSelected, roles)
{
    if (lastSelected == roles['doctor'] || lastSelected == roles['nurse'])
    {
        var roleId = lastSelected;
    }
    else if(allSelected == roles['doctor'],roles['admin'] || allSelected == roles['nurse'],roles['admin'] || selected == roles['admin'])
    {
        var roleId = selected;
    }

    return roleId;
}

/**
 * Create a dropdown html
 *
 * @param  {array} values
 * @return {string}        [html]
 */
function getOptions(values)
{
   var html = '';

   $.each(values, function(index, value) {
      html += '<option value="'+ value.id +'">'+ value.name+'</option>'
   });

   return html;
}

/**
 * Append title options to select box.
 *
 * @param  {string} selectCreate
 * @param  {string} selectEdit
 * @param  {string} Placeholder
 * @param  {array} options
 * @return {void}
 */
function appendOptions(selectCreate, selectEdit, placeholder, options=null)
{
   selectCreate.add(selectEdit).empty().append(placeholder).append(options)
}

/**
 * Notify user when hovering over the icon
 * @param  {string} basicIcon
 * @param  {string} filedIcon
 * @param  {string} message
 * @param  {string} type
 * @return {[string}
 */
function iconNotification(element, message, type='warn') {
  element.mouseover(function(){
    $(this).notify(message, type);
  })

  element.mouseout(function(){
    $(".notifyjs-wrapper").fadeOut();
  })
}

/**
 * Make a new array
 *
 * @param  {array} fields
 * @return {array}
 */
// function getIdsArray(array)
// {
//     var tempArray = []

//     $.each(array, function(index, item) {

//         tempArray.push(item.id);

//         tempArray.sort();
//     });

//     return tempArray;
// }

/**
 * Find missing value in a sequence of values
 *
 * @param  {array} array
 * @return {int}
 */
// function getMissingValue(array)
// {
//     var missing;

//     for(var i=1;i<=array.length;i++)
//     {
//        if(array[i-1] != i) {

//           missing = i;
//           break;
//        }
//     }

//     return i;
// }

/**
 * Replace value with a new one
 *
 * @param  {int} oldValue
 * @param  {int} newValue
 * @return {int}
 */
// function replaceValue(oldValue, newValue) {
//     return oldValue.replace(/\d+/, newValue);
// }

/**
 * Create a schedule template clone
 *
 * @param  {string} template
 * @param  {string} templateHolder
 * @param  {int} index
 * @return {string}
 */
// function cloneTemplate(template, container, index)
// {
//   var cloned = template.clone()
//     .attr('id', index)
//     .find('label.day').text('Day #'+(index+1)).end()
//     .find("select").each(function(){
//         this.name = replaceValue(this.name, index)
//     }).end()
//     .find(':input').each(function(){
//         this.value = '';
//         this.name = replaceValue(this.name, index)
//     }).end()
//     .find('span.invalid-feedback').text("").end()
//     .find('.day').removeClass("day-0").addClass("day-" + index).end()
//     .find('.start').removeClass("start-0").addClass("start-"+ index).end()
//     .find('.end').removeClass("end-0").addClass("end-"+ index).end()
//     .sort(sortId)
//     .appendTo(container);

//   return cloned;
// }

/**
 * Create multidimensional array
 *
 * @param  {string} inputArrayName
 * @param  {integer} chunkSize
 * @return {array}                [multidimensional array]
 */
function createScheduleArray(arrayName, chunkSize)
{
    var chunks = getChunks(arrayName, chunkSize)

    var days = [];

    for (var i = 0; i < chunks.length; i++) {

        days[i] = {
            'day_id': chunks[i][0],
            'start_at': chunks[i][1],
            'end_at': chunks[i][2],
        }
    }

    return days;
}


/**
 * Get chunked array values
 *
 * @param  {string} inputArrayName
 * @param  {integer} chunkSize
 * @return {array}
 */
function getChunks(arrayName, chunkSize)
{
    var values = $( "select[name*="+ arrayName +"], input[name*="+ arrayName +"]" ).map(function() {
        return this.value;
    }).get()

    var chunks = chunkArray(values, chunkSize);

    return chunks;
}

/**
 * Chunk an array
 *
 * @param  {array} myArray
 * @param  {int} chunkSize
 * @return {array}
 */
function chunkArray(myArray, chunkSize)
{
    var index = 0;
    var arrayLength = myArray.length;
    var tempArray = [];

    for (index = 0; index < arrayLength; index += chunkSize) {

        myChunk = myArray.slice(index, index+chunkSize);

        tempArray.push(myChunk);
    }

    return tempArray;
}

function sortId(a,b) {
    return +a.getAttribute('id') - +b.getAttribute('id');
}

// function addRow(container, counter, maxRows)
// {
//     var rows = container.children();
//     var template = rows.first();
//     var totalRows = rows.length;
//     var dynamicRows = rows.not(":first");
//     var dynamicRowsIds = getIdsArray(dynamicRows);
//     var index = getMissingValue(dynamicRowsIds);
//     counter++;

//     if (totalRows < maxRows) {
//         var addedRow = cloneTemplate(template, container, index)
//     }

//     return addedRow;
// }

// function removeRow(button)
// {
//   button.parents().eq(2).remove();

//   $('fieldset').each(function(i) {
//     $(this).attr('id', i)
//     .find('label.day').text('Day #'+(i+1)).end()
//     .find("select").each(function(){
//         this.name = replaceValue(this.name, i)
//     }).end()
//     .find(':input').each(function() {
//         this.name = replaceValue(this.name, i)
//     }).end()
//     .find('.day').removeClass('day-'+(i+1)).addClass('day-'+ i).end()
//     .find('.start').removeClass('start-'+ (i+1)).addClass('start-'+ i).end()
//     .find('.end').removeClass('end-'+ (i+1)).addClass('end-'+ i)
//   });
// }

// function getValuesArray(array)
// {
//   var tempArray = [];

//   $.each(array, function(index, item)
//   {
//       tempArray.push(item.value);
//   });

//   return tempArray;
// }

function selectArrayValues(arrayName)
{
    var selects = $( "select[name*="+ arrayName +"]" );

    var values = getValuesArray(selects);

    return values;
}

function inputArrayValues(arrayName)
{
    var inputs = $( "input[name*="+ arrayName +"]" );

    var values = getValuesArray(inputs);

    return values;
}

function getMappedArray(arrayName)
{
    var values = $( "select[name*="+ arrayName +"], input[name*="+ arrayName +"]" ).map(function() {
        return this.value;
    }).get();

    return values;
}