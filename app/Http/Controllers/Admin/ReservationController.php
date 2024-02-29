<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $req)
    {
        $table = Table::findOrFail($req->table_id);
        if ($req->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $req_date = Carbon::parse($req->res_date);
        foreach ($table->reservations as $res) {
            if ($res->res_date->format('Y-m-d') == $req_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date');
            }
        }
        $formFields = $req->validated();
        Reservation::create($formFields);

        return to_route('admin.reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationStoreRequest $req, Reservation $reservation)
    {
        $table = Table::findOrFail($req->table_id);
        if ($req->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table base on guests.');
        }
        $req_date = Carbon::parse($req->res_date);
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        foreach ($reservations as $res) {
            if ($res->res_date->format('Y-m-d') == $req_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date');
            }
        }

        // dd($req->all());
        $formFields = $req->validated();
        // dd($formFields);
        $reservation->update($formFields);

        return to_route('admin.reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return to_route('admin.reservations.index')->with('danger', 'Reservation deleted successfully.');
    }
}
