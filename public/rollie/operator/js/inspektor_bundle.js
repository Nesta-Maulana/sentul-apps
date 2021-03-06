
function prosesrpd(namaproduk,nomorwo) 
{
    Swal.fire
    ({
        title: 'Konfirmasi Aksi Filling',
        text: 'Apakah '+namaproduk+' dengan Nomor Wo '+nomorwo+' akan diproses filling?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Masuk Ke Form RPD Filling',
        cancelButtonText: 'Tidak Proses Yang Lain',
    }).then((result) => 
    {
        if (result.value) 
        {
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('proses-rpd-filling') }}',
                method: 'POST',
                dataType: 'JSON',
                data: 
                { 
                    'nama_produk'   : namaproduk, 
                    'nomor_wo'      : nomorwo
                },
                success: function (data) 
                {
                    window.location.href    = "rollie-inspektor-qc/rpd-filling/"+data.id_rpd_head
                },
            });
        }
    })
}
function analisa_sampel_pi(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id,nama_produk,wo_id_sampel,mesin_filling_id_sampel)
{
    // set analisa sampel popup value untuk input ke database
    document.getElementById('nama_produk_analisa_pi').innerHTML         = nama_produk;
    document.getElementById('sampel_pi_analisa').value                  = kode_sampel+" - "+event_sampel;
    document.getElementById('mesin_filling_pi_analisa').value           = mesin_filling;
    document.getElementById('tanggal_filling_pi_analisa').value         = tanggal_filling;
    document.getElementById('jam_filling_pi_analisa').value             = jam_filling;
    document.getElementById('rpd_filling_detail_id_pi').value           = rpd_filling_detail_id;
    document.getElementById('wo_id_sampel').value                       = wo_id_sampel;
    document.getElementById('mesin_filling_id_sampel').value            = mesin_filling_id_sampel;
}



