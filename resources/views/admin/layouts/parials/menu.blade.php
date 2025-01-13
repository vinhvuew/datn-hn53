<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" height="150px" width="250px" alt="">
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Dashboards">
                    Dashboards
                </div>
                <span class="badge badge-center rounded-pill bg-danger ms-auto">5</span>
            </a>
        </li>


        <!-- e-commerce-app menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-folder-open"></i>
                <div class="text-truncate" data-i18n="Danh Mục">Danh Mục</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới`
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- e-commerce-app menu end -->
        <!-- Academy menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div class="text-truncate" data-i18n="Thương thiệu">thương hiệu</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="text-truncate" data-i18n="Thêm Mới">
                            Thêm Mới
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="text-truncate" data-i18n="Danh Sách">
                            Danh Sách
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Academy menu end -->

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div class="text-truncate" data-i18n="Sản phẩm">Sản phẩm</div>

            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-invoice-list.html" class="menu-link">
                        <div class="text-truncate" data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-preview.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Preview">Preview</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-edit.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Edit">Edit</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-add.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Add">Add</div>
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
                    <a href="extended-ui-drag-and-drop.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Drag & Drop">
                            Drag &amp; Drop
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-media-player.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Media Player">
                            Media Player
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Perfect Scrollbar">
                            Perfect Scrollbar
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-star-ratings.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Star Ratings">
                            Star Ratings
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-sweetalert2.html" class="menu-link">
                        <div class="text-truncate" data-i18n="SweetAlert2">
                            SweetAlert2
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-text-divider.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Text Divider">
                            Text Divider
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('orders') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div class="text-truncate" data-i18n="Đơn hàng">
                    Đơn hàng
                </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-user-list.html" class="menu-link">
                        <div class="text-truncate" data-i18n="List">List</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div class="text-truncate" data-i18n="View">View</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-user-view-account.html" class="menu-link">
                                <div class="text-truncate" data-i18n="Account">
                                    Account
                                </div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-security.html" class="menu-link">
                                <div class="text-truncate" data-i18n="Security">
                                    Security
                                </div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-billing.html" class="menu-link">
                                <div class="text-truncate" data-i18n="Billing & Plans">
                                    Billing & Plans
                                </div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-notifications.html" class="menu-link">
                                <div class="text-truncate" data-i18n="Notifications">
                                    Notifications
                                </div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-connections.html" class="menu-link">
                                <div class="text-truncate" data-i18n="Connections">
                                    Connections
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chart"></i>
                <div class="text-truncate" data-i18n="Bình luận">Bình luận</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="charts-apex.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Apex Charts">
                            Apex Charts
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="charts-chartjs.html" class="menu-link">
                        <div class="text-truncate" data-i18n="ChartJS">ChartJS</div>
                    </a>
                </li>
            </ul>
        </li>

</aside>
