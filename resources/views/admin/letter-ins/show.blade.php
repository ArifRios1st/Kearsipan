@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.letter-in.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.letter-ins.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.id') }}
                            </th>
                            <td>
                                {{ $letterIn->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.code') }}
                            </th>
                            <td>
                                {{ $letterIn->code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.sender') }}
                            </th>
                            <td>
                                {{ $letterIn->sender }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.regarding') }}
                            </th>
                            <td>
                                {{ $letterIn->regarding }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.received_at') }}
                            </th>
                            <td>
                                {{ $letterIn->received_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.date') }}
                            </th>
                            <td>
                                {{ $letterIn->date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.disposition') }}
                            </th>
                            <td>
                                {{ $letterIn->disposition }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.file') }}
                            </th>
                            <td>
                                @if ($letterIn->file)
                                    <a href="{{ $letterIn->file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.letter-in.fields.servicer') }}
                            </th>
                            <td>
                                {{ $letterIn->servicer->name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.letter-ins.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
