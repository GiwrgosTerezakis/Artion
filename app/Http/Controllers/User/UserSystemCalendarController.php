<?php

namespace App\Http\Controllers\User;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];


        // exw valei  na vlepei o kathens ta dika tou mono events
        $appointments = Appointment::with(['user', 'doctor'])->where('user_id',Auth::id())->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }


            $title = 'User - ' . $appointment->user->name ;
            $title .= "\r\n";
            $title .= "Doctor";
            $title .= "\r\n";
            $title .=  ' ('.$appointment->doctor->name.')';

            $events[] = [
                'title' => $title,
                'start' => $appointment->start_time,
            ];
        }

        $user = User::findOrFail(Auth::id());

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('user.calendar.calendar', compact('events','user','doctors'));
    }
}
