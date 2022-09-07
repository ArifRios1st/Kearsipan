<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLetterInRequest;
use App\Http\Requests\StoreLetterInRequest;
use App\Http\Requests\UpdateLetterInRequest;
use App\Models\LetterIn;
use App\Models\Servicer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LetterInController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('letter_in_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterIns = LetterIn::all();

        return view('admin.letter-ins.index', compact('letterIns'));
    }

    public function create()
    {
        abort_if(Gate::denies('letter_in_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.letter-ins.create', compact('servicers'));
    }

    public function store(StoreLetterInRequest $request)
    {
        $letter = LetterIn::create($request->all());

        if ($request->input('file', false)) {
            $letter->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $letter->id]);
        }

        return redirect()->route('admin.letter-ins.index');
    }

    public function show(LetterIn $letterIn)
    {
        abort_if(Gate::denies('letter_in_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterIn->load('servicer');

        return view('admin.letter-ins.show', compact('letterIn'));
    }

    public function edit(LetterIn $letterIn)
    {
        abort_if(Gate::denies('letter_in_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $letterIn->load('servicer');

        return view('admin.letter-ins.edit', compact('letterIn', 'servicers'));
    }

    public function update(UpdateLetterInRequest $request, LetterIn $letterIn)
    {
        $letterIn->update($request->all());

        if ($request->input('file', false)) {
            if (!$letterIn->file || $request->input('file') !== $letterIn->file->file_name) {
                if ($letterIn->file) {
                    $letterIn->file->delete();
                }
                $letterIn->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($letterIn->file) {
            $letterIn->file->delete();
        }

        return redirect()->route('admin.letter-ins.index');
    }

    public function destroy(LetterIn $letterIn)
    {
        abort_if(Gate::denies('letter_in_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterIn->delete();

        return back();
    }

    public function massDestroy(MassDestroyLetterInRequest $request)
    {
        LetterIn::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('letter_in_create') && Gate::denies('letter_in_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LetterIn();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
