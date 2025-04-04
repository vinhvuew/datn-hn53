<?php $__env->startSection('content'); ?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Hỗ trợ trực tiếp</h3>
                    </div>
                    <div class="card-body" id="chat-box" style="height: 400px; overflow-y: scroll; padding: 10px;">
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php echo e($message->admin_id ? 'text-left' : 'text-right'); ?>">
                                <strong><?php echo e($message->admin_id ? 'Admin' : 'Bạn'); ?>:</strong>
                                <?php echo e($message->message); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="card-footer">
                        <form id="chat-form" class="d-flex">
                            <?php echo csrf_field(); ?>
                            <input type="text" id="message" name="message" class="form-control mr-2" placeholder="Nhập tin nhắn..." required>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return; // Không gửi nếu input rỗng

            fetch("<?php echo e(route('chat.send')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Thêm tin nhắn vào chat-box ngay lập tức
                    chatBox.innerHTML += `<div class="text-right"><strong>Bạn:</strong> ${data.message.message}</div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                    input.value = ''; // Xóa input
                }
            })
            .catch(error => console.error('Error:', error)); // Log lỗi nếu có
        });

        // Lắng nghe tin nhắn từ admin
        Echo.channel('chat.user.' + <?php echo e(Auth::id()); ?>)
            .listen('MessageSent', (e) => {
                if (!e.is_admin) return; // Chỉ hiển thị tin nhắn từ admin
                chatBox.innerHTML += `<div class="text-left"><strong>Admin:</strong> ${e.message}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    </script>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/chat/index.blade.php ENDPATH**/ ?>