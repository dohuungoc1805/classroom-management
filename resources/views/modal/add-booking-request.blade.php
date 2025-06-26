<!-- Add Booking Request Modal -->
<div id="addRequestModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addRequestModal')">&times;</span>
        <h2>Tạo yêu cầu đặt phòng</h2>

        @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('requests.store') }}">
            @csrf
            <div class="form-group">
                <label for="roomId">Phòng:</label>
                <select id="roomId" name="roomId" required>
                    <option value="">Chọn phòng</option>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('roomId') == $room->id ? 'selected' : '' }}>{{ $room->name }} ({{ $room->capacity }} chỗ)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="courseId">Môn học:</label>
                <select id="courseId" name="courseId" required>
                    <option value="">Chọn môn học</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('courseId') == $course->id ? 'selected' : '' }}>{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="requestDate">Ngày yêu cầu:</label>
                <input type="date" id="requestDate" name="requestDate" value="{{ old('requestDate') }}" required>
            </div>
            <div class="form-group">
                <label for="startTime">Thời gian bắt đầu:</label>
                <input type="time" id="startTime" name="startTime" value="{{ old('startTime') }}" required>
            </div>
            <div class="form-group">
                <label for="endTime">Thời gian kết thúc:</label>
                <input type="time" id="endTime" name="endTime" value="{{ old('endTime') }}" required>
            </div>
            <div class="form-group">
                <label for="purpose">Mục đích:</label>
                <textarea id="purpose" name="purpose" rows="3" required placeholder="Mô tả mục đích sử dụng phòng">{{ old('purpose') }}</textarea>
            </div>
            <button type="submit" class="btn">Tạo yêu cầu</button>
        </form>
    </div>
</div>