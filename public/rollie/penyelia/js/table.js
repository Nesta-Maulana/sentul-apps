var TableJadwal = {
    init:function()
    {
        var table_jadwal = $('#data-tables-wo').dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [5]
            }],
            orderCellsTop: true,
            fixedHeader: true,
            bFilter:false,
            bInfo:false,
            bLengthChange:false,
            pageLength:10,
            scrollY: 400,
            scrollX: true,

        });
    }
};

jQuery(document).ready(function(){
    TableJadwal.init();
});