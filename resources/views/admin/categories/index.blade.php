@extends('admin.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">eCommerce /</span> Category List
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
                        + Add Category
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
                                    <th>Category Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                        <td class="text-center" style="display:flex; margin-left:50px">
                                            <a href="{{ route('category.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="post"
                                                id="form-{{ $item->id }}" style="margin-left: 10px">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-id='{{ $item->id }}' id="submit-form">Delete</button>
                                            </form>
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

        <div class="buy-now">
            <a href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/" target="_blank"
                class="btn btn-danger btn-buy-now">Buy Now</a>
        </div>

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