function submit_analisa_pi(rpd_filling_detail_id_pi,rpd_filling_head_id,nama_produk_analisa_pi,hasil_air_gap,hasil_ts_accurate_kanan,hasil_ts_accurate_kiri,hasil_ls_accurate,hasil_sa_accurate,hasil_surface_check,hasil_pinching,hasil_strip_folding,hasil_konduktivity_kanan,hasil_konduktivity_kiri,hasil_design_kanan,hasil_design_kiri,hasil_dye_test,hasil_residu_h2o2,hasil_prod_code_no_md,hasil_correction,ts_accurate_kanan_tidak_ok,ts_accurate_kiri_tidak_ok,ls_accurate_tidak_ok,sa_accurate_tidak_ok,surface_check_tidak_ok,wo_id,mesin_filling_id,overlap,ls_sa_proportion,volume_kanan,volume_kiri,user_id_inputer) 
{
    if (!rpd_filling_detail_id_pi || !rpd_filling_head_id || !nama_produk_analisa_pi || !hasil_air_gap || !hasil_ts_accurate_kanan || !hasil_ts_accurate_kiri || !hasil_ls_accurate || !hasil_sa_accurate || !hasil_surface_check || !hasil_pinching || !hasil_strip_folding || !hasil_konduktivity_kanan || !hasil_konduktivity_kiri || !hasil_design_kanan || !hasil_design_kiri || !hasil_dye_test || !hasil_residu_h2o2 || !hasil_prod_code_no_md || !hasil_correction || !ts_accurate_kanan_tidak_ok || !ts_accurate_kiri_tidak_ok || !ls_accurate_tidak_ok || !sa_accurate_tidak_ok || !surface_check_tidak_ok || !wo_id || !mesin_filling_id || !overlap || !ls_sa_proportion || !volume_kanan || !volume_kiri || !user_id_inputer || rpd_filling_detail_id_pi=='' || rpd_filling_head_id=='' || nama_produk_analisa_pi=='' || hasil_air_gap=='' || hasil_ts_accurate_kanan=='' || hasil_ts_accurate_kiri=='' || hasil_ls_accurate=='' || hasil_sa_accurate=='' || hasil_surface_check=='' || hasil_pinching=='' || hasil_strip_folding=='' || hasil_konduktivity_kanan=='' || hasil_konduktivity_kiri=='' || hasil_design_kanan=='' || hasil_design_kiri=='' || hasil_dye_test=='' || hasil_residu_h2o2=='' || hasil_prod_code_no_md=='' || hasil_correction=='' || ts_accurate_kanan_tidak_ok=='' || ts_accurate_kiri_tidak_ok=='' || ls_accurate_tidak_ok=='' || sa_accurate_tidak_ok=='' || surface_check_tidak_ok=='' || wo_id=='' || mesin_filling_id=='' || overlap=='' || ls_sa_proportion=='' || volume_kanan=='' || volume_kiri=='' || user_id_inputer=='')
    {
        swal({
            title: "Proses Gagal",
            text : "Harap Lengkapi Data Analisa",
            type : "error",
        });
        return false;   
    }

    if (ls_sa_proportion.includes(':'))
    {
        if (ls_sa_proportion.toString().split(":")[1].length != 2 | ls_sa_proportion.toString().split(":")[0].length != 2)
        {
            swal({
                title: "Proses Gagal",
                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                type : "error",
            });
            return false;
        }
    }
    else
    {
        swal({
                title: "Proses Gagal",
                text: "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                type: "error",
            });
        return false;
    }

    if (hasil_air_gap == 'OK' && hasil_ts_accurate_kanan == 'OK' && hasil_ts_accurate_kiri == 'OK' && hasil_ls_accurate == 'OK' && hasil_sa_accurate == 'OK' && hasil_surface_check == 'OK' && hasil_pinching == 'OK' && hasil_strip_folding == 'OK' && hasil_konduktivity_kanan == 'OK' && hasil_konduktivity_kiri == 'OK' && hasil_design_kanan == 'OK' && hasil_design_kiri == 'OK' && hasil_dye_test == 'OK' && hasil_residu_h2o2 == 'OK' && hasil_prod_code_no_md == 'OK'  && (ls_sa_proportion !== '10:90' || ls_sa_proportion !== '90:10' || ls_sa_proportion !== '80:20' ||ls_sa_proportion !== '70:30' ) && (volume_kanan >= 198 || volume_kanan <= 202) && (volume_kiri >= 198 || volume_kiri <= 202) || (overlap >= 3,5 && overlap <= 4,5))
    {
        Swal.fire({
            title: 'Apa benar hasil semua pengecekan OK?',
            text: "Jika hasil semua OK klik lanjutkan, Jika ada #OK click Revisi dan ubah hasil sesuai pengamatan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Ya, Lanjutkan',
            cancelButtonText    : 'Revisi Data Analisa'
        }).then((result) => {
            if (result.value) 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisapi-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        'rpd_filling_detail_id_pi'  :rpd_filling_detail_id_pi,
                        'rpd_filling_head_id'       :rpd_filling_head_id,
                        'nama_produk_analisa_pi'    :nama_produk_analisa_pi,
                        'air_gap'                   :hasil_air_gap,
                        'ts_accurate_kanan'         :hasil_ts_accurate_kanan,
                        'ts_accurate_kiri'          :hasil_ts_accurate_kiri,
                        'ls_accurate'               :hasil_ls_accurate,
                        'sa_accurate'               :hasil_sa_accurate,
                        'surface_check'             :hasil_surface_check,
                        'pinching'                  :hasil_pinching,
                        'strip_folding'             :hasil_strip_folding,
                        'konduktivity_kanan'        :hasil_konduktivity_kanan,
                        'konduktivity_kiri'         :hasil_konduktivity_kiri,
                        'design_kanan'              :hasil_design_kanan,
                        'design_kiri'               :hasil_design_kiri,
                        'dye_test'                  :hasil_dye_test,
                        'residu_h2o2'               :hasil_residu_h2o2,
                        'prod_code_no_md'           :hasil_prod_code_no_md,
                        'correction'                :hasil_correction,
                        'ts_accurate_kanan_tidak_ok':ts_accurate_kanan_tidak_ok,
                        'ts_accurate_kiri_tidak_ok' :ts_accurate_kiri_tidak_ok,
                        'ls_accurate_tidak_ok'      :ls_accurate_tidak_ok,
                        'sa_accurate_tidak_ok'      :sa_accurate_tidak_ok,
                        'surface_check_tidak_ok'    :surface_check_tidak_ok,
                        'wo_id'                     :wo_id,
                        'mesin_filling_id'          :mesin_filling_id,
                        'overlap'                   :overlap,
                        'ls_sa_proportion'          :ls_sa_proportion,
                        'volume_kanan'              :volume_kanan,
                        'volume_kiri'               :volume_kiri,
                        'user_inputer_id'           :user_id_inputer,
                    },
                    success      : function(data) 
                    {
                        if (data.success == true) 
                        {                                                    
                            hapusdatapopup();
                            document.getElementById('close-button-pi').click();
                            reloadTablePi();
                        } 
                    }
                });
            }
        })
    }
    else
    {
        console.log(rpd_filling_detail_id_pi+rpd_filling_head_id+nama_produk_analisa_pi+hasil_air_gap+hasil_ts_accurate_kanan+hasil_ts_accurate_kiri+hasil_ls_accurate+hasil_sa_accurate+hasil_surface_check+hasil_pinching+hasil_strip_folding+hasil_konduktivity_kanan+hasil_konduktivity_kiri+hasil_design_kanan+hasil_design_kiri+hasil_dye_test+hasil_residu_h2o2+hasil_prod_code_no_md+hasil_correction+ts_accurate_kanan_tidak_ok+ts_accurate_kiri_tidak_ok+ls_accurate_tidak_ok+sa_accurate_tidak_ok+surface_check_tidak_ok)
    }
}

