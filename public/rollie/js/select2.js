var Select2= {
    init:function() {
        $("#nama_produk_cpp").select2( {
            placeholder: "Select a produk"
        }),
        $("#tanggal_produksi_cpp").select2( {
            placeholder: "Select a produk"
        }),
        $("#nama_produk_rkj").select2( {
            placeholder: "Select a produk"
        })
    }
}

;
jQuery(document).ready(function() {
    Select2.init()
}

);