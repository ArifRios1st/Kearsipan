@extends('layouts.admin')
@section('content')
    @can('letter_out_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.letter-outs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.letter-out.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.letter-out.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-LetterOut">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.code') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.receiver') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.regarding') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.sended_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.file') }}
                            </th>
                            <th>
                                {{ trans('cruds.letter-out.fields.servicer') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letterOuts as $key => $letter)
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
                                    {{ $letter->receiver ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->regarding ?? '' }}
                                </td>
                                <td>
                                    {{ $letter->sended_at ?? '' }}
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
                                    @can('letter_out_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.letter-outs.show', $letter->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('letter_out_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.letter-outs.edit', $letter->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('letter_out_delete')
                                        <form action="{{ route('admin.letter-outs.destroy', $letter->id) }}" method="POST"
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
            @can('letter_out_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.letter-outs.massDestroy') }}",
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
            let table = $('.datatable-LetterOut:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
