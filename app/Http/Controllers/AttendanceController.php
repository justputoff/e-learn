<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('user')->get();
        $hasAttendanceToday = Attendance::whereDate('date', now()->toDateString())->exists();
        return view('pages.attendances.index', compact('attendances', 'hasAttendanceToday'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|string|in:Hadir,Tidak Hadir',
        ]);

        $attendance->update([
            'status' => $request->status,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Status updated successfully.');
    }

    public function generate()
    {
        $students = User::whereHas('role', function($query) {
            $query->where('name', 'student');
        })->get();

        foreach ($students as $student) {
            $student->attendances()->create([
                'date' => now()->toDateString(),
                'status' => 'Belum Hadir',
            ]);
        }

        return redirect()->route('attendances.index')->with('success', 'Attendances generated successfully.');
    }
}
