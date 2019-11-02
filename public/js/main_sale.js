//for printing Invoice
function printInvoice() {
    window.print();
}

$(function () {
    // initializing select 2
    $('.select2').select2();

    //initializing datatable
    $('#myTable').DataTable({});

    //showing report
    $("#reportStartDate").datepicker({
        changeDate:true,
        changeMonth:true,
        changeYear:true,
        yearRange:'1970:+0',
        dateFormat:'yy-mm-dd',
        onSelect:function(dateText){
            var DateCreated = $('#reportStartDate').val();
            var data = {DateCreated:DateCreated};
            var url = "/reports/getdailyreport";
            var appendId = "daily-report";
            getReports(data, url, appendId);
        }
    });

    // for export data to ms excel format
    $(".excel").click(function(){
        $("#list-sale-report").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "Salereport" + new Date().toISOString().replace(/[\-\:\.]/g, "")+'.xls',
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs:true
        });
    });

    // for export data to ms word format
    $(".word").click(function () {
        $("#list-of-sale").wordexport("Daily Report");
    });

    // for export data to pdf format
    $('.pdf').on('click', function(e){
        var doc = new jsPDF('p', 'pt');
        doc.setFontSize(10);
        doc.text("Sales Report "+ new Date(), 40, 50);
        var res = doc.autoTableHtmlToJson(document.getElementById("list-sale-report"));
        doc.autoTable(res.columns, res.data, {
            theme : 'grid',
            startY:60
        });
        doc.save("Salereport" + new Date().toISOString().replace(/[\-\:\.]/g, "")+'.pdf')
    });

    // for date wise sales filtering
    $("#StartDate, #EndDate").datepicker({
        changeMonth:true,
        changeYear:true,
        yearRange:'1970:+0',
        dateFormat:'yy-mm-dd',
        onSelect:function(dateText){
            var DateCreated = $('#StartDate').val();
            var EndDate = $('#EndDate').val();
            var inputData = {DateCreated:DateCreated,EndDate:EndDate};
            var url = "/reports/getsalereport";
            getReports(inputData, url, "list-of-sale")
        }
    });

    // for date wise sales filtering
    $("#lStartDate, #lEndDate").datepicker({
        changeMonth:true,
        changeYear:true,
        yearRange:'1970:+0',
        dateFormat:'yy-mm-dd',
        onSelect:function(dateText){
            var DateCreated = $('#lStartDate').val();
            var EndDate = $('#lEndDate').val();
            var inputData = {DateCreated:DateCreated,EndDate:EndDate};
            var url = "/reports/getsales";
            getReports(inputData, url, "list-sale-report")
        }
    });

});


function getReports(inputData, url, appendId)
{
    $.ajax({
        type : 'get',
        url : site_url + url,
        data : inputData,
        success:function(data)
        {
            $('#' + appendId).empty().html(data);
        }
    });
}

function saleReportFilter()
{
    $('Form#saleReportFilterForm').submit();
}

$("#holdSale").on("click", function(){
    var formData = $("#saleForm").serialize();
    $.ajax({
        url: site_url + "/sales",
        type: "post",
        data: formData + "&action=" + "hold-sale",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (response) {
            console.log(response);
            if (!response.success) {
                alert(response.message);
            } else if (response.success) {
                alert(response.message);
                location.reload();
            }
        // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});