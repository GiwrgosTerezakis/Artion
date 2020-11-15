<?php

namespace App\Http\Controllers\User;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Doctor;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Appointment::with(['user', 'doctor'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('doctor_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });


            $table->rawColumns(['actions', 'placeholder', 'user', 'doctor']);

            return $table->make(true);
        }

        return redirect()->route('user.systemCalendar');
    }

//    public function create()
//    {
//        //abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $users = User::all()->pluck('name', 'id')->prepend(__('Select User'), '');
//
//        $doctors = Doctor::all()->pluck('name', 'id')->prepend(__('Select Doctor'), '');
//
//
//
//        return view('user.appointments.create', compact('users', 'doctors'));
//    }

    public function store(StoreAppointmentRequest $request)
    {
        $minutes_to_add = 45;
        $date = $request['start_time'];
        $request['finish_time'] = new DateTime($request['start_time']) ;

        // 45 lepta to rantevou
        $request['finish_time']->add(new DateInterval('PT' . $minutes_to_add  . 'M'))->format('Y-m-d H:i');

        // Tsekarw an uparxei idi rantevou konta sautin tin wra
        $alreadyBooked = DB::table('appointments')
            ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, start_time, ?)) <= 30', [$date])
            ->where('user_id',Auth::id())
            ->exists();

        if($alreadyBooked){
            echo '<script>alert("Appointment time already exists")</script>';
            return redirect()->route('user.systemCalendar');
        }

        Appointment::create($request->all());


        return redirect()->route('user.systemCalendar');
    }


//    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
//    {
//        $appointment->update($request->all());
//
//        //gurnaei sto callendar
//        return redirect()->route('user.calendar.calendar');
//    }

//    public function show(Appointment $appointment)
//    {
//        //abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $appointment->load('user', 'doctor');
//
//        return view('user.appointments.show', compact('appointment'));
//    }

//    public function destroy(Appointment $appointment)
//    {
//       // abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $appointment->delete();
//
//        return back();
//    }

}
