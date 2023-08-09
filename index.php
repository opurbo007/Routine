<!DOCTYPE html>
<html>
<head>
    <title>Department, Semester, and Course List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Select Department, Semester, and Course:</h2>
    <form id="selectForm">
        <label for="department">Select Department:</label>
        <select id="department" name="department">
            <option value="" disabled selected>Select a department</option>
        </select>

        <label for="semester">Select Semester:</label>
        <select id="semester" name="semester" disabled>
            <option value="" disabled selected>Select a semester</option>
        </select>

        <label for="course">Select Course:</label>
        <select id="course" name="course" disabled>
            <option value="" disabled selected>Select a course</option>
        </select>
    </form>

    <script>
    // Populate the departments dropdown
    $.getJSON('get_departments.php', function(data) {
        var departments = $('#department');
        $.each(data, function(key, value) {
            departments.append('<option value="' + value.department_id + '">' + value.department_name + '</option>');
        });
    });

    // Update semester dropdown when department is selected
    $('#department').on('change', function() {
        var departmentId = $(this).val();
        if (departmentId) {
            $.post('get_semesters.php', { department_id: departmentId }, function(data) {
                var options = '<option value="" disabled selected>Select a semester</option>';
                $.each(data, function(key, value) {
                    options += '<option value="' + value.semester_id + '">' + value.semester_name + '</option>';
                });
                $('#semester').prop('disabled', false).html(options);
            }, 'json');
        } else {
            $('#semester').prop('disabled', true).html('<option value="" disabled selected>Select a department first</option>');
            $('#course').prop('disabled', true).html('<option value="" disabled selected>Select a course</option>');
        }
    });

    // Update course dropdown when semester is selected
    $('#semester').on('change', function() {
        var semesterId = $(this).val();
        if (semesterId) {
            $('#course').prop('disabled', false).html('<option value="" disabled selected>Select a course</option>');

            // Fetch courses for the selected semester
            $.getJSON('get_courses.php', { semester_id: semesterId }, function(data) {
                var courses = $('#course');
                $.each(data, function(key, value) {
                    courses.append('<option value="' + value.course_id + '">' + value.course_name + ' (Credits: ' + value.credits + ')' + '</option>');
                });
            });
        } else {
            $('#course').prop('disabled', true).html('<option value="" disabled selected>Select a course</option>');
        }
    });
</script>

</body>
</html>
