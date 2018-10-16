@extends('layouts.admin')

@section('title')
    <i class="fas fa-archive"></i> Toolkit
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-options-simple">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.toolkit.create') }}"><i class="fas fa-plus"></i> Create</a>
            </div>
        </div>
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th width="60%">Title</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.toolkit.edit', ['toolkit' => $item->id]) }}"><i class="fas fa-edit"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()