function analisa_sampel_at_event(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id,wo_id,mesin_filling_id)
{
    // function tambahan analisa untuk sampel at event
    document.getElementById('sampel_at_event').value                = kode_sampel+" - "+event_sampel;
    document.getElementById('sampel_at_event_kode').value           = kode_sampel;
    document.getElementById('mesin_filling_at_event').value         = mesin_filling;
    document.getElementById('mesin_filling_at_event_id').value      = mesin_filling_id;
    document.getElementById('rpd_filling_detail_id_at_event').value = rpd_filling_detail_id;
    document.getElementById('wo_id_sampel_event').value             = wo_id_sampel;
    document.getElementById('jam_filling_at_event').value           = jam_filling;
    document.getElementById('tanggal_filling_at_event').value       = tanggal_filling;
    if (kode_sampel.includes(' (Event)')) 
    {
        kode_sampel_baru    = kode_sampel.split(' (Event)')
        kode_sampel         = kode_sampel_baru[0];
    }
    if (kode_sampel.includes('(')) 
    {
        kode_sampel_baru    = kode_sampel.split('(');
        kode_sampel         = kode_sampel_baru[0];
    }
    switch(kode_sampel)
    {
        case 'B':
            $('#paper_splicing').removeClass('sembunyi');
        break;
        case 'C':
            $('#paper_splicing').removeClass('sembunyi');
        break;
        case 'D':
            $('#strip_splicing').removeClass('sembunyi');
        break;
        case 'E':
            $('#strip_splicing').removeClass('sembunyi');
        break;
        case 'F':
            $('#short_stop').removeClass('sembunyi');
        break;
        case 'G':
            $('#short_stop').removeClass('sembunyi');
        break;
    }
}

function status_akhir_at_event(kode_sampel) 
{
    if (kode_sampel.includes(' (Event)')) 
    {
        kode_sampel_baru    = kode_sampel.split(' (Event)')
        kode_sampel         = kode_sampel_baru[0];
    }
    if (kode_sampel.includes('(')) 
    {
        kode_sampel_baru    = kode_sampel.split('(');
        kode_sampel         = kode_sampel_baru[0];
    }
    switch(kode_sampel)
    {
        case 'B':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_sideway_sealing_alignment_event       =  $('#hasil_sideway_sealing_alignment_event').val();
            var hasil_overlap_event                         =  $('#hasil_overlap_event').val();
            var hasil_package_length_event                  =  $('#hasil_package_length_event').val();
            var hasil_paper_splice_sealing_quality_event    =  $('#hasil_paper_splice_sealing_quality_event').val();
            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 || hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event >= 16 || hasil_overlap_event <= 17) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
        case 'C':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_sideway_sealing_alignment_event       =  $('#hasil_sideway_sealing_alignment_event').val();
            var hasil_overlap_event                         =  $('#hasil_overlap_event').val();
            var hasil_package_length_event                  =  $('#hasil_package_length_event').val();
            var hasil_paper_splice_sealing_quality_event    =  $('#hasil_paper_splice_sealing_quality_event').val();
            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 || hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event >= 16 || hasil_overlap_event <= 17) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
        case 'D':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_ls_sa_sealing_quality_strip_event     =  $('#hasil_ls_sa_sealing_quality_strip_event').val();
            
            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
        case 'E':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_ls_sa_sealing_quality_strip_event     =  $('#hasil_ls_sa_sealing_quality_strip_event').val();
            
            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
        case 'F':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_ls_short_stop_quality_event           =  $('#hasil_ls_short_stop_quality_event').val();
            var hasil_sa_short_stop_quality_event           =  $('#hasil_sa_short_stop_quality_event').val();
            
            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' &&hasil_sa_short_stop_quality_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_short_stop_quality_event !== null && hasil_sa_short_stop_quality_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
        case 'G':
            var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
            var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
            var hasil_ls_short_stop_quality_event           =  $('#hasil_ls_short_stop_quality_event').val();
            var hasil_sa_short_stop_quality_event           =  $('#hasil_sa_short_stop_quality_event').val();
            
            if (hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
            {
                document.getElementById('hasil_status_akhir_event').value = 'OK';
            }
            else
            {
                document.getElementById('hasil_status_akhir_event').value = '#OK';
            }
        break;
    }
}   

