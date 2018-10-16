<div class="col-lg-9">
    <div class="dashboard-header">
        <h1>{{ $campaign->title }} <span><a style="font-size: 20px; color: #774b92;" href="{{ route('campaign.dashboard.edit') }}"><i class="fas fa-edit"></i></a></span></h1>
        <p class="forgot-pass">Need help? <a href="{{ route('page.contact') }}"> Contact Us</a></p>
    </div>
    <div class="campaign-detail__share">
        <h3>Share with Friends & Family</h3>
        <ul class="detail-share__links">
            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('campaign.show', ['slug' => $campaign->slug]) }}" class="fb-share"><i class="fab fa-facebook-square"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/home?status={{ route('campaign.show', ['slug' => $campaign->slug]) }}" class="tw-share"><i class="fab fa-twitter-square"></i></a></li>
            <li><a target="_blank" href="https://plus.google.com/share?url={{ route('campaign.show', ['slug' => $campaign->slug]) }}" class="gg-share"><i class="fab fa-google-plus-square"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('campaign.show', ['slug' => $campaign->slug]) }}" class="li-share"><i class="fab fa-linkedin"></i></a></li>
        </ul>
    </div>
</div>
<div class="col-lg-3">
    <div class="dash-tour__button">
        <button id="start-tour">dashboard tour</button>
    </div>
</div>
@push('stack-script')
    <script>
        var tour = new Tour({
            backdrop: true,
            steps: [{
                placement: 'top',
                element: '#dash-amount',
                title: 'Amount Raised',
                content: '{!! $settings['campaign_tour_amount_raised'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-calender',
                title: 'My Calendar',
                content: '{!! $settings['campaign_tour_my_calendar'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-toolkit',
                title: 'Resources',
                content: '{!! $settings['campaign_tour_resources'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-details',
                title: 'Funeral Details',
                content: '{!! $settings['campaign_tour_funeral_details'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-donors',
                title: 'Who has donated',
                content: '{!! $settings['campaign_tour_who_donated'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-settings',
                title: 'Account Settings',
                content: '{!! $settings['campaign_tour_account_settings'][0]['value'] !!}'
            }, {
                placement: 'top',
                element: '#dash-delete',
                title: 'Unpublish Campaign',
                content: '{!! $settings['campaign_tour_unpublish_campaign'][0]['value'] !!}'
            }]
        })

        $('#start-tour').on('click', function (e) {
            e.preventDefault()

            tour.init()
            tour.restart()
        })

    </script>
@endpush