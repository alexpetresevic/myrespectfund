@extends('layouts.admin')

@section('title')
    <i class="fas fa-tags"></i> Tags
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-table">
            <div class="block-header">
                <div class="block-options-simple">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.tags.create') }}"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td class="text-center">{{ $tag->created_at }}</td>
                        <td class="text-center">{{ $tag->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.blog.tags.edit', ['category' => $tag->id]) }}"><i class="fas fa-edit"></i> </a>
                            <a class="delete__confirm" href="#0" data-form-id="{{md5($tag->id)}}"><i class="fas fa-times text-danger"></i></a>
                            <form id="{{md5($tag->id)}}" action="{{ route('admin.blog.tags.destroy', ['tag' => $tag->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}{{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection()

@section('script')
    <script>
      $('.delete__confirm').on('click', function (e){
        e.preventDefault();

        var form = $(this).data('form-id');

        swal({
          title: "Are you sure?", text: "Category will be deleted.", icon: "warning", buttons: [true, 'Delete']
        }).then(function (value){
          if (value) {
            $('#' + form).submit();
          }
        });
      })
    </script>
@endsection
