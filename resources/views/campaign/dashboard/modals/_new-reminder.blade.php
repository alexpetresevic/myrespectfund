<button style="display: none" id="modal-button" type="button" class="btn btn-info btn-lg" data-toggle="modal"
        data-target="#event-modal">
</button>
<div class="reminder-modal">
    <div id="event-modal" class="modal" role="dialog">
        <div class="modal-dialog">
            <form id="reminder-form" action="{{ route('campaign.dashboard.reminder.store') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Reminder</h4>
                        <p id="reminder-date"></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="reminder-control">
                            <button type="button" id="add-new-reminder">add new &#43</button>
                        </div>
                        <input type="hidden" value="" id="date" name="date">
                        <div class="form-group" id="all-reminders">
                            <div class="reminder-section">
                                <input class="form-control reminders" id="reminder" name="reminders[]" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-close" id="modal-close"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>