@extends('layouts.admin')
@section('content')
    @can('letter_in_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.letter-ins.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.letter-in.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.letter-in.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-LetterIn">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.code') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.sender') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.regarding') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.received_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.disposition') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.file') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-in.fields.servicer') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letterIns as $key => $letter)
                            <tr data-entry-id="{{ $letter->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $letter->id ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->code ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->sender ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->regarding ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->received_at ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->date ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->disposition ?? '' }}
                                </td>
                                <td>
                                    @if ($letter->file)
                                        <a href="{{ $letter->file->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $letter->servicer->name ?? '' }}
                                </td>
                                <td>
                                    @can('letter_in_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.letter-ins.show', $letter->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('letter_in_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.letter-ins.edit', $letter->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('letter_in_delete')
                                        <form action="{{ route('admin.letter-ins.destroy', $letter->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('letter_in_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.letter-ins.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'asc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-LetterIn:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
