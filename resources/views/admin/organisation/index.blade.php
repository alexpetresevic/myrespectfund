@extends('layouts.admin')

@section('title')
    <i class="fas fa-id-card"></i> Organizations
@endsection

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header">
            <div class="block-options-simple">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.organization.create') }}"><i class="fas fa-plus"></i> Create</a>
            </div>
        </div>
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th class="text-center">Created</th>
                    <th class="text-center">Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->url }} <a class="pull-right" href="{{ $item->url }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->updated_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.organization.edit', ['organisation' => $item->id]) }}"><i class="fas fa-edit"></i></a>
                            <a class="delete__confirm" href="#0" data-form-id="{{md5($item->id)}}"><i class="fas fa-times text-danger"></i></a>
                            <form id="{{md5($item->id)}}" action="{{ route('admin.organization.destroy', ['organisation' => $item->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}{{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $items->links() }}
@endsection()
@section('script')
    <script>
      $('.delete__confirm').on('click', function (e) {
        e.preventDefault();

        var form = $(this).data('form-id');

        swal({
          title: "Are you sure?",
          text: "Organization will be deleted.",
          icon: "warning",
          buttons: [true, 'Delete']
        }).then(function(value) {
          if (value) $('#' + form).submit();
        });
      })
    </script>
@endsection
