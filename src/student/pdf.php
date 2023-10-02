<?php
require __DIR__ . '/../../vendor/autoload.php';
include("../../database/config.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Check if the teacher_id
$selectedBatch = $_GET['batch'];
$selectedSemester = $_GET['semester'];
$selectedSession = $_GET['session'];

// Fetch batch name
$batchQuery = "SELECT batch_number FROM batch WHERE batch_id = ?";
$batchStmt = $conn->prepare($batchQuery);
$batchStmt->bind_param("i", $selectedBatch);
$batchStmt->execute();
$batchResult = $batchStmt->get_result();
$batchRow = $batchResult->fetch_assoc();
$selectedBatchName = $batchRow['batch_number'];

// Fetch semester name
$semesterQuery = "SELECT semester_name FROM semester WHERE semester_id = ?";
$semesterStmt = $conn->prepare($semesterQuery);
$semesterStmt->bind_param("i", $selectedSemester);
$semesterStmt->execute();
$semesterResult = $semesterStmt->get_result();
$semesterRow = $semesterResult->fetch_assoc();
$selectedSemesterName = $semesterRow['semester_name'];

// Initialize Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

// Generate the HTML content
$html = '<html>
  <body>
    <div class="flex flex-col justify-center">
      <div class="w-full text-center">
        <h3 style="text-align: center;">Batch: ' . htmlspecialchars($selectedBatchName) . '</h3>
        <h3 style="text-align: center;">Semester: ' . htmlspecialchars($selectedSemesterName) . '</h3>
        <h3 style="text-align: center;">Session: ' . htmlspecialchars($selectedSession) . '</h3>
      </div>
    </div>';



$routineQuery = "SELECT routine_id, course.course_code, course.course_name, day, start_time, end_time, room_number, name
FROM routine
INNER JOIN course ON routine.course_id = course.course_id
INNER JOIN room ON routine.room_id = room.room_id
INNER JOIN teachers ON routine.teacher_id = teachers.teacher_id
WHERE batch = ? AND semester = ? AND session = ?";


$routineStmt = $conn->prepare($routineQuery);
$routineStmt->bind_param("iis", $selectedBatch, $selectedSemester, $selectedSession); 
$routineStmt->execute();
$routineResult = $routineStmt->get_result();


$html .= '<div>
    <table style="border-collapse: collapse; width: 100%;">
    <thead>
    <tr>
        <th style="border: 1px solid #000; text-align: center;">Day & Time</th>';

        $timeSlotsToShow = array(); // Store time slots with at least one class

        $timeSlotQuery = "SELECT DISTINCT start_time, end_time FROM timeslot";
        $timeSlotResult = $conn->query($timeSlotQuery);
        $timeSlots = array();
      
        while ($row = $timeSlotResult->fetch_assoc()) {
          $timeSlots[] = $row;
        }
      
        foreach ($timeSlots as $timeSlot) {
          $found = false;
  
          mysqli_data_seek($routineResult, 0);
  
          while ($row = $routineResult->fetch_assoc()) {
            // Check if the routine matches the current time slot
            if ($row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
              $found = true;
              break;
            }
          }

          if ($found) {

            $startTime = date("h:i A", strtotime($timeSlot['start_time']));
            $endTime = date("h:i A", strtotime($timeSlot['end_time']));
            $html .= "<th style=' border: 1px solid #000;' >$startTime - $endTime</th>";
            $timeSlotsToShow[] = $timeSlot;
          }
        }


$html .= '</tr>
    </thead>
    <tbody>';

$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

foreach ($days as $day) {
    $html .= "<tr>";
    $html .= '<td style="border: 1px solid #000; text-align: center; font-size: 10px;"> '. htmlspecialchars($day) .' </td>';

    foreach ($timeSlotsToShow as $timeSlot) {
        $html .= '<td style="border: 1px solid #000; text-align: center;">';

        $routineResult->data_seek(0);
        $found = false;

        while ($row = $routineResult->fetch_assoc()) {
            if ($row['day'] == $day && $row['start_time'] == $timeSlot['start_time'] && $row['end_time'] == $timeSlot['end_time']) {
                $html .= "<div><span>{$row['course_code']}</span><br>{$row['course_name']}<br><b>{$row['name']}</b><br>({$row['room_number']})</div><br>";

                $found = true;
            }
        }

        if (!$found) {
            $html .= "<div>  " . htmlspecialchars('x') . "</div>";
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
?>