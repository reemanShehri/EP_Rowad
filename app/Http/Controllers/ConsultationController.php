<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::latest()->get();
        return view('consultations.index', compact('consultations'));
    }

  public function create()
{
    $consultants = \App\Models\User::where('role', 'consultant')->get();
    $entrepreneurs = \App\Models\User::where('role', 'entrepreneur')->get();

    return view('consultations.create', compact('consultants', 'entrepreneurs'));
}


    public function store(Request $request)
    {


        $data = $request->validate([
            'consultant_id'    => 'required|exists:users,id',
            'entrepreneur_id'  => 'required|exists:users,id',
            'topic'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'scheduled_at'     => 'required|date',
            'duration'         => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'status'           => 'required|string',
            'meeting_link'     => 'nullable|url',
            'payment_status'   => 'required|string',
            'user_id'          => 'required|exists:users,id',
        ]);

        Consultation::create($data);

        return redirect()->route('consultations.index')->with('success', 'Consultation created successfully.');
    }

    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        return view('consultations.edit', compact('consultation'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $data = $request->validate([
            'consultant_id'    => 'required|exists:users,id',
            'entrepreneur_id'  => 'required|exists:users,id',
            'topic'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'scheduled_at'     => 'required|date',
            'duration'         => 'required|integer|min:1',
            'price'            => 'required|numeric|min:0',
            'status'           => 'required|string',
            'meeting_link'     => 'nullable|url',
            'payment_status'   => 'required|string',
            'user_id'          => 'required|exists:users,id',
        ]);

        $consultation->update($data);

        return redirect()->route('consultations.index')->with('success', 'Consultation updated successfully.');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation deleted successfully.');
    }
}
