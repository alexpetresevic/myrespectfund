@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
<div class="col-lg-5">
    <div id="dash-amount" class="dashboard-fund__ammount">
        <p>Raised:</p> ${{ number_format($campaign->allApprovedDonations()->sum('amount'), 2, '.', ',') }} <p>of</p> ${{ number_format($campaign->goal, 2, '.', ',') }}
    </div>
    
    @include('campaign.dashboard.modals._new-reminder')
    
    <div class="dashboard-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <ul>
            @if($campaign->active && strtotime(is_null($campaign->campaign_end) ? date('Ydm') : $campaign->campaign_end)  < time())
                <li id="dash-withdraw" class="{{ request()->route()->getName() === 'withdraw.index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('withdraw.index') }}" role="tab">Withdraw Funds</a></li>
            @endif
            <li id="dash-overview" class="{{ request()->route()->getName() === 'campaign.dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ route('campaign.dashboard') }}" role="tab">Overview</a></li>
            @php
                $text = 'Reminders';
            @endphp
            @if (isset($funeralHome) && $funeralHome->user()->exists())
                @if($funeralHome->user->is('affiliate'))
                    @php
                        $messageModal = 'id=message-button data-toggle=modal data-target=#message-modal';
                        $text = 'Messages/Reminders';
                    @endphp
                    @include('campaign.dashboard.modals._send-message')
                @endif
            @endif
            <li><a {{ isset($messageModal) ? $messageModal : '' }} class="nav-link" href="#" onclick="return false" role="tab">{{ $text }}</a></li>
            <li id="dash-calender" class="dashboard-calendar">
                <div id="datepicker"></div>
            </li>
            @php
                $detailId = is_null($campaign->funeralHome) ? 'no-funeral-home' : 'has-funeral-home';
            @endphp
            {{--<li id="dash-toolkit" class="{{ request()->route()->getName() === 'campaign.dashboard.toolkit' ? 'active' : '' }}"><a class="nav-link" href="{{ route('campaign.dashboard.toolkit') }}" role="tab">Resources</a></li>--}}
            <li id="dash-details" class="{{ request()->route()->getName() === 'campaign.dashboard.funeral-details' ? 'active' : '' }}"><a class="nav-link" id="{{ $detailId }}" href="{{ route('campaign.dashboard.funeral-details') }}" role="tab">Funeral
                    Details</a></li>
            <li id="dash-donors" class="{{ request()->route()->getName() === 'campaign.dashboard.donors' ? 'active' : '' }}"><a class="nav-link" href="{{ route('campaign.dashboard.donors', ['slug' => $campaign->slug]) }}" role="tab">Who has
                    Donated</a></li>
            <li id="dash-settings" class="{{ request()->route()->getName() === 'user.profile' ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.profile', ['user' => auth()->user()->id]) }}" role="tab">Account Settings</a></li>
            <li id="dash-delete" class=""><a class="nav-link" href="{{ route('campaign.dashboard.campaign-delete') }}" role="tab">Unpublish Campaign</a></li>
        </ul>
    </div>
