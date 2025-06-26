<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\BookingRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'username' => 'admin',
            'fullName' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users
        $user1 = User::create([
            'username' => 'giaovien1',
            'fullName' => 'Nguyễn Văn A',
            'email' => 'giaovien1@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'username' => 'giaovien2',
            'fullName' => 'Trần Thị B',
            'email' => 'giaovien2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create rooms
        $room1 = Room::create([
            'name' => 'Phòng 101',
            'capacity' => 30,
            'location' => 'Tầng 1',
            'equipment' => 'Máy chiếu, Máy tính, Bảng thông minh',
        ]);

        $room2 = Room::create([
            'name' => 'Phòng 102',
            'capacity' => 25,
            'location' => 'Tầng 1',
            'equipment' => 'Máy chiếu, Loa',
        ]);

        $room3 = Room::create([
            'name' => 'Phòng 201',
            'capacity' => 40,
            'location' => 'Tầng 2',
            'equipment' => 'Máy chiếu, Điều hòa, Micro',
        ]);

        // Create courses
        $course1 = Course::create([
            'name' => 'Lập trình Web',
            'code' => 'LTW001',
            'description' => 'Khóa học lập trình web cơ bản với HTML, CSS, JavaScript',
            'credits' => 3,
            'instructorId' => $user1->id,
        ]);

        $course2 = Course::create([
            'name' => 'Cơ sở dữ liệu',
            'code' => 'CSDL001',
            'description' => 'Khóa học về hệ quản trị cơ sở dữ liệu',
            'credits' => 4,
            'instructorId' => $user2->id,
        ]);

        $course3 = Course::create([
            'name' => 'Lập trình hướng đối tượng',
            'code' => 'OOP001',
            'description' => 'Khóa học lập trình hướng đối tượng với Java',
            'credits' => 3,
            'instructorId' => $user1->id,
        ]);

        // Create schedules
        Schedule::create([
            'roomId' => $room1->id,
            'userId' => $user1->id,
            'startTime' => Carbon::now()->setTime(8, 0),
            'endTime' => Carbon::now()->setTime(10, 0),
            'purpose' => 'Giảng dạy môn Lập trình Web',
        ]);

        Schedule::create([
            'roomId' => $room2->id,
            'userId' => $user2->id,
            'startTime' => Carbon::now()->addDay()->setTime(14, 0),
            'endTime' => Carbon::now()->addDay()->setTime(16, 0),
            'purpose' => 'Giảng dạy môn Cơ sở dữ liệu',
        ]);

        // Create booking requests
        BookingRequest::create([
            'userId' => $user1->id,
            'roomId' => $room3->id,
            'courseId' => $course3->id,
            'requestDate' => Carbon::now()->addDays(1),
            'startTime' => '09:00',
            'endTime' => '11:00',
            'purpose' => 'Dạy thêm môn Lập trình hướng đối tượng',
            'status' => 'pending',
        ]);

        BookingRequest::create([
            'userId' => $user2->id,
            'roomId' => $room1->id,
            'courseId' => $course2->id,
            'requestDate' => Carbon::now()->addDays(2),
            'startTime' => '13:00',
            'endTime' => '15:00',
            'purpose' => 'Bài kiểm tra giữa kỳ',
            'status' => 'approved',
        ]);
    }
}
