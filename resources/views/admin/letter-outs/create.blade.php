@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.letter-out.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.letter-outs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="code">{{ trans('cruds.letter-out.fields.code') }}</label>
                    <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                        id="code" value="{{ old('code', '') }}" required>
                    @if ($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="receiver">{{ trans('cruds.letter-out.fields.receiver') }}</label>
                    <input class="form-control {{ $errors->has('receiver') ? 'is-invalid' : '' }}" type="text" name="receiver"
                        id="receiver" value="{{ old('receiver', '') }}" required>
                    @if ($errors->has('receiver'))
                        <span class="text-danger">{{ $errors->first('receiver') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.receiver_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="regarding">{{ trans('cruds.letter-out.fields.regarding') }}</label>
                    <input class="form-control {{ $errors->has('regarding') ? 'is-invalid' : '' }}" type="text" name="regarding"
                        id="regarding" value="{{ old('regarding', '') }}" required>
                    @if ($errors->has('regarding'))
                        <span class="text-danger">{{ $errors->first('regarding') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.regarding_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sended_at">{{ trans('cruds.letter-out.fields.sended_at') }}</label>
                    <input class="form-control date {{ $errors->has('sended_at') ? 'is-invalid' : '' }}" type="text"
                        name="sended_at" id="sended_at" value="{{ old('sended_at') }}" required>
                    @if ($errors->has('sended_at'))
                        <span class="text-danger">{{ $errors->first('sended_at') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.sended_at') }}</span>
                </div>
                <div class="form-group">
                    <label for="file">{{ trans('cruds.letter-out.fields.file') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                    </div>
                    @if ($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.file_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="servicer_id">{{ trans('cruds.letter-out.fields.servicer') }}</label>
                    <select class="form-control select2 {{ $errors->has('servicer') ? 'is-invalid' : '' }}"
                        name="servicer_id" id="servicer_id" required>
                        @foreach ($servicers as $id => $entry)
                            <option value="{{ $id }}" {{ old('servicer_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('servicer'))
                        <span class="text-danger">{{ $errors->first('servicer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-out.fields.servicer_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.fileDropzone = {
            url: '{{ route('admin.letter-outs.storeMedia') }}',
            maxFilesize: 20, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 20
            },
            success: function(file, response) {
                $('form').find('input[name="file"]').remove()
                $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($letter) && $letter->file)
                    var file = {!! json_encode($letter->file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
