@push('headerFiles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 450px;
        }
        .ck-content .image {
            max-width: 80%;
            margin: 20px auto;
        }
        .ck.ck-voice-label {
            display: none !important;
        }
        .widget.box .widget-header {
            border-bottom: 1px solid #e0e6ed;
        }

        .flatpickr-calendar .flatpickr-monthDropdown-months {
            display: inline-block;
            width: auto;
        }
        .flatpickr-calendar .flatpickr-current-month {
            display: flex;
            justify-content: space-between;
        }
        .flatpickr-calendar {
            z-index: 1050 !important;
        }
        .dropdown.show .flatpickr-calendar {
            position: absolute;
            top: 100%;
        }
    </style>
@endpush

<div class="form-group mb-4">
    @if($label)
        <label for="{{ $id }}">{{ $label }}@if($isRequired) <strong class="text-danger">*</strong> @endif</label>
    @endif
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control"
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    >
        {{ old($oldName ?: $name, $value) }}
    </textarea>
    @error($oldName ?: $name)
    <span class="invalid-feedback" style="display:block" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('footerFiles')
    <script src="{{ asset('plugins/editors/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#{{ $id }}'), {
            simpleUpload: {
                uploadUrl: '{{ route('admin.editor_upload', ['_token' => csrf_token()]) }}'
            },
        })
        @if (isset($isEdit) && !$isEdit)
        .then(editor => {
            editor.enableReadOnlyMode('');
        })
        @endif
        .catch(error => {
            Snackbar.show({
                text: error.message,
                textColor: '#fbeced',
                backgroundColor: '#e7515a',
                actionText: '{{ __('Bỏ qua') }}',
                actionTextColor: '#3b3f5c',
            });
            console.error(error);
        });
    </script>
@endpush
