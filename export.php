<?php
$idd = $_GET['project_id'];
$table 				= $_GET["table"];
if($table == "project_task"){
	include_once('includes/connection.php');
}elseif($table == "pending_task"){
	include_once('includes/connection.php');
}elseif($table == "completed_task"){
	include_once('includes/connection.php');
}


$flag 				= 0;
$count				= 1;
$setData = '';  
if($table == "project_task"){

	$sql 	= "SELECT * FROM project_task WHERE status != 5 AND project_id = $idd ORDER BY id DESC";  
	$setRec = mysqli_query($conn, $sql); 

	$filename 			=	$table;
	$columnHeader 		= "Main Task Tittle" . "\t" ."Sub Task Tittle" . "\t" . "Start Date" . "\t" . "End Date" . "\t" . "Assign By" . "\t". "Assign To" . "\t". "Priority" . "\t". "Time Period" . "\t". "Status" . "\t" ;  

    if (mysqli_num_rows($setRec) > 0) {
        $flag = 1;
        while ($rec = mysqli_fetch_assoc($setRec)) {
            $task_id = $rec['id'];
            $sql1 	= "SELECT * FROM project_subtask WHERE status != 5 AND task_id = $task_id ORDER BY id DESC";  
	        $setRec1 = mysqli_query($conn, $sql1); 
            while ($rec1 = mysqli_fetch_assoc($setRec1)) {

             if($rec1['subtask_status']==2){
                $status = "New";
             } elseif($rec1['subtask_status']==3) {
                $status = "Hold";
             } elseif($rec1['subtask_status']==0) {
                $status = "Pending";
             } elseif($rec1['subtask_status']==1) {
                $status = "Completed";
             } elseif($rec1['subtask_status']==4) {
                $status = "TBD";
             } 
          $rowData = '';
          $rowData .= '"' . $rec['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['start_date'] . '"' . "\t";
          $rowData .= '"' . $rec1['end_date'] . '"' . "\t";

          $jsonTeamLeader = $rec1['assign_by'];
          $teamLeaderArray = json_decode($jsonTeamLeader, true);
          if ($teamLeaderArray !== null) {
              foreach ($teamLeaderArray as $teamLeader) {
                  $rowData .= '"' . $teamLeader['name'] . '"' . "\t";
              }
           } 

           $jsonTeamMember = $rec1['assign_to'];
          $teamMemberArray = json_decode($jsonTeamMember, true);
	        if ($teamMemberArray !== null) {
                foreach ($teamMemberArray as $teamMember) {
                    $rowData .= '"' . $teamMember['name'] . '"' . "\t";	
                }
            }
          
          $rowData .= '"' . $rec1['priority'] . '"' . "\t";
          $rowData .= '"' . $rec1['time_period'] . '"' . "\t";
          $rowData .= '"' . $status . '"' . "\t";
          
          $setData .= trim($rowData) . "\n";
        }
        }
      }
	
	
	
	if(mysqli_num_rows($setRec)>0){
		$flag=1;
		while ($rec = mysqli_fetch_row($setRec)) {  
    		$rowData = '';  
    		foreach ($rec as $value) {  
        		$value = '"' . $value . '"' . "\t";  
        		$rowData .= $value;  
    		}  
    		$setData .= trim($rowData) . "\n";  

		}
	}
}elseif($table == "pending_task"){

	$sql 	= "SELECT * FROM project_task WHERE status != 5 AND project_id = $idd ORDER BY id DESC";  
	$setRec = mysqli_query($conn, $sql); 

	$filename 			=	$table;
	$columnHeader 		= "Main Task Tittle" . "\t" ."Sub Task Tittle" . "\t" . "Start Date" . "\t" . "End Date" . "\t" . "Assign By" . "\t". "Assign To" . "\t". "Priority" . "\t". "Time Period" . "\t". "Status" . "\t" ;  

    if (mysqli_num_rows($setRec) > 0) {
        $flag = 1;
        while ($rec = mysqli_fetch_assoc($setRec)) {

            $query_check_subtask = "SELECT COUNT(*) AS subtask_count FROM project_subtask WHERE task_id = " . $rec['id'] . " AND subtask_status = 0";
            $result_check_subtask = mysqli_query($conn, $query_check_subtask);
            $row_check_subtask = mysqli_fetch_assoc($result_check_subtask);
    
            if ($row_check_subtask['subtask_count'] > 0) {

            $task_id = $rec['id'];
            $sql1 	= "SELECT * FROM project_subtask WHERE status != 5 AND task_id = $task_id ORDER BY id DESC";  
	        $setRec1 = mysqli_query($conn, $sql1); 
            while ($rec1 = mysqli_fetch_assoc($setRec1)) {

             if($rec1['subtask_status']==2){
                $status = "New";
             } elseif($rec1['subtask_status']==3) {
                $status = "Hold";
             } elseif($rec1['subtask_status']==0) {
                $status = "Pending";
             } elseif($rec1['subtask_status']==1) {
                $status = "Completed";
             } elseif($rec1['subtask_status']==4) {
                $status = "TBD";
             } 
          $rowData = '';
          $rowData .= '"' . $rec['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['start_date'] . '"' . "\t";
          $rowData .= '"' . $rec1['end_date'] . '"' . "\t";

          $jsonTeamLeader = $rec1['assign_by'];
          $teamLeaderArray = json_decode($jsonTeamLeader, true);
          if ($teamLeaderArray !== null) {
              foreach ($teamLeaderArray as $teamLeader) {
                  $rowData .= '"' . $teamLeader['name'] . '"' . "\t";
              }
           } 

           $jsonTeamMember = $rec1['assign_to'];
          $teamMemberArray = json_decode($jsonTeamMember, true);
	        if ($teamMemberArray !== null) {
                foreach ($teamMemberArray as $teamMember) {
                    $rowData .= '"' . $teamMember['name'] . '"' . "\t";	
                }
            }
          
          $rowData .= '"' . $rec1['priority'] . '"' . "\t";
          $rowData .= '"' . $rec1['time_period'] . '"' . "\t";
          $rowData .= '"' . $status . '"' . "\t";
          
          $setData .= trim($rowData) . "\n";
        }
        }
      }
    }
	
	
	
	if(mysqli_num_rows($setRec)>0){
		$flag=1;
		while ($rec = mysqli_fetch_row($setRec)) {  
    		$rowData = '';  
    		foreach ($rec as $value) {  
        		$value = '"' . $value . '"' . "\t";  
        		$rowData .= $value;  
    		}  
    		$setData .= trim($rowData) . "\n";  

		}
	}
}elseif($table == "completed_task"){

	$sql 	= "SELECT * FROM project_task WHERE status != 5 AND project_id = $idd ORDER BY id DESC";  
	$setRec = mysqli_query($conn, $sql); 

	$filename 			=	$table;
	$columnHeader 		= "Main Task Tittle" . "\t" ."Sub Task Tittle" . "\t" . "Start Date" . "\t" . "End Date" . "\t" . "Assign By" . "\t". "Assign To" . "\t". "Priority" . "\t". "Time Period" . "\t". "Status" . "\t" ;  

    if (mysqli_num_rows($setRec) > 0) {
        $flag = 1;
        while ($rec = mysqli_fetch_assoc($setRec)) {

            $query_check_subtask = "SELECT COUNT(*) AS subtask_count FROM project_subtask WHERE task_id = " . $rec['id'] . " AND subtask_status = 0";
            $result_check_subtask = mysqli_query($conn, $query_check_subtask);
            $row_check_subtask = mysqli_fetch_assoc($result_check_subtask);
    
            if ($row_check_subtask['subtask_count'] == 0) {

            $task_id = $rec['id'];
            $sql1 	= "SELECT * FROM project_subtask WHERE status != 5 AND task_id = $task_id ORDER BY id DESC";  
	        $setRec1 = mysqli_query($conn, $sql1); 
            while ($rec1 = mysqli_fetch_assoc($setRec1)) {

             if($rec1['subtask_status']==2){
                $status = "New";
             } elseif($rec1['subtask_status']==3) {
                $status = "Hold";
             } elseif($rec1['subtask_status']==0) {
                $status = "Pending";
             } elseif($rec1['subtask_status']==1) {
                $status = "Completed";
             } elseif($rec1['subtask_status']==4) {
                $status = "TBD";
             } 
          $rowData = '';
          $rowData .= '"' . $rec['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['tittle'] . '"' . "\t";
          $rowData .= '"' . $rec1['start_date'] . '"' . "\t";
          $rowData .= '"' . $rec1['end_date'] . '"' . "\t";

          $jsonTeamLeader = $rec1['assign_by'];
          $teamLeaderArray = json_decode($jsonTeamLeader, true);
          if ($teamLeaderArray !== null) {
              foreach ($teamLeaderArray as $teamLeader) {
                  $rowData .= '"' . $teamLeader['name'] . '"' . "\t";
              }
           } 

           $jsonTeamMember = $rec1['assign_to'];
          $teamMemberArray = json_decode($jsonTeamMember, true);
	        if ($teamMemberArray !== null) {
                foreach ($teamMemberArray as $teamMember) {
                    $rowData .= '"' . $teamMember['name'] . '"' . "\t";	
                }
            }
          
          $rowData .= '"' . $rec1['priority'] . '"' . "\t";
          $rowData .= '"' . $rec1['time_period'] . '"' . "\t";
          $rowData .= '"' . $status . '"' . "\t";
          
          $setData .= trim($rowData) . "\n";
        }
        }
      }
    }
	
	
	
	if(mysqli_num_rows($setRec)>0){
		$flag=1;
		while ($rec = mysqli_fetch_row($setRec)) {  
    		$rowData = '';  
    		foreach ($rec as $value) {  
        		$value = '"' . $value . '"' . "\t";  
        		$rowData .= $value;  
    		}  
    		$setData .= trim($rowData) . "\n";  

		}
	}
}




if($flag == 1){
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  

}else{
	if($table == "project_task"){
		header("Location: https://bigdreams.in/Nipralo/project-view.php?idd=" . $idd);
	}elseif($table == "pending_task"){
		header("Location: https://bigdreams.in/Nipralo/project-view.php?idd=" . $idd);
	}elseif($table == "completed_task"){
		header("Location: https://bigdreams.in/Nipralo/project-view.php?idd=" . $idd);
	}
}

?>
