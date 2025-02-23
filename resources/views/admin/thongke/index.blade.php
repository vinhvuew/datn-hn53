@extends('admin.layouts.master')

@section('content')
    <div class="container my-4">
        <h1 class="text-center mb-4">📊 Thống Kê Doanh Thu</h1>

        <!-- Bộ lọc thời gian -->
        <div class="text-center mb-4">
            <label for="dateFilter" class="form-label">Chọn khoảng thời gian:</label>
            <input type="date" id="dateFilter" class="form-control mx-auto" style="max-width: 300px;">
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Bộ chọn bảng -->
        <div class="text-center mb-4">
            <select id="tableSelector" class="form-select w-50 mx-auto">
                <option value="doanhThuNgay">Doanh thu theo ngày</option>
                <option value="doanhThuTuan">Doanh thu theo tuần</option>
                <option value="doanhThuThang">Doanh thu theo tháng</option>
                <option value="doanhThuNam">Doanh thu theo năm</option>
            </select>
        </div>

        <div class="table-responsive my-3">
            <div id="doanhThuNgay" class="data-table">
                <h3 class="text-center text-white bg-success p-2 rounded">📅 Doanh thu theo ngày</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr><th>Ngày</th><th>Doanh thu (VNĐ)</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($doanhThuNgay as $item)
                            <tr><td>{{ $item->ngay }}</td><td>{{ number_format($item->doanh_thu) }} VNĐ</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="doanhThuTuan" class="data-table d-none">
                <h3 class="text-center text-white bg-info p-2 rounded">📆 Doanh thu theo tuần</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr><th>Tuần</th><th>Doanh thu (VNĐ)</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($doanhThuTuan as $item)
                            <tr><td>Tuần {{ $item->tuan }}</td><td>{{ number_format($item->doanh_thu) }} VNĐ</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="doanhThuThang" class="data-table d-none">
                <h3 class="text-center text-white bg-warning p-2 rounded">📅 Doanh thu theo tháng</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr><th>Tháng</th><th>Năm</th><th>Doanh thu (VNĐ)</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($doanhThuThang as $item)
                            <tr><td>{{ $item->thang }}</td><td>{{ $item->nam }}</td><td>{{ number_format($item->doanh_thu) }} VNĐ</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="doanhThuNam" class="data-table d-none">
                <h3 class="text-center text-white bg-danger p-2 rounded">📆 Doanh thu theo năm</h3>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-primary">
                        <tr><th>Năm</th><th>Doanh thu (VNĐ)</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($doanhThuNam as $item)
                            <tr><td>{{ $item->nam }}</td><td>{{ number_format($item->doanh_thu) }} VNĐ</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    
    <script>
        document.getElementById('tableSelector').addEventListener('change', function() {
            document.querySelectorAll('.data-table').forEach(table => table.classList.add('d-none'));
            document.getElementById(this.value).classList.remove('d-none');
        });

        document.getElementById('dateFilter').addEventListener('change', function() {
            let filterValue = this.value;
            document.querySelectorAll('.data-table:not(.d-none) tbody tr').forEach(row => {
                let dateCell = row.cells[0].innerText;
                if (dateCell.includes(filterValue) || filterValue === "") {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        $(document).ready(function () {
            $('table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copy', text: '📋 Sao chép', className: 'btn btn-primary my-3' },
                    { extend: 'excel', text: '📊 Excel', className: 'btn btn-info' },
                    { extend: 'pdf', text: '📜 PDF', className: 'btn btn-danger' },
                    { extend: 'print', text: '🖨️ In', className: 'btn btn-warning' }
                ],
                searching: false
            });
        });
    </script>
@endsection
