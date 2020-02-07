@extends('layouts.app')
@section('cssLib')
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div id="page-body">
                        <!-- [PERIOD SELECTOR] -->
                        <div id="cal-date" class="float-left">
                            <select id="cal-mth"></select>
                            <select id="cal-yr"></select>
                            <input id="cal-set" class="btn btn-outline-danger" type="button" value="SET"/>
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/appointments/create') }}" class="btn btn-outline-danger mt-3">Create Appointment</a>
                        </div>
                        <!-- [CALENDAR] -->
                        <div id="cal-container"></div>

                        <!-- [EVENT] -->
                        <div id="cal-event"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="deleteDialog" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this appointment?</p>
                <form method="post" id="delete-appointment">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitDelete()">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsLib')

    <script src="{{ asset('js/calendar.js') }}"></script>
    <script>
        function submitDelete() {
            $("#delete-appointment").submit();
        }
        function showDeleteConfirm(id) {
            $("#delete-appointment").attr('action', '/appointments/'+id);
            $("#deleteDialog").modal('show');
        }
    </script>

@endsection
