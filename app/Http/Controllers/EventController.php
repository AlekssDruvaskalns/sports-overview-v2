<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Organization;

class EventController extends Controller
{
    
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255'
        ]);

        Event::create($request->all());
        return redirect()->route('event.index')->with('success', 'Event created successfully');
    }


    public function show(Event $event)
    {
        $allOrganizations = Organization::all();
        return view('event.show', ['allorganizations' => $allOrganizations], ['event' => $event]);
    }

    public function edit($id)
    {
        // Retrieve the organization by its ID
        $event = Event::findOrFail($id);

        return view('event.edit', ['event' => $event]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        if ($request->user()->id == auth()->user()->id)
        {
            Event::where('id', $id)->update($$request->all());

        }

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::where('id', $id);

        $event->delete();

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }



    public function addOrganizaion(Request $request, Event $event) {
        if ($event->organization->contains($request['organization'])) {
            return redirect()->back()->with('error', 'Organization is already in the event.');
        }

        $event->organizations()->attach($request['organization']);
        return redirect('/event/' . $event->id)->with('success', 'Organization added successfully!');
    }

    public function removeOrganization(Request $request, Event $event){
        $event->organizations()->detach($request['organization']);
        return redirect('/event/' . $event->id)->with('success', 'Organization removed successfully!');
    }


}