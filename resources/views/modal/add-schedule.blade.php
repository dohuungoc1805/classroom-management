<!-- Add Schedule Modal -->
<div id="addScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addScheduleModal')">&times;</span>
        <h2>Đặt phòng học</h2>
        <form method="POST" action="{{ route('schedules.store') }}">
            @csrf
            <div class="form-group">
                <label for="roomId">Phòng:</label>
                <select id="roomId" name="roomId" required>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="courseId">Môn học:</label>
                <select id="courseId" name="courseId" required>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="dayOfWeek">Thứ trong tuần:</label>
                <select id="dayOfWeek" name="dayOfWeek" required>
                    <option value="Monday">Thứ 2</option>
                    <option value="Tuesday">Thứ 3</option>
                    <option value="Wednesday">Thứ 4</option>
                    <option value="Thursday">Thứ 5</option>
                    <option value="Friday">Thứ 6</option>
                    <option value="Saturday">Thứ 7</option>
                    <option value="Sunday">Chủ nhật</option>
                </select>
            </div>
            <div class="form-group">
                <label for="startTime">Thời gian bắt đầu:</label>
                <input type="time" id="startTime" name="startTime" required>
            </div>
            <div class="form-group">
                <label for="endTime">Thời gian kết thúc:</label>
                <input type="time" id="endTime" name="endTime" required>
            </div>
            <div class="form-group">
                <label for="startDate">Ngày bắt đầu:</label>
                <input type="date" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="endDate">Ngày kết thúc:</label>
                <input type="date" id="endDate" name="endDate" required>
            </div>
            <button type="submit" class="btn">Đặt phòng</button>
        </form>
    </div>
</div>