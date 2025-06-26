<!-- Edit Booking Request Modal -->
<div id="editBookingRequestModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editBookingRequestModal')">&times;</span>
        <h3>Sửa yêu cầu đặt phòng</h3>
        <form id="editBookingRequestForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_request_roomId">Phòng học:</label>
                <select id="edit_request_roomId" name="roomId" required>
                    <option value="">Chọn phòng học</option>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} - {{ $room->location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit_request_courseId">Môn học:</label>
                <select id="edit_request_courseId" name="courseId" required>
                    <option value="">Chọn môn học</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit_request_requestDate">Ngày:</label>
                <input type="date" id="edit_request_requestDate" name="requestDate" required>
            </div>
            <div class="form-group">
                <label for="edit_request_startTime">Thời gian bắt đầu:</label>
                <input type="time" id="edit_request_startTime" name="startTime" required>
            </div>
            <div class="form-group">
                <label for="edit_request_endTime">Thời gian kết thúc:</label>
                <input type="time" id="edit_request_endTime" name="endTime" required>
            </div>
            <div class="form-group">
                <label for="edit_request_purpose">Mục đích:</label>
                <textarea id="edit_request_purpose" name="purpose" rows="3" required></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editBookingRequestModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>