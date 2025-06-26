<div id="editCourseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editCourseModal')">&times;</span>
        <h2>Sửa môn học</h2>
        <form method="POST" id="editCourseForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editCourseId" name="id">
            <div class="form-group">
                <label for="editCourseName">Tên môn học:</label>
                <input type="text" id="editCourseName" name="name" required class="form-control">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editCourseCode">Mã môn học:</label>
                <input type="text" id="editCourseCode" name="code" required class="form-control">
                @error('code')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="editCourseInstructor">Giảng viên:</label>
                <select id="editCourseInstructor" name="instructorId" required class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
                @error('instructorId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>