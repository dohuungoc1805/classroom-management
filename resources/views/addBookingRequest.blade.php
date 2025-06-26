<div id="addBookingRequestModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addBookingRequestModal')">&times;</span>
        <h2>Thêm yêu cầu đặt phòng</h2>
        <form method="POST" action="{{ route('requests.store') }}" id="addBookingRequestForm">
            @csrf
            <div class="form-group">
                <label for="requestRoom">Phòng:</label>
                <select id="requestRoom" name="roomId" required class="form-control">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
                @error('roomId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="requestCourse">Môn học:</label>
                <select id="requestCourse" name="courseId" required class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
                @error('courseId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="requestRequestedAt">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="requestRequestedAt" name="requestedAt" required class="form-control">
                @error('requestedAt')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="requestEndTime">Thời gian kết thúc:</label>
                <input type="datetime-local" id="requestEndTime" name="endTime" required class="form-control">
                @error('endTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
        </form>
    </div>
</div>