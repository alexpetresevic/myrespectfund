@extends('layouts.admin')

@section('title')
    <i class="fas fa-file-alt"></i> Pages
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
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
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td class="text-center">{{ $page->created_at }}</td>
                        <td class="text-center">{{ $page->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}"><i class="fas fa-edit"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()
