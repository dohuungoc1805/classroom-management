<!-- Add Course Modal -->
<div id="addCourseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addCourseModal')">&times;</span>
        <h2>Thêm môn học mới</h2>
        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Tên môn học:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="code">Mã môn học:</label>
                <input type="text" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="credits">Số tín chỉ:</label>
                <input type="number" id="credits" name="credits" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="instructorId">Giảng viên:</label>
                <select id="instructorId" name="instructorId" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn">Thêm môn học</button>
        </form>
    </div>
</div>