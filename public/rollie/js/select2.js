var Select2= {
    init:function() {
        $("#m_select2_1,#m_select2_2").select2( {
            placeholder: "Select a produk"
        }
        )
    }
}

;
jQuery(document).ready(function() {
    Select2.init()
}

);