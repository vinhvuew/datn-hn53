<?php $__env->startSection('content'); ?>
  <main>
    <div class="container">
        <h3>Hỗ trợ trực tiếp</h3>
        <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><strong><?php echo e($message->is_admin ? 'Admin' : 'Bạn'); ?>:</strong> <?php echo e($message->message); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <form id="chat-form">
            <?php echo csrf_field(); ?>
            <input type="text" id="message" name="message" class="form-control" placeholder="Nhập tin nhắn...">
            <button type="submit" class="btn btn-primary mt-2">Gửi</button>
        </form>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message').value;

            fetch("<?php echo e(route('chat.send')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ message: message })
            }).then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        });
    </script>
  </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn-hn53\resources\views/client/chat/index.blade.php ENDPATH**/ ?>