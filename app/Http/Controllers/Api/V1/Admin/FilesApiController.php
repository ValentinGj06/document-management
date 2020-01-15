<?php
//
//namespace App\Http\Controllers\Api\V1\Admin;
//
//use App\File;
//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Traits\MediaUploadingTrait;
//use App\Http\Requests\StoreFileRequest;
//use App\Http\Requests\UpdateFileRequest;
//use App\Http\Resources\Admin\FileResource;
//use Gate;
//use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//class FilesApiController extends Controller
//{
//    use MediaUploadingTrait;
//
//    public function index()
//    {
//        abort_if(Gate::denies('file_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        return new FileResource(File::with(['team'])->get());
//    }
//
//    public function store(StoreFileRequest $request)
//    {
//        $file = File::create($request->all());
//
//        if ($request->input('document_file', false)) {
//            $file->addMedia(storage_path('tmp/uploads/' . $request->input('document_file')))->toMediaCollection('document_file');
//        }
//
//        return (new FileResource($file))
//            ->response()
//            ->setStatusCode(Response::HTTP_CREATED);
//    }
//
//    public function show(File $file)
//    {
//        abort_if(Gate::denies('file_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        return new FileResource($file->load(['team']));
//    }
//
//    public function update(UpdateFileRequest $request, File $file)
//    {
//        $file->update($request->all());
//
//        if ($request->input('document_file', false)) {
//            if (!$file->document_file || $request->input('document_file') !== $file->document_file->file_name) {
//                $file->addMedia(storage_path('tmp/uploads/' . $request->input('document_file')))->toMediaCollection('document_file');
//            }
//        } elseif ($file->document_file) {
//            $file->document_file->delete();
//        }
//
//        return (new FileResource($file))
//            ->response()
//            ->setStatusCode(Response::HTTP_ACCEPTED);
//    }
//
//    public function destroy(File $file)
//    {
//        abort_if(Gate::denies('file_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $file->delete();
//
//        return response(null, Response::HTTP_NO_CONTENT);
//    }
//}
