<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServicerRequest;
use App\Http\Requests\StoreServicerRequest;
use App\Http\Requests\UpdateServicerRequest;
use App\Models\Servicer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ServicerController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('servicer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicers = Servicer::all();

        return view('admin.servicers.index', compact('servicers'));
    }

    public function create()
    {
        abort_if(Gate::denies('servicer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicers.create');
    }

    public function store(StoreServicerRequest $request)
    {
        $servicer = Servicer::create($request->all());

        return redirect()->route('admin.servicers.index');
    }

    public function edit(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicers.edit', compact('servicer'));
    }

    public function update(UpdateServicerRequest $request, Servicer $servicer)
    {
        $servicer->update($request->all());

        return redirect()->route('admin.servicers.index');
    }

    public function show(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicers.show', compact('servicer'));
    }

    public function destroy(Servicer $servicer)
    {
        abort_if(Gate::denies('servicer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicer->delete();

        return back();
    }

    public function massDestroy(MassDestroyServicerRequest $request)
    {
        Servicer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
