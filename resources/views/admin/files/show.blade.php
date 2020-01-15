@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.file.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.id') }}
                        </th>
                        <td>
                            {{ $file->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.name') }}
                        </th>
                        <td>
                            {{ $file->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.document_file') }}
                        </th>
                        <td>
                            @foreach($file->document_file as $key => $media)
                                {{--@dd($file->name);--}}
                                <a href="{{ asset(substr($media->getUrl(), strpos($media->getUrl(), 'storage'))) }}" target="_blank">
                                    {!! trim(strstr($media->name, '_', false), "_") !!}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.description') }}
                        </th>
                        <td>
                            {{ $file->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.created_at') }}
                        </th>
                        <td>
                            {{ $file->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.file.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $file->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.files.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection