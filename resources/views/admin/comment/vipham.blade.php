@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Các Nội Dung Vi Phạm Cộng Đồng Và Cách Xử Lý</h2>
        
        <div class="list-group">
            <div class="list-group-item list-group-item-action">
                <h5>1. Ngôn từ thô tục, xúc phạm:</h5>
                <p><strong>Ví dụ:</strong> Các bình luận chứa từ ngữ thô tục, xúc phạm hoặc ngôn ngữ bạo lực.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Sử dụng bộ lọc từ ngữ (Bad Words Filter) để phát hiện và ngăn chặn các bình luận này.</li>
                    <li>Xử lý mạnh tay với người vi phạm (cảnh cáo hoặc cấm tài khoản).</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>2. Quảng cáo hoặc spam:</h5>
                <p><strong>Ví dụ:</strong> Bình luận quảng cáo sản phẩm hoặc dịch vụ không liên quan, hoặc spam liên kết đến các trang web khác.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Cảnh báo người dùng và xóa các bình luận spam.</li>
                    <li>Có thể chặn tài khoản của người đăng bình luận spam để ngăn ngừa vi phạm tiếp theo.</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>3. Thông tin sai sự thật:</h5>
                <p><strong>Ví dụ:</strong> Bình luận đưa ra thông tin sai lệch về sản phẩm, dịch vụ hoặc công ty với mục đích gây hiểu lầm hoặc lừa đảo.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Cảnh báo người dùng nếu phát hiện bình luận sai sự thật và yêu cầu chỉnh sửa hoặc xóa bình luận.</li>
                    <li>Đảm bảo cung cấp thông tin chính xác về sản phẩm để tránh bị hiểu nhầm.</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>4. Nội dung phân biệt chủng tộc, giới tính hoặc phân biệt đối xử:</h5>
                <p><strong>Ví dụ:</strong> Bình luận mang tính chất phân biệt chủng tộc, giới tính, hoặc xúc phạm các nhóm cộng đồng khác nhau.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Đưa ra các quy định rõ ràng trong điều khoản sử dụng và cộng đồng.</li>
                    <li>Áp dụng chế tài mạnh như cấm vĩnh viễn tài khoản nếu phát hiện vi phạm nghiêm trọng.</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>5. Nội dung phản ánh hành vi phạm pháp:</h5>
                <p><strong>Ví dụ:</strong> Bình luận khuyến khích hành vi phạm pháp, như việc mua bán hàng giả, hàng cấm, hoặc các sản phẩm không hợp pháp.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Xóa bình luận và báo cáo với cơ quan chức năng nếu cần thiết.</li>
                    <li>Cấm tài khoản nếu có hành vi vi phạm pháp luật nghiêm trọng.</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>6. Lăng mạ cá nhân hoặc tổ chức:</h5>
                <p><strong>Ví dụ:</strong> Bình luận xúc phạm nhân viên, khách hàng khác hoặc doanh nghiệp.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Cảnh báo người dùng và yêu cầu chỉnh sửa bình luận.</li>
                    <li>Chặn tài khoản nếu lặp lại hành vi này.</li>
                </ul>
            </div>

            <div class="list-group-item list-group-item-action">
                <h5>7. Khuyến khích hoặc liên kết đến hành vi xấu:</h5>
                <p><strong>Ví dụ:</strong> Các bình luận khuyến khích hành vi như trộm cắp, lừa đảo, hoặc các hành động gây hại cho người khác.</p>
                <p><strong>Cách xử lý:</strong></p>
                <ul>
                    <li>Xóa ngay lập tức và áp dụng các biện pháp xử phạt tài khoản.</li>
                </ul>
            </div>
        </div>

       
        <div class="text-center mt-4">
            <a href="{{ route('comment.index') }}" class="btn btn-primary">Quay lại Trang Danh Sách</a>
        </div>
    </div>
@endsection

@section('style-libs')
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('script-libs')
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
