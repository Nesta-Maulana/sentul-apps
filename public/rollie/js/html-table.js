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
        $("#nomor_wo").on("change", function() {
            e.search($(this).val().toLowerCase(), "Nomor Wo")
        }
        ),
        $("#m_form_type").on("change", function() {
            e.search($(this).val().toLowerCase(), "Type")
        }
        ),
        $("#nomor_wo, #mesinfilling").select2()
    }
}

;
jQuery(document).ready(function() {
    DatatableHtmlTableDemo.init()
}

);