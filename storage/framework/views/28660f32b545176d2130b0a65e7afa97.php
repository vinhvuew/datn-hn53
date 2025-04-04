<?php $__env->startSection('content'); ?>
    <main>
        <div class="container">
            <h3>Hỗ trợ trực tiếp</h3>
            <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><strong><?php echo e($message->admin_id ? 'Admin' : 'Bạn'); ?>:</strong> <?php echo e($message->message); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <form id="chat-form">
                <?php echo csrf_field(); ?>
                <input type="text" id="message" name="message" class="form-control" placeholder="Nhập tin nhắn...">
                <button type="submit" class="btn btn-primary mt-2">Gửi</button>
            </form>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
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
                            body: JSON.stringify({
                                message: message
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                chatBox.innerHTML += `<p><strong>Bạn:</strong> ${data.message.message}</p>`;
                                chatBox.scrollTop = chatBox.scrollHeight;
                                input.value = ''; // Xóa input
                            }
                        })
                        .catch(error => console.error('Lỗi gửi tin nhắn:', error));
                });

                // Kiểm tra nếu Echo đã được load
                if (typeof Echo !== 'undefined') {
                    Echo.channel('chat.user.<?php echo e(Auth::id()); ?>')
                        .listen('MessageSent', (e) => {
                            if (!e.message.admin_id) return; // Chỉ hiển thị tin nhắn từ admin
                            chatBox.innerHTML += `<p><strong>Admin:</strong> ${e.message.message}</p>`;
                            chatBox.scrollTop = chatBox.scrollHeight;
                        });
                } else {
                    console.error('Laravel Echo chưa được định nghĩa. Kiểm tra lại file bootstrap.js!');
                }
            });
        </script>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/chat/index.blade.php ENDPATH**/ ?>