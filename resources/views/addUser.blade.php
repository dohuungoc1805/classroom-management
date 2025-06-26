<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addUserModal')">&times;</span>
        <h2>Thêm người dùng</h2>
        <form method="POST" action="{{ route('users.store') }}" id="addUserForm">
            @csrf
            <div class="form-group">
                <label for="userUsername">Tên đăng nhập:</label>
                <input type="text" id="userUsername" name="username" required class="form-control">
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userFullName">Họ tên:</label>
                <input type="text" id="userFullName" name="fullName" required class="form-control">
                @error('fullName')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" name="email" required class="form-control">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userPassword">Mật khẩu:</label>
                <input type="password" id="userPassword" name="password" required class="form-control">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="userPasswordConfirmation">Xác nhận mật khẩu:</label>
                <input type="password" id="userPasswordConfirmation" name="password_confirmation" required class="form-control">
            </div>
            <div class="form-group">
                <label for="userRole">Vai trò:</label>
                <select id="userRole" name="role" required class="form-control">
                    <option value="admin">Quản trị viên</option>
                    <option value="user" selected>Người dùng</option>
                </select>
                @error('role')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm người dùng</button>
        </form>
    </div>
</div>