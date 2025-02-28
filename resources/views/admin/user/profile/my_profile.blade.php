<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ __('general.common.profile') }}
    </x-slot:pageTitle>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        {{-- @vite(['resources/scss/light/assets/components/timeline.scss']) --}}
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/tomSelect/tom-select.default.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/flatpickr/flatpickr.css')}}">

        @vite([
            'resources/scss/light/plugins/tomSelect/custom-tomSelect.scss',
            'resources/scss/dark/plugins/tomSelect/custom-tomSelect.scss',

            'resources/scss/light/plugins/filepond/custom-filepond.scss',
            'resources/scss/dark/plugins/filepond/custom-filepond.scss',

            'resources/scss/light/assets/components/tabs.scss',
            'resources/scss/light/assets/components/list-group.scss',
            'resources/scss/dark/assets/components/tabs.scss',
            'resources/scss/dark/assets/components/list-group.scss',

            'resources/scss/light/assets/elements/alert.scss',
            'resources/scss/dark/assets/elements/alert.scss',

            'resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss',
            'resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss',

            'resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss',
            'resources/scss/dark/plugins/notification/snackbar/custom-snackbar.scss',

            'resources/scss/light/assets/forms/switches.scss',
            'resources/scss/dark/assets/forms/switches.scss',

            'resources/scss/light/assets/users/account-setting.scss',
            'resources/scss/dark/assets/users/account-setting.scss',
        ])

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot:headerFiles>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <x-custom.breadcrumb
        :breadcrumb-items="[__('Người dùng') => '', __('general.common.profile') => '']"
    />
    <!-- /BREADCRUMB -->

    <div class="layout-top-spacing">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 @class(['text-capitalize'])>{{ __('general.common.profile') }}</h2>
            </div>
        </div>
    </div>

    <div class="account-settings-container">
        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-home-tab"
                                    data-bs-toggle="tab" href="#animated-underline-home" role="tab"
                                    aria-controls="animated-underline-home" aria-selected="true" name="home">
                                <i data-feather="home"></i>
                                {{ __('general.common.profile') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-password-tab" data-bs-toggle="tab"
                                    href="#animated-underline-password" role="tab"
                                    aria-controls="animated-underline-password" aria-selected="false"
                                    tabindex="-1" name="password">
                                <i data-feather="lock"></i>
                                {{ __('general.common.password_reset') }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
                     aria-labelledby="animated-underline-home-tab" name="home">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">{{ __('general.common.information') }}</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <x-form.form-layout
                                                    :custom-col="'col-lg-12'"
                                                    :form-id="'general-settings'"
                                                    :form-method="'PUT'"
                                                    :form-url="route('admin.user.update_profile')"
                                                    :enctype="'multipart/form-data'"
                                                >

                                                <div class="info">
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                                    <div class="profile-image  mt-4 pe-md-4">
                                                                        <div class="img-uploader-content">
                                                                            <x-form.form-upload
                                                                                :id="'sAvatar'"
                                                                                :name="'user_avatar'"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                    <div class="form">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <x-form.form-input
                                                                                :id="'last_name'"
                                                                                :isRequired="'true'"
                                                                                :label="__('general.common.last_name')"
                                                                                :name="'last_name'"
                                                                                :placeholder="__('general.common.last_name')"
                                                                                :value="auth()->user()->userProfile->last_name"
                                                                            />
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <x-form.form-input
                                                                                    :id="'first_name'"
                                                                                    :isRequired="'true'"
                                                                                    :label="__('general.common.first_name')"
                                                                                    :name="'first_name'"
                                                                                    :placeholder="__('general.common.first_name')"
                                                                                    :value="auth()->user()->userProfile->first_name"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <x-form.form-input
                                                                                    :id="'email'"
                                                                                    :label="__('general.common.email')"
                                                                                    :name="'email'"
                                                                                    :placeholder="__('general.common.email')"
                                                                                    :value="auth()->user()->email"
                                                                                    :readonly="true"
                                                                                />
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <x-form.form-input
                                                                                    :id="'phone_number'"
                                                                                    :label="__('general.common.phone')"
                                                                                    :isRequired="true"
                                                                                    :name="'phone_number'"
                                                                                    :placeholder="__('general.common.phone')"
                                                                                    :value="auth()->user()->userProfile->phone_number"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <x-form.form-date-picker
                                                                                    id="date_of_birth"
                                                                                    label="{{ __('Ngày tháng năm sinh') }}"
                                                                                    name="date_of_birth"
                                                                                    placeholder="{{ __('Ngày tháng năm sinh') }}"
                                                                                    :value="auth()->user()->userProfile->date_of_birth"
                                                                                    :isRequired="true"
                                                                                />
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <x-form.form-select
                                                                                    :id="'sGendersSelect'"
                                                                                    :label="__('Giới tính')"
                                                                                    :name="'gender'"
                                                                                    :data-values="App\Enum\Gender::options(true)"
                                                                                    :select-value-attribute="'value'"
                                                                                    :select-value-label="'value'"
                                                                                    :multiple="false"
                                                                                    :placeholder="__('Giới tính')"
                                                                                    :values="auth()->user()->userProfile->gender?->value"
                                                                                    :isRequired="'true'"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <x-form.form-input
                                                                                    :id="'address'"
                                                                                    :label="'Địa chỉ'"
                                                                                    :name="'address'"
                                                                                    :placeholder="'Địa chỉ'"
                                                                                    :value="auth()->user()->userProfile->address"
                                                                                    :isRequired="true"
                                                                                />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 mt-1">
                                                                            <div class="form-group text-end">
                                                                                <x-buttons.submit :label="__('general.common.save')"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-form.form-layout>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-password" role="tabpanel"
                    aria-labelledby="animated-underline-password-tab" name="password">
                     <x-custom.stat-box :custom-col="'col-lg-12'" :id="'user-management'">
                        <x-slot:boxTitle>
                            {{ __('general.common.password_reset') }}
                        </x-slot:boxTitle>
                        <x-form.form-layout
                          :form-id="'general-settings'"
                          :form-method="'PUT'"
                          :form-url="route('admin.user.update_password')"
                        >
                            <div class="info">
                                <x-form.form-input
                                    :id="'current_password'"
                                    :isRequired="true"
                                    :label="__('general.common.current_password')"
                                    :name="'current_password'"
                                    :placeholder="__('general.common.current_password')"
                                    :type="'password'"
                                />
                                <x-form.form-input
                                    :id="'password'"
                                    :isRequired="true"
                                    :label="__('general.common.password')"
                                    :name="'password'"
                                    :placeholder="__('general.common.password')"
                                    :type="'password'"
                                />
                                <x-form.form-input
                                    :id="'password_confirmation'"
                                    :isRequired="true"
                                    :label="__('general.common.password_confirmation')"
                                    :name="'password_confirmation'"
                                    :placeholder="__('general.common.password_confirmation')"
                                    :type="'password'"
                                />
                                <x-buttons.submit :label="__('general.common.complete')" />
                            </div>
                        </x-form.form-layout>
                    </x-custom.stat-box>
                </div>
            </div>
        </div>
    </div>

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
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
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
                document.querySelector('#sAvatar'), {
                    acceptedFileTypes: ['image/*'],
                    labelFileTypeNotAllowed: 'sai định dạng',
                    fileValidateTypeLabelExpectedTypes: 'phải là hình ảnh',
                    maxFileSize: '5MB',
                    stylePanelLayout: 'compact circle',
                    labelMaxFileSizeExceeded: 'Tệp quá lớn',
                    labelMaxFileSize: 'Kích thước ảnh tối đa 5MB',
                    labelIdle: 'Kéo & thả hoặc <span class="filepond--label-action">chọn từ thiết bị</span>',
                }
            );

            @if (auth()->user()->avatar_url)
                userAvatar.addFile(
                    '{{ auth()->user()->avatar_url }}'
                );
            @endif

            $(function() {
                let searchParams = new URLSearchParams(window.location.search);
                let tab = searchParams.get('tab');

                if (tab === 'password') {
                    $('#animated-underline-password-tab').tab(
                        'show', );
                }
                $('#animated-underline-home-tab').on('show.bs.tab',
                    function() {

                        appendAvatar();

                    });

                $('#animated-underline-password-tab').on(
                    'show.bs.tab',
                    function() {
                        let currentUrl = new URL(window.location);
                        currentUrl.searchParams.set('tab',
                            'password');
                        window.history.pushState({}, '', currentUrl);
                    }).on('hide.bs.tab', function() {
                    let currentUrl = new URL(window.location);
                    currentUrl.searchParams.delete('tab');
                    window.history.pushState({}, '', currentUrl);
                });

                appendAvatar();

                function appendAvatar() {
                    @if (auth()->user()->avatar_url)
                        userAvatar.addFile(
                            '{{ auth()->user()->avatar_url }}'
                        );
                    @endif
                }
            });
        </script>
    </x-slot:footerFiles>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
