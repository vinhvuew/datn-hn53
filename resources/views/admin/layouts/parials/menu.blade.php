<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" height="150px" width="250px" alt="">
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item @yield('item-dashboards')">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Dashboards">
                    Dashboards
                </div>
                <span class="badge badge-center rounded-pill bg-danger ms-auto">5</span>
            </a>
        </li>
        <li class="menu-item @yield('item-order')">
            <a href="{{ route('orders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div class="text-truncate" data-i18n="Đơn hàng">
                    Đơn hàng
                </div>
            </a>
        </li>
        {{-- danh mục --}}
        <li class="menu-item @yield('item-category')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-folder-open"></i>
                <div class="text-truncate" data-i18n="Danh Mục">Danh Mục</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item @yield('item-category-create')">
                    <a href="{{ route('category.create') }}" class="menu-link">

                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới`
                        </div>
                    </a>
                </li>

                <li class="menu-item @yield('item-category-index')">
                    <a href="{{ route('category.index') }}" class="menu-link">

                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- thương hiệu --}}
        <li class="menu-item @yield('item-brand')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div class="text-truncate" data-i18n="Thương thiệu">Thương hiệu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('item-brand-create')">
                    <a href="{{ route('brands.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới
                        </div>
                    </a>
                </li>
                <li class="menu-item @yield('item-brand-index')">
                    <a href="{{ route('brands.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- sản phẩm --}}
        <li class="menu-item @yield('item-product')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Sản phẩm">Sản phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('item-product-create')">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm sản phẩm">Thêm sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item @yield('item-product-index')">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh sách sản phẩm">Danh sách sản phẩm</div>
                    </a>
                </li>

            </ul>
        </li>
        {{-- thuộc tính --}}
        <li class="menu-item  @yield('item-atribute')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Thuộc tính">Thuộc tính</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('item-atribute-add')">
                    <a href="{{ route('attributes.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm thuộc tính">Thêm thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item @yield('item-atribute-index')">
                    <a href="{{ route('attributes.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh sách thuộc tính">Danh sách thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item @yield('item-atribute-value')">
                    <a href="{{ route('attribute-values.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Giá trị thuộc tính">Giá trị thuộc tính</div>
                    </a>
                </li>

            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div class="text-truncate" data-i18n="Voucher">
                    Voucher
                </div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('vouchers.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="danh sach">
                            Danh sách
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('vouchers.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="them">
                            Thêm
                        </div>
                    </a>
                </li>
            </ul>

        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh Sách Tài Khoản">Danh Sách Tài Khoản</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="{{ route('comment.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chart"></i>
                <div class="text-truncate" data-i18n="Bình luận">Bình luận</div>
            </a>
        </li>


        <li class="menu-item">
            <a href="{{ route('thongke.statistical') }}" class="menu-link">
                <i class=" menu-icon fa-sharp fa-solid fa-chart-simple"></i>
                <div class="text-truncate" data-i18n="Thống Kê">Thống Kê</div>
            </a>
        </li>





        <li class="menu-item">
            <a href="{{ route('news.index') }}" class="menu-link">
                <i class="menu-icon fa-regular fa-newspaper"></i>
                {{-- <i class=" menu-icon fa-sharp fa-solid fa-chart-simple"></i> --}}
                <div class="text-truncate" data-i18n="Tin Tức">Tin Tức</div>
            </a>
        </li>


        <li class="menu-item">
            <a href="{{ route('admin.chat.index') }}" class="menu-link">
                <i class="menu-icon fa-regular fa-newspaper"></i>
                {{-- <i class=" menu-icon fa-sharp fa-solid fa-chart-simple"></i> --}}
                <div class="text-truncate" data-i18n="chat">chat</div>
            </a>
        </li>




    </ul>
</aside>
