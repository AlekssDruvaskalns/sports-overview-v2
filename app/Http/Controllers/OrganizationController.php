<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Event;

class OrganizationController extends Controller
{

    public function index()
    {
        $organizations = Organization::all();
        // dd($organizations);
        return view('organization.index', compact('organizations'));
        
        
    }

    public function create(){
        return view('organization.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tag' => 'required'
        ]);

        Organization::create([
            'name' => $request->input('name'),
            'tag' => $request->input('tag')
        ]);

        return redirect('/organization')->with('success', 'Organization created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        $allEvents = Event::all();
        return view('organization.show', ['organization' => $organization, 'allEvents' => $allEvents]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {

        return view('organization.edit', ['organization' => $organization]);
    }


    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => 'required',
            'tag' => 'required'
        ]);

    $organization->update([
        'name' => $request->input('name'),
        'tag' => $request->input('tag'),
    ]);

    return redirect()->route('organization.index')->with('success', 'Organization updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization) {
        $organization->delete();
        return redirect('/organization')->with('success', 'Organization deleted successfully!');
    }

    public function addEvent(Request $request, Organization $organization) {
        if ($organization->events->contains($request['event'])) {
            return redirect()->back()->with('error', 'Event is already in the organization.');
        }

        $organization->events()->attach($request['event']);
        return redirect('/organization/' . $organization->id)->with('success', 'Event added successfully!');
    }
    public function removeEvent(Request $request, Organization $organization) {
        $organization->events()->detach($request['event']);
        return redirect('/organization/' . $organization->id)->with('success', 'Event removed successfully!');
        }

}
