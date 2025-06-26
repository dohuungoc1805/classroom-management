<!-- Add Room Modal -->
<div id="addRoomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addRoomModal')">&times;</span>
        <h2>Thêm phòng học mới</h2>
        <form method="POST" action="{{ route('rooms.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Tên phòng:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="capacity">Sức chứa:</label>
                <input type="number" id="capacity" name="capacity" required>
            </div>
            <div class="form-group">
                <label for="location">Vị trí:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="equipment">Thiết bị:</label>
                <textarea id="equipment" name="equipment" rows="3" placeholder="Mô tả thiết bị có trong phòng"></textarea>
            </div>
            <button type="submit" class="btn">Thêm phòng</button>
        </form>
    </div>
</div>