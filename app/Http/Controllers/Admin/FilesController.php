<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFileRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FilesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = File::with(['team'])->select(sprintf('%s.*', (new File)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'file_show';
                $editGate      = 'file_edit';
                $deleteGate    = 'file_delete';
                $crudRoutePart = 'files';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('document_file', function ($row) {
                if (!$row->document_file) {
                    return '';
                }

                $links = [];

                foreach ($row->document_file as $media) {
//                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                    $links[] = '<a href="' . asset(substr($media->getUrl(), strpos($media->getUrl(), 'storage'))) . '" target="_blank">' .trim(strstr($media->name, '_', false), "_"). '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'document_file']);

            return $table->make(true);
        }

        return view('admin.files.index');
    }

    public function create()
    {
        abort_if(Gate::denies('file_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.files.create');
    }

    public function store(StoreFileRequest $request)
    {
        $file = File::create($request->all());

        foreach ($request->input('document_file', []) as $fileName) {

            $file->addMedia(storage_path('tmp/uploads/' . $fileName))->toMediaCollection('document_file');
        }

        return redirect()->route('admin.files.index');
    }

    public function edit(File $file)
    {
        abort_if(Gate::denies('file_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file->load('team');

        return view('admin.files.edit', compact('file'));
    }

    public function update(UpdateFileRequest $request, File $file)
    {
        $file->update($request->all());

        if (count($file->document_file) > 0) {
            foreach ($file->document_file as $media) {
                if (!in_array($media->file_name, $request->input('document_file', []))) {
                    $media->delete();
                }
            }
        }

        $media = $file->document_file->pluck('file_name')->toArray();

        foreach ($request->input('document_file', []) as $fileName) {
            if (count($media) === 0 || !in_array($fileName, $media)) {
                $file->addMedia(storage_path('tmp/uploads/' . $fileName))->toMediaCollection('document_file');
            }
        }

        return redirect()->route('admin.files.index');
    }

    public function show(File $file)
    {
        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file->load('team');

        return view('admin.files.show', compact('file'));
    }

    public function destroy(File $file)
    {
        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $file->delete();

        return back();
    }

    public function massDestroy(MassDestroyFileRequest $request)
    {
        File::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
