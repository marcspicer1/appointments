<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('appointment.create',[
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|before:end_time',
            'end_time' => 'required|after:start_time',
            'users' => 'required'
        ]);

        $start_date_time = date('Y-m-d H:i:s', strtotime($request->date.' '.$request->start_time));
        $end_date_time = date('Y-m-d H:i:s', strtotime($request->date.' '.$request->end_time));

        $appointment = Appointment::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $start_date_time,
            'end_time' => $end_date_time,
            'user_id' => Auth::user()->id
        ]);
        $users = $request->users;
        array_push($users, Auth::user()->id);
        $appointment->users()->attach($users);

        return redirect('/home')->with(['success' => 'Appointment created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::with(['users'])
            ->where([['id', $id],['user_id', Auth::user()->id]])
            ->firstOrFail();
        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('appointment.edit', [
            'appointment' => $appointment,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'start_time' => 'required|before:end_time',
            'end_time' => 'required|after:start_time',
            'users' => 'required'
        ]);

        $start_date_time = date('Y-m-d H:i:s', strtotime($request->date.' '.$request->start_time));
        $end_date_time = date('Y-m-d H:i:s', strtotime($request->date.' '.$request->end_time));

        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();
        $appointment->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $start_date_time,
            'end_time' => $end_date_time,
            'user_id' => Auth::user()->id
        ]);
        $users = $request->users;
        array_push($users, Auth::user()->id);
        $appointment->users()->sync($users);

        return redirect('/home')->with(['success' => 'Appointment updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::where([['id', $id],['user_id', Auth::user()->id]])
            ->delete();
        return redirect('/home')->with(['success' => 'Appointment deleted successfully!']);
    }

    public function listAppointments(Request $request) {
        $date = $request->year . '-' . $request->month . '-' . $request->day;
        $appointments = Appointment::with(['createdBy'])
            ->whereHas('users', function($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->whereDate('start_time', $date)
            ->orderBy('start_time')
            ->get();
        return view('appointment.detail', [
            'appointments' => $appointments
        ])->render();
    }
}
