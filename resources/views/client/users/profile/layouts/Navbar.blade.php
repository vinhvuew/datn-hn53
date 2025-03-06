<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item">
                <a class="nav-link @yield('info')" href="javascript:void(0);">
                    <i class='mdi mdi-account-outline me-1 mdi-20px'>
                    </i>Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('order')" href="pages-profile-teams.html">
                    <i class='mdi mdi mdi-cart-check mdi-20px me-1'>
                    </i>Đơn hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @yield('History')" href="pages-profile-projects.html">
                    <i class='mdi mdi-history me-1 mdi-20px'>
                    </i>Lịch sử</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages-profile-connections.html">
                    <i class='mdi mdi-logout me-1 mdi-20px'>
                    </i>Đăng xuất</a>
            </li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->
