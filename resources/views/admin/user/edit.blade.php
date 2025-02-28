<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ __('Chỉnh sửa') }}
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/tomSelect/tom-select.default.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/flatpickr/flatpickr.css')}}">

        @vite([
            'resources/scss/light/plugins/tomSelect/custom-tomSelect.scss',
            'resources/scss/dark/plugins/tomSelect/custom-tomSelect.scss',

            'resources/scss/light/plugins/filepond/custom-filepond.scss',
            'resources/scss/dark/plugins/filepond/custom-filepond.scss',
        ])
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <x-custom.breadcrumb
        :breadcrumb-items="[
            'Người dùng' => '',
            'Danh sách người dùng' => route('admin.user.index'),
            'Chỉnh sửa người dùng' => ''
        ]"/>

    <x-custom.stat-box :id="'role-management'" :custom-col="'col-lg-12'">
        <x-slot:boxTitle>
            {{ __('Chỉnh sửa người dùng') }}
        </x-slot:boxTitle>

        <x-form.form-layout
            :form-id="'general-settings'"
            :form-url="route('admin.user.update', $user)"
            :form-method="'PUT'"
        >
            <x-form.form-upload
                :label="'Ảnh đại diện'"
                :id="'sAvatar'"
                :name="'user_avatar'"
            />
            <x-form.form-input
                :id="'name'"
                :label="'Họ tên người dùng'"
                :name="'name'"
                :placeholder="'Nhập họ tên người dùng'"
                :value="$user->name"
                :readonly="true"
            />
            <x-form.form-input
                :id="'first_name'"
                :label="'Tên người dùng'"
                :name="'first_name'"
                :placeholder="'Nhập tên người dùng'"
                :value="$userProfile->first_name"
                :isRequired="true"
            />
            <x-form.form-input
                :id="'last_name'"
                :label="'Họ người dùng'"
                :name="'last_name'"
                :placeholder="'Nhập họ người dùng'"
                :value="$userProfile->last_name"
                :isRequired="true"
            />
            <x-form.form-input
                :id="'email'"
                :label="'Email'"
                :name="'email'"
                :placeholder="'Nhập Email người dùng'"
                :value="$user->email"
                :readonly="true"
            />
            <x-form.form-select
                :id="'sStatusSelect'"
                :label="'Trạng thái hoạt động'"
                :data-values="App\Enum\UserStatus::options(true)"
                :name="'status'"
                :select-value-attribute="'value'"
                :select-value-label="'label'"
                :placeholder="__('Trạng thái hoạt động')"
                :values="$user->status->value"
                :isRequired="true"
            />
            <x-form.form-input
                :id="'phone_number'"
                :label="'Số điện thoại'"
                :name="'phone_number'"
                :placeholder="'Nhập số điện thoại'"
                :value="$userProfile->phone_number"
                :isRequired="true"
            />
            <x-form.form-date-picker
                id="date_of_birth"
                label="{{ __('Ngày tháng năm sinh') }}"
                name="date_of_birth"
                placeholder="{{ __('Ngày tháng năm sinh') }}"
                :value="$userProfile->date_of_birth"
                :isRequired="true"
            />
            <x-form.form-select
                :id="'sGendersSelect'"
                :label="__('Giới tính')"
                :name="'gender'"
                :data-values="App\Enum\Gender::options(true)"
                :select-value-attribute="'value'"
                :select-value-label="'value'"
                :multiple="false"
                :placeholder="__('Giới tính')"
                :values="$userProfile->gender?->value"
                :isRequired="'true'"
            />
            <x-form.form-input
                :id="'password'"
                :label="'Mật khẩu (Nếu không thay đổi mật khẩu thì để trống)'"
                :name="'password'"
                :placeholder="'Mật khẩu'"
                :type="'password'"
            />
            <x-form.form-input
                :id="'password_confirmation'"
                :label="'Xác nhận mật khẩu (Nếu không thay đổi mật khẩu thì để trống)'"
                :name="'password_confirmation'"
                :placeholder="'Xác nhận mật khẩu'"
                :type="'password'"
            />
            <x-form.form-select
                :id="'sRoleSelect'"
                :label="'Vai trò trong hệ thống'"
                :data-values="$roles"
                :name="'roles'"
                :multiple="true"
                :placeholder="__('Chọn vai trò')"
                :values="$userRoles"
                :isRequired="true"
            />
            <x-form.form-input
                :id="'address'"
                :label="'Địa chỉ'"
                :name="'address'"
                :placeholder="'Địa chỉ'"
                :value="$userProfile->address"
                :isRequired="true"
            />
            <x-buttons.submit :label="__('Hoàn tất')"/>
        </x-form.form-layout>
    </x-custom.stat-box>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/tomSelect/tom-select.base.js')}}"></script>
        <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
        <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/l10n/vn.js') }}"></script>

        <script>
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginImageTransform,
                FilePondPluginFileEncode,
                FilePondPluginFileValidateType
            );
            const userAvatar = FilePond.create(
                document.querySelector('#sAvatar'),
                {
                    acceptedFileTypes: ['image/*'],
                    labelFileTypeNotAllowed: 'sai định dạng',
                    fileValidateTypeLabelExpectedTypes: 'phải là hình ảnh',
                    maxFileSize: '5MB',
                    labelMaxFileSizeExceeded: 'Tệp quá lớn',
                    labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
                    labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
                }
            );

            @if($user->avatar_url)
                userAvatar.addFile('{{ $user->avatar_url }}');
            @endif
        </script>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
