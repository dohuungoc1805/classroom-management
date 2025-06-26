<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Lớp học</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        
        .welcome-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
        }
        
        .welcome-container h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .welcome-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>🏫 Hệ thống Quản lý Lớp học</h1>
        <p>Chào mừng bạn đến với hệ thống quản lý lớp học. Vui lòng đăng nhập để tiếp tục.</p>
        
        @guest
            <a href="{{ route('login') }}" class="btn">Đăng nhập</a>
        @else
            <a href="{{ route('dashboard') }}" class="btn">Vào Dashboard</a>
        @endguest
    </div>
</body>
</html>
            document.getElementById('dashboard').style.display = 'none';
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }

        function setUserPermissions() {
            const isAdmin = currentUser.role === 'admin';

            // Hide admin-only elements for regular users
            document.getElementById('addRoomBtn').style.display = isAdmin ? 'inline-block' : 'none';
            document.getElementById('addCourseBtn').style.display = isAdmin ? 'inline-block' : 'none';
            document.getElementById('usersTab').style.display = isAdmin ? 'inline-block' : 'none';

            // Hide admin action columns for users
            const actionCells = document.querySelectorAll('.admin-only');
            actionCells.forEach(cell => {
                cell.style.display = isAdmin ? 'table-cell' : 'none';
            });
        }

        function showTab(tabName) {
            // Hide all tab panes
            const panes = document.querySelectorAll('.tab-pane');
            panes.forEach(pane => pane.classList.remove('active'));

            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.nav-tab');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');

            // Load data for the selected tab
            switch (tabName) {
                case 'rooms':
                    loadRooms();
                    break;
                case 'schedules':
                    loadSchedules();
                    break;
                case 'courses':
                    loadCourses();
                    break;
                case 'users':
                    if (currentUser.role === 'admin') loadUsers();
                    break;
                case 'requests':
                    loadBookingRequests();
                    break;
            }
        }

        function loadData() {
            loadRooms();
            populateDropdowns();
        }

        function loadRooms() {
            const tbody = document.getElementById('roomsTable');
            tbody.innerHTML = '';

            rooms.forEach(room => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${room.name}</td>
                    <td>${room.capacity}</td>
                    <td>${room.location}</td>
                    <td>${room.equipment}</td>
                    <td class="admin-only">
                        ${currentUser.role === 'admin' ? 
                            `<button class="btn" onclick="editRoom(${room.id})">Sửa</button>
                             <button class="btn btn-danger" onclick="deleteRoom(${room.id})">Xóa</button>` : 
                            ''
                        }
                    </td>
                `;
            });
        }

        function loadSchedules() {
            const tbody = document.getElementById('schedulesTable');
            tbody.innerHTML = '';

            schedules.forEach(schedule => {
                const room = rooms.find(r => r.id === schedule.roomId);
                const user = users.find(u => u.id === schedule.userId);
                const row = tbody.insertRow();

                row.innerHTML = `
                    <td>${room ? room.name : 'N/A'}</td>
                    <td>${user ? user.fullName : 'N/A'}</td>
                    <td>${new Date(schedule.startTime).toLocaleString('vi-VN')}</td>
                    <td>${new Date(schedule.endTime).toLocaleString('vi-VN')}</td>
                    <td>${schedule.purpose}</td>
                    <td>
                        ${currentUser.role === 'admin' || currentUser.id === schedule.userId ? 
                            `<button class="btn" onclick="editSchedule(${schedule.id})">Sửa</button>
                             <button class="btn btn-danger" onclick="deleteSchedule(${schedule.id})">Xóa</button>` : 
                            ''
                        }
                    </td>
                `;
            });
        }

        function loadCourses() {
            const tbody = document.getElementById('coursesTable');
            tbody.innerHTML = '';

            courses.forEach(course => {
                const instructor = users.find(u => u.id === course.instructorId);
                const row = tbody.insertRow();

                row.innerHTML = `
                    <td>${course.name}</td>
                    <td>${course.code}</td>
                    <td>${instructor ? instructor.fullName : 'N/A'}</td>
                    <td class="admin-only">
                        ${currentUser.role === 'admin' ? 
                            `<button class="btn" onclick="editCourse(${course.id})">Sửa</button>
                             <button class="btn btn-danger" onclick="deleteCourse(${course.id})">Xóa</button>` : 
                            ''
                        }
                    </td>
                `;
            });
        }

        function loadUsers() {
            if (currentUser.role !== 'admin') return;

            const tbody = document.getElementById('usersTable');
            tbody.innerHTML = '';

            users.forEach(user => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td>${user.username}</td>
                    <td>${user.fullName}</td>
                    <td>${user.email}</td>
                    <td>${user.role === 'admin' ? 'Quản trị viên' : 'Người dùng'}</td>
                    <td>
                        ${user.id !== currentUser.id ? 
                            `<button class="btn" onclick="editUser(${user.id})">Sửa</button>
                             <button class="btn btn-danger" onclick="deleteUser(${user.id})">Xóa</button>` : 
                            ''
                        }
                    </td>
                `;
            });
        }

        function loadBookingRequests() {
            const tbody = document.getElementById('requestsTable');
            tbody.innerHTML = '';

            const userRequests = currentUser.role === 'admin' ?
                bookingRequests :
                bookingRequests.filter(req => req.userId === currentUser.id);

            userRequests.forEach(request => {
                const user = users.find(u => u.id === request.userId);
                const room = rooms.find(r => r.id === request.roomId);
                const course = courses.find(c => c.id === request.courseId);
                const row = tbody.insertRow();

                const statusClass = request.status === 'pending' ? 'status-pending' :
                    request.status === 'approved' ? 'status-approved' : 'status-rejected';
                const statusText = request.status === 'pending' ? 'Chờ duyệt' :
                    request.status === 'approved' ? 'Đã duyệt' : 'Từ chối';

                row.innerHTML = `
                    <td>${user ? user.fullName : 'N/A'}</td>
                    <td>${room ? room.name : 'N/A'}</td>
                    <td>${course ? course.name : 'N/A'}</td>
                    <td>${new Date(request.requestedAt).toLocaleString('vi-VN')}</td>
                    <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    <td>
                        ${currentUser.role === 'admin' && request.status === 'pending' ? 
                            `<button class="btn btn-success" onclick="approveRequest(${request.id})">Duyệt</button>
                             <button class="btn btn-danger" onclick="rejectRequest(${request.id})">Từ chối</button>` : 
                            ''
                        }
                        ${currentUser.id === request.userId ? 
                            `<button class="btn btn-danger" onclick="deleteRequest(${request.id})">Xóa</button>` : 
                            ''
                        }
                    </td>
                `;
            });
        }

        function populateDropdowns() {
            // Populate room dropdown for add schedule
            const roomSelect = document.getElementById('scheduleRoom');
            roomSelect.innerHTML = '';
            rooms.forEach(room => {
                const option = document.createElement('option');
                option.value = room.id;
                option.textContent = `${room.name} (${room.capacity} chỗ)`;
                roomSelect.appendChild(option);
            });

            // Populate room dropdown for edit schedule
            const editRoomSelect = document.getElementById('editScheduleRoom');
            if (editRoomSelect) {
                editRoomSelect.innerHTML = '';
                rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = `${room.name} (${room.capacity} chỗ)`;
                    editRoomSelect.appendChild(option);
                });
            }

            // Populate instructor dropdown for add course
            const instructorSelect = document.getElementById('courseInstructor');
            instructorSelect.innerHTML = '';
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.fullName;
                instructorSelect.appendChild(option);
            });

            // Populate instructor dropdown for edit course
            const editInstructorSelect = document.getElementById('editCourseInstructor');
            if (editInstructorSelect) {
                editInstructorSelect.innerHTML = '';
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.fullName;
                    editInstructorSelect.appendChild(option);
                });
            }
        }

        function updateStats() {
            document.getElementById('totalRooms').textContent = rooms.length;
            document.getElementById('totalBookings').textContent = schedules.length;
            document.getElementById('totalCourses').textContent = courses.length;
            document.getElementById('pendingRequests').textContent =
                bookingRequests.filter(req => req.status === 'pending').length;
        }

        // Modal functions
        function showAddRoomModal() {
            if (currentUser.role !== 'admin') return;
            document.getElementById('addRoomModal').style.display = 'block';
        }

        function showAddScheduleModal() {
            populateDropdowns();
            document.getElementById('addScheduleModal').style.display = 'block';
        }

        function showAddCourseModal() {
            if (currentUser.role !== 'admin') return;
            populateDropdowns();
            document.getElementById('addCourseModal').style.display = 'block';
        }

        function showAddUserModal() {
            if (currentUser.role !== 'admin') return;
            document.getElementById('addUserModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            // Reset form
            const form = document.querySelector(`#${modalId} form`);
            if (form) form.reset();
        }

        // Add functions
        function addRoom(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const newRoom = {
                id: Date.now(),
                name: document.getElementById('roomName').value,
                capacity: parseInt(document.getElementById('roomCapacity').value),
                location: document.getElementById('roomLocation').value,
                equipment: document.getElementById('roomEquipment').value
            };

            rooms.push(newRoom);
            loadRooms();
            updateStats();
            closeModal('addRoomModal');
            alert('Thêm phòng học thành công!');
        }

        function addSchedule(event) {
            event.preventDefault();

            const startTime = new Date(document.getElementById('scheduleStart').value);
            const endTime = new Date(document.getElementById('scheduleEnd').value);

            if (startTime >= endTime) {
                alert('Thời gian bắt đầu phải trước thời gian kết thúc!');
                return;
            }

            // Check for conflicts
            const roomId = parseInt(document.getElementById('scheduleRoom').value);
            const hasConflict = schedules.some(schedule => {
                if (schedule.roomId !== roomId) return false;
                const schedStart = new Date(schedule.startTime);
                const schedEnd = new Date(schedule.endTime);
                return (startTime < schedEnd && endTime > schedStart);
            });

            if (hasConflict) {
                alert('Phòng đã được đặt trong khoảng thời gian này!');
                return;
            }

            const newSchedule = {
                id: Date.now(),
                roomId: roomId,
                userId: currentUser.id,
                startTime: document.getElementById('scheduleStart').value,
                endTime: document.getElementById('scheduleEnd').value,
                purpose: document.getElementById('schedulePurpose').value
            };

            schedules.push(newSchedule);
            loadSchedules();
            updateStats();
            closeModal('addScheduleModal');
            alert('Đặt phòng thành công!');
        }

        function addCourse(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const newCourse = {
                id: Date.now(),
                name: document.getElementById('courseName').value,
                code: document.getElementById('courseCode').value,
                instructorId: parseInt(document.getElementById('courseInstructor').value)
            };

            courses.push(newCourse);
            loadCourses();
            updateStats();
            closeModal('addCourseModal');
            alert('Thêm môn học thành công!');
        }

        function addUser(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const username = document.getElementById('newUsername').value;
            if (users.find(u => u.username === username)) {
                alert('Tên đăng nhập đã tồn tại!');
                return;
            }

            const newUser = {
                id: Date.now(),
                username: username,
                password: document.getElementById('newPassword').value,
                fullName: document.getElementById('newFullName').value,
                email: document.getElementById('newEmail').value,
                role: document.getElementById('newRole').value
            };

            users.push(newUser);
            loadUsers();
            populateDropdowns();
            closeModal('addUserModal');
            alert('Thêm người dùng thành công!');
        }

        // Edit functions
        function editRoom(id) {
            if (currentUser.role !== 'admin') return;
            const room = rooms.find(r => r.id === id);
            if (!room) return;

            document.getElementById('editRoomId').value = room.id;
            document.getElementById('editRoomName').value = room.name;
            document.getElementById('editRoomCapacity').value = room.capacity;
            document.getElementById('editRoomLocation').value = room.location;
            document.getElementById('editRoomEquipment').value = room.equipment;

            document.getElementById('editRoomModal').style.display = 'block';
        }

        function editSchedule(id) {
            const schedule = schedules.find(s => s.id === id);
            if (!schedule) return;
            if (currentUser.role !== 'admin' && currentUser.id !== schedule.userId) return;

            populateDropdowns();
            document.getElementById('editScheduleId').value = schedule.id;
            document.getElementById('editScheduleRoom').value = schedule.roomId;
            document.getElementById('editScheduleStart').value = schedule.startTime;
            document.getElementById('editScheduleEnd').value = schedule.endTime;
            document.getElementById('editSchedulePurpose').value = schedule.purpose;

            document.getElementById('editScheduleModal').style.display = 'block';
        }

        function editCourse(id) {
            if (currentUser.role !== 'admin') return;
            const course = courses.find(c => c.id === id);
            if (!course) return;

            populateDropdowns();
            document.getElementById('editCourseId').value = course.id;
            document.getElementById('editCourseName').value = course.name;
            document.getElementById('editCourseCode').value = course.code;
            document.getElementById('editCourseInstructor').value = course.instructorId;

            document.getElementById('editCourseModal').style.display = 'block';
        }

        function editUser(id) {
            if (currentUser.role !== 'admin') return;
            const user = users.find(u => u.id === id);
            if (!user) return;

            document.getElementById('editUserId').value = user.id;
            document.getElementById('editUsername').value = user.username;
            document.getElementById('editFullName').value = user.fullName;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editPassword').value = '';
            document.getElementById('editRole').value = user.role;

            document.getElementById('editUserModal').style.display = 'block';
        }

        // Update functions
        function updateRoom(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const id = parseInt(document.getElementById('editRoomId').value);
            const roomIndex = rooms.findIndex(r => r.id === id);

            if (roomIndex !== -1) {
                rooms[roomIndex] = {
                    ...rooms[roomIndex],
                    name: document.getElementById('editRoomName').value,
                    capacity: parseInt(document.getElementById('editRoomCapacity').value),
                    location: document.getElementById('editRoomLocation').value,
                    equipment: document.getElementById('editRoomEquipment').value
                };

                loadRooms();
                populateDropdowns();
                closeModal('editRoomModal');
                alert('Cập nhật phòng học thành công!');
            }
        }

        function updateSchedule(event) {
            event.preventDefault();

            const id = parseInt(document.getElementById('editScheduleId').value);
            const scheduleIndex = schedules.findIndex(s => s.id === id);

            if (scheduleIndex === -1) return;
            if (currentUser.role !== 'admin' && currentUser.id !== schedules[scheduleIndex].userId) return;

            const startTime = new Date(document.getElementById('editScheduleStart').value);
            const endTime = new Date(document.getElementById('editScheduleEnd').value);

            if (startTime >= endTime) {
                alert('Thời gian bắt đầu phải trước thời gian kết thúc!');
                return;
            }

            // Check for conflicts (excluding current schedule)
            const roomId = parseInt(document.getElementById('editScheduleRoom').value);
            const hasConflict = schedules.some(schedule => {
                if (schedule.roomId !== roomId || schedule.id === id) return false;
                const schedStart = new Date(schedule.startTime);
                const schedEnd = new Date(schedule.endTime);
                return (startTime < schedEnd && endTime > schedStart);
            });

            if (hasConflict) {
                alert('Phòng đã được đặt trong khoảng thời gian này!');
                return;
            }

            schedules[scheduleIndex] = {
                ...schedules[scheduleIndex],
                roomId: roomId,
                startTime: document.getElementById('editScheduleStart').value,
                endTime: document.getElementById('editScheduleEnd').value,
                purpose: document.getElementById('editSchedulePurpose').value
            };

            loadSchedules();
            closeModal('editScheduleModal');
            alert('Cập nhật lịch đặt phòng thành công!');
        }

        function updateCourse(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const id = parseInt(document.getElementById('editCourseId').value);
            const courseIndex = courses.findIndex(c => c.id === id);

            if (courseIndex !== -1) {
                courses[courseIndex] = {
                    ...courses[courseIndex],
                    name: document.getElementById('editCourseName').value,
                    code: document.getElementById('editCourseCode').value,
                    instructorId: parseInt(document.getElementById('editCourseInstructor').value)
                };

                loadCourses();
                closeModal('editCourseModal');
                alert('Cập nhật môn học thành công!');
            }
        }

        function updateUser(event) {
            event.preventDefault();
            if (currentUser.role !== 'admin') return;

            const id = parseInt(document.getElementById('editUserId').value);
            const userIndex = users.findIndex(u => u.id === id);

            if (userIndex === -1) return;

            const username = document.getElementById('editUsername').value;
            const existingUser = users.find(u => u.username === username && u.id !== id);

            if (existingUser) {
                alert('Tên đăng nhập đã tồn tại!');
                return;
            }

            const newPassword = document.getElementById('editPassword').value;

            users[userIndex] = {
                ...users[userIndex],
                username: username,
                fullName: document.getElementById('editFullName').value,
                email: document.getElementById('editEmail').value,
                role: document.getElementById('editRole').value
            };

            // Only update password if provided
            if (newPassword.trim() !== '') {
                users[userIndex].password = newPassword;
            }

            loadUsers();
            populateDropdowns();
            closeModal('editUserModal');
            alert('Cập nhật người dùng thành công!');
        }

        function deleteRoom(id) {
            if (currentUser.role !== 'admin') return;
            if (confirm('Bạn có chắc muốn xóa phòng này?')) {
                rooms = rooms.filter(room => room.id !== id);
                loadRooms();
                updateStats();
            }
        }

        function deleteSchedule(id) {
            const schedule = schedules.find(s => s.id === id);
            if (currentUser.role !== 'admin' && currentUser.id !== schedule.userId) return;

            if (confirm('Bạn có chắc muốn xóa lịch đặt phòng này?')) {
                schedules = schedules.filter(schedule => schedule.id !== id);
                loadSchedules();
                updateStats();
            }
        }

        function deleteCourse(id) {
            if (currentUser.role !== 'admin') return;
            if (confirm('Bạn có chắc muốn xóa môn học này?')) {
                courses = courses.filter(course => course.id !== id);
                loadCourses();
                updateStats();
            }
        }

        function deleteUser(id) {
            if (currentUser.role !== 'admin') return;
            if (confirm('Bạn có chắc muốn xóa người dùng này?')) {
                users = users.filter(user => user.id !== id);
                loadUsers();
                populateDropdowns();
            }
        }

        function deleteRequest(id) {
            const request = bookingRequests.find(r => r.id === id);
            if (currentUser.role !== 'admin' && currentUser.id !== request.userId) return;

            if (confirm('Bạn có chắc muốn xóa yêu cầu này?')) {
                bookingRequests = bookingRequests.filter(req => req.id !== id);
                loadBookingRequests();
                updateStats();
            }
        }

        // Booking request functions
        function approveRequest(id) {
            if (currentUser.role !== 'admin') return;
            const request = bookingRequests.find(req => req.id === id);
            if (request) {
                request.status = 'approved';
                loadBookingRequests();
                updateStats();
                alert('Đã duyệt yêu cầu!');
            }
        }

        function rejectRequest(id) {
            if (currentUser.role !== 'admin') return;
            const request = bookingRequests.find(req => req.id === id);
            if (request) {
                request.status = 'rejected';
                loadBookingRequests();
                updateStats();
                alert('Đã từ chối yêu cầu!');
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Set default datetime values
            const now = new Date();
            const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
            const startInput = document.getElementById('scheduleStart');
            const endInput = document.getElementById('scheduleEnd');

            if (startInput && endInput) {
                startInput.value = tomorrow.toISOString().slice(0, 16);
                endInput.value = new Date(tomorrow.getTime() + 2 * 60 * 60 * 1000).toISOString().slice(0, 16);
            }
        });
    </script>
</body>

</html>