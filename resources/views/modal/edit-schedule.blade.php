<!-- Edit Schedule Modal -->
<div id="editScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editScheduleModal')">&times;</span>
        <h3>Sửa lịch đặt phòng</h3>
        <form id="editScheduleForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_schedule_roomId">Phòng học:</label>
                <select id="edit_schedule_roomId" name="roomId" required>
                    <option value="">Chọn phòng học</option>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} - {{ $room->location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit_schedule_startTime">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="edit_schedule_startTime" name="startTime" required>
            </div>
            <div class="form-group">
                <label for="edit_schedule_endTime">Thời gian kết thúc:</label>
                <input type="datetime-local" id="edit_schedule_endTime" name="endTime" required>
            </div>
            <div class="form-group">
                <label for="edit_schedule_purpose">Mục đích:</label>
                <input type="text" id="edit_schedule_purpose" name="purpose" required>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editScheduleModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>