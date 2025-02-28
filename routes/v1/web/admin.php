<?php

use App\Acl\Acl;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    include 'admin/auth.php';

    Route::middleware(['auth.admin', 'active', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF])->group(function () {
        include 'admin/dashboard.php';
        include 'admin/setting.php';
        include 'admin/role.php';
        include 'admin/user.php';
    });
});
