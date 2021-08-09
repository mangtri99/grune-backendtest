$(function () {
    var formatActionField = function (row, cell, formatterParams) {
        return '<form id="form-delete-' + row.getData()['id'] + '" action="' + rootUrl + '/company/delete" method="get">' +
               '<a class="btn btn-primary" href="' + rootUrl + '/company/edit/' + row.getData()['id'] + '" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;' +
               '<input type="hidden" name="id" value="' + row.getData()['id'] + '">' +
               '<input type="hidden" name="delete_flag" value="1">' +
               '<span onclick="javascript:if(confirm(\'Are you sure want to delete this Data？\')) { document.getElementById(\'form-delete-' + row.getData()['id'] + '\').submit(); } return false;" class="btn btn-warning btn-delete" title="削除"><i class="fa fa-trash"></i></span>' +
               '</form>';
    };

    $("#datalist").tabulator({
        layout: "fitColumns",
        placeholder: "There is not Data",
        responsiveLayout: false,
        resizableColumns: true,
        pagination: "local",
        paginationSize: 20,
        langs:{
            "ja-jp":{
                "pagination":{
                    "first":"<<",
                    "first_title":"First Page",
                    "last":">>",
                    "last_title":"Last Page",
                    "prev":"<",
                    "prev_title":"Prev Page",
                    "next":">",
                    "next_title":"Next Page",
                },
            },
        },
        columns: [
            {title: "ID", field: "id", width: 70, headerFilter: "input", sorter: "number", headerFilterPlaceholder: " "},
            {title: "Name", field: "name", width: 200, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Email", field: "email", width: 200, headerFilter: "input", headerFilterPlaceholder: " "},
			{title: "PostCode", field: "postcode", width: 150, headerFilter:"input", headerFilterPlaceholder: " "},
            {title: "Prefecture", field: "prefecture.name", width: 150, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Address", field: "street_address", width: 200, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Updated_at", field: "updated_at", width: 150, headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "Action", field: "action", align: "center", headerFilter: false, width: 100, formatter: formatActionField, headerFilterPlaceholder: " ", headerSort: false, frozen: true}
        ],
        dataLoaded: function (data) {
            redrawTabulator();
        },
        columnResized: function (column) {
            // none
        },
        pageLoaded: function (pageno) {
            setTimeout(function () {
                // display datalist information : Showing xx to yy of zz entries
                var totalData = $('#total-data').val();
                var pageSize = $("#datalist").tabulator("getPageSize");
                var dataMin = ((pageno * pageSize) + 1) - pageSize;
                var dataMax = pageno * pageSize;
                if (totalData < dataMax) {
                    dataMax = totalData;
                }
                $('#datalist-min-data').html(dataMin);
                $('#datalist-max-data').html(dataMax);
            }, 1200);
        },
        dataFiltered:function(filters, rows){
            redrawTabulator();
        }
    });

    $('#datalist').tabulator('setData', rootUrl + '/api/admin/company/getCompanyTabular');
    $('#datalist').tabulator('setLocale', 'ja-jp');

    $(window).resize(function(){
       redrawTabulator();
    });

    $('.sidebar-toggle').click(function() {
        redrawTabulator();
    });
})

// redraw tabulator column
function redrawTabulator() {
    setTimeout(function() {
        $('#datalist').tabulator('redraw', true);
        PageDataInfo();

    }, 300);
}

function PageDataInfo(data){
    var getDataCount = $("#datalist").tabulator("getDataCount");
    var getPage      = $("#datalist").tabulator("getPage");
    var getPageSize  = $("#datalist").tabulator("getPageSize");
    var getPageMax   = $("#datalist").tabulator("getPageMax");

    $('#datalist-total-data').html(getDataCount);
    $('#total-data').val(getDataCount);

    if(getDataCount < getPageSize) {
        getPageSize = getDataCount;
    }

    $('#datalist-max-data').html(getPageSize);


    if(getPageSize == 0) {
        $('#datalist-min-data').html(0);
    } else {
        $('#datalist-min-data').html(1);
    }

    if(getDataCount > 0 ){
        $('#datalist-header').removeClass('invisible');
    }else{
        $('#datalist-header').addClass('invisible');
    }
}