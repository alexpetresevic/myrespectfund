@extends('layouts.admin')

@section('title')
<i class="fas fa-quote-right"></i> Testimonials
@endsection

@section('content')
<div class="block block-rounded block-bordered">
    <div class="block-header">
        <div class="block-options-simple">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.testimonial.create') }}"><i class="fas fa-plus"></i> Create</a>
        </div>
    </div>
    <div class="block-table">
        <table class="table">
            <thead>
            <tr>
                <th>Fundraiser</th>
                <th>Body</th>
                <th class="text-center">Created</th>
                <th class="text-center">Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
            <tr>
                @if(isset($item->campaign->title))
                    <td>{{ $item->campaign->title }}<a class="pull-right" href="{{ route('campaign.show', ['slug' => $item->campaign->slug]) }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                @else
                    <td>{{ $item->campaign_name }}</td>
                @endif
                <td>{{ $item->body }}</td>
                <td class="text-center">{{ $item->created_at }}</td>
                <td class="text-center">{{ $item->updated_at }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.testimonial.edit', ['testimonial' => $item->id]) }}"><i class="fas fa-edit"></i></a>
                    <a class="delete__confirm" href="#0" data-form-id="{{md5($item->id)}}"><i class="fas fa-times text-danger"></i></a>
                    <form id="{{md5($item->id)}}" action="{{ route('admin.testimonial.destroy', ['testimonial' => $item->id]) }}" method="POST" style="display: none;">
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
    $('.delete__confirm').on('click', function (e){
        e.preventDefault();
        
        var form = $(this).data('form-id');
        
        swal({
            title: "Are you sure?", text: "Testimonial will be deleted.", icon: "warning", buttons: [true, 'Delete']
        }).then(function (value){
            if (value) {
                $('#' + form).submit();
            }
        });
    })
</script>
    @endsection
