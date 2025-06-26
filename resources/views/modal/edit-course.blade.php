<!-- Edit Course Modal -->
<div id="editCourseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editCourseModal')">&times;</span>
        <h3>Sửa thông tin môn học</h3>
        <form id="editCourseForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_course_name">Tên môn học:</label>
                <input type="text" id="edit_course_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_course_code">Mã môn học:</label>
                <input type="text" id="edit_course_code" name="code" required>
            </div>
            <div class="form-group">
                <label for="edit_course_description">Mô tả:</label>
                <textarea id="edit_course_description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="edit_course_credits">Số tín chỉ:</label>
                <input type="number" id="edit_course_credits" name="credits" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="edit_course_instructorId">Giảng viên:</label>
                <select id="edit_course_instructorId" name="instructorId" required>
                    <option value="">Chọn giảng viên</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editCourseModal')">Hủy</button>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>