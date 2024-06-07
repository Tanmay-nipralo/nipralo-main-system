<?php

include './includes/function.php';
// include './includes/connection.php';

    $employee = getAllEmployee();
    $Allattendance = getAllAttendence();
    
	if(isset($_GET['month'])) {
        $selectedMonth=$_GET['month'];
        // $attendance = getAttendenceByMonth($selectedMonth);
        $attendance = getAttendenceMonth($selectedMonth);
    } else {
        $selectedMonth = date('m');
        // $attendance = getAttendenceByMonth($selectedMonth);
        $attendance = getAttendenceMonth($selectedMonth);
    }
	// $attendance = getAttendenceByDate(date('Y-m-d'));
?>
                <?php foreach($employee as $emp){?>
                <tr>
                    <td>
                        <?php echo $emp['id']; ?>
                    </td>
                    <td>
                        <h2 class="table-avatar">
                            <a class="avatar avatar-xs" href="#"><img src="<?php echo $emp['photo'];?>" alt="User Image"></a>
                            <a href="#"><?php echo $emp['first_name'];?></a>
                        </h2>
                    </td>
                    <td>
                        <?php
                            $x = 0;
                            foreach ($attendance as $present) {
                                // $presentIds[] = implode(', ', $present['present']) . "<br>";
                                $presentIds = $present['present'];
                                if (($key = array_search($emp['id'], $presentIds)) !== false) {
                                    $x++;
                                }
                            }
                            echo $x;
                        ?>
                        <input type="hidden" class="empId" name="eid" value="<?php echo $emp['id']; ?>">
                    </td>	
                    <td>
                        <?php
                            $y = 0;
                            foreach ($attendance as $absent) {
                                // $absentIds[] = implode(', ', $absent['absent']) . "<br>";
                                $absentIds = $absent['absent'];
                                if (($key = array_search($emp['id'], $absentIds)) !== false) {
                                    $y++;
                                }
                            }
                            echo $y;
                        ?>
                    </td>
                    <td>
                        <?php
                            $z = 0;
                            foreach ($attendance as $paidleave) {
                                // $paidleaveIds[] = implode(', ', $paidleave['paidleave']) . "<br>";
                                $paidleaveIds = $paidleave['paid_leave'];
                                if (($key = array_search($emp['id'], $paidleaveIds)) !== false) {
                                    $z++;
                                }
                            }
                            echo $z;
                        ?>
                    </td>
                    <td>
                        <?php
                            $count = 0;
                            foreach ($Allattendance as $paidleave) {
                                // $paidleaveIds[] = implode(', ', $paidleave['paidleave']) . "<br>";
                                $paidleaveIds = $paidleave['paid_leave'];
                                if (($key = array_search($emp['id'], $paidleaveIds)) !== false) {
                                    $count++;
                                }
                            }
                            echo $count;
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $emp['paid_leave'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $x + $y;
                        ?>
                    </td>
                </tr>
                
                <?php } ?>
                