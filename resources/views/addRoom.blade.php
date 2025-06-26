<div id="addRoomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addRoomModal')">&times;</span>
        <h2>Thêm phòng học</h2>
        <form method="POST" action="{{ route('rooms.store') }}" id="addRoomForm">
            @csrf
            <div class="form-group">
                <label for="roomName">Tên phòng:</label>
                <input type="text" id="roomName" name="name" required class="form-control">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="roomCapacity">Sức chứa:</label>
                <input type="number" id="roomCapacity" name="capacity" min="1" required class="form-control">
                @error('capacity')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="roomLocation">Vị trí:</label>
                <input type="text" id="roomLocation" name="location" required class="form-control">
                @error('location')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="roomEquipment">Thiết bị:</label>
                <textarea id="roomEquipment" name="equipment" class="form-control"></textarea>
                @error('equipment')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm phòng</button>
        </form>
    </div>
</div>