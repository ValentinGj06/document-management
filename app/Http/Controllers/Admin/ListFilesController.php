<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\Models\Media;

class ListFilesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Media $media)
    {
        $file = DB::table('media')
            ->join('files', 'media.model_id', '=', 'files.id')
            ->select('model_id', 'file_name')
            ->where('deleted_at', '=',null)
            ->paginate(3);

        return view('admin.files.listFiles', compact('file'));
    }
}
