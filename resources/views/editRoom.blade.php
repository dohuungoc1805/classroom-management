<div id="editRoomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editRoomModal')">&times;</span>
        <h2>Sửa phòng học</h2>
        <form method="POST" id="editRoomForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editRoomId" name="id">
            <div class="form-group">
                <label for="editRoomName">Tên phòng:</label>
                <input type="text" id="editRoomName" name="name" required class="form-control">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRoomCapacity">Sức chứa:</label>
                <input type="number" id="editRoomCapacity" name="capacity" min="1" required class="form-control">
                @error('capacity')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRoomLocation">Vị trí:</label>
                <input type="text" id="editRoomLocation" name="location" required class="form-control">
                @error('location')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editRoomEquipment">Thiết bị:</label>
                <textarea id="editRoomEquipment" name="equipment" class="form-control"></textarea>
                @error('equipment')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>