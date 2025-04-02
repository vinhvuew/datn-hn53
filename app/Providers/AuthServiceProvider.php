<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::define('modules', function ($user, $permissionName) {
            // $user: đại diện cho đối tượng đang login hiện tại
            // $permissionName: Đại diện cho tên quyền cần kiểm tra

            // Nếu người dùng có vai trò admin, cho phép tất cả quyền
            if ($user->role->name === 'Admin') {
                return true;
            }

            // Kiểm tra các quyền của vai trò người dùng
            $permission = $user->role->permissions;

            // Kiểm tra các quyền có chứa slug xem có phù hợp với tên quyền yêu cầu không
            return $permission->contains('slug', $permissionName);
        });
    }
}
