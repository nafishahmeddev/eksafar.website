<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Venue;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    function details($eventSlug){
        $type = "Event Details";

        $event = Event::where(["slug"=>$eventSlug])->first();
        if(!$event) return abort(404);
        $event_tickets= EventTicket::where(["event_id"=>$event->id])->where('status', '!=', "CREATED")->orderBy("start_datetime", "ASC")->orderBy("price", "ASC")->get();
        $venue= Venue::where(["id"=>$event->venue])->first();
        $artists= Artist::whereIn("id", $event->artists??[])->get();
        

        return view("front.event.details", compact('type','event_tickets','event', 'venue','artists'));
    }
}
