<div class="col-lg-9 col-md-8">
    <div class="dashboard-header">
        @if(!is_null($user->funeralHome))
            <h1>
                {{ $user->funeralHome->name }}
                <span>
                    <a style="font-size: 20px; color: #774b92;" href="{{ route('partner.edit') }}"><i class="fas fa-edit"></i></a>
                </span>
            </h1>
        @endif
        <p class="forgot-pass">Need help? <a href="{{ route('page.contact') }}"> Contact Us</a></p>
    </div>
</div>
<div class="col-lg-3 col-md-4">
    <div class="dash-tour__button">
        <button id="start-tour">dashboard tour</button>
    </div>
</div>
@push('stack-script')
<script>
    var tour = new Tour({
        backdrop: true, steps: [
            {
                placement: 'top',
                element: '#recent-messages',
                title: 'Recent Messages',
                content: '{!! $settings['partner_tour_recent_messages'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#linked-campaigns',
                title: 'Linked Campaigns',
                content: '{!! $settings['partner_tour_linked_campaigns'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#reminder-funds',
                title: 'Reminder Funds',
                content: '{!! $settings['partner_tour_reminder_funds'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#request-call',
                title: 'Request My Respects Call',
                content: '{!! $settings['partner_tour_request_call'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#request-literature',
                title: 'Request My Respects literature',
                content: '{!! $settings['partner_tour_request_literature'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#contact-respect',
                title: 'Contact My Respects',
                content: '{!! $settings['partner_tour_contact'][0]['value'] !!}'
            },
        ]
    });


    $('#start-tour').on('click', function (e) {
        e.preventDefault();

        tour.init();
        tour.restart();
    })

</script>
@endpush
