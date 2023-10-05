<?php
require __DIR__ . '/../../vendor/autoload.php';
include("../../database/config.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Check if the teacher_id
if (isset($_GET['teacher_id'])) {
  $teacherId = $_GET['teacher_id'];

  // Initialize dompdf
  $options = new Options();
  $options->set('isHtml5ParserEnabled', true);
  $options->set('isPhpEnabled', true);
  $dompdf = new Dompdf($options);

  // Fetch time slots from the database
  $timeSlotsQuery = "SELECT DISTINCT TIME_FORMAT(start_time, '%h:%i %p') AS start_time, TIME_FORMAT(end_time, '%h:%i %p') AS end_time FROM timeslot ORDER BY start_time";
  $timeSlotsResult = $conn->query($timeSlotsQuery);
  $timeSlots = [];
  while ($row = $timeSlotsResult->fetch_assoc()) {
    $timeSlots[] = "{$row['start_time']} - {$row['end_time']}";
  }

  // Generate the HTML content
  $html = '<html>
      <head>
        <title>Class Routine PDF</title>
      </head>
      <body>';

      $routineQuery = "SELECT routine.day, TIME_FORMAT(routine.start_time, '%h:%i %p') AS start_time, TIME_FORMAT(routine.end_time, '%h:%i %p') AS end_time, course.course_code, course.course_name, room.room_number, batch.batch_number, semester.semester_name, course.course_id, course.course_type
      FROM routine
      INNER JOIN course ON routine.course_id = course.course_id
      INNER JOIN room ON routine.room_id = room.room_id
      INNER JOIN batch ON routine.batch = batch.batch_id
      INNER JOIN semester ON routine.semester = semester.semester_id
      WHERE routine.teacher_id = ?
      ORDER BY FIELD(routine.day,'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), routine.start_time";
    

  $routineStmt = $conn->prepare($routineQuery);
  $routineStmt->bind_param("i", $teacherId);
  $routineStmt->execute();
  $routineResult = $routineStmt->get_result();

  // Generate the routine table with only borders
  $html .= '<div class="container mx-auto py-8">
                <h1 class="text-3xl font-bold mb-10 text-center">Class Routine</h1>
                <table style="border-collapse: collapse; width: 100%;">
                <thead>
                <tr>
                  <th style="border: 1px solid #000; ">Day & Time</th>';

  $columnsToDisplay = [];
  foreach ($timeSlots as $timeSlot) {
    $found = false;
    $routineResult->data_seek(0);
    while ($row = $routineResult->fetch_assoc()) {
      if ("{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
        $found = true;
        break;
      }
    }
    if ($found) {
      $html .= "<th style='border: 1px solid #000; padding: 8px;'>{$timeSlot}</th>";
      $columnsToDisplay[] = $timeSlot;
    }
  }

  $html .= '</tr>
              </thead>
              <tbody>';

              $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
              foreach ($days as $day) {
                  $html .= "<tr>";
                  $html .= "<td style='border: 1px solid #000; padding: 8px; text-align: center;'>{$day}</td>";
              
                  foreach ($columnsToDisplay as $timeSlot) {
                      $classes = [];
                      $cellStyle = "padding: 8px; text-align: center;"; 
                       
                      $routineResult->data_seek(0);
                      while ($row = $routineResult->fetch_assoc()) {
                          if ($row['day'] == $day && "{$row['start_time']} - {$row['end_time']}" == $timeSlot) {
                              // Check if the course type is "Lab" and set the background color to blue
                              if ($row['course_type'] == 'lab') {
                                  $cellStyle .= "background-color: #00d2ff;";
                              }
              
                              $classes[] = "<div style='{$cellStyle}'>{$row['course_code']}<br>{$row['course_name']}<br>{$row['room_number']}</div>";
                          }
                      }
              
                      $html .= "<td style='{$cellStyle} border: 1px solid #000;'>";
                      if (empty($classes)) {
                          $html .= "X";
                      } else {
                          foreach ($classes as $class) {
                              $html .= "{$class}<br>";
                          }
                      }
                      $html .= "</td>";
                  }
              
                  $html .= "</tr>";
              }

  $html .= '</tbody>
            </table>
          </div>';

  $html .= '</body>
</html>';

  // Load HTML content
  $dompdf->loadHtml($html);

  // Set paper size and orientation
  $dompdf->setPaper('A2', 'portrait');

  // Render the PDF
  $dompdf->render();

  // Output the PDF
  $dompdf->stream('class_routine.pdf', ['Attachment' => 0]);
} else {
  echo "Teacher ID is missing.";
}
?>