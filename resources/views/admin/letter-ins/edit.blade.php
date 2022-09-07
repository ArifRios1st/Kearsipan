@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.letter-in.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.letter-ins.update', $letterIn->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="code">{{ trans('cruds.letter-in.fields.code') }}</label>
                    <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                        id="code" value="{{ old('code', $letterIn->code) }}" required>
                    @if ($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sender">{{ trans('cruds.letter-in.fields.sender') }}</label>
                    <input class="form-control {{ $errors->has('sender') ? 'is-invalid' : '' }}" type="text" name="sender"
                        id="sender" value="{{ old('sender', $letterIn->sender) }}" required>
                    @if ($errors->has('sender'))
                        <span class="text-danger">{{ $errors->first('sender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.sender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="regarding">{{ trans('cruds.letter-in.fields.regarding') }}</label>
                    <input class="form-control {{ $errors->has('regarding') ? 'is-invalid' : '' }}" type="text" name="regarding"
                        id="regarding" value="{{ old('regarding', $letterIn->regarding) }}" required>
                    @if ($errors->has('regarding'))
                        <span class="text-danger">{{ $errors->first('regarding') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.regarding_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="received_at">{{ trans('cruds.letter-in.fields.received_at') }}</label>
                    <input class="form-control date {{ $errors->has('received_at') ? 'is-invalid' : '' }}" type="text"
                        name="received_at" id="received_at" value="{{ old('received_at', $letterIn->received_at) }}" required>
                    @if ($errors->has('received_at'))
                        <span class="text-danger">{{ $errors->first('received_at') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.received_at') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="date">{{ trans('cruds.letter-in.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text"
                        name="date" id="date" value="{{ old('date', $letterIn->date) }}" required>
                    @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.date') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="disposition">{{ trans('cruds.letter-in.fields.disposition') }}</label>
                    <input class="form-control {{ $errors->has('disposition') ? 'is-invalid' : '' }}" type="text" name="disposition"
                        id="disposition" value="{{ old('disposition', $letterIn->disposition) }}" required>
                    @if ($errors->has('disposition'))
                        <span class="text-danger">{{ $errors->first('disposition') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.disposition_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="file">{{ trans('cruds.letter-in.fields.file') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                    </div>
                    @if ($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.file_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="servicer_id">{{ trans('cruds.letter-in.fields.servicer') }}</label>
                    <select class="form-control select2 {{ $errors->has('servicer') ? 'is-invalid' : '' }}"
                        name="servicer_id" id="servicer_id" required>
                        @foreach ($servicers as $id => $entry)
                            <option value="{{ $id }}" {{ old('servicer_id', $letterIn->servicer->id) == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('servicer'))
                        <span class="text-danger">{{ $errors->first('servicer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.letter-in.fields.servicer_helper') }}</span>
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
            url: '{{ route('admin.letter-ins.storeMedia') }}',
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
