<div id="addScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addScheduleModal')">&times;</span>
        <h2>Đặt phòng</h2>
        <form method="POST" action="{{ route('schedules.store') }}" id="addScheduleForm">
            @csrf
            <div class="form-group">
                <label for="scheduleRoom">Phòng:</label>
                <select id="scheduleRoom" name="roomId" required class="form-control">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
                @error('roomId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="scheduleStartTime">Thời gian bắt đầu:</label>
                <input type="datetime-local" id="scheduleStartTime" name="startTime" required class="form-control">
                @error('startTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="scheduleEndTime">Thời gian kết thúc:</label>
                <input type="datetime-local" id="scheduleEndTime" name="endTime" required class="form-control">
                @error('endTime')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="schedulePurpose">Mục đích:</label>
                <textarea id="schedulePurpose" name="purpose" required class="form-control"></textarea>
                @error('purpose')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Đặt phòng</button>
        </form>
    </div>
</div>