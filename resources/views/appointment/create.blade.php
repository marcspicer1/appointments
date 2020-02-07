@extends('layouts.app')
@section('cssLib')
    <link href="{{asset('css/BsMultiSelect.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />


@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Create Appointment</div>
                    <div class="p-4">
                    <form method="post" action="{{ url('/appointments') }}">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                        @endforeach
                        @csrf
                        <div class="form-group">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Appointment Title">
                        </div>

                        <div class="form-group form-row">
                            <div class="col">
                                <div class="input-group date" id="date" data-target-input="nearest">
                                    <input type="text" value="{{ old('date') }}" data-format="yyyy-MM-dd" name="date" class="form-control datetimepicker-input" data-target="#date"/>
                                    <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group date" id="start-time" data-target-input="nearest">
                                    <input type="text" name="start_time" value="{{ old('start_time') }}"  class="form-control datetimepicker-input" data-target="#start-time"/>
                                    <div class="input-group-append" data-target="#start-time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group date" id="end-time" data-target-input="nearest">
                                    <input type="text" name="end_time" value="{{ old('end_time') }}"  class="form-control datetimepicker-input" data-target="#end-time"/>
                                    <div class="input-group-append" data-target="#end-time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <select multiple class="form-control" id="users" name="users[]">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" placeholder="Appointment Detail" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Appointmeent">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsLib')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="{{ asset('js/BsMultiSelect.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
        $("#users").bsMultiSelect({
            placeholder: 'Select Users'
        });
        $('#date').datetimepicker({
            format:'YYYY-MM-DD',
            pickTime: false
        });
        $('#start-time, #end-time').datetimepicker({
            format: 'LT'
        });

    </script>

@endsection
