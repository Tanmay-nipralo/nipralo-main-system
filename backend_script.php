<?php 
include './includes/function.php';
$employee = getAllEmployee();

// Check if month is provided
if(isset($_GET['month'])) {
    $selectedMonth=$_GET['month'];
    $attendance = getAttendenceByMonth($selectedMonth);
} else {
    $selectedMonth = date('m');
    $attendance = getAttendenceByMonth($selectedMonth);
}

// Get the number of days in the selected month
$numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date('Y'));
$selectedMonth = date('Y') . '-' . $selectedMonth; 
foreach ($employee as $emp) : ?>
    <tr>
        <td>
            <h2 class="table-avatar">
                <a class="avatar avatar-xs" href="#"><img src="<?= $emp['photo'] ?>" alt="<?= $emp['first_name'] ?>"></a>
                <a href="#"><?= $emp['first_name'] ?></a>
            </h2>
        </td>
        <?php
        // Loop through the days of the month
        for ($day = 1; $day <= $numDaysInMonth; $day++) {
            $attendanceFound = false;
            foreach ($attendance as $record) {
                if ($record['date'] == $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) && in_array($emp['id'], $record['paid_leave'])) {
                    // echo '<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info">P</a></td>';
                    $p = "Paid";
                    // $attendanceFound = true;
                    // break;
                }else{
                    $p = "";
                }
                if ($record['date'] == $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) && in_array($emp['id'], $record['present'])) {
                    echo '<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>';
                    $attendanceFound = true;
                    break;
                } elseif ($record['date'] == $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) && in_array($emp['id'], $record['absent'])) {
                    echo '<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info">'.$p.'<i class="fa fa-close text-danger"></i></a></td>';
                    $attendanceFound = true;
                    break;
                } elseif ($record['date'] == $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) && in_array($emp['id'], $record['half_day'])) {
                    echo '<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a><br><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></td>';
                    $attendanceFound = true;
                    break;
                }
            }
            if (!$attendanceFound) {
                echo '<td> - </td>';
            }
        }
        ?>
    </tr>
<?php endforeach; ?>