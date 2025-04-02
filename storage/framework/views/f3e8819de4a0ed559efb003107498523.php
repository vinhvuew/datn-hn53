<?php $__env->startSection('content'); ?>
    <main>
        <?php if($carts): ?>
            <div class="container mt-4">
                <h2 class="text-center mb-4">🛒 Giỏ Hàng</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Chọn
                                
                            </th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <?php
                        $totalAmount = 0;
                    ?>

                    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cart->variant): ?>
                            <tbody id="cart-item-<?php echo e($cart->id); ?>">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-item-checkbox" data-id="<?php echo e($cart->id); ?>"
                                            data-price="<?php echo e($cart->total_amount); ?>" name="selected_items[]"
                                            value="<?php echo e($cart->id); ?>" <?php echo e($cart->is_selected ? 'checked' : ''); ?>>
                                    </td>
                                    <td><img src="<?php echo e(Storage::url($cart->variant->image)); ?>" alt="" width="50px"
                                            class="rounded-2"></td>
                                    <td><?php echo e(Str::limit($cart->variant->product->name, 30)); ?></td>
                                    <td>
                                        <?php if($cart->variant->product->price_sale): ?>
                                            <?php echo e(number_format($cart->variant->product->price_sale, 0, ',', '.')); ?> VNĐ
                                        <?php else: ?>
                                            <?php echo e(number_format($cart->variant->product->base_price, 0, ',', '.')); ?> VNĐ
                                        <?php endif; ?>
                                    </td>
                                    <td class="col-2">
                                        <form class="update-cart-form" data-cart-id="<?php echo e($cart->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="item-quantity d-flex align-items-center">
                                                <input type="number" name="quantity"
                                                    class="form-control quantity-input w-50" data-id="<?php echo e($cart->id); ?>"
                                                    value="<?php echo e($cart->quantity); ?>" min="1">
                                            </div>
                                        </form>
                                    </td>
                                    <td id="total-amount-<?php echo e($cart->id); ?>">
                                        <?php
                                            if ($cart->is_selected) {
                                                $money = $cart->total_amount;
                                                $totalAmount += $money;
                                            }
                                        ?>
                                        <?php echo e(number_format($cart->total_amount, 0, ',', '.')); ?> VNĐ

                                    </td>
                                    <td>
                                        <form class="delete-cart-form" data-id="<?php echo e($cart->id); ?>"
                                            action="<?php echo e(route('cart.delete', $cart->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        <?php elseif($cart->product): ?>
                            <tbody id="cart-item-<?php echo e($cart->id); ?>">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="cart-item-checkbox" data-id="<?php echo e($cart->id); ?>"
                                            data-price="<?php echo e($cart->total_amount); ?>" name="selected_items[]"
                                            value="<?php echo e($cart->id); ?>" <?php echo e($cart->is_selected ? 'checked' : ''); ?>>
                                    </td>

                                    <td><img src="<?php echo e(Storage::url($cart->product->img_thumbnail)); ?>" alt=""
                                            height="50px" width="40px">
                                    </td>
                                    <td><?php echo e(Str::limit($cart->product->name, 30)); ?> </td>
                                    <td>
                                        <?php if($cart->product->price_sale): ?>
                                            <?php echo e(number_format($cart->product->price_sale, 0, ',', '.')); ?> VNĐ
                                        <?php else: ?>
                                            <?php echo e(number_format($cart->product->base_price, 0, ',', '.')); ?> VNĐ
                                        <?php endif; ?>
                                    </td>
                                    <td class="col-2">
                                        <form class="update-cart-form" data-cart-id="<?php echo e($cart->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="item-quantity d-flex align-items-center">
                                                <input type="number" name="quantity"
                                                    class="form-control quantity-input w-50" data-id="<?php echo e($cart->id); ?>"
                                                    value="<?php echo e($cart->quantity); ?>" min="1">
                                            </div>

                                        </form>
                                    </td>
                                    <td id="total-amount-<?php echo e($cart->id); ?>">
                                        <?php
                                            if ($cart->is_selected) {
                                                $money = $cart->total_amount;
                                                $totalAmount += $money;
                                            }
                                        ?>

                                        <?php echo e(number_format($cart->total_amount, 0, ',', '.')); ?> VNĐ
                                    </td>
                                    <td>
                                        <form class="delete-cart-form" data-id="<?php echo e($cart->id); ?>"
                                            action="<?php echo e(route('cart.delete', $cart->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            </tbody>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <form id="checkout-form" action="<?php echo e(route('checkout.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="text-end mb-5 p-4">
                        <h4 class="fw-bold text-primary">
                            Tổng tiền: <span id="overall-total" class="text-danger">
                                <?php echo e(number_format($totalAmount, 0, ',', '.')); ?> VNĐ
                            </span>
                        </h4>
                        <button type="submit" class="btn btn-success btn-lg mt-2 px-4 fw-bold">
                            <i class="fas fa-shopping-cart"></i> Thanh toán
                        </button>
                    </div>
                </form>

            </div>
        <?php else: ?>
            <div class="empty-cart-box text-center" id="empty-cart" style=" margin-top: 140px;">
                <img class="mb-5" src="https://static-smember.cellphones.com.vn/smember/_nuxt/img/empty.db6deab.svg"
                    alt="Empty Cart" width="300px">
                <h4 class="text-secondary mt-5" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</h4>
                <p style="font-size: 14px; color: #888;">Giỏ hàng của bạn đang trống.
                    Hãy chọn thêm sản phẩm để mua sắm nhé</p>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-danger mb-5">
                    Quay Lại Trang Chủ
                </a>
            </div>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script-libs'); ?>
    <script>
        $(document).ready(function() {
            function updateOverallTotal() {
                let total = 0;
                $('.cart-item-checkbox:checked').each(function() {
                    let itemId = $(this).data('id');
                    let itemTotal = parseFloat($('#total-amount-' + itemId).text().replace(/[^\d]/g, ''));
                    total += itemTotal;
                });
                $('#overall-total').text(total.toLocaleString('vi-VN') + ' VNĐ');
            }

            // Cập nhật số lượng sản phẩm
            $('.quantity-input').on('input', function() {
                let id = $(this).data('id');
                let quantity = $(this).val();

                if (quantity < 1) {
                    alert('Số lượng không hợp lệ!');
                    return;
                }

                $.ajax({
                    url: '/cart/update/' + id,
                    type: 'PUT',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#total-amount-' + id).text(response.totalAmountFormatted);
                            updateOverallTotal();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            // Cập nhật tổng tiền khi chọn/bỏ chọn sản phẩm
            $('.cart-item-checkbox').on('change', function() {
                updateOverallTotal();
            });

            // Xử lý form thanh toán
            $('#checkout-form').on('submit', function(e) {
                e.preventDefault();

                let selectedItems = $('.cart-item-checkbox:checked');
                if (selectedItems.length === 0) {
                    alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
                    return;
                }

                // Cập nhật trạng thái chọn sản phẩm
                let updatePromises = selectedItems.map(function() {
                    let id = $(this).data('id');
                    return $.ajax({
                        url: '/cart/update-selection/' + id,
                        type: 'PUT',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            is_selected: 1
                        }
                    });
                });

                // Sau khi cập nhật xong, submit form
                Promise.all(updatePromises).then(function() {
                    e.target.submit();
                });
            });
        });

        // Xóa sản phẩm khỏi giỏ hàng
        $(document).ready(function() {
            $('.btn-delete').on('click', function() {
                let id = $(this).data('id');

                if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                    return;
                }

                $.ajax({
                    url: '/cart/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#cart-item-' + id).remove();
                            $('#overall-total').text(response.overallTotalFormatted);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectAllCheckbox = document.getElementById('select-all');
            let checkboxes = document.querySelectorAll('.cart-item-checkbox');
            let totalAmountSpan = document.getElementById('overall-total');
            let checkoutForm = document.getElementById('checkout-form'); // Form thanh toán

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.cart-item-checkbox:checked').forEach(function(checkedBox) {
                    total += parseFloat(checkedBox.dataset.price);
                });
                totalAmountSpan.textContent = total.toLocaleString('vi-VN') + ' VNĐ';
            }

            // Sự kiện khi chọn/bỏ chọn tất cả
            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateTotal();
            });

            // Sự kiện khi chọn từng sản phẩm
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (!checkbox.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        let allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                    updateTotal();
                });
            });

            // Kiểm tra trước khi submit form
            checkoutForm.addEventListener('submit', function(event) {
                let selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');

                if (selectedItems.length === 0) {
                    event.preventDefault(); // Ngăn form submit
                    alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán!");
                }
            });
        });
    </script>
    <script>
        $('.cart-item-checkbox').on('change', function() {
            let id = $(this).data('id');
            let isSelected = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/cart/update-selection/' + id,
                type: 'PUT',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    is_selected: isSelected
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.message);
                        $('#overall-total').text(response.overallTotalFormatted);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra! Vui lòng thử lại.');
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/cart/listCart.blade.php ENDPATH**/ ?>