function submit_at_event(kode_sampel, rpd_filling_detail_id_at_event, wo_id_sampel_event,hasil_ls_sa_sealing_quality_event,hasil_ls_sa_proportion_event,hasil_sideway_sealing_alignment_event,hasil_overlap_event,hasil_package_length_event,hasil_paper_splice_sealing_quality_event,hasil_no_kk_event,hasil_nomor_md_event,hasil_ls_sa_sealing_quality_strip_event,hasil_ls_short_stop_quality_event,hasil_sa_short_stop_quality_event,hasil_status_akhir_event,hasil_keterangan_event) 
{
    var paketan = [];
    paketan.push(kode_sampel,rpd_filling_detail_id_at_event,wo_id_sampel_event);
    if (kode_sampel.includes(' (Event)')) 
    {
        kode_sampel_baru    = kode_sampel.split(' (Event)')
        kode_sampel         = kode_sampel_baru[0];
    }
    if (kode_sampel.includes('(')) 
    {
        kode_sampel_baru    = kode_sampel.split('(');
        kode_sampel         = kode_sampel_baru[0];
    }
    switch(kode_sampel)
    {
        case 'B':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_package_length_event !== null && hasil_paper_splice_sealing_quality_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_package_length_event !=='' && hasil_paper_splice_sealing_quality_event !=='') 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        sideway_sealing_alignment_event     : hasil_sideway_sealing_alignment_event,
                        overlap_event                       : hasil_overlap_event,
                        package_length_event                : hasil_package_length_event,
                        paper_splice_sealing_quality_event  : hasil_paper_splice_sealing_quality_event,
                        no_md                               : hasil_nomor_md_event,
                        no_kk                               : hasil_no_kk_event,
                        keterangan                          : hasil_keterangan_event,
                        status_akhir                        : hasil_status_akhir_event
                    },
                    success      : function(data) 
                    {
                        document.getElementById('close-button-at-event').click();
                        resetPiAtEvent();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }
        break;
        
        case 'C':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_package_length_event !== null && hasil_paper_splice_sealing_quality_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_package_length_event !=='' && hasil_paper_splice_sealing_quality_event !=='') 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        sideway_sealing_alignment_event     : hasil_sideway_sealing_alignment_event,
                        overlap_event                       : hasil_overlap_event,
                        package_length_event                : hasil_package_length_event,
                        paper_splice_sealing_quality_event  : hasil_paper_splice_sealing_quality_event,
                        no_md                               : hasil_nomor_md_event,
                        no_kk                               : hasil_no_kk_event,
                        keterangan                          : hasil_keterangan_event
                    },
                    success      : function(data) 
                    {
                        resetPiAtEvent();
                        document.getElementById('close-button-at-event').click();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }

        break;
        case 'D':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_strip_event !== null) 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        ls_sa_sealing_quality_strip         : hasil_ls_sa_sealing_quality_strip_event,
                        keterangan                          : hasil_keterangan_event
                    },
                    success      : function(data) 
                    {
                        resetPiAtEvent();
                        document.getElementById('close-button-at-event').click();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }
        break;
        case 'E':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_strip_event !== null) 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        ls_sa_sealing_quality_strip         : hasil_ls_sa_sealing_quality_strip_event,
                        keterangan                          : hasil_keterangan_event
                    },
                    success      : function(data) 
                    {
                        resetPiAtEvent();
                        document.getElementById('close-button-at-event').click();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }
        break;
        case 'F':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' && hasil_sa_short_stop_quality_event !=='' && hasil_ls_short_stop_quality_event !==null && hasil_sa_short_stop_quality_event !==null) 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        ls_short_stop_quality               : hasil_ls_short_stop_quality_event,
                        sa_short_stop_qulity                : hasil_sa_short_stop_quality_event,
                        keterangan                          : hasil_keterangan_event
                    },
                    success      : function(data) 
                    {
                        resetPiAtEvent();
                        document.getElementById('close-button-at-event').click();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }
        break;  
        case 'G':
            if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' && hasil_sa_short_stop_quality_event !=='' && hasil_ls_short_stop_quality_event !==null && hasil_sa_short_stop_quality_event !==null) 
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '{{ route('analisaevent-inspektor-qc') }}',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        paketan                             : paketan,
                        ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                        ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                        ls_short_stop_quality               : hasil_ls_short_stop_quality_event,
                        sa_short_stop_qulity                : hasil_sa_short_stop_quality_event,
                        keterangan                          : hasil_keterangan_event
                    },
                    success      : function(data) 
                    {
                        resetPiAtEvent();
                        document.getElementById('close-button-at-event').click();
                        reloadTablePi();
                    }
                });
            }
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Harap Lengkapi Data Analisa",
                    type : "error",
                });
                return false;   
            }
        break;          
    }
}

