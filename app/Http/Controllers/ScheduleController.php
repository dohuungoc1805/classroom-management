<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the schedules.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $schedules = Auth::user()->isAdmin() 
            ? Schedule::with(['room', 'user'])->get()
            : Schedule::with(['room', 'user'])->where('userId', Auth::id())->get();

        $rooms = Room::all();
        $users = User::all();
        return view('dashboard', compact('schedules', 'rooms', 'users'));
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'roomId' => ['required', 'exists:rooms,id'],
            'startTime' => ['required', 'date'],
            'endTime' => ['required', 'date', 'after:startTime'],
            'purpose' => ['required', 'string', 'max:255'],
        ]);

        $startTime = Carbon::parse($request->startTime);
        $endTime = Carbon::parse($request->endTime);

        // Check for scheduling conflicts
        $conflict = Schedule::where('roomId', $request->roomId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('startTime', [$startTime, $endTime])
                    ->orWhereBetween('endTime', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('startTime', '<=', $startTime)
                            ->where('endTime', '>=', $endTime);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['conflict' => 'Phòng đã được đặt trong khoảng thời gian này!']);
        }

        Schedule::create([
            'roomId' => $request->roomId,
            'userId' => Auth::id(),
            'startTime' => $startTime,
            'endTime' => $endTime,
            'purpose' => $request->purpose,
        ]);

        return redirect()->route('dashboard')->with('success', 'Đặt phòng thành công!');
    }

    /**
     * Update the specified schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Schedule $schedule)
    {
        if (!Auth::user()->isAdmin() && $schedule->userId !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền sửa lịch này!');
        }

        $request->validate([
            'roomId' => ['required', 'exists:rooms,id'],
            'startTime' => ['required', 'date'],
            'endTime' => ['required', 'date', 'after:startTime'],
            'purpose' => ['required', 'string', 'max:255'],
        ]);

        $startTime = Carbon::parse($request->startTime);
        $endTime = Carbon::parse($request->endTime);

        // Check for scheduling conflicts (excluding current schedule)
        $conflict = Schedule::where('roomId', $request->roomId)
            ->where('id', '!=', $schedule->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('startTime', [$startTime, $endTime])
                    ->orWhereBetween('endTime', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('startTime', '<=', $startTime)
                            ->where('endTime', '>=', $endTime);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['conflict' => 'Phòng đã được đặt trong khoảng thời gian này!']);
        }

        $schedule->update([
            'roomId' => $request->roomId,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'purpose' => $request->purpose,
        ]);

        return redirect()->route('dashboard')->with('success', 'Cập nhật lịch đặt phòng thành công!');
    }

    /**
     * Remove the specified schedule from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Schedule $schedule)
    {
        if (!Auth::user()->isAdmin() && $schedule->userId !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền xóa lịch này!');
        }

        $schedule->delete();
        return redirect()->route('dashboard')->with('success', 'Xóa lịch đặt phòng thành công!');
    }
}