@extends('client.layouts.master')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<main class="bg-gray-100 min-h-screen flex justify-center">
    <div class="max-w-5xl w-full mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4 bg-white p-4 rounded-lg shadow-md text-center">
                <!-- Avatar -->
               <!-- Avatar -->
<div class="relative w-32 h-32 mx-auto mb-4">
    <div class="w-full h-full rounded-full border-4 border-gray-300 overflow-hidden">
        <img id="avatar-preview"
            src="{{ Auth::user()->avata ? asset('storage/' . Auth::user()->avata) : asset('default-avatar.png') }}" 
            class="w-full h-full object-cover">
    </div>

    <!-- Icon camera nằm ngoài hình ảnh -->
    <label for="avatar-upload" class="absolute -bottom-2 -right-2 bg-gray-700 text-white p-2 rounded-full cursor-pointer shadow-lg">
        <i class="fas fa-camera"></i>
    </label>
    <input type="file" id="avatar-upload" name="avata" class="hidden">
</div>


                <p class="text-lg font-semibold">{{ Auth::user()->name }}</p>

                <!-- Sidebar menu -->
                <div class="mb-4">
                    <button id="btn-info" class="sidebar-btn active">
                        <i class="fas fa-user mr-2"></i> Thông tin tài khoản
                    </button>
                </div>
                <div class="mb-4">
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
            <div class="w-full md:w-3/4 bg-white p-4 rounded-lg shadow-md ml-0 md:ml-4 mt-4 md:mt-0">
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Thông tin tài khoản -->
                <div id="info-display">
                    <h2 class="text-xl font-semibold mb-4">Thông tin tài khoản</h2>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p><strong>Họ và tên:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ Auth::user()->phone }}</p>
                        <button id="edit-info" class="mt-4 bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Chỉnh sửa thông tin
                        </button>
                        @if(in_array(Auth::user()->role, ['admin', 'moderator']))
                        <a href="{{ route('logad') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Đăng nhập Admin
                        </a>
                    @endif
                    </div>
                </div>

                <!-- Form cập nhật thông tin -->
                <div id="info-form" class="hidden">
                    <h2 class="text-xl font-semibold mb-4">Cập nhật thông tin</h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="bg-gray-100 p-4 rounded-lg">
                        @csrf
                        @method('PUT')
                    
                        <!-- Họ và tên -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Họ và tên:</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full p-2 border rounded">
                            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Email:</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full p-2 border rounded">
                            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    
                        <!-- Số điện thoại -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Số điện thoại:</label>
                            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full p-2 border rounded">
                            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    
                        <!-- Nút lưu -->
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Lưu thay đổi
                        </button>
                    </form>
                    
                    
                </div>

                <!-- Form cập nhật mật khẩu -->
                <div id="password-form" class="hidden">
                    <h2 class="text-xl font-semibold mb-4">Đổi mật khẩu</h2>
                    
                    <form action="{{ route('profile.updatePassword') }}" method="POST" class="bg-gray-100 p-4 rounded-lg">
                        @csrf
                
                        <!-- Mật khẩu hiện tại -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Mật khẩu hiện tại:</label>
                            <input type="password" name="current_password" class="w-full p-2 border rounded @error('current_password') border-red-500 @enderror">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <!-- Mật khẩu mới -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Mật khẩu mới:</label>
                            <input type="password" name="new_password" class="w-full p-2 border rounded @error('new_password') border-red-500 @enderror">
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <!-- Xác nhận mật khẩu mới -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Nhập lại mật khẩu mới:</label>
                            <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded">
                        </div>
                
                
                        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded hover:bg-orange-600">
                            Cập nhật mật khẩu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy trạng thái tab từ session
        let activeTab = "{{ session('tab', 'info') }}"; // Mặc định là 'info'
    
        function showTab(tab) {
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.add('hidden');
            document.getElementById('password-form').classList.add('hidden');
    
            if (tab === 'password') {
                document.getElementById('password-form').classList.remove('hidden');
            } else {
                document.getElementById('info-display').classList.remove('hidden');
            }
        }
    
        // Hiển thị tab từ session
        showTab(activeTab);
    
        document.getElementById('avatar-upload').addEventListener('change', function () {
            let formData = new FormData();
            formData.append('avata', this.files[0]);
    
            fetch("{{ route('profile.updateAvatar') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('avatar-preview').src = data.avatar;
                } else {
                    alert("Lỗi khi cập nhật avatar");
                }
            })
            .catch(error => console.error('Lỗi:', error));
        });
    
        document.getElementById('btn-info').addEventListener('click', function () {
            showTab('info');
        });
    
        document.getElementById('btn-password').addEventListener('click', function () {
            showTab('password');
        });
    
        document.getElementById('edit-info').addEventListener('click', function () {
            showTab('info');
            document.getElementById('info-display').classList.add('hidden');
            document.getElementById('info-form').classList.remove('hidden');
        });
    });
    </script>
    
@endsection
