 <!-- ========== Left Sidebar Start ========== -->
 <div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png')}}" alt="logo" style="width:100%;height:100%;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo-sm.png')}}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="assets/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard')}}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('cities.index') }}"  class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Popular Cities </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('hotel.index') }}"  class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Hotels </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('rooms.index') }}"  class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Rooms </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('booking.index') }}"  class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Bookings </span>
                </a>
            </li>










        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
