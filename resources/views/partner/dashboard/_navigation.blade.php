@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
<div class="col-lg-5">
    <div class="acordion-nav" id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button id="recent-messages" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        Recent Messages <span class="ac-toggle-off"><i class="fas fa-plus"></i></span><span
                            class="ac-toggle-on"><i class="fas fa-minus"></i></span>
                    </button>
                </h5>
            </div>
            
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <ul class="partner-info__section">
                        @if($user->conversations()->exists())
                            @foreach($user->conversations as $conversation)
                                <input type="hidden" value="{{ $conversation->id }}" id="conversation">
                                <li class="msg-modal"><a target="_blank" data-toggle="modal" data-target="#message-modal" href="">{{ $user->conversations[0]->user->email }}</a></li>
                                @include('partner.dashboard.modals._send-message')
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button id="linked-campaigns" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        Fundraisers linked to <span class="ac-toggle-off"><i class="fas fa-plus"></i></span><span
                            class="ac-toggle-on"><i class="fas fa-minus"></i></span>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <ul class="partner-info__section">
                        @if ($user->funeralHome->campaigns()->exists())
                            @foreach($user->funeralHome->campaigns as $campaign)
                                <li><a href="{{ route('campaign.show', ['campaign' => $campaign->slug]) }}">{{ $campaign->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button id="reminder-funds" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="false" aria-controls="collapseThree">
                        Send reminders to Funds <span class="ac-toggle-off"><i class="fas fa-plus"></i></span><span
                            class="ac-toggle-on"><i class="fas fa-minus"></i></span>
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <ul class="partner-info__section">
                        @if ($user->funeralHome->campaigns()->exists())
                            @foreach($user->funeralHome->campaigns as $key => $campaign)
                                <li><a target="_blank" data-toggle="modal" data-target="#send-reminder-{{ $key }}" href="{{ route('campaign.show', ['campaign' => $campaign->slug]) }}">{{ $campaign->title }}</a></li>
                                @include('partner.dashboard.modals.send-reminder')
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                    <a href="{{ route('partner.request-call') }}" id="request-call" class="btn btn-link collapsed">
                        Request My Respects Call
                    </a>
                </h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
                <h5 class="mb-0">
                    <a href="{{ route('partner.request-literature') }}" id="request-literature" class="btn btn-link collapsed">
                        Request My Respects Literature
                    </a>
                </h5>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingSix">
                <h5 class="mb-0">
                    <button id="contact-respect" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix"
                            aria-expanded="false" aria-controls="collapseSix">
                        Contact My Respects <span class="ac-toggle-off"><i class="fas fa-plus"></i></span><span
                            class="ac-toggle-on"><i class="fas fa-minus"></i></span>
                    </button>
                </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                <div class="card-body">
                    <div class="partner-info__section">
                        <p>Phone: <a href="tel:908 685-6584">(908 685-6584)</a></p>
                        <p>Contact E-Mail: <a href="mailto:cs@myrespects.com">cs@myrespects.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('stack-script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
@endpush


