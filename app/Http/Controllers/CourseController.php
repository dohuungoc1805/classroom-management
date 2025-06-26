<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
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
     * Display a listing of the courses and other data for the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $courses = Course::with('instructor')->get();
        $rooms = Room::all();
        $schedules = Auth::user()->isAdmin()
            ? Schedule::with(['room', 'user'])->get()
            : Schedule::with(['room', 'user'])->where('userId', Auth::id())->get();
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
            'courses',
            'rooms',
            'schedules',
            'users',
            'bookingRequests',
            'totalRooms',
            'totalBookings',
            'totalCourses',
            'pendingRequests'
        ));
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:courses'],
            'instructorId' => ['required', 'exists:users,id'],
            'credits' => ['required', 'integer', 'min:1', 'max:10'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Course::create([
            'name' => $request->name,
            'code' => $request->code,
            'instructorId' => $request->instructorId,
            'credits' => $request->credits,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Thêm môn học thành công!');
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('courses')->ignore($course->id)],
            'instructorId' => ['required', 'exists:users,id'],
            'credits' => ['required', 'integer', 'min:1', 'max:10'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $course->update([
            'name' => $request->name,
            'code' => $request->code,
            'instructorId' => $request->instructorId,
            'credits' => $request->credits,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Cập nhật môn học thành công!');
    }

    /**
     * Remove the specified course from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course)
    {
        // Check if the course is used in any booking requests
        if ($course->bookingRequests()->exists()) {
            return redirect()->route('dashboard')->with('error', 'Không thể xóa môn học vì đang được sử dụng trong yêu cầu đặt phòng!');
        }

        $course->delete();
        return redirect()->route('dashboard')->with('success', 'Xóa môn học thành công!');
    }
}
