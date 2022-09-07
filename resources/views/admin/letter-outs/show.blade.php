@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.letter-out.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.letter-outs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.id') }}
                            </th>
                            <td>
                                {{ $letterOut->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.code') }}
                            </th>
                            <td>
                                {{ $letterOut->code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.receiver') }}
                            </th>
                            <td>
                                {{ $letterOut->receiver }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.regarding') }}
                            </th>
                            <td>
                                {{ $letterOut->regarding }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.sended_at') }}
                            </th>
                            <td>
                                {{ $letterOut->sended_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.file') }}
                            </th>
                            <td>
                                @if ($letterOut->file)
                                    <a href="{{ $letterOut->file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-out.fields.servicer') }}
                            </th>
                            <td>
                                {{ $letterOut->servicer->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.letter-outs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
