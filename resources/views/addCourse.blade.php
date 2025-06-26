<div id="addCourseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addCourseModal')">&times;</span>
        <h2>Thêm môn học</h2>
        <form method="POST" action="{{ route('courses.store') }}" id="addCourseForm">
            @csrf
            <div class="form-group">
                <label for="courseName">Tên môn học:</label>
                <input type="text" id="courseName" name="name" required class="form-control">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="courseCode">Mã môn học:</label>
                <input type="text" id="courseCode" name="code" required class="form-control">
                @error('code')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="courseInstructor">Giảng viên:</label>
                <select id="courseInstructor" name="instructorId" required class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
                @error('instructorId')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm môn học</button>
        </form>
    </div>
</div>