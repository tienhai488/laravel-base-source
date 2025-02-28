<?php

use App\Acl\Acl;

return [
    'Vai trò' => [
        Acl::PERMISSION_ASSIGNEE,
        Acl::PERMISSION_ROLE_LIST,
        Acl::PERMISSION_ROLE_ADD,
        Acl::PERMISSION_ROLE_EDIT,
        Acl::PERMISSION_ROLE_DELETE,
    ],
    'Người dùng' => [
        Acl::PERMISSION_USER_LIST,
        Acl::PERMISSION_USER_ADD,
        Acl::PERMISSION_USER_EDIT,
        Acl::PERMISSION_USER_DELETE,
    ],
    'Cài đặt' => [
        Acl::PERMISSION_EDIT_GENERAL_SETTING,
    ],
];
