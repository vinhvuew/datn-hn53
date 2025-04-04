<?php $__env->startSection('content'); ?>

<main>
    <div class="container py-5">
        <h3 class="text-center mb-4" style="font-weight: 700; color: #2c3e50;">Hỗ trợ trực tiếp</h3>

        <div id="chat-box" class="bg-light p-4 rounded-3 shadow-lg" style="height: 500px; overflow-y: scroll; border: 1px solid #ddd; transition: all 0.3s ease;">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: <?php echo e($message->admin_id ? '#e6f7ff' : '#f1f8e9'); ?>;">
                    <div>
                        <strong class="<?php echo e($message->admin_id ? 'text-primary' : 'text-success'); ?> font-weight-bold">
                            <?php echo e($message->admin_id ? 'Admin' : 'Bạn'); ?>:
                        </strong>
                        <span><?php echo e($message->message); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <form id="chat-form" class="mt-4">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <input type="text" id="message" name="message" class="form-control rounded-pill border-0" placeholder="Nhập tin nhắn..." aria-label="Tin nhắn">
                <button type="submit" class="btn btn-primary rounded-pill ml-2 px-4" style="transition: all 0.3s ease;">Gửi</button>
            </div>
        </form>
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
                    chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: #e6f7ff;">
                                            <div><strong class="text-primary font-weight-bold">Bạn:</strong> ${data.message.message}</div>
                                        </div>`;
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
                chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: #f1f8e9;">
                                        <div><strong class="text-success font-weight-bold">Admin:</strong> ${e.message}</div>
                                      </div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    </script>

</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/chat/index.blade.php ENDPATH**/ ?>