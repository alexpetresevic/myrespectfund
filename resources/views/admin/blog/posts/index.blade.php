@extends('layouts.admin')

@section('title')
    <i class="fas fa-thumbtack"></i> Posts
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-table">
            <div class="block-header">
                <div class="block-options-simple">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.posts.create') }}"><i class="fas fa-plus"></i> Create</a>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th width="60px"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ str_limit($post->title, 70) }}</td>
                        <td>{{ $post->author->first_name }} {{ $post->author->last_name }}</td>
                        <td>
                            @php $categoriesArray = []; @endphp
                            @foreach($post->categories as $category)
                                @php $categoriesArray[] = $category->name; @endphp
                            @endforeach
                            {{ implode(', ', $categoriesArray) }}
                        </td>
                        <td>
                            @foreach($post->tags as $tag)
                                <span class="label label-primary">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">{{ $post->created_at }}</td>
                        <td class="text-center">{{ $post->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.blog.posts.edit', ['post' => $post->id]) }}"><i class="fas fa-edit"></i> </a>
                            <a class="delete__confirm" href="#0" data-form-id="{{md5($post->id)}}"><i class="fas fa-times text-danger"></i></a>
                            <form id="{{md5($post->id)}}" action="{{ route('admin.blog.posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: none;">
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
          title: "Are you sure?", text: "Post will be deleted.", icon: "warning", buttons: [true, 'Delete']
        }).then(function (value){
          if (value) {
            $('#' + form).submit();
          }
        });
      })
    </script>
@endsection
