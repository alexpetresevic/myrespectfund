@extends('layouts.app')

@section('content')
    <div class="campaign-detail__donate">
        <div class="container">
            <div class="campaign-detail__section">
                <div class="row">
                    <div class="col-lg-5">
                        @include('withdraw._navigation')
                    </div>
                    <div class="col-lg-7">
                        <div class="withdraw-section">
                            <h2>your testimonial</h2>
                            <h3>need help?<a href="#0">contact us</a></h3>
                            <h3>Leave a testimonial</h3>
                            <div class="withdraw-block">
                                <form action="{{ route('testimonial.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <textarea rows="6" placeholder="Testimonial text" name="testimonial_text"></textarea>
                                    <div class="thank-button">
                                        <button type="submit">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection