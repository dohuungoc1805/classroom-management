<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Course;
use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('index');
    }

    /**
     * Display a listing of the rooms and other data for the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rooms = Room::all();
        $schedules = Auth::user()->isAdmin()
            ? Schedule::with(['room', 'user'])->get()
            : Schedule::with(['room', 'user'])->where('userId', Auth::id())->get();
        $courses = Course::with('instructor')->get();
        $users = User::all();
        $bookingRequests = Auth::user()->isAdmin()
            ? BookingRequest::with(['user', 'room', 'course'])->get()
            : BookingRequest::with(['user', 'room', 'course'])->where('userId', Auth::id())->get();

        // Calculate stats
        $totalRooms = $rooms->count();
        $totalBookings = $schedules->count();
        $totalCourses = $courses->count();
        $pendingRequests = $bookingRequests->where('status', 'pending')->count();

        return view('dashboard', compact(
            'rooms',
            'schedules',
            'courses',
            'users',
            'bookingRequests',
            'totalRooms',
            'totalBookings',
            'totalCourses',
            'pendingRequests'
        ));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:rooms'],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'equipment' => ['nullable', 'string'],
        ]);

        Room::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Thêm phòng học thành công!');
    }

    /**
     * Update the specified room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('rooms')->ignore($room->id)],
            'capacity' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'equipment' => ['nullable', 'string'],
        ]);

        $room->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Cập nhật phòng học thành công!');
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Room $room)
    {
        // Check if the room is used in any schedules or booking requests
        if ($room->schedules()->exists() || $room->bookingRequests()->exists()) {
            return redirect()->route('dashboard')->with('error', 'Không thể xóa phòng vì đang được sử dụng trong lịch hoặc yêu cầu đặt phòng!');
        }

        $room->delete();
        return redirect()->route('dashboard')->with('success', 'Xóa phòng học thành công!');
    }
}