// function reset popup pi at event
function resetPiAtEvent()
{
    var custom_input    = $('#custom_input');
    var find_non_active     = custom_input.find('.sembunyi');
    for (var i = 0; i < find_non_active.length; i++) 
    {
        var hapus_class = $('#'+find_non_active[i].id);
        hapus_class.removeClass('sembunyi');
    }
    $('#paper_splicing').addClass('sembunyi');        
    $('#strip_splicing').addClass('sembunyi');        
    $('#short_stop').addClass('sembunyi');

    $('#kodeanalisasampel option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#hasil_ls_sa_sealing_quality_event option').prop('selected', function() 
    {
        return this.defaultSelected;
    });
    $('#hasil_sideway_sealing_alignment_event').val('');
    $('#hasil_overlap_event').val('');
    $('#hasil_package_length_event').val('');
    $('#hasil_paper_splice_sealing_quality_event option').prop('selected',function() 
    {
        return this.defaultSelected;
    })

    $('#hasil_no_kk_event').val('');
    $('#hasil_nomor_md_event').val('');
    $('#hasil_ls_sa_sealing_quality_strip_event option').prop('selected',function() 
    {
        return this.defaultSelected;
    });

    $('#hasil_ls_short_stop_quality_event option').prop('selected', function() 
    {
        return this.defaultSelected;
    })
    $('#hasil_sa_short_stop_quality_event option').prop('selected', function() 
    {
        return this.defaultSelected;
    })
    $('#hasil_status_akhir_event').val('');
    $('#hasil_keterangan_event').val('');
}

