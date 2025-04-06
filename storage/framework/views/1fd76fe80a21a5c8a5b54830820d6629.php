<?php $__env->startSection('content'); ?>
    <main class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Chat</h5>
            </div>
            <div class="card-body p-3" style="background-color: #f8f9fa;">
                <div id="chat-box" class="mb-3 border rounded p-3 bg-white" style="height: 300px; overflow-y: auto;">

                    
                </div>

                <form id="chat-form" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="message" id="message" class="form-control"
                        placeholder="Nhập tin nhắn..." />
                    <input type="file" name="file" id="file" class="form-control" accept="image/*,video/*" />
                    <button type="submit" class="btn btn-success">Gửi</button>
                </form>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script-libs'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // ⚡ Hàm fetchMessages để load tin nhắn từ server về
        function fetchMessages() {
            $.get('/chat/messages', function(messages) {
                let html = '';

                messages.forEach(msg => {
                    html += `<div class="mb-2">`;

                    if (msg.message) {
                        html += `<p class="mb-1"><strong>Bạn:</strong> ${msg.message}</p>`;
                    }

                    // Nếu có đính kèm ảnh hoặc video
                    if (msg.attachment) {
                        let url = '/storage/chat/' + msg.attachment;

                        if (msg.attachment_type.startsWith('image/')) {
                            html +=
                                `<img src="${url}" class="img-fluid mb-2 rounded" style="max-width: 200px;" />`;
                        } else if (msg.attachment_type.startsWith('video/')) {
                            html += `
                            <video controls style="max-width: 200px;" class="mb-2">
                                <source src="${url}" type="${msg.attachment_type}">
                                Trình duyệt không hỗ trợ video.
                            </video>`;
                        }
                    }

                    html += `</div>`;
                });

                $('#chat-box').html(html);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight); // Auto scroll to bottom
            });
        }

        // 📤 Gửi tin nhắn + file qua Ajax
        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '/chat/send',
                type: 'POST',
                data: formData,
                processData: false, // Bắt buộc để gửi file
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        $('#message').val('');
                        $('#file').val('');
                        fetchMessages(); // Reload tin nhắn sau khi gửi
                    }
                }
            });
        });

        // 🔁 Tự động load tin nhắn mỗi 3 giây (mô phỏng real-time)
        setInterval(fetchMessages, 3000);
        fetchMessages(); // Gọi lần đầu
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/admin/chat/index.blade.php ENDPATH**/ ?>