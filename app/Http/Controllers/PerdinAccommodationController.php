<?php

namespace App\Http\Controllers;

use App\Models\PerdinAccommodation;
use Illuminate\Http\Request;

class PerdinAccommodationController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'perdin_id' => $request->perdin_id,

            /*
            ======================================================
            TRANSPORT DEPART
            ======================================================
            */
            'transport_depart_qty' => $request->transport_depart_qty ?? 0,
            'transport_depart_nominal' => $request->transport_depart_nominal ?? 0,
            'transport_depart_total' => ($request->transport_depart_qty ?? 0) * ($request->transport_depart_nominal ?? 0),
            'transport_depart_note' => $request->transport_depart_note,

            /*
            ======================================================
            TRANSPORT RETURN
            ======================================================
            */
            'transport_return_qty' => $request->transport_return_qty ?? 0,
            'transport_return_nominal' => $request->transport_return_nominal ?? 0,
            'transport_return_total' => ($request->transport_return_qty ?? 0) * ($request->transport_return_nominal ?? 0),
            'transport_return_note' => $request->transport_return_note,

            /*
            ======================================================
            MEAL BREAKFAST
            ======================================================
            */
            'meal_breakfast_qty' => $request->meal_breakfast_qty ?? 0,
            'meal_breakfast_nominal' => $request->meal_breakfast_nominal ?? 0,
            'meal_breakfast_total' => ($request->meal_breakfast_qty ?? 0) * ($request->meal_breakfast_nominal ?? 0),
            'meal_breakfast_note' => $request->meal_breakfast_note,

            /*
            ======================================================
            MEAL LUNCH
            ======================================================
            */
            'meal_lunch_qty' => $request->meal_lunch_qty ?? 0,
            'meal_lunch_nominal' => $request->meal_lunch_nominal ?? 0,
            'meal_lunch_total' => ($request->meal_lunch_qty ?? 0) * ($request->meal_lunch_nominal ?? 0),
            'meal_lunch_note' => $request->meal_lunch_note,

            /*
            ======================================================
            MEAL DINNER
            ======================================================
            */
            'meal_dinner_qty' => $request->meal_dinner_qty ?? 0,
            'meal_dinner_nominal' => $request->meal_dinner_nominal ?? 0,
            'meal_dinner_total' => ($request->meal_dinner_qty ?? 0) * ($request->meal_dinner_nominal ?? 0),
            'meal_dinner_note' => $request->meal_dinner_note,

            /*
            ======================================================
            DAILY ACCOMMODATION
            ======================================================
            */
            'daily_accommodation_qty' => $request->daily_accommodation_qty ?? 0,
            'daily_accommodation_nominal' => $request->daily_accommodation_nominal ?? 0,
            'daily_accommodation_total' => ($request->daily_accommodation_qty ?? 0) * ($request->daily_accommodation_nominal ?? 0),
            'daily_accommodation_note' => $request->daily_accommodation_note,
        ];

        /*
        ======================================================
        GRAND TOTAL
        ======================================================
        */
        $data['grand_total'] =
            $data['transport_depart_total'] +
            $data['transport_return_total'] +
            $data['meal_breakfast_total'] +
            $data['meal_lunch_total'] +
            $data['meal_dinner_total'] +
            $data['daily_accommodation_total'];

        PerdinAccommodation::create($data);

        return redirect()
            ->back()
            ->with('success', 'Data akomodasi berhasil disimpan');
    }

    public function update(Request $request, )
    {
        $accommodation = PerdinAccommodation::findOrFail($request->perdinAccoId);

        $data = [
            

            /*
            ======================================================
            TRANSPORT DEPART
            ======================================================
            */
            'transport_depart_qty' => $request->transport_depart_qty ?? 0,
            'transport_depart_nominal' => $request->transport_depart_nominal ?? 0,
            'transport_depart_total' => ($request->transport_depart_qty ?? 0) * ($request->transport_depart_nominal ?? 0),
            'transport_depart_note' => $request->transport_depart_note,

            /*
            ======================================================
            TRANSPORT RETURN
            ======================================================
            */
            'transport_return_qty' => $request->transport_return_qty ?? 0,
            'transport_return_nominal' => $request->transport_return_nominal ?? 0,
            'transport_return_total' => ($request->transport_return_qty ?? 0) * ($request->transport_return_nominal ?? 0),
            'transport_return_note' => $request->transport_return_note,

            /*
            ======================================================
            MEAL BREAKFAST
            ======================================================
            */
            'meal_breakfast_qty' => $request->meal_breakfast_qty ?? 0,
            'meal_breakfast_nominal' => $request->meal_breakfast_nominal ?? 0,
            'meal_breakfast_total' => ($request->meal_breakfast_qty ?? 0) * ($request->meal_breakfast_nominal ?? 0),
            'meal_breakfast_note' => $request->meal_breakfast_note,

            /*
            ======================================================
            MEAL LUNCH
            ======================================================
            */
            'meal_lunch_qty' => $request->meal_lunch_qty ?? 0,
            'meal_lunch_nominal' => $request->meal_lunch_nominal ?? 0,
            'meal_lunch_total' => ($request->meal_lunch_qty ?? 0) * ($request->meal_lunch_nominal ?? 0),
            'meal_lunch_note' => $request->meal_lunch_note,

            /*
            ======================================================
            MEAL DINNER
            ======================================================
            */
            'meal_dinner_qty' => $request->meal_dinner_qty ?? 0,
            'meal_dinner_nominal' => $request->meal_dinner_nominal ?? 0,
            'meal_dinner_total' => ($request->meal_dinner_qty ?? 0) * ($request->meal_dinner_nominal ?? 0),
            'meal_dinner_note' => $request->meal_dinner_note,

            /*
            ======================================================
            DAILY ACCOMMODATION
            ======================================================
            */
            'daily_accommodation_qty' => $request->daily_accommodation_qty ?? 0,
            'daily_accommodation_nominal' => $request->daily_accommodation_nominal ?? 0,
            'daily_accommodation_total' => ($request->daily_accommodation_qty ?? 0) * ($request->daily_accommodation_nominal ?? 0),
            'daily_accommodation_note' => $request->daily_accommodation_note,
        ];

        /*
        ======================================================
        GRAND TOTAL
        ======================================================
        */
        $data['grand_total'] =
            $data['transport_depart_total'] +
            $data['transport_return_total'] +
            $data['meal_breakfast_total'] +
            $data['meal_lunch_total'] +
            $data['meal_dinner_total'] +
            $data['daily_accommodation_total'];

        $accommodation->update($data);

        return redirect()
            ->back()
            ->with('success', 'Data akomodasi berhasil diupdate');
    }
}
