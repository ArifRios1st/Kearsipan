<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLetterOutRequest;
use App\Http\Requests\StoreLetterOutRequest;
use App\Http\Requests\UpdateLetterOutRequest;
use App\Models\LetterOut;
use App\Models\Servicer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LetterOutController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('letter_out_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterOuts = LetterOut::all();

        return view('admin.letter-outs.index', compact('letterOuts'));
    }

    public function create()
    {
        abort_if(Gate::denies('letter_out_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.letter-outs.create', compact('servicers'));
    }

    public function store(StoreLetterOutRequest $request)
    {
        $letter = LetterOut::create($request->all());

        if ($request->input('file', false)) {
            $letter->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $letter->id]);
        }

        return redirect()->route('admin.letter-outs.index');
    }

    public function show(LetterOut $letterOut)
    {
        abort_if(Gate::denies('letter_out_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterOut->load('servicer');

        return view('admin.letter-outs.show', compact('letterOut'));
    }

    public function edit(LetterOut $letterOut)
    {
        abort_if(Gate::denies('letter_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicers = Servicer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $letterOut->load('servicer');

        return view('admin.letter-outs.edit', compact('letterOut', 'servicers'));
    }

    public function update(UpdateLetterOutRequest $request, LetterOut $letterOut)
    {
        $letterOut->update($request->all());

        if ($request->input('file', false)) {
            if (!$letterOut->file || $request->input('file') !== $letterOut->file->file_name) {
                if ($letterOut->file) {
                    $letterOut->file->delete();
                }
                $letterOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($letterOut->file) {
            $letterOut->file->delete();
        }

        return redirect()->route('admin.letter-outs.index');
    }

    public function destroy(LetterOut $letterOut)
    {
        abort_if(Gate::denies('letter_out_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $letterOut->delete();

        return back();
    }

    public function massDestroy(MassDestroyLetterOutRequest $request)
    {
        LetterOut::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('letter_out_create') && Gate::denies('letter_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LetterOut();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
