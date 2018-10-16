@extends('layouts.admin')

@section('title')
    <i class="fas fa-question-circle"></i> FAQ
@endsection

@section('content')

    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-options-simple">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.faq.create') }}"><i class="fas fa-plus"></i> Create</a>
            </div>
        </div>
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th width="60%">Question</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td class="text-center">{{ $faq->created_at }}</td>
                        <td class="text-center">{{ $faq->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.faq.edit', ['page' => $faq->id]) }}"><i class="fas fa-edit"></i> </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()
