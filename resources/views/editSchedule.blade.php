<div id="editScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editScheduleModal')">&times;</span>
        <h2>Sửa lịch đặt phòng</h2>
        <form method="POST" id="editScheduleForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editScheduleId" name="id">
            <div class="form-group">
                <label for="editScheduleRoom">Phòng:</label>
                <select id="editScheduleRoom" name="roomId" required class="form-control">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
                @error('roomId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editScheduleStartTime">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="editScheduleStartTime" name="startTime" required class="form-control">
                @error('startTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editScheduleEndTime">Thời gian kết thúc:</label>
                <input type="datetime-local" id="editScheduleEndTime" name="endTime" required class="form-control">
                @error('endTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editSchedulePurpose">Mục đích:</label>
                <textarea id="editSchedulePurpose" name="purpose" required class="form-control"></textarea>
                @error('purpose')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>