//function tambah sampel analisa untuk dimasukan di analisa QC rpd filling
function tambahSampelAnalisa(nomorwo,mesinfilling,tanggalfilling,jamfilling,kodeanalisa,keteranganevent,beratkanan,beratkiri,id_user,id_rpd_head) 
{
    if (!nomorwo || !mesinfilling || !tanggalfilling || !jamfilling || !kodeanalisa || !keteranganevent || !beratkanan || !beratkiri)
    {
        swal({
            title: "Proses Gagal",
            text: "Harap lengkapi data-data analisa sampel",
            type: "error",
        });
        return false;
    }
    if (beratkanan.includes('.') && beratkiri.includes('.'))
    {
        if (beratkanan.toString().split(".")[1].length != 2 || beratkiri.toString().split(".")[1].length != 2)
        {
            swal({
                title: "Proses Gagal",
                text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                type: "error",
            });
            return false;
        }
    }
    else
    {
        swal({
                title: "Proses Gagal",
                text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                type: "error",
            });
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : '{{ route('tambahsampel-inspektor-qc') }}',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            'nomor_wo'          : nomorwo,
            'mesin_filling_id'  : mesinfilling,
            'tanggal_filling'   : tanggalfilling,
            'jam_filling'       : jamfilling,
            'kode_analisa_id'   : kodeanalisa,
            'keteranganevent'   : keteranganevent,
            'berat_kanan'       : beratkanan,
            'berat_kiri'        : beratkiri,
            'user_inputer_id'   : id_user,
            'rpd_filling_head_id' : id_rpd_head
        },
        success      : function(data) 
        {
            hapusdatapopup();
            document.getElementById('close-button').click();
            reloadTablePi();
        }
    });
}
//reload otomatis table
function reloadTablePi() 
{
    var $idrpdfillinghead = $('#idrpdfillinghead').val();
    $.ajax({
        url     : '/sentul-apps/rollie-inspektor-qc/refresh-rpd-filling/'+$idrpdfillinghead,
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            console.log(data);
            var isitable = '', $isitable = $('#detail_pi');
            for (var i = 0; i < data.detail_pi_nya.length; i++)
            {
                isitable    += '<tr>';
                isitable    += '<td>'+data.detail_pi_nya[i].nomor_wo+'</td>';
                isitable    += '<td>'+data.detail_pi_nya[i].mesin_filling+'</td>';
                isitable    += '<td>'+data.detail_pi_nya[i].jam_filling+'</td>';
                isitable    += '<td>'+data.detail_pi_nya[i].kode_sampel+'</td>';
                if (data.detail_pi_nya[i].kodenya == 'Event') 
                {
                    isitable    += '<td><a data-toggle="modal" data-target="#analisa-sample-at-event" onclick="analisa_sampel_at_event(\''+data.detail_pi_nya[i].kode_sampel+'\',\''+data.detail_pi_nya[i].event+'\',\''+data.detail_pi_nya[i].mesin_filling+'\',\''+data.detail_pi_nya[i].tanggal_filling+'\',\''+data.detail_pi_nya[i].jam_filling+'\',\''+data.detail_pi_nya[i].detail_id_enkripsi+'\',\''+data.detail_pi_nya[i].wo_id+'\',\''+data.detail_pi_nya[i].mesin_filling_id+'\')">Analisa</a></td>';
                } 
                else if (data.detail_pi_nya[i].kodenya == 'Bukan Event') 
                {
                    isitable    += '<td><a data-toggle="modal" data-target="#analisa-sample-pi" onclick="analisa_sampel_pi(\''+data.detail_pi_nya[i].kode_sampel+'\',\''+data.detail_pi_nya[i].event+'\',\''+data.detail_pi_nya[i].mesin_filling+'\',\''+data.detail_pi_nya[i].tanggal_filling+'\',\''+data.detail_pi_nya[i].jam_filling+'\',\''+data.detail_pi_nya[i].detail_id_enkripsi+'\',\''+data.detail_pi_nya[i].nama_produk+'\',\''+data.detail_pi_nya[i].wo_id+'\',\''+data.detail_pi_nya[i].mesin_filling_id+'\')">Analisa</a></td>';
                }
                isitable    += '</tr>';
            }
            $isitable.html(isitable).on('change');
        }
    });
}
function hapusdatapopup()
{
    $('#nomorwosampel option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#mesinfillingsampel option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('.timepickernya').data("DateTimePicker").date(moment(new Date()).format('HH:mm:ss'));
    $('.datepickernya').data("DateTimePicker").date(moment(new Date()).format('YYYY-MM-DD'));
    $('#kodeanalisasampel option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#eventsampel option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#beratkanansampel').val('');
    $('#beratkirisampel').val('');
}

function hapusdatapopupanalisapi()
{
    $('#rpd_filling_detail_id_pi').val('');
    $('#wo_id_sampel').val('');
    $('#mesin_filling_id_sampel').val('');
    $('#rpd_filling_detail_id_pi').val('');
    $('#sampel_pi_analisa').val('');
    $('#mesin_filling_pi_analisa').val('');
    $('#tanggal_filling_pi_analisa').val('');
    $('#jam_filling_pi_analisa').val('');
    $('#hasil_air_gap option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_ts_accurate_kanan option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_ts_accurate_kiri option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_ls_accurate option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_sa_accurate option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_surface_check option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_pinching option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_strip_folding option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_konduktivity_kanan option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_konduktivity_kiri option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_design_kanan option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_design_kiri option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_dye_test option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_residu_h2o2 option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_prod_code_no_md option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#hasil_correction option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#ts_accurate_kanan_tidak_ok option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#ts_accurate_kiri_tidak_ok option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#ls_accurate_tidak_ok option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#sa_accurate_tidak_ok option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#surface_check_tidak_ok option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#wo_id option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#mesin_filling_id option').prop('selected', function() {
        return this.defaultSelected;
    })
    $('#overlap').val('');
    $('#ls_sa_proportion').val('');
    $('#volume_kanan').val('');
    $('#volume_kiri').val('');
}