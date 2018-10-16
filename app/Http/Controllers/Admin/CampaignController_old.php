<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index()
    {
        $items = Campaign::paginate(15);
        
        return view('admin.campaign.index', compact('items'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit(Campaign $campaign)
    {
        return view('admin.campaign.edit', compact('campaign'));
    }
    
    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title'          => 'required',
            'first_name'     => 'required',
            'address'        => 'required',
            'zip_code'       => 'required',
            'last_name'      => 'required',
            'phone_number'   => 'required',
            'campaign_story' => 'required',
            'funeral_date'   => 'required',
            'funeral_time'   => 'required',
            'campaign_end'   => 'required',
            'goal'           => 'required',
            'private'        => 'boolean',
        ]);
        
        $campaign->title = $data['title'];
        $campaign->first_name = $data['first_name'];
        $campaign->last_name = $data['last_name'];
        $campaign->address = $data['address'];
        $campaign->zip_code = $data['zip_code'];
        $campaign->phone_number = $data['phone_number'];
        $campaign->campaign_story = $data['campaign_story'];
        $campaign->goal = $data['goal'];
        $campaign->funeral_date = isset($data['funeral_date']) ? (new Carbon($data['funeral_date']))->format('Y-m-d') : new Carbon();
        $campaign->funeral_time = isset($data['funeral_time']) ? $data['funeral_time'] : (new Carbon())->format('H:i');
        $campaign->campaign_end = isset($data['campaign_end']) ? (new Carbon($data['campaign_end']))->format('Y-m-d') : (new Carbon())->format('Y-m-d');
        $campaign->private = $data['private'];

        $campaign->update();
        
        return redirect()->route('admin.campaigns.index')->with('status', ['type' => 'success', 'message' => 'Fundraiser updated successfully']);
    }
    
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image()->exists()){
            $campaign->image->delete();
        }
        $campaign->delete();
    
        return redirect()->route('admin.campaigns.index')->with('status', ['type' => 'success', 'message' => 'Fundraiser deleted successfully.']);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $items = Campaign::where('title', 'like', '%' . $search . '%')->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->paginate(20);
        
        return view('admin.campaign.index', compact('items'));
    }
}
