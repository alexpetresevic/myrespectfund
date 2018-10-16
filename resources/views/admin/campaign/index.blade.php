@extends('layouts.admin')

@section('title')
    <i class="fas fa-star"></i> Fundraisers
@endsection

@section('content')
    <div class="excel-controls">
        <form method="get" action="{{ route('admin.campaign.search') }}" class="form-inline">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="block block-rounded block-bordered">
        <div class="block-table">
            <table class="table">
                <thead>
                <tr>
                    <th><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=title&sort={{ ($order == 'title' && $sort == 'asc') ? 'desc' : 'asc' }}">Title</a>
                        @if ($order == 'title')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=first_name&sort={{ ($order == 'first_name' && $sort == 'asc') ? 'desc' : 'asc' }}">Name</a>
                        @if ($order == 'first_name')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=goal&sort={{ ($order == 'goal' && $sort == 'asc') ? 'desc' : 'asc' }}">Goal</a>
                        @if ($order == 'goal')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th class="text-center">
                        <a >Raised</a>
                    </th>


                    <th class="text-center"><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=created_at&sort={{ ($order == 'created_at' && $sort == 'asc') ? 'desc' : 'asc' }}">Created</a>
                        @if ($order == 'created_at')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th class="text-center"><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=updated_at&sort={{ ($order == 'updated_at' && $sort == 'asc') ? 'desc' : 'asc' }}">Updated</a>
                        @if ($order == 'updated_at')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th class="text-center"><a href="/admin/campaigns?{{ $filter ? 'filter=campaigns&' : '' }}order=featured&sort={{ ($order == 'featured' && $sort == 'asc') ? 'desc' : 'asc' }}">Featured</a>
                        @if ($order == 'featured')
                            <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>

                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            {!! $item->private ? '<i class="far fa-eye-slash"></i>' : '<i class="far fa-eye"></i>'  !!}
                            {{ $item->title }}
                        </td>
                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                        <td>${{ number_format($item->goal, 2, '.', ',') }}</td>
                        <td>${{ number_format($item->allApprovedDonations()->sum('amount'), 2, '.', ',') }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">{{ $item->updated_at }}</td>


                        <td class="text-center">
                            @if ($item->featured)
                            <a><i class="fa fa-check-circle"></i></a>
                            @endif
                        </td>





                        <td class="text-right">
                            <a href="{{ route('admin.campaigns.edit', ['campaign' => $item->id]) }}"><i class="fas fa-edit"></i> </a>
                        </td>
                        <td class="text-right">
                            <a target="_blank" href="{{ route('campaign.show', ['campaign' => $item->slug]) }}"><i class="fas fa-eye"></i> </a>
                            <a class="delete__confirm" data-name="{{ $item->title }}" href="#0" data-form-id="{{md5($item->id)}}"><i class="fas fa-times text-danger"></i></a>
                            <form id="{{md5($item->id)}}" action="{{ route('admin.campaigns.destroy', ['campaign' => $item->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}{{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <div class="progress progress-mini" style="margin: 0">
                                @php
                                        $color = false;
                                        $percent = false;

                                        if ($item->donations()->sum('amount') != 0 && $item->goal != 0) {
                                            $percent = (($item->allApprovedDonations()->sum('amount') / $item->goal) * 100);
                                            $color = 'danger';
                                            if ($percent > 33)  $color = 'warning';
                                            if ($percent >= 66) $color = 'success';
                                        }
                                @endphp

                                @if ($color && $percent)
                                    <div class="progress-bar progress-bar-{{$color}}" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent }}%;"></div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $items->links() }}
@endsection()
@push('stack-script')
    @if(isset($items))
        <script>
            $('.delete__confirm').on('click', function (e){
                e.preventDefault();
                
                var form = $(this).data('form-id');
                
                swal({
                    title: "Are you sure?", text: $(this).data('name') + "will be deleted.", icon: "warning", buttons: [true, 'Delete']
                }).then(function (value){
                    if (value) {
                        $('#' + form).submit();
                    }
                });
            })
        </script>
    @endif
@endpush
