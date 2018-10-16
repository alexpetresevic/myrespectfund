<?php

namespace App\Http\Controllers;

use App\Reminder;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'reminders.*' => 'Fill all reminder inputs',
        ];
        
        $request->validate([
            'reminders.*' => 'required',
            'date'        => 'required'
        ], $messages);
        
        foreach ($request->reminders as $newReminder) {
            $reminder = new Reminder();
            $reminder->user_id = Auth::user()->id;
            $reminder->campaign_id = $request->campaignId;
            $reminder->reminder = $newReminder;
            $reminder->date = Carbon::parse($request->date);
            
            $reminder->save();
        }
        
        return Auth::user()->reminders;
    }
    
    public function update(Request $request, $id)
    {
        $reminder = Reminder::find($id);
        
        if ( ! is_null($request->reminder)) {
            $reminder->reminder = $request->reminder;
        }
        
        if ( ! is_null($request->done)) {
            $reminder->done = $request->done;
        }
        
        $reminder->update();
        
        return $reminder;
    }
    
    public function getByDate()
    {
        $reminders = Reminder::where('campaign_id', request()->campaignId)->where('date', Carbon::parse(request()->date))->get();
        
        return $reminders;
    }
    
    public function delete(Reminder $reminder)
    {
        $reminder->delete();
    }
}
