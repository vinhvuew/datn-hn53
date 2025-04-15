<?php $__env->startSection('title'); ?>
    Trò Chuyện
<?php $__env->stopSection(); ?>
<?php $__env->startSection('menu-item-chat', 'active'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-chat card overflow-hidden">
            <div class="row g-0">
                <!-- Sidebar Left -->
                <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                    <div
                        class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                        <div class="avatar avatar-xl avatar-online w-px-75 h-px-75">
                            <img src="<?php echo e(asset('admin')); ?>/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                        </div>
                        <h5 class="mt-3 mb-1">John Doe</h5>
                        <span>UI/UX Designer</span>
                        <i class="mdi mdi-close mdi-20px cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay
                            data-target="#app-chat-sidebar-left"></i>
                    </div>
                    <div class="sidebar-body px-4 pb-4">
                        <div class="my-4 pt-2">
                            <label for="chat-sidebar-left-user-about" class="text-uppercase text-muted">About</label>
                            <textarea id="chat-sidebar-left-user-about" class="form-control chat-sidebar-left-user-about mt-2" rows="3"
                                maxlength="120">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</textarea>
                        </div>
                        <div class="my-4">
                            <p class="text-uppercase text-muted">Status</p>
                            <div class="d-grid gap-2">
                                <div class="form-check form-check-success">
                                    <input name="chat-user-status" class="form-check-input" type="radio" value="active"
                                        id="user-active" checked>
                                    <label class="form-check-label" for="user-active">Active</label>
                                </div>
                                <div class="form-check form-check-warning">
                                    <input name="chat-user-status" class="form-check-input" type="radio" value="away"
                                        id="user-away">
                                    <label class="form-check-label" for="user-away">Away</label>
                                </div>
                                <div class="form-check form-check-danger">
                                    <input name="chat-user-status" class="form-check-input" type="radio" value="busy"
                                        id="user-busy">
                                    <label class="form-check-label" for="user-busy">Do not Disturb</label>
                                </div>
                                <div class="form-check form-check-secondary">
                                    <input name="chat-user-status" class="form-check-input" type="radio" value="offline"
                                        id="user-offline">
                                    <label class="form-check-label" for="user-offline">Offline</label>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <p class="text-uppercase text-muted mb-2">Settings</p>
                            <ul class="list-unstyled d-grid gap-3 ms-2">
                                <li>
                                    <i class="mdi mdi-check-circle-outline me-1"></i>
                                    <span class="align-middle">Two-step Verification</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-bell-outline me-1"></i>
                                    <span class="align-middle">Notification</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-account-outline me-1"></i>
                                    <span class="align-middle">Invite Friends</span>
                                </li>
                                <li>
                                    <i class="mdi mdi-delete-outline me-1"></i>
                                    <span class="align-middle">Delete Account</span>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex mt-4">
                            <button class="btn btn-primary" data-bs-toggle="sidebar" data-overlay
                                data-target="#app-chat-sidebar-left">Logout</button>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar Left-->

                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                    id="app-chat-contacts">
                    <div class="sidebar-header py-3 px-4 border-bottom">
                        <div class="d-flex align-items-center me-3 me-lg-0">
                            <div class="flex-shrink-0 avatar avatar-online me-3" data-bs-toggle="sidebar"
                                data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                <img class="user-avatar rounded-circle cursor-pointer"
                                    src="<?php echo e(asset('admin')); ?>/assets/img/avatars/1.png" alt="Avatar">
                            </div>
                            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                <span class="input-group-text" id="basic-addon-search31"><i
                                        class="mdi mdi-magnify lh-1"></i></span>
                                <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                    aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <i class="mdi mdi-close mdi-20px cursor-pointer position-absolute top-0 end-0 mt-2 me-2 fs-4 d-lg-none d-block"
                            data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                    </div>
                    <div class="sidebar-body">

                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title">
                                <h5 class="text-primary mb-0">Trò Chuyện</h5>
                            </li>
                            <li class="chat-contact-list-item chat-list-item-0 d-none">
                                <h6 class="text-muted mb-0">No Chats Found</h6>
                            </li>
                            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="chat-contact-list-item">
                                    <a href="<?php echo e(route('chat.admin', ['roomId' => $item->id, 'receiverId' => Auth::user()->id])); ?>"
                                        class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar <?php echo e($item->is_active ? ' avatar-online' : ''); ?>">
                                            <?php if($room->user->avatar): ?>
                                                <img src="<?php echo e(Storage::url($room->user->avatar)); ?>"
                                                    alt="<?php echo e($room->user->name); ?>" class="rounded-circle">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('admin/image/logo.jpg')); ?>"
                                                    alt="<?php echo e($room->user->name); ?>" class="rounded-circle">
                                            <?php endif; ?>
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-3">
                                            <div class=" justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate fw-normal m-0">
                                                    <?php echo e($item->user->name); ?>

                                                </h6>
                                                <?php if($item->messages->isNotEmpty()): ?>
                                                    <p class="chat-contact-status text-truncate mb-0 text-muted">
                                                        <?php echo e($item->messages->first()->created_at); ?>

                                                    </p>
                                                <?php else: ?>
                                                    <p class="chat-contact-status text-truncate mb-0 text-muted">Null</p>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
                <!-- /Chat -->
                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <i class="mdi mdi-menu mdi-24px cursor-pointer d-lg-none d-block me-3"
                                        data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                    <div class="flex-shrink-0 avatar<?php echo e($room->is_active ? ' avatar-online' : ''); ?>">
                                        <img src="<?php echo e(asset('admin')); ?>/assets/img/avatars/4.png" alt="Avatar"
                                            class="rounded-circle" data-bs-toggle="sidebar" data-overlay
                                            data-target="#app-chat-sidebar-right">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="m-0 fw-normal"><?php echo e($room->user->name); ?></h6>
                                        <span class="user-status text-muted" id="user-status">Đang kiểm tra...</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i
                                        class="mdi mdi-phone-outline mdi-24px cursor-pointer d-sm-block d-none btn btn-text-secondary btn-icon rounded-pill"></i>
                                    <i
                                        class="mdi mdi-video-outline mdi-24px cursor-pointer d-sm-block d-none btn btn-text-secondary btn-icon rounded-pill"></i>
                                    <i
                                        class="mdi mdi-magnify mdi-24px cursor-pointer d-sm-block d-none btn btn-text-secondary btn-icon rounded-pill"></i>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="true" id="chat-header-actions"><i
                                                class="mdi mdi-dots-vertical mdi-24px"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="chat-header-actions">
                                            <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history-body" id="message-box">

                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2): ?>
                                    <?php if(Auth::user()->id === $item->sender_id): ?>
                                        <div class="message sent">
                                            <strong>Bạn: </strong><?php echo e($item->message); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="message received">
                                            <strong>Khách hàng: </strong><?php echo e($item->message); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(Auth::user()->role_id == 3): ?>
                                    <?php if(Auth::user()->id === $item->sender_id): ?>
                                        <div class="message sent">
                                            <strong>Bạn: </strong><?php echo e($item->message); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="message received">
                                            <strong>Quản trị viên: </strong><?php echo e($item->message); ?>

                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- Chat message form -->
                        <div class="chat-history-footer mt-3">
                            <form class="form-send-message d-flex justify-content-between align-items-center ">
                                <input class="form-control message-input me-3 shadow-none" id="message-input"
                                    placeholder="Nhập tin nhắn ...">

                                <div class="message-actions d-flex align-items-center">
                                    <i
                                        class="btn btn-text-secondary btn-icon rounded-pill speech-to-text mdi mdi-microphone mdi-20px cursor-pointer text-heading"></i>
                                    <label for="attach-doc" class="form-label mb-0">
                                        <i
                                            class="mdi mdi-paperclip mdi-20px cursor-pointer btn btn-text-secondary btn-icon rounded-pill me-2 ms-1 text-heading"></i>
                                        <input type="file" id="attach-doc" hidden>
                                    </label>
                                    <button id="send-message-btn" class="btn btn-primary d-flex send-msg-btn">
                                        <span class="align-middles">Gửi</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Chat History -->

                <!-- Sidebar Right -->
                <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                    <div
                        class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                        <div class="avatar avatar-xl avatar-online w-px-75 h-px-75">
                            <img src="<?php echo e(asset('admin')); ?>/assets/img/avatars/4.png" alt="Avatar"
                                class="rounded-circle">
                        </div>
                        <h5 class="mt-3 mb-1">Felecia Rower</h5>
                        <span>NextJS Developer</span>
                        <i class="mdi mdi-close mdi-20px cursor-pointer close-sidebar d-block" data-bs-toggle="sidebar"
                            data-overlay data-target="#app-chat-sidebar-right"></i>
                    </div>
                    <div class="sidebar-body px-4">
                        <div class="my-4 pt-2">
                            <p class="text-uppercase mb-2 text-muted">About</p>
                            <p class="mb-0">A Next. js developer is a software developer who uses the Next. js framework
                                alongside ReactJS to build web applications.</p>
                        </div>
                        <div class="my-4 py-1">
                            <p class="text-uppercase mb-2 text-muted">Personal Information</p>
                            <ul class="list-unstyled d-grid gap-3 mb-0 ms-2">
                                <li class="d-flex align-items-center">
                                    <i class='mdi mdi-email-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">josephGreen@email.com</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class='mdi mdi-phone mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">+1(123) 456 - 7890</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class='mdi mdi-clock-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Mon - Fri 10AM - 8PM</span>
                                </li>
                            </ul>
                        </div>
                        <div class="my-4">
                            <p class="text-uppercase text-muted mb-2">Options</p>
                            <ul class="list-unstyled d-grid gap-3 ms-2">
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='mdi mdi-bookmark-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Add Tag</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='mdi mdi-star-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Important Contact</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='mdi mdi-image-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Shared Media</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='mdi mdi-delete-outline mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Delete Contact</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='mdi mdi-block-helper mdi-20px'></i>
                                    <span class="align-middle ms-2 ps-1">Block Contact</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar Right -->

                <div class="app-overlay"></div>
            </div>
        </div>


    </div>
    <!-- / Content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style-libs'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/chat.css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin')); ?>/assets/vendor/css/pages/app-chat.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <script>
        let userId = <?php echo e(auth()->id()); ?>;
        let receiverId = <?php echo e($receiverId); ?>;
        let roomId = <?php echo e($roomId); ?>;
        let roleId = <?php echo e(auth()->user()->role_id); ?>;
    </script>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/present.js'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/list.js'); ?>

    <script src="<?php echo e(asset('admin')); ?>/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <!-- Page JS -->
    <script src="<?php echo e(asset('admin')); ?>/assets/js/app-chat.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/admin/chat/room-admin.blade.php ENDPATH**/ ?>