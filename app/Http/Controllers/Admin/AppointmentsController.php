<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Doctor;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->POST()) {

            $query = Appointment::with(['user', 'doctor'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('admin.appointments.datatablesActions', compact(
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
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('doctor_name', function ($row) {
                return $row->doctor ? $row->doctor->name : '';
            });

            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });





            $table->rawColumns(['actions', 'placeholder', 'user', 'doctor']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->except(Auth::id())->pluck('name', 'id')->prepend(__('Select User'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(__('Select Doctor'), '');



        return view('admin.appointments.create', compact('users', 'doctors'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $minutes_to_add = 45;
        $date = $request['start_time'];
        $doctor = $request['doctor_id'];
        $request['finish_time'] = new DateTime($request['start_time']) ;

        // 45 lepta to rantevou
        $request['finish_time']->add(new DateInterval('PT' . $minutes_to_add  . 'M'))->format('Y-m-d H:i');

        // Tsekarw an uparxei idi rantevou konta sautin tin wra
        $alreadyBooked = DB::table('appointments')
            ->whereRaw('ABS(TIMESTAMPDIFF(MINUTE, start_time, ?)) <= 30', [$date])
            ->where('doctor_id',$doctor)
            ->exists();

        if($alreadyBooked){
            echo '<script>alert("Appointment time already exists")</script>';
            return redirect()->route('admin.appointments.index');
        }
        $appointment = Appointment::create($request->all());


        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        //abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->except(Auth::id())->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');



        $appointment->load('user', 'doctor');

        return view('admin.appointments.edit', compact('users', 'doctors','appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());


        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        //abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('user', 'doctor');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
       // abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return redirect()->route('admin.appointments.index');
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
