

<?php $__env->startSection('content'); ?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<main class="bg-gray-100 min-h-screen flex justify-center">
    <div class="max-w-5xl w-full mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4 bg-white p-4 rounded-lg shadow-md text-center">
                <!-- Avatar -->
               <!-- Avatar -->
<div class="relative w-32 h-32 mx-auto mb-4">
    <div class="w-full h-full rounded-full border-4 border-gray-300 overflow-hidden">
        <img id="avatar-preview"
            src="<?php echo e(Auth::user()->avata ? asset('storage/' . Auth::user()->avata) : asset('default-avatar.png')); ?>" 
            class="w-full h-full object-cover">
    </div>

    <!-- Icon camera nằm ngoài hình ảnh -->
    <label for="avatar-upload" class="absolute -bottom-2 -right-2 bg-gray-700 text-white p-2 rounded-full cursor-pointer shadow-lg">
        <i class="fas fa-camera"></i>
    </label>
    <input type="file" id="avatar-upload" name="avata" class="hidden">
</div>


                <p class="text-lg font-semibold"><?php echo e(Auth::user()->name); ?></p>

                <!-- Sidebar menu -->
                <div class="mb-4">
                    <button id="btn-info" class="sidebar-btn active">
                        <i class="fas fa-user mr-2"></i> Thông tin tài khoản
                    </button>
                </div>
                <div class="mb-4">
                    <button id="btn-password" class="sidebar-btn">
                        <i class="fas fa-lock mr-2"></i> Thay đổi mật khẩu
                    </button>
                </div>
                <div class="mt-4">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-center p-3 text-red-600 border border-red-600 rounded-lg hover:bg-red-100">
                            Đăng Xuất
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4 bg-white p-4 rounded-lg shadow-md ml-0 md:ml-4 mt-4 md:mt-0">
                <?php if(session('success')): ?>
                    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <!-- Thông tin tài khoản -->
                <div id="info-display">
                    <h2 class="text-xl font-semibold mb-4">Thông tin tài khoản</h2>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p><strong>Họ và tên:</strong> <?php echo e(Auth::user()->name); ?></p>
                        <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>
                        <p><strong>Số điện thoại:</strong> <?php echo e(Auth::user()->phone); ?></p>
                        <button id="edit-info" class="mt-4 bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Chỉnh sửa thông tin
                        </button>
                        <?php if(in_array(Auth::user()->role, ['admin', 'moderator'])): ?>
                        <a href="<?php echo e(route('logad')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Đăng nhập Admin
                        </a>
                    <?php endif; ?>
                    </div>
                </div>

                <!-- Form cập nhật thông tin -->
                <div id="info-form" class="hidden">
                    <h2 class="text-xl font-semibold mb-4">Cập nhật thông tin</h2>
                    
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="bg-gray-100 p-4 rounded-lg">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                    
                        <!-- Họ và tên -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Họ và tên:</label>
                            <input type="text" name="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" class="w-full p-2 border rounded">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Email:</label>
                            <input type="email" name="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" class="w-full p-2 border rounded">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <!-- Số điện thoại -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Số điện thoại:</label>
                            <input type="text" name="phone" value="<?php echo e(old('phone', Auth::user()->phone)); ?>" class="w-full p-2 border rounded">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    
                        <!-- Nút lưu -->
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Lưu thay đổi
                        </button>
                    </form>
                    
                    
                </div>

                <!-- Form cập nhật mật khẩu -->
                <div id="password-form" class="hidden">
                    <h2 class="text-xl font-semibold mb-4">Đổi mật khẩu</h2>
                    
                    <form action="<?php echo e(route('profile.updatePassword')); ?>" method="POST" class="bg-gray-100 p-4 rounded-lg">
                        <?php echo csrf_field(); ?>
                
                        <!-- Mật khẩu hiện tại -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Mật khẩu hiện tại:</label>
                            <input type="password" name="current_password" class="w-full p-2 border rounded <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                
                        <!-- Mật khẩu mới -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Mật khẩu mới:</label>
                            <input type="password" name="new_password" class="w-full p-2 border rounded <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                
                        <!-- Xác nhận mật khẩu mới -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Nhập lại mật khẩu mới:</label>
                            <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded">
                        </div>
                
                
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Cập nhật mật khẩu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy trạng thái tab từ session
        let activeTab = "<?php echo e(session('tab', 'info')); ?>"; // Mặc định là 'info'
    
        function showTab(tab) {
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.add('hidden');
            document.getElementById('password-form').classList.add('hidden');
    
            if (tab === 'password') {
                document.getElementById('password-form').classList.remove('hidden');
            } else {
                document.getElementById('info-display').classList.remove('hidden');
            }
        }
    
        // Hiển thị tab từ session
        showTab(activeTab);
    
        document.getElementById('avatar-upload').addEventListener('change', function () {
            let formData = new FormData();
            formData.append('avata', this.files[0]);
    
            fetch("<?php echo e(route('profile.updateAvatar')); ?>", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('avatar-preview').src = data.avatar;
                } else {
                    alert("Lỗi khi cập nhật avatar");
                }
            })
            .catch(error => console.error('Lỗi:', error));
        });
    
        document.getElementById('btn-info').addEventListener('click', function () {
            showTab('info');
        });
    
        document.getElementById('btn-password').addEventListener('click', function () {
            showTab('password');
        });
    
        document.getElementById('edit-info').addEventListener('click', function () {
            showTab('info');
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.remove('hidden');
        });
    });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/users/profile.blade.php ENDPATH**/ ?>