@extends('layouts.app')

@section('content')
    <div class="start-campaign__section">
        <div class="container">
            <div class="campaign_dashboard__block">
                <div class="row">
                    @include('campaign.dashboard._header')

                    @include('campaign.dashboard._navigation')

                    <div id="toolkit-overview" class="col-lg-7">
                        @foreach($items as $item)
                            <div class="dash-tool__section">
                                <h5>{{ $item->title }}</h5>
                                <div>
                                    {!! $item->body !!}
                                </div>
                                @if($item->file)
                                    <div class="dash-pdf__download">
                                        <a href="/uploads/toolkits/{{ $item->file->filename}}"><i
                                                    class="fas fa-file-pdf"></i> Download PDF</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
