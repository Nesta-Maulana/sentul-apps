"use strict";

$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2] }
  ]
});

$("#table-pengamatan").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2,3] }
  ]
});
 $('#data-tables').dataTable({
      "columnDefs": [
          { "sortable": false, "targets": [5] }
      ]
});
$('#table-jadwal').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    scrollY: 400,
    scrollX: true,
    ordering:false,
});
var tablenya =  $('#table-draft-analisa').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    aaSorting: [[2,'asc'],[3,'asc']] 
});
var tablecppb =  $('#table-cppb').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:100,
    paging:false  
});
var tablecppa =  $('#table-cppa').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:100,
    paging:false 
   
});
var tablecppa =  $('#table-cppc').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:100,
    paging:false 

});