</div>
@push('stack-script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        var selectedDate;
        
        $(document).on('click', '.remember-checkbox', function (){
            var input = $(this).siblings('.reminder-done');
            if ($(this).is(':checked')) {
                input.css("text-decoration", "line-through");
                reminderDone($(this), 1);
            }else {
                input.css("text-decoration", "");
                reminderDone($(this), 0);
            }
        });
        
        $(document).on('click', '.delete-single-reminder', function (){
            var that = this;
            if (confirm('Delete reminder?')){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: CSRF_TOKEN
                };
                $.ajax({
                    type: 'POST',
                    url: '/my-fundraiser/reminder/delete/' + $(this).data('reminder'),
                    data: data,
                    success: function (){
                        $(that).parent('.single-reminder').fadeOut(200);
                    }
                });
            }
        });
        
        function reminderDone(reminder, isDone)
        {
            var reminderId = reminder.val();
            $('.reminder-saved').remove();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST", url: '/my-fundraiser/reminder/update/' + reminderId, data: {
                    _token: CSRF_TOKEN, id: reminderId, done: isDone
                }, success: function (response){
                    reminder.parent('label').after($('<span class="reminder-saved">Saved</span>').fadeOut(2000))
                }
            });
            
        }
        
        $('#add-new-reminder').on('click', function (){
            var allReminderInputs = $('#all-reminders').children('.reminder-section');
            var inputHtml = '<div class="reminder-section"><input class="form-control reminders new-reminder" id="reminder" name="reminders[]" type="text" value=""/><span class="remove-reminder">x</span></div>';
            $(allReminderInputs[allReminderInputs.length - 1]).after(inputHtml);
        });
        
        $(document).on('click', '.remove-reminder', function (){
            $(this).parent('.reminder-section').remove();
        });
        
        $(document).keydown(function (e){
            if (e.keyCode === 27) {
                $('#event-modal').modal('hide');
                $('#message-modal').modal('hide');
            }
        });
        
        function datepicker(Reminders)
        {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                onSelect: function (date){
                    selectedDate = date;
                    $('#submit').attr('disabled', false);
                    $('#modal-button').click();
                    $('#reminder-date').html(date);
                    $('#date').val(date);
                    
                    showAllReminderForDate(date);
                }, beforeShowDay: function (date){
                    var Highlight = Reminders.reminderDates[date];
                    var HighlightText = Reminders.reminderTitles[date];
                    if (Highlight) {
                        return [true, 'has-reminder', HighlightText];
                    }else {
                        return [true, 'no-reminder'];
                    }
                }
            });
        }
        
        function showAllReminderForDate(date)
        {
            $('.single-reminder').remove();
            $('.new-reminder').remove();
            var dateParts = date.split('/');
            var newDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2];
            $.ajax({
                type: "GET", url: '/my-fundraiser/reminder/get-by-date/' + newDate, data: {
                    date: date, campaignId: '{!! $campaign->id !!}'
                }, success: function (response){
                    for (var i in response) {
                        var checked = '';
                        var style = '';
                        if (response[i].done) {
                            style = 'style="text-decoration: line-through;"';
                            checked = 'checked';
                        }
                        var html = '<div class="single-reminder">' + '<label id="modal-checkbox" class="control control--checkbox" for="become_partner' + i + '">' + '<p ' + style + ' class="reminder-done">' + response[i].reminder + ' </p>' + '<input type="checkbox" value="' + response[i].id + '" ' + checked + ' class="remember-checkbox" name="become_partner" id="become_partner' + i + '">' + '<div class="control__indicator">' + '</div>' + '</label><span data-reminder="' + response[i].id + '" class="delete-single-reminder">&times;</span>' + '</div>';
                        $('#date').after(html);
                    }
                }
            });
        }
        
        function reminderDates(reminders)
        {
            var Reminders = {
                reminderDates: {}, reminderTitles: {}
            };
            for (var i in reminders) {
                var dateParts = reminders[i].date.split('-');
                var date = dateParts[1] + '-' + dateParts[2] + '-' + dateParts[0];
                Reminders.reminderDates[new Date(date)] = new Date(date);
                Reminders.reminderTitles[new Date(date)] = reminders[i].title;
            }
            return Reminders;
        }
        
        datepicker(reminderDates({!! $campaign->reminders->toJson() !!}));
        
        $('#modal-close').on('click', function (){
            $('.error').remove();
        });
        
        $('#submit').on('click', function (e){
            e.preventDefault();
            var reminders = [];
            
            $('.reminders').each(function (){
                reminders.push($(this).val());
            });
            
            $('.error').remove();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST", url: '/my-fundraiser/reminder/store', data: {
                    _token: CSRF_TOKEN, reminders: reminders, campaignId: '{!! $campaign->id !!}', date: $('#date').val()
                }, success: function (response){
                    $("#datepicker").datepicker("destroy");
                    datepicker(reminderDates(response));
                    $("#datepicker").datepicker("refresh");
                    $('#submit').attr('disabled', true);
                    $('#event-modal').modal('hide');
                    siteMessage('Your reminder was saved', '#footer');
                    $('#reminder').val('');
                }, error: function (data){
                    $('.modal-body').append(' <div class="error"><p>' + data.responseJSON.errors['reminders.0'] + '</p></div>');
                }
            });
        });
        
        //        $(document).ready(function (){
        //            $('#no-funeral-home').on('click', function (e){
        //                e.preventDefault();
        //                siteMessage('You don\' have a funeral home selected', '#footer');
        //            });
        //        });
    </script>
@endpush

