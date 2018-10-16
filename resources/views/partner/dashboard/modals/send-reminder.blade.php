<div class="modal" id="send-reminder-{{ $key }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-form">
            <form class="send-reminder-form-{{ $key }}" action="{{ route('campaign.dashboard.reminder.store') }}"
                  method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Send Reminder to {{ $campaign->title }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="reminder-control">
                            <button type="button" id="add-new-reminder-{{ $key }}">add new &#43</button>
                        </div>
                        <div class="reminder-date">
                            <input type="text" id="date-{{ $key }}" class="send-reminder-date" name="date" value="" placeholder="Choose a date">
                        </div>
                        <div class="form-group" id="all-reminders-{{ $key }}">
                            <div class="reminder-section">
                                <input class="form-control reminders" id="reminder" name="reminders[]" type="text" value="" placeholder="type a reminder"/>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-close" id="modal-close"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" id="send-reminder-button-{{ $key }}"
                                class="send-reminder-button-{{ $key }}">Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('stack-script')
    <script>
        $(document).ready(function () {
            $('#add-new-reminder-{!! $key !!}').on('click', function () {
                var allReminderInputs = $('#all-reminders-{!! $key !!}').children('.reminder-section');
                var inputHtml = '<div class="reminder-section"><input class="form-control reminders new-reminder" id="reminder" name="reminders[]" type="text" value="" placeholder="type a reminder"/><span class="remove-reminder">x</span></div>';
                $(allReminderInputs[allReminderInputs.length - 1]).after(inputHtml);
            });

            $(document).on('click', '.remove-reminder', function () {
                $(this).parent('.reminder-section').remove();
            });

            $('.send-reminder-date').datepicker({
                changeMonth: true, changeYear: true, yearRange: "1930:2018"
            });

            $('.send-reminder-form-{!! $key !!}').on('submit', function (e) {
                e.preventDefault();
                var reminders = [];

                var allReminders = $(this).find('.reminders');

                $(allReminders).each(function () {
                    reminders.push($(this).val());
                });

                $('.error').remove();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST", url: '/my-fundraiser/reminder/store', data: {
                        _token: CSRF_TOKEN,
                        reminders: reminders,
                        campaignId: '{!! $campaign->id !!}',
                        date: $('#date-{!! $key !!}').val()
                    }, success: function (response) {
                        $('#send-reminder-button-{!! $key !!}').attr('disabled', true);
                        $('#send-reminder-{!! $key !!}').modal('hide');
                        siteMessage('Reminder has been sent to {!! $campaign->title !!}', '#footer');
                        $('#reminder').val('');
                    }, error: function (data) {
                        console.log(data);
                        $.each(data.responseJSON.errors, function (i, value) {
                            $('.modal-body').after(' <div class="error"><p>' + value + '</p></div>');
                        })
                    }
                });
            });
        });
    </script>
@endpush