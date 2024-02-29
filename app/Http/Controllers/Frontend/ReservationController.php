<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function stepOne(Request $req)
    {
        $reservation = $req->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $req)
    {
        $validated = $req->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'tel_number' => ['required'],
            'guest_number' => ['required'],
        ]);

        if (empty($req->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $req->session()->put('reservation', $reservation);
        } else {
            $reservation = $req->session()->get('reservation');
            $reservation->fill($validated);
            $req->session()->put('reservation', $reservation);
        }

        return to_route('reservations.step.two');
    }

    public function stepTwo(Request $req)
    {
        $reservation = $req->session()->get('reservation');
        $res_table_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation) {
            return $value->res_date->format('Y-m-d') == $reservation->res_date->format('Y-m-d');
        })->pluck('table_id');
        $tables = Table::where('status', TableStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_table_ids)->get();
        return view('reservations.step-two', compact('reservation', 'tables'));
    }

    public function storeStepTwo(Request $req)
    {
        $validated = $req->validate(['table_id' => ['required']]);
        $reservation = $req->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $req->session()->forget('reservation');

        return to_route('thankyou');
    }
}
