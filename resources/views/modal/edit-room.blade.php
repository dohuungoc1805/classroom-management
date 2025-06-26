<!-- Edit Room Modal -->
<div id="editRoomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editRoomModal')">&times;</span>
        <h3>Sửa thông tin phòng học</h3>
        <form id="editRoomForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_room_name">Tên phòng:</label>
                <input type="text" id="edit_room_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_room_capacity">Sức chứa:</label>
                <input type="number" id="edit_room_capacity" name="capacity" min="1" required>
            </div>
            <div class="form-group">
                <label for="edit_room_location">Vị trí:</label>
                <input type="text" id="edit_room_location" name="location" required>
            </div>
            <div class="form-group">
                <label for="edit_room_equipment">Thiết bị:</label>
                <textarea id="edit_room_equipment" name="equipment" rows="3"></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editRoomModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>