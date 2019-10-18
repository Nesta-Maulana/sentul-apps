@auth()
    @include('utilityOnline.operator_lite.layouts.navbars.navs.auth')
@endauth

@guest()
    @include('utilityOnline.operator_lite.layouts.navbars.navs.guest')
@endguest
