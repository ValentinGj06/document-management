@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.file.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            @foreach ($file as $media)
                    <iframe style="width: 500px; height: 700px;" src="{{ asset("storage/$media->model_id/$media->file_name") }}" height="200" width="300"></iframe>
            @endforeach
        </div>
    </div>
    {{ $file->links() }}


@endsection
@section('scripts')
    @parent
@endsection