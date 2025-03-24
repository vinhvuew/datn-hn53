@extends('admin.layouts.master')
@section('item-category', 'open')
@section('item-category-index', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">

                <span class="text-muted fw-light">Danh mục /</span> Danh sách danh mục

            </h4>

            <div class="app-ecommerce-category">
                <!-- Search Bar and Add Category Button in a Single Row -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Search Bar -->
                    <div style="width: 25%;" class="me-2">
                        <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." />
                    </div>
                    <!-- Add Category Button -->
                    <a href="{{ route('category.create') }}" class="btn btn-primary">

                        + Thêm mới danh mục

                    </a>
                </div>

                @if (session('categorySuccess'))
                    <div class="alert alert-success">
                        {{ session('categorySuccess') }}
                    </div>
                @endif

                <!-- Category List Table -->
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="datatables-category-list table border-top" id="tableData">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Tên danh mục</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">

                                            <span class="badge bg-success">Kích hoạt</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('category.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">Chỉnh sửa</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <div class="content-backdrop fade"></div>



    </div>
    <script>
        const btn = document.querySelectorAll('#submit-form');
        for (const iterator of btn) {
            iterator.addEventListener('click', () => {
                let id = iterator.dataset.id;
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector(`#form-${id}`).submit();
                    }
                });
            })
        }
    </script>
@endsection
