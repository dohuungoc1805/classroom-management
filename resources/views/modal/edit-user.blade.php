<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editUserModal')">&times;</span>
        <h3>Sửa thông tin người dùng</h3>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_user_username">Tên đăng nhập:</label>
                <input type="text" id="edit_user_username" name="username" required>
            </div>
            <div class="form-group">
                <label for="edit_user_fullName">Họ và tên:</label>
                <input type="text" id="edit_user_fullName" name="fullName" required>
            </div>
            <div class="form-group">
                <label for="edit_user_email">Email:</label>
                <input type="email" id="edit_user_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="edit_user_role">Vai trò:</label>
                <select id="edit_user_role" name="role" required>
                    <option value="user">Người dùng</option>
                    <option value="admin">Quản trị viên</option>
                </select>
            </div>
            <div class="form-group">
                <label for="edit_user_password">Mật khẩu mới (để trống nếu không đổi):</label>
                <input type="password" id="edit_user_password" name="password">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editUserModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>