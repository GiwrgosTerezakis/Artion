<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AdminSystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::with(['user', 'doctor'])->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }


            $title = 'User - ' . $appointment->user->name ;
            $title .= "\r\n";
            $title .= "Doctor";
            $title .= "\r\n";
            $title .=  ' ('.$appointment->doctor->name.')';
            $title .= "\r\n";

            if($appointment->comments){
                $title .= "-----------";
                $title .= "\r\n";
                $title .= $appointment->comments ;
            }


            $events[] = [
                'title' => $title,
                'start' => $appointment->start_time,
                'url'   => route('admin.appointments.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
