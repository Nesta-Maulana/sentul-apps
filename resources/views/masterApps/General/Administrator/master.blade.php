<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator | @yield('judul')</title>
    <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/css/style.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/plugins/select2/css/select2.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/plugins/select2/css/select2.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')!!}">
    {{-- <link rel="stylesheet" href="{!!asset('generalStyle/plugins/bootstrap-select-1.13.2/dist/css/bootstrap-select.min.css')!!}"> 
    <link rel="stylesheet" href="{!!asset('generalStyle/plugins/bootstrap-select-1.13.2/dist/css/bootstrap-select.css')!!}">  --}}

    <link rel="stylesheet" href="{!!asset('generalStyle/fonts/icon/font-awesome.min.css')!!}">
</head>
<body style="background: whitesmoke;">
    <nav class="navbar navbar-expand-sm navbar-light" style="background:#0CBEF2;height: 65px;">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#"><img src="{!!asset('generalStyle/images/logo/mixpro-logo.png')!!}" style="width:50px;height:50px;" alt=""></a>    
        <!-- Links -->
        <ul class="navbar-nav mr-auto" >
            <li class="nav-item">
                <a class="nav-link-2" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-2" href="#">User Guide</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-2" href="#">Help</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link-4 dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, Nesta Maulana
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Edit Profile</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-expand-sm navbar-light" style="background:#0070DB;height: 35px; margin-top:5px;padding-left: 83px;">
        <!-- Links -->
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link @yield('active-home')" href="{{url('administrator/home')}}">
                   <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item"> 
                <a href="javascript:void(0)" class="nav-link-3" style="color:white">|</a>
            </li>
            <li class="nav-item @yield('active-lpm')">
                <a class="nav-link" href="{{url('administrator/lpm')}}">
                    <i class="fa fa-files-o"></i> LPM
                </a>
            </li>
            <li class="nav-item"> 
                <a href="javascript:void(0)" class="nav-link-3" style="color:white">|</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('active-pmb')" href="{{url('administrator/pmb')}}">
                    <i class="fa fa-edit"></i> PMB
                </a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid" style="min-height: 565px;">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-lg-12  py-4">
                @php
                    $menu   = explode("/",Request::path());
                    $a      = 1;
                @endphp
                @if (count($menu)>1 && $menu['1'] != "home")
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="background: #0cbef259">
                        @foreach ($menu as $item)
                            @if ($a < count($menu))
                            <li class="breadcrumb-item" style="color:black;font-weight: 900;">{{ucfirst($item)}}</li>
                            @else
                            <li class="breadcrumb-item active" style="color:#232020;font-weight: 600">{{ucfirst($item)}}</li>                                
                            @endif
                            @php
                                $a++;
                            @endphp
                        @endforeach
                        </ol>
                    </nav>            
                @endif
                
                @yield('content') 
            </div>
        </div>        
    </div>

    <!-- Footer -->           
    <br>
    <div class="footer-copyright text-center" style="background:#0CBEF2;padding-top: 5px;padding-bottom: 5px;color:white">© 2018 Copyright:
        <a href="javascript:void(0)" style="color:darkgreen">PT. Nutrifood Indonesia</a> | Coded <i class="fa fa-code" style="color:palevioletred;"></i> With Love <i class="fa fa-heart" style="color:palevioletred"></i>
    </div>
    </footer>
    
    
      <!-- Footer -->
    <script src="{!!asset('generalStyle/js/jquery.slim.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/js/popper.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/js/bootstrap.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/js/bootstrap.js')!!}"></script>
    <script src="{!!asset('generalStyle/js/shortcut.js')!!}"></script>
    <script src="{!!asset('generalStyle/plugins/select2/js/select2.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/plugins/select2/js/select2.js')!!}"></script>
    <script src="{!!asset('generalStyle/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')!!}"></script>
    {{-- Start Select Two Script --}}
    <script>
        $(document).ready(function() {
            $('.custom-select').select2();
        });
        $(function(){
        $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
    {{-- End Select Two Script --}}

    {{-- Start Checked Box To Text Box --}}
    <script>
        var checks = document.getElementsByClassName('checkBox'); //ini buat ambil semua checkbox
        var texts = document.getElementsByClassName('textBox'); // ini buat ambil semua textbox
        var chk2 = document.getElementsByClassName('caca'); // in case apabila satu check box untuk dua atau lebih textbox
        Array.from(checks).forEach((v,i) => v.addEventListener('change', function(){
            //if conditional untuk masing masing mesin
            console.log(i);
            if($('#contentnya').find('.active').attr('id') == 'milkTankyb')
            {
                
                if(i == 3)
                {
                    texts[i].disabled = !this.checked;
                    chk2[0].disabled = !this.checked;
                }
                else
                {
                    texts[i].disabled = !this.checked;
                }
            }
            else if($('#contentnya').find('.active').attr('id') == 'pheYb')
            {
                if(i == 6)
                {
                    texts[i].disabled = !this.checked;
                    chk2[1].disabled = !this.checked;
                }
                else
                {
                    texts[i].disabled = !this.checked;
                }
            }
            else
            {
                texts[i].disabled = !this.checked;
            }
        }));
      
    </script>
    {{-- end check box to text box --}}
    
    {{-- start Menu Form Compliting Page --}}
    <script>
        $(document).ready(function () {
            // untuk tab aktif dan tidak aktifnya
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });  
            // untuk mengambil semua button yang ada class nextnya 
            $(".next-page").click(function (e){

                var $active = $('.wizard .nav-wizard li.active'); //  mengambil tab yang aktif 
                $active.removeClass('active');  // menghilangkan class active di kelas yang diambil
                $active.next().removeClass('disabled');  // menghilangkan class disable dari tab setelahnya 
                $active.next().addClass('active'); // mengaktifkan tab setelahnya
                nextTab($active); // mengklik otomatis tab yang ada

            });

        }); 
        function nextTab(elem)
        {
            $(elem).next().find('a[data-toggle="tab"]').click(); // auto click untuk tab yang dikirim
        }
    </script>
    {{-- end menu form compliting page --}}
    <script>
        var $kliktabel = 0;
        var $tableawal ="";
        function tambahAktivitas()
        {
            $kliktabel = $kliktabel+1;
            if($kliktabel == 1)
            {
                $tableawal = $('#contentnya').find('.active').attr('id');
                $(".table-aktivitas-"+$('#contentnya').find('.active').attr('id')).css("visibility","");
                $(".btn-hapus").css("visibility","");
                //$(".table-aktivitas").css("visibility","");
            }   
            else
            {
                if($('#contentnya').find('.active').attr('id') == $tableawal)
                {
                    tambahRow($('#contentnya').find('.active').attr('id'));
                }
                else
                {
                    $tableawal = $('#contentnya').find('.active').attr('id');
                    const inidivnya  = document.querySelector(".table-aktivitas-"+$('#contentnya').find('.active').attr('id'));
                    const visibility = inidivnya.style.visibility; 
                    if(visibility == 'hidden')
                    {
                        $(".table-aktivitas-"+$('#contentnya').find('.active').attr('id')).css("visibility","");
                        $(".btn-hapus").css("visibility","");
                    }
                    else
                    {
                        tambahRow($('#contentnya').find('.active').attr('id'));
                    }
                }
                
            }
        }
    </script>
    {{-- start tambah row untuk table dan short cut nya --}}
    <script>
        function tambahRow(tablenya) 
        {
            var $tableBody = $('#'+tablenya+"table").find("tbody");
            $trLast = $tableBody.find("tr:last");
            $trLast.find('.custom-select').select2('destroy'); // Un-instrument original row
            $trNew = $trLast.clone();
            $trLast.find('.custom-select').select2(); // Re-instrument original row
            $trNew.find('.custom-select').select2(); // Instrument clone
            $trLast.after($trNew);
            $i = 1;
            $trNew.find("input:radio").each(function() {
                $(this).attr({
                // 'id': function(_, id) { return id + $i },
                'name': function(_, name) { return name + $i },
                'value': ''               
                });
            });
            $i++;
        }
        function hapusRow(tablenya) 
        {
            var rows = document.getElementById(tablenya+"table").getElementsByTagName("tr").length;
            if (rows == 2) 
            {
                if(tablenya == 'pheTermisasi')
                {
                    $(".table-aktivitas-pheTermisasi").css("visibility","hidden");
                    $(".btn-hapus").css("visibility","hidden");

                    $kliktabel = 0;                    
                }
                else if(tablenya == 'milkTankyb')
                {
                    $(".table-aktivitas-milkTankyb").css("visibility","hidden");
                    $(".btn-hapus").css("visibility","hidden");
                    $kliktabel = 0;                    
                }
                else if(tablenya == 'pheYb')
                {
                    $(".table-aktivitas-pheYb").css("visibility","hidden");
                    $(".btn-hapus").css("visibility","hidden");
                    $kliktabel = 0;
                }
                else
                {
                    alert("Tidak bisa menghapus baris pertama");
                }
            }
            else
            {
                var rows = document.getElementById(tablenya+"table").getElementsByTagName("tr").length;
                var result = confirm("Apakah anda akan menghapus data dibaris terakhir?");
                if(result)
                {
                    var table = document.getElementById(tablenya+"table");
                    var row = table.deleteRow(rows-1);
                }
            }   
        }

        shortcut.add("Alt+A",
            function() 
            {
                if($('#contentnya').find('.active').attr('id') == 'pheTermisasi')
                {
                    tambahAktivitas();
                }
                else if($('#contentnya').find('.active').attr('id') == 'milkTankyb')
                {
                    tambahAktivitas();
                }
                else if($('#contentnya').find('.active').attr('id') == 'pheYb')
                {
                    tambahAktivitas();
                }
                else
                {
                    tambahRow($('#contentnya').find('.active').attr('id'));
                }
            },
            { 
                'type':'keydown', 
                'propagate':true, 
                'target':document
            }
        ); 
        
        shortcut.add("Alt+Z",
            function() 
            {
                hapusRow($('#contentnya').find('.active').attr('id'));
            },
            { 
                'type':'keydown', 
                'propagate':true, 
                'target':document
            }
        ); 
    </script>
    <script>
        (function($) {
        $(document).ready(function() {
            $('.select-phe')
            .change(function() {
                switch ($(this).val()) {
                case '1':
                    console.log('Ini pilihan pertama');
                break;
                
                case '2':
                    console.log('Ini pilihan kedua');
                break;

                case '3':
                    console.log('Ini pilihan ketiga');
                break;
                case '4':
                    console.log('Ini pilihan keempat');
                break;
                case '5':
                    console.log('Ini pilihan kelima');
                break;
                case '6':
                    console.log('Ini pilihan keenam');
                break;
                case '7':
                    console.log('Ini pilihan ketujuh');
                break;
                }
            });
        });
        })(jQuery)
    </script>
    {{-- <script src="{!!asset('generalStyle/plugins/bootstrap-select-1.13.2/dist/js/bootstrap-select.min.js')!!}"></script>
    <script src="{!!asset('generalStyle/plugins/bootstrap-select-1.13.2/dist/js/bootstrap-select.js')!!}"></script> --}}
</body>
</html>