@foreach($appointments as $appointment)
<div class="row row-striped">
    <div class="col-2 text-center">
        <h1 class="display-4"><span class="badge badge-secondary">{{ \Carbon\Carbon::parse($appointment->start_time)->format('d') }}</span></h1>
        <h2>{{\Carbon\Carbon::parse($appointment->start_time)->format('M')}}</h2>
        </div>
    <div class="@if(Auth::user()->id === $appointment->user_id) col-8 @else col-10 @endif">
        <h3 class="text-uppercase">
            <strong>{{ $appointment->title }}</strong>
        </h3>
        <ul class="list-inline">
            '    <li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i> {{\Carbon\Carbon::parse($appointment->start_time)->format('l')}}</li>
            <li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i>
                {{\Carbon\Carbon::parse($appointment->start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($appointment->end_time)->format('h:i A')}}
            </li>
            </ul>
        <p>{{ $appointment->description }}</p>
    </div>
    @if(Auth::user()->id === $appointment->user_id)
    <div class="col-2">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <a class="dropdown-item" href="{{ url('/appointments/'.$appointment->id.'/edit') }}">Edit</a>
                <button class="dropdown-item" type="button" onclick="showDeleteConfirm({{ $appointment->id }})">Delete</button>
            </div>
        </div>
    </div>
    @endif
</div>
@endforeach
