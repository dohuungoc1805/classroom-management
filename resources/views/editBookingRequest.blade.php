<div id="editBookingRequestModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editBookingRequestModal')">&times;</span>
        <h2>Sửa yêu cầu đặt phòng</h2>
        <form method="POST" id="editBookingRequestForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editRequestId" name="id">
            <div class="form-group">
                <label for="editRequestRoom">Phòng:</label>
                <select id="editRequestRoom" name="roomId" required class="form-control">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
                @error('roomId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRequestCourse">Môn học:</label>
                <select id="editRequestCourse" name="courseId" required class="form-control">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
                @error('courseId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRequestRequestedAt">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="editRequestRequestedAt" name="requestedAt" required class="form-control">
                @error('requestedAt')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRequestEndTime">Thời gian kết thúc:</label>
                <input type="datetime-local" id="editRequestEndTime" name="endTime" required class="form-control">
                @error('endTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>