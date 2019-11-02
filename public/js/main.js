
$(function () {
    // initializing select 2
    $('.select2').select2();

    //initializing datatable
    $('#myTable').DataTable({});
});

// change role change related permissions
function onChange() {
    var roleId = $("#role_id").val();
    window.location.replace(site_url + '/allpermissions' + '/' + roleId)
}

// check permissions check all if checked
function checkPermissions(elem) {
    var boxCheck = $(elem).parents();
    if($(elem).is(":checked")){
        boxCheck.children('div.box-body').children('p').children('input').attr('checked', 'checked');
    } else {
        boxCheck.children('div.box-body').children('p').children('input').removeAttr('checked');
    }
}

// check all permissons is checked
function checAllkPermissions(elem) {
    var boxCheckLen = $(elem).parents().children('div.box-body').children('p').children('input').length;
    var boxCheckedLen = $(elem).parents().children('div.box-body').children('p').children('input:checked').length;
    if (parseInt(boxCheckLen) === parseInt(boxCheckedLen)) {
        $(elem).parents().children('div.box-header').children('input').attr('checked', true);
    } else {
        $(elem).parents().children('div.box-header').children('input').attr('checked', false);
    }
}

