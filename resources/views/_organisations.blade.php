@if ($organisations->count())
    <div class="footer-partners">
        <div class="container">
            <div class="row">
                @foreach($organisations as $org)
                    @if ($org->image()->exists())
                        <div class="col-md col-sm-6  col-12">
                            <div class="single-partner">
                                <a href="{{ $org->url }}" {{ $org->url_new_window ? 'target="_blank"' : '' }}>
                                    <img src="{{asset('uploads/organisations/' . $org->image->filename)}}" alt="{{ $org->name }}">
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
