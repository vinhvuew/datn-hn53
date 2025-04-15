@extends('client.layouts.master')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold text-uppercase">Chính Sách Của Chúng Tôi</h1>
                <p class="text-muted">Tôn trọng khách hàng – Tận tâm phục vụ</p>
            </div>

            {{-- Chính sách đổi trả --}}
            <div class="mb-5">
                <h2 class="text-primary mb-3">1. Chính Sách Đổi Trả</h2>
                <p>Chúng tôi cam kết mang đến sự hài lòng cho khách hàng khi mua sắm tại cửa hàng. Nếu sản phẩm gặp vấn đề,
                    bạn có thể đổi trả theo các điều kiện sau:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Sản phẩm còn nguyên vẹn, chưa qua sử dụng, không bị hư hỏng.</li>
                    <li class="list-group-item">✅ Đổi trả trong vòng <strong>3 ngày</strong> kể từ ngày nhận hàng.</li>
                    <li class="list-group-item">✅ Có hóa đơn hoặc bằng chứng mua hàng (video, ảnh).</li>
                    <li class="list-group-item">❌ Không hỗ trợ đổi trả với sản phẩm đã qua sử dụng, hư hỏng do khách hàng,
                        đặt nhầm size nhưng không liên hệ trước khi giao.</li>
                    <li class="list-group-item">💸 Khách hàng chịu phí vận chuyển đổi trả (trừ khi lỗi do cửa hàng).</li>
                </ul>
            </div>

            {{-- Chính sách vận chuyển --}}
            <div class="mb-5">
                <h2 class="text-primary mb-3">2. Chính Sách Vận Chuyển</h2>
                <p><strong>⏱ Thời gian giao hàng:</strong></p>
                <ul>
                    <li>🚚 <strong>Nội thành:</strong> 1–3 ngày làm việc</li>
                    <li>🚚 <strong>Ngoại thành & tỉnh thành khác:</strong> 3–7 ngày làm việc</li>
                </ul>

                <p><strong>💵 Phí vận chuyển:</strong></p>
                <ul>
                    <li>📦 <strong>Miễn phí vận chuyển</strong> áp dụng cho toàn bộ đơn hàng</li>
                </ul>
            </div>

            {{-- Chính sách bảo mật --}}
            <div class="mb-5">
                <h2 class="text-primary mb-3">3. Chính Sách Bảo Mật</h2>
                <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của khách hàng:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">🔒 Thông tin của bạn chỉ được sử dụng để xử lý đơn hàng, chăm sóc khách hàng
                        và <strong>không chia sẻ với bên thứ ba</strong>.</li>
                    <li class="list-group-item">🔐 Mọi giao dịch thanh toán trực tuyến đều được <strong>bảo mật tuyệt
                            đối</strong>.</li>
                </ul>
            </div>

            <div class="text-center">
                <p class="text-muted">Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ: <strong>[hotline/email]</strong></p>
            </div>
        </div>
    </main>
@endsection
