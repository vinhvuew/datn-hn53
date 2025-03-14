<?php $__env->startSection('title'); ?>
    Chi tiết đơn hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">



        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Đơn hàng /</span> Chi tiết đơn hàng
        </h4>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

            <div class="d-flex flex-column justify-content-center">
                <h5 class="mb-1 mt-3">Order <?php echo e($order->id); ?>

                    <span class="badge bg-label-info">Sẵn sàng để nhận hàng</span>
                </h5>
                <p class="text-body">Ngày đặt hàng: <?php echo e(\Carbon\Carbon::parse($order->order_date)->format('d/m/Y')); ?></p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <button class="btn btn-label-danger delete-order">Hủy đơn hàng</button>
            </div>
        </div>

        <!-- Order Details Table -->

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Chi tiết đơn hàng</h5>
                        
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables-order-details table">
                            <thead>
                                <tr>
                                    <th class="col-2">ảnh</th>
                                    <th class="col-2">sản phẩm</th>
                                    <th class="col-2">biến thể</th>
                                    <th class="col-2">Số lượng</th>
                                    <th class="col-2">tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title m-0">Hoạt động vận chuyển</h5>
                    </div>
                    <div class="card-body">
                        <ul class="timeline pb-0 mb-0">
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Order was placed (Order ID: #32543)</h6>
                                        <span class="text-muted">Tuesday 11:29 AM</span>
                                    </div>
                                    <p class="mt-2">Your order has been placed successfully</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Pick-up</h6>
                                        <span class="text-muted">Wednesday 11:29 AM</span>
                                    </div>
                                    <p class="mt-2">Pick-up scheduled with courier</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Dispatched</h6>
                                        <span class="text-muted">Thursday 11:29 AM</span>
                                    </div>
                                    <p class="mt-2">Item has been picked up by courier</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Package arrived</h6>
                                        <span class="text-muted">Saturday 15:20 AM</span>
                                    </div>
                                    <p class="mt-2">Package arrived at an Amazon facility, NY</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-left-dashed">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-primary"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Dispatched for delivery</h6>
                                        <span class="text-muted">Today 14:12 PM</span>
                                    </div>
                                    <p class="mt-2">Package has left an Amazon facility, NY</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                                <span class="timeline-point-wrapper"><span
                                        class="timeline-point timeline-point-secondary"></span></span>
                                <div class="timeline-event pb-0">
                                    <div class="timeline-header">
                                        <h6 class="mb-0">Delivery</h6>
                                    </div>
                                    <p class="mt-2 mb-0">Package will be delivered by tomorrow</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title m-0">Chi tiết khách hàng</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <div class="avatar me-2">
                                <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html" class="text-body text-nowrap">
                                    <h6 class="mb-0">Shamus Tuttle</h6>
                                </a>
                                <small class="text-muted">Customer ID: #58909</small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <span
                                class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i
                                    class="bx bx-cart-alt bx-sm lh-sm"></i></span>
                            <h6 class="text-body text-nowrap mb-0">12 Orders</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Contact info</h6>
                            <h6><a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editUser">Edit</a>
                            </h6>
                        </div>
                        <p class=" mb-1">Email: Shamus889@yahoo.com</p>
                        <p class=" mb-0">Mobile: +1 (609) 972-22-22</p>
                    </div>
                </div>

                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between">
                        <h6 class="card-title m-0">Địa chỉ giao hàng</h6>
                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#addNewAddress">Edit</a></h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">45 Roker Terrace <br>Latheronwheel <br>KW5 8NW,London <br>UK</p>
                    </div>

                </div>
                
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit User Information</h3>
                            <p>Updating user details will receive a privacy audit.</p>
                        </div>
                        <form id="editUserForm" class="row g-3" onsubmit="return false">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                    class="form-control" placeholder="John" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                    class="form-control" placeholder="Doe" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalEditUserName">Username</label>
                                <input type="text" id="modalEditUserName" name="modalEditUserName"
                                    class="form-control" placeholder="john.doe.007" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserEmail">Email</label>
                                <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                    class="form-control" placeholder="example@domain.com" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserStatus">Status</label>
                                <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Suspended</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                    class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">+1</span>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                        class="form-control phone-number-mask" placeholder="202 555 0111" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLanguage">Language</label>
                                <select id="modalEditUserLanguage" name="modalEditUserLanguage"
                                    class="select2 form-select" multiple>
                                    <option value="">Select</option>
                                    <option value="english" selected>English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                    <option value="dutch">Dutch</option>
                                    <option value="hebrew">Hebrew</option>
                                    <option value="sanskrit">Sanskrit</option>
                                    <option value="hindi">Hindi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserCountry">Country</label>
                                <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="switch">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">Use as a billing address?</span>
                                </label>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- Add New Address Modal -->
        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="address-title">Add New Address</h3>
                            <p class="address-subtitle">Add new address for express delivery</p>
                        </div>
                        <form id="addNewAddressForm" class="row g-3" onsubmit="return false">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md mb-md-0 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="customRadioHome">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-home"></i>
                                                    <span class="custom-option-title">Home</span>
                                                    <small> Delivery time (9am – 9pm) </small>
                                                </span>
                                                <input name="customRadioIcon" class="form-check-input" type="radio"
                                                    value="" id="customRadioHome" checked />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-0 mb-3">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="customRadioOffice">
                                                <span class="custom-option-body">
                                                    <i class='bx bx-briefcase'></i>
                                                    <span class="custom-option-title"> Office </span>
                                                    <small> Delivery time (9am – 5pm) </small>
                                                </span>
                                                <input name="customRadioIcon" class="form-check-input" type="radio"
                                                    value="" id="customRadioOffice" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressFirstName">First Name</label>
                                <input type="text" id="modalAddressFirstName" name="modalAddressFirstName"
                                    class="form-control" placeholder="John" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLastName">Last Name</label>
                                <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                    class="form-control" placeholder="Doe" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddressCountry">Country</label>
                                <select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12 ">
                                <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                                <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                    class="form-control" placeholder="12, Business Park" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                                <input type="text" id="modalAddressAddress2" name="modalAddressAddress2"
                                    class="form-control" placeholder="Mall Road" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLandmark">Landmark</label>
                                <input type="text" id="modalAddressLandmark" name="modalAddressLandmark"
                                    class="form-control" placeholder="Nr. Hard Rock Cafe" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressCity">City</label>
                                <input type="text" id="modalAddressCity" name="modalAddressCity" class="form-control"
                                    placeholder="Los Angeles" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressLandmark">State</label>
                                <input type="text" id="modalAddressState" name="modalAddressState"
                                    class="form-control" placeholder="California" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                                <input type="text" id="modalAddressZipCode" name="modalAddressZipCode"
                                    class="form-control" placeholder="99950" />
                            </div>
                            <div class="col-12">
                                <label class="switch">
                                    <input type="checkbox" class="switch-input">
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">Use as a billing address?</span>
                                </label>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Address Modal -->



    </div>
    <!-- / Content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style-libs'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>