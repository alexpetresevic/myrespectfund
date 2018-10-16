@extends('layouts.app')

@section('content')
    <div class="verify-section">
        <div class="container">
            <div class="offset-lg-1 col-lg-10 offset-md-1 col-md-10 offset-0 col-12">
                <div class="verify-mail__block">
                    <h1>FAQ</h1>
                    <form action="{{ route('page.faq') }}" method="get">
                        <div class="faq-search">
                            <input class="form-control" type="search" name="q"
                                   value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" placeholder="Search...">
                            <button><img src="{{asset('/img/search.svg')}}" alt=""></button>
                        </div>
                    </form>
                    <div class="faq__items">
                        <div id="accordion">
                            @foreach($items as $key => $item)
                                <div class="faq__item">
                                    <div class="card">
                                        <div class="card-header" id="heading{{$key}}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapse-{{ str_slug($item->question) }}"
                                                        aria-expanded="true" aria-controls="collapse-{{ str_slug($item->question) }}">
                                                    {{ $item->question }}<span class="ac-toggle-off"><i class="fas fa-plus"></i></span><span
                                                        class="ac-toggle-on"><i class="fas fa-minus"></i></span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{ str_slug($item->question) }}" class="collapse{{ isset($_GET['q']) ? ' show' : '' }}" aria-labelledby="heading-{{ str_slug($item->question) }}"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <p>{!! $item->answer !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="contact-button">
                        <a href="{{ route('page.contact') }}">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
    @if (isset($_GET['q']) && $_GET['q'] != '')
        <script>
            var context = document.querySelector(".faq__items");
            var instance = new Mark(context);
            instance.mark('{{ $_GET['q'] }}');
        </script>
    @endif
@endsection
