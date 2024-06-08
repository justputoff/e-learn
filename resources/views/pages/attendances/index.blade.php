@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title">Absensi</h5>
      @if(auth()->user()->role->name == 'teacher' && !$hasAttendanceToday)
        <form action="{{ route('attendances.generate') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary btn-sm">Generate Attendance</button>
        </form>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap p-3">
        <table class="table" id="attendanceTable">
          <thead>
            <tr class="text-nowrap table-dark">
              <th class="text-white">No</th>
              <th class="text-white">Nama</th>
              <th class="text-white">Tanggal</th>
              <th class="text-white">Status</th>
              <th class="text-white">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($attendances as $attendance)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $attendance->user->name }}</td>
              <td>{{ $attendance->date }}</td>
              <td>{{ $attendance->status }}</td>
              <td>
                @if(auth()->user()->role->name == 'teacher')
                  <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="Hadir">
                    <button type="submit" class="btn btn-success btn-sm">Hadir</button>
                  </form>
                  <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="Tidak Hadir">
                    <button type="submit" class="btn btn-danger btn-sm">Tidak Hadir</button>
                  </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection
