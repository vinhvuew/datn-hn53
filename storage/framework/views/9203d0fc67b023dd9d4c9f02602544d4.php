<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <i class="bx bx-search bx-sm"></i>
                    <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online d-flex align-items-center justify-content-center">
                        <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt
                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" />
                    </div>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" >
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online d-flex align-items-center justify-content-center">
                                        <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt
                                            class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block"><?php echo e(Auth::user()->name); ?></span>
                                    <small class="text-muted"><?php echo e(Auth::user()->role); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt me-1 text-center"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/layouts/parials/navBar.blade.php ENDPATH**/ ?>