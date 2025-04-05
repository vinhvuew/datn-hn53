<?php $__env->startSection('content'); ?>
    <main>
        <div class="container py-4" style="max-width: 700px;">
            <h5 class="text-center fw-bold text-gradient mb-3">
                💬 Chat với <?php echo e($messages->first()->user->name ?? 'User ' . $user_id); ?>

            </h5>

            <div id="chat-box" class="p-3 rounded-4 shadow-sm"
                style="height: 400px; overflow-y: auto; background: #fcfbff; border: 1px solid #e0d7f7;">
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isAdmin = $message->admin_id ? true : false;
                        $name = $isAdmin ? 'Shop' : $message->user->name ?? 'User';
                        $initial = strtoupper(substr($name, 0, 1));
                    ?>
                    <div class="d-flex mb-2 <?php echo e($isAdmin ? 'justify-content-end' : 'justify-content-start'); ?>">
                        <div class="d-flex <?php echo e($isAdmin ? 'flex-row-reverse' : ''); ?> align-items-end gap-2">
                            <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold"
                                style="width: 36px; height: 36px; font-size: 0.85rem; background: <?php echo e($isAdmin ? '#42a5f5' : '#66bb6a'); ?>;">
                                <?php echo e($initial); ?>

                            </div>
                            <div class="px-3 py-2 rounded-4"
                                style="
                            background: <?php echo e($isAdmin ? '#e3f2fd' : '#e8f5e9'); ?>;
                            max-width: 70%;
                            font-size: 0.95rem;
                        ">
                                <div class="fw-semibold mb-1 <?php echo e($isAdmin ? 'text-primary' : 'text-success'); ?>">
                                    <?php echo e($name); ?>:
                                </div>
                                <div><?php echo e($message->message); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <form id="chat-form" class="mt-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>">
                <div class="input-group input-group-sm">
                    <input type="text" id="message" name="message"
                        class="form-control rounded-start-pill border-0 shadow-sm" placeholder="Nhập tin nhắn..."
                        style="font-size: 0.95rem;">
                    <button type="submit" class="btn btn-gradient rounded-end-pill text-white px-3 fw-bold"
                        style="font-size: 0.9rem;">Gửi</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="<?php echo e(route('admin.chat.index')); ?>"
                    class="btn btn-outline-secondary rounded-pill px-4 py-1 shadow-sm" style="font-size: 0.9rem;">⬅️ Quay
                    lại</a>
            </div>
        </div>

        <style>
            .btn-gradient {
                background: linear-gradient(135deg, #42a5f5, #7e57c2);
                border: none;
            }

            .btn-gradient:hover {
                background: linear-gradient(135deg, #64b5f6, #9575cd);
            }

            .text-gradient {
                background: linear-gradient(to right, #6a11cb, #2575fc);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>

        <script>
            const chatBox = document.getElementById('chat-box');
            const form = document.getElementById('chat-form');
            const input = document.getElementById('message');
            const userId = <?php echo e($user_id); ?>;

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = input.value.trim();
                if (!message) return;

                fetch("<?php echo e(route('admin.chat.send')); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                        },
                        body: JSON.stringify({
                            message: message,
                            user_id: userId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            chatBox.innerHTML += `
                        <div class="d-flex justify-content-end mb-2">
                            <div class="d-flex flex-row-reverse align-items-end gap-2">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold" style="width: 36px; height: 36px; background: #42a5f5;">A</div>
                                <div class="px-3 py-2 rounded-4" style="background: #e3f2fd; max-width: 70%; font-size: 0.95rem;">
                                    <div class="fw-semibold text-primary mb-1">Admin:</div>
                                    <div>${data.message.message}</div>
                                </div>
                            </div>
                        </div>`;
                            chatBox.scrollTop = chatBox.scrollHeight;
                            input.value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            Echo.channel('chat.admin')
                .listen('MessageSent', (e) => {
                    if (e.user_id == userId && !e.is_admin) {
                        chatBox.innerHTML += `
                        <div class="d-flex justify-content-start mb-2">
                            <div class="d-flex align-items-end gap-2">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold" style="width: 36px; height: 36px; background: #66bb6a;">U</div>
                                <div class="px-3 py-2 rounded-4" style="background: #e8f5e9; max-width: 70%; font-size: 0.95rem;">
                                    <div class="fw-semibold text-success mb-1">${e.name ?? 'User'}:</div>
                                    <div>${e.message}</div>
                                </div>
                            </div>
                        </div>`;
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                });
        </script>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/chat/show.blade.php ENDPATH**/ ?>