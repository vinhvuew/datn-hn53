@extends('client.layouts.master')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<style>
    .sidebar-btn {
        @apply w-full text-left flex items-center p-3 text-gray-700 bg-gray-200 border border-gray-300 rounded-lg transition duration-200;
    }
    .sidebar-btn:hover {
        @apply bg-gray-300;
    }
    .sidebar-btn.active {
        @apply bg-orange-600 text-white border-orange-700 font-semibold shadow-md;
    }
    .content-box {
        @apply bg-white p-6 border border-gray-300 rounded-lg shadow-md;
    }
    .admin-btn {
        @apply bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700;
    }
</style>

<main class="bg-gray-100 min-h-screen flex justify-center">
    <div class="max-w-5xl w-full mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4 bg-white p-4 border border-gray-300 rounded-lg shadow-md">
                <!-- Avatar -->
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <div class="w-full h-full rounded-full border-4 border-gray-400 overflow-hidden">
                        <img id="avatar-preview"
                            src="{{ Auth::user()->avata ? asset('storage/' . Auth::user()->avata) : asset('default-avatar.png') }}" 
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <p class="text-lg font-semibold text-center">{{ Auth::user()->name }}</p>
                
                <!-- Menu Sidebar -->
                <div class="mt-4">
                    <button id="btn-info" class="sidebar-btn active">
                        <i class="fas fa-user mr-2"></i> Thông tin tài khoản
                    </button>
                </div>
                <div class="mt-4">
                    <button id="btn-password" class="sidebar-btn">
                        <i class="fas fa-lock mr-2"></i> Thay đổi mật khẩu
                    </button>
                </div>
                <div class="mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center p-3 text-red-600 border border-red-600 rounded-lg hover:bg-red-100">
                            Đăng Xuất
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full md:w-3/4 md:ml-4 mt-4 md:mt-0">
                <!-- Thông tin tài khoản -->
                <div id="info-display" class="content-box">
                    <h2 class="text-xl font-semibold mb-4">Thông tin tài khoản</h2>
                    <div class="bg-gray-100 p-4 rounded-lg border border-gray-300">
                        <p><strong>Họ và tên:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ Auth::user()->phone }}</p>
                        
                        <div class="flex space-x-2 mt-4">
                            <button id="edit-info" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                                Chỉnh sửa thông tin
                            </button>
                          
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'moderator')
                                <a href="{{ route('admin.dashboard') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 admin-btn">
                                    Đăng nhập Admin
                                </a>
                            
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form cập nhật thông tin (Ẩn mặc định) -->
                <div id="info-form" class="hidden content-box">
                    <h2 class="text-xl font-semibold mb-4">Cập nhật thông tin</h2>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Họ và tên:</label>
                            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email:</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Số điện thoại:</label>
                            <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded-lg hover:bg-orange-600">
                            Lưu thay đổi
                        </button>
                    </form>
                </div>

                <!-- Form đổi mật khẩu (Ẩn mặc định) -->
                <div id="password-form" class="hidden content-box">
                    <h2 class="text-xl font-semibold mb-4">Thay đổi mật khẩu</h2>
                    <form action="{{ route('profile.updatePassword') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700">Mật khẩu hiện tại:</label>
                            <input type="password" id="current_password" name="current_password" required class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="new_password" class="block text-gray-700">Mật khẩu mới:</label>
                            <input type="password" id="new_password" name="new_password" required class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="block text-gray-700">Xác nhận mật khẩu mới:</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded-lg hover:bg-orange-600">
                            Đổi mật khẩu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let buttons = document.querySelectorAll('.sidebar-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        document.getElementById('edit-info').addEventListener('click', function() {
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.remove('hidden');
            document.getElementById('password-form').classList.add('hidden');
        });

        document.getElementById('btn-info').addEventListener('click', function() {
            document.getElementById('info-display').classList.remove('hidden');
            document.getElementById('info-form').classList.add('hidden');
            document.getElementById('password-form').classList.add('hidden');
        });

        document.getElementById('btn-password').addEventListener('click', function() {
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.add('hidden');
            document.getElementById('password-form').classList.remove('hidden');
        });
    });
</script>

@endsection
