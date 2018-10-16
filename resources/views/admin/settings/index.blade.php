@extends('layouts.admin')

@section('title')
    <i class="fas fa-cogs"></i> Settings
@endsection
@section('subtitle', 'Edit')

@section('content')
    <form id="news-update-form" action="{{ route('admin.settings.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active">
                        <a href="#btabs-alt-static-site"><i class="fa fa-globe"></i> Site</a>
                    </li>
                    <li>
                        <a href="#btabs-alt-static-social"><i class="fa fa-share-square"></i> Social Media</a>
                    </li>
                    <li>
                        <a href="#btabs-alt-static-cam-dash-tour"><i class="fa fa-share-square"></i> Campaign Dashboard Tour</a>
                    </li>
                    <li>
                        <a href="#btabs-alt-static-par-dash-tour"><i class="fa fa-share-square"></i> Partner Dashboard Tour</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-alt-static-site">
                        <div class="form-group">
                            <label for="settings[site_title]">Site Title</label>
                            <input type="text" name="settings[site_title]" class="form-control" value="{{ old('settings[site_title]', $settings->get('site_title')) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="settings[custom_script]">Custom JavaScript (eg: google analytics code)</label>
                            <textarea type="text" name="settings[custom_script]" class="form-control">{{ old('settings[custom_script]', $settings->get('custom_script')) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="btabs-alt-static-social">
                        <div class="form-group">
                            <label for="settings[facebook]">Facebook</label>
                            <input type="text" name="settings[facebook]" class="form-control" value="{{ old('settings[facebook]', $settings->get('facebook')) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="settings[google_plus]">Google Plus</label>
                            <input type="text" name="settings[google_plus]" class="form-control" value="{{ old('settings[google_plus]', $settings->get('google_plus')) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="settings[twitter]">Twitter</label>
                            <input type="text" name="settings[twitter]" class="form-control" value="{{ old('settings[twitter]', $settings->get('twitter')) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="settings[linkedin]">LinkedIn</label>
                            <input type="text" name="settings[linkedin]" class="form-control" value="{{ old('settings[linkedin]', $settings->get('linkedin')) }}">
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="btabs-alt-static-cam-dash-tour">
                        <div class="form-group">
                            <label for="settings[campaign_tour_amount_raised]">Amount Raised</label>
                            <textarea type="text" name="settings[campaign_tour_amount_raised]" class="form-control editor">{{ old('settings[campaign_tour_amount_raised]', $settings->get('campaign_tour_amount_raised')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_my_calendar]">My Calendar</label>
                            <textarea type="text" name="settings[campaign_tour_my_calendar]" class="form-control editor">{{ old('settings[campaign_tour_my_calendar]', $settings->get('campaign_tour_my_calendar')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_resources]">Resources</label>
                            <textarea type="text" name="settings[campaign_tour_resources]" class="form-control editor">{{ old('settings[campaign_tour_resources]', $settings->get('campaign_tour_resources')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_funeral_details]">Funeral Details</label>
                            <textarea type="text" name="settings[campaign_tour_funeral_details]" class="form-control editor">{{ old('settings[campaign_tour_funeral_details]', $settings->get('campaign_tour_funeral_details')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_who_donated]">Who has donated</label>
                            <textarea type="text" name="settings[campaign_tour_who_donated]" class="form-control editor">{{ old('settings[campaign_tour_who_donated]', $settings->get('campaign_tour_who_donated')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_account_settings]">Account Settings</label>
                            <textarea type="text" name="settings[campaign_tour_account_settings]" class="form-control editor">{{ old('settings[campaign_tour_account_settings]', $settings->get('campaign_tour_account_settings')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[campaign_tour_unpublish_campaign]">Unpublish Campaign</label>
                            <textarea type="text" name="settings[campaign_tour_unpublish_campaign]" class="form-control editor">{{ old('settings[campaign_tour_unpublish_campaign]', $settings->get('campaign_tour_unpublish_campaign')) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="btabs-alt-static-par-dash-tour">
                        <div class="form-group">
                            <label for="settings[partner_tour_recent_messages]">Recent Messages</label>
                            <textarea type="text" name="settings[partner_tour_recent_messages]" class="form-control editor">{{ old('settings[partner_tour_recent_messages]', $settings->get('partner_tour_recent_messages')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[partner_tour_linked_campaigns]">Linked Campaigns</label>
                            <textarea type="text" name="settings[partner_tour_linked_campaigns]" class="form-control editor">{{ old('settings[partner_tour_linked_campaigns]', $settings->get('partner_tour_linked_campaigns')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[partner_tour_reminder_funds]">Reminder Funds</label>
                            <textarea type="text" name="settings[partner_tour_reminder_funds]" class="form-control editor">{{ old('settings[partner_tour_reminder_funds]', $settings->get('partner_tour_reminder_funds')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[partner_tour_request_call]">Request My Respects Call</label>
                            <textarea type="text" name="settings[partner_tour_request_call]" class="form-control editor">{{ old('settings[partner_tour_request_call]', $settings->get('partner_tour_request_call')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[partner_tour_request_literature]">Request My Respects literature</label>
                            <textarea type="text" name="settings[partner_tour_request_literature]" class="form-control editor">{{ old('settings[partner_tour_request_literature]', $settings->get('partner_tour_request_literature')) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settings[partner_tour_contact]">Contact My Respects</label>
                            <textarea type="text" name="settings[partner_tour_contact]" class="form-control editor">{{ old('settings[partner_tour_contact]', $settings->get('partner_tour_contact')) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    <div class="form-group">
                        <button type="submit" form="news-update-form" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection()
@push('stack-script')
    @include('admin._settingsnote')
@endpush
