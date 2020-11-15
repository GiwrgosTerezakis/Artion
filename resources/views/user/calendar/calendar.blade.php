@extends('user.layouts.user')
@section('content')

    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="open" style="margin-bottom:10px ">Create An Appointment</button>
    <a id="UserLogout" href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
        <i class="nav-icon fas fa-fw fa-sign-out-alt">
        </i>
        {{ __('Logout') }}
    </a>
    <form action="{{ route("user.appointments.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-header">
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2 style="text-align: center;">   Create an Appointment </h2>
                        <input type="number" id="user_id" name="user_id" style="display: none;" value="{{$user->id ? $user->id : '' }}">

                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('doctor_id') ? 'has-error' : '' }}">
                                <label for="doctor">{{ __('Doctors') }}*</label>
                                <select name="doctor_id" id="doctor" class="form-control select2" required>
                                    @foreach($doctors as $id => $doctor)
                                        <option value="{{ $id }}" {{ (isset($appointment) && $appointment->doctor ? $appointment->doctor->id : old('doctor_id')) == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('doctor_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('doctor_id') }}
                                    </em>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-sm-12 {{ $errors->has('start_time') ? 'has-error' : '' }}">
                                <label for="start_time">{{ __('Start Time') }}*</label>
                                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($appointment) ? $appointment->start_time : '') }}" required>
                                @if($errors->has('start_time'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('start_time') }}
                                    </em>
                                @endif

                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="form-group col-sm-12 {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                                <label for="finish_time">{{ __('Finishing Time') }}</label>
                                <input type="text" id="finish_time" name="finish_time" class="form-control datetime" value="1">
                                @if($errors->has('finish_time'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('finish_time') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('comments') ? 'has-error' : '' }}">
                                <label for="comments">{{ __('Comments') }}</label>
                                <textarea id="comments" name="comments" class="form-control ">{{ old('comments', isset($appointment) ? $appointment->comments : '') }}</textarea>
                                @if($errors->has('comments'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('comments') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn " data-dismiss="modal">Close</button>
                        <button  class="btn btn-success" >Submit Randez-vous</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">
            {{ trans('global.systemCalendar') }}
        </div>

        <div class="card-body">
            <link rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>

            <div id='calendar'></div>


        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
      $(document).ready(function () {
        // page is now ready, initialize the calendar...
        events ={!! json_encode($events) !!};
        $('#calendar').fullCalendar({
          // put your options and callbacks here
          events: events,
          defaultView: 'agendaWeek',
            timeFormat: 'H(:mm)'

        })
      })
    </script>


@stop
