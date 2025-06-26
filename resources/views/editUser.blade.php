<div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editUserModal')">&times;</span>
        <h2>Sửa người dùng</h2>
        <form method="POST" id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editUserId" name="id">
            <div class="form-group">
                <label for="editUserUsername">Tên đăng nhập:</label>
                <input type="text" id="editUserUsername" name="username" required class="form-control">
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editUserFullName">Họ tên:</label>
                <input type="text" id="editUserFullName" name="fullName" required class="form-control">
                @error('fullName')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editUserEmail">Email:</label>
                <input type="email" id="editUserEmail" name="email" required class="form-control">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editUserPassword">Mật khẩu mới (để trống nếu không đổi):</label>
                <input type="password" id="editUserPassword" name="password" class="form-control">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editUserPasswordConfirmation">Xác nhận mật khẩu:</label>
                <input type="password" id="editUserPasswordConfirmation" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <label for="editUserRole">Vai trò:</label>
                <select id="editUserRole" name="role" required class="form-control">
                    <option value="admin">Quản trị viên</option>
                    <option value="user">Người dùng</option>
                </select>
                @error('role')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>