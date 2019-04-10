var DatatableHtmlTableDemo= {
    init:function() {
        var e;
        e=$("#table-cpp").mDatatable({
            data: {
                saveState: {
                    cookie: !1
                }
            }
            , search: {
                input: $("#generalSearch")
            }
            , columns:[ 
            {
                field: "Tanggal Selesai Filling", type: "date", format: "YYYY-MM-DD"
            },{
                field: "Palet Start", type: "time", format: "HH:ii:ss"
            }, {
                field: "Palet End", type: "time", format: "HH:ii:ss"
            }, 
            ]
        }
        ),
        $("#nomor_wo_filter").on("change", function() {
            e.search($(this).val().toLowerCase(), "Nomor Wo")
        }
        ),
        $("#mesin_filling_filter").on("change", function() {
            e.search($(this).val().toLowerCase(), "Mesin Filling")
        }
        ),
        $("#nomor_wo_filter, #mesin_filling_filter").select2()
    }
}

;
jQuery(document).ready(function() {
    DatatableHtmlTableDemo.init()
}

);