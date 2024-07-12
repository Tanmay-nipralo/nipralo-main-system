<?php 
include './includes/function.php';
$employee = getAllEmployee();

// Check if month is provided


foreach ($employee as $emp) : 
    if(isset($_GET['month'])) {
        $selectedMonth = $_GET['month'];
        $attendance = getAllProjectsCalender($selectedMonth, $emp['id']);
    } else {
        $selectedMonth = date('m');
        $attendance = getAllProjectsCalender($selectedMonth, $emp['id']);
    }
    
    // Get the number of days in the selected month
    $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date('Y'));
    $selectedMonth = date('Y') . '-' . $selectedMonth; 
?>
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
        $projectsOnDay = array(); // Initialize an array to store projects for the current day
        foreach ($attendance as $project) {
            $projectStartDate = date('Y-m-d', strtotime($project['start_date']));
            $projectEndDate = date('Y-m-d', strtotime($project['end_date']));
            if ($selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) >= $projectStartDate && 
                $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) <= $projectEndDate) {
                // Store the project details
                $projectsOnDay[] = '<a href="project-view.php?idd=' . $project['id'] . '">' . $project['project_name'] . '</a>';

            }
        }
        
        // Display all projects for the current day
        if (!empty($projectsOnDay)) {
            echo '<td>' . implode('<br>', $projectsOnDay) . '</td>';
        } else {
            echo '<td> - </td>';
        }
    }
    ?>
</tr>
<?php endforeach; ?>
