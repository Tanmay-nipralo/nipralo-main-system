<?php 
date_default_timezone_set('Asia/Kolkata');
function GetLabelForNavbar($label){
    switch($label){
        case "index":
            return "Dashboard";
        case "clients":
            return "Clients";
        case "projects":
            return "Projects";
        case "assignbyproject":
            return "All Assigned Project";
        case "attendanceemployee":
            return "Attendance";
        case "attendance":
            return "Attendance";
        case "salary":
            return "Salary";
        case "appliedcandidates":
            return "Applied Candidate";
        case "accuratecandidates":
            return "Accurate Fit Candidate";
        case "bestcandidates":
            return "Best Fit Candidate";
        case "okcandidates":
            return "Ok Fit Candidate";
        case "addsystem":
            return "Add System";
        case "allsystem":
            return "System";
        case "departments":
            return "Department";
        case "designations":
            return "Designations";
        case "assets":
            return "Assets";
        case "createproject":
            return "Create Project";
        case "completedtaskreport":
            return "Completed Task Report";
        case "dailytask":
            return "Daily Task";
        case "Assignedproject":
            return "Assigned Project";
        case "allproductcustomer";
            return "Customers";
        case "changepassword":
            return "Change password";
        case "contact":
              return "Contact Enquiry";
       case "career":
           return "Career Enquiry";
       case "enquiry":
            return "Enquiry";
        case "holidays":
          return "Holidays";
        case "employees":
            return "Employees";
        case "hardware":
            return "Hardware";
         case "vendorshop":
            return "Vendor Shop";
        case "hardware":
            return "Hardware";
        case "hardware":
            return "Hardware";
        default:
            return "";
    }
}
    
    function ProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    } 

    function InterviewCount($date){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM interview_history  WHERE DATE(interview_scheduledate)='$date'");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    } 

    function MeetingCount($date){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM meeting_history  WHERE DATE(meeting_scheduledate)='$date'");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    } 

    function ProjectCountById($id){
        include 'connection.php';
        
        // $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE status !=5 AND 
        // JSON_CONTAINS(team_member, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 ");

        $json_id = json_encode([['id' => (string)$id]]);
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE status != 5 AND
               JSON_CONTAINS(team_member, '$json_id', '$') = 1");

        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function ProjectCountTaskById($id){
        include 'connection.php';

        // $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND 
        // JSON_CONTAINS(assign_to, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 ");

        $json_id = json_encode([['id' => (string)$id]]);
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND
               JSON_CONTAINS(assign_to, '$json_id', '$') = 1 ");

        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function PendingCountTaskById($id){
        include 'connection.php';

        // $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND subtask_status != 1 AND 
        // JSON_CONTAINS(assign_to, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 ");

        $json_id = json_encode([['id' => (string)$id]]);
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND subtask_status != 1 AND 
               JSON_CONTAINS(assign_to, '$json_id', '$') = 1 ");
        
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function CompletedCountTaskById($id){
        include 'connection.php';

        // $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND subtask_status = 1 AND 
        // JSON_CONTAINS(assign_to, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 ");

        $json_id = json_encode([['id' => (string)$id]]);
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM project_subtask WHERE status!=5 AND subtask_status = 1 AND 
                JSON_CONTAINS(assign_to, '$json_id', '$') = 1 ");

        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function ClientCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS client_count FROM clients WHERE status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['client_count'];
    }

    function TaskCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS task_count FROM project_task WHERE status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['task_count'];
    }

    function EmployeCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS employees_count FROM employees WHERE status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['employees_count'];
    }

    function OutProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE project_status = 'Outgoing Projects' AND status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function HoldProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE project_status = 'Hold Projects' AND status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function CompleteProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE project_status = 'Completed Projects' AND status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }
    function DelayedProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE position = 'Delayed' AND status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }
    function OnTrackProjectCount(){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT COUNT(*) AS project_count FROM projects WHERE position = 'On Track' AND status!=5");
        $row = mysqli_fetch_assoc($sql);
        return $row['project_count'];
    }

    function getFolders(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM folder WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    
    function getClients(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM clients WHERE status != 5 ORDER BY id DESC LIMIT 5");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getProjects(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM projects WHERE status != 5 ORDER BY id DESC LIMIT 5");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllProjects(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM projects WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            // $row['doc'] = getDocumentById($row['id']);
            $result[] =$row;
        }
        return $result;
    }


    function getAllDepartment(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM departments WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getNewCandidate(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM candidate WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAppliedCandidate(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM appliedcandidate WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAccurateFitCandidate(){
        include 'connection.php';
        $result = [];
        $sql = mysqli_query($conn,"SELECT * FROM appliedcandidate WHERE experience>3 AND noticeperiod=0 AND technology like'%laravel%' AND status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getBestFitCandidate(){
        include 'connection.php';
        $result = [];
        $sql = mysqli_query($conn,"SELECT * FROM appliedcandidate WHERE experience>1 AND noticeperiod=30 AND technology like'%php%' AND status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getOkFitCandidate(){
        include 'connection.php';
        $result = [];
        $sql = mysqli_query($conn,"SELECT * FROM appliedcandidate WHERE experience=0 AND technology like'%html%' AND status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getHardware(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM hardware WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getVendorShop(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM shop WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getDepartmentById($bid){
        include 'connection.php';
        $result = array();
        if ($bid != 'Select Department') {
            $res = "SELECT * FROM `departments` WHERE id = $bid";
            $sql = mysqli_query($conn,$res);
        
            while($row = mysqli_fetch_assoc($sql)){
                $result[] =$row;
            }
        }
        return $result;
    }

    
    function getFolderById($fid ,$pid){
        include 'connection.php';
        // $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM `folder` WHERE project_id = $pid AND id=$fid");
        $row = mysqli_fetch_assoc($sql);
            $result =$row;
        return $result;
    }

    function getDocumentById($bid ,$fid){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM `documents` WHERE project_id = $bid AND folder_id=$fid");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    
    function getDesignationById($bid){
        include 'connection.php';
        $result = array();
        if ($bid != 'Select designation') {
        $sql = mysqli_query($conn,"SELECT * FROM `designations` WHERE id = $bid");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
    }
        return $result;
    }

    function getAllDesignation(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM designations WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['department'] = getDepartmentById($row['department_name']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllAssets(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM assets WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['employee'] = getEmployeeById($row['asset_user']);
            $result[] =$row;
        }
        return $result;
    }

    function getEmployeeById($bid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `employees` WHERE id = '$bid'");
       
        while($row = mysqli_fetch_assoc($sql)){
            $row['des'] = getDesignationById($row['designation']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllDocuments(){
        include 'connection.php';
        $result = [];
        $sql = mysqli_query($conn,"SELECT * FROM documents WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            // $row['project'] = getProjecById($row['project_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllPost(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM post WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllProjecttask($pid){
        include 'connection.php';
        $result=array();
        $sql = mysqli_query($conn,"SELECT * FROM project_task WHERE status != 5 AND project_id = $pid ORDER BY id DESC");
        $rowCount = mysqli_num_rows($sql);
        while($row = mysqli_fetch_assoc($sql)){
            $result['count'] = $rowCount;
            $result[] =$row;
        }
        return $result;
    }

    function getAllProjecttaskByEmployee($pid ,$eid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM project_task WHERE status != 5 AND project_id = $pid AND JSON_CONTAINS(assign_to, JSON_OBJECT('id', '$eid')) ORDER BY id DESC");
    
        $result = array(); // Initialize result array
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllProjectsubtaskByEmployee($pid,$eid){
        include 'connection.php';
        $result=array();
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 AND task_id = $pid AND JSON_CONTAINS(assign_to, JSON_OBJECT('id', '$eid')) ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getPendingProjecttaskByEmployee($pid ,$eid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM project_task WHERE status != 5 AND project_id = $pid AND JSON_CONTAINS(assign_to, JSON_OBJECT('id', '$eid')) ORDER BY id DESC");
    
        $result = array(); // Initialize result array
        while($row = mysqli_fetch_assoc($sql)){
            $row['rcat'] = getSubtaskCount($row['id']);
            $result[] =$row;
        }
        return $result;
    }

    function getSubtaskCount($tid){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT COUNT(*) AS subtask_count FROM project_subtask WHERE task_id = $tid AND subtask_status = 0 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getPendingProjectsubtaskByEmployee($pid,$eid){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 AND task_id = $pid AND JSON_CONTAINS(assign_to, JSON_OBJECT('id', '$eid')) ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }


    function getAllProjectsubtask($pid){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 AND task_id = '$pid' ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    function getAllSubtaskByProjectId($pid){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 AND project_id = $pid ORDER BY id DESC");
        $rowCount = mysqli_num_rows($sql);
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
            $result['count'] = $rowCount;
        }
        return $result;
    }

    function getPendingProjectsubtask($pid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 AND task_id = $pid AND subtask_status=0 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }


    function getProjecById($bid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `projects` WHERE id = $bid");
       
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getMaintaskById($bid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `project_task` WHERE id = $bid");
       
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getSubtaskById($bid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `project_subtask` WHERE id = $bid");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    
    function getExtraTaskById($bid,$date){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM `extra_task` WHERE emp_id = $bid AND DATE(created_at) = '$date' ");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function viewExtraTaskById($bid,$date){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `extra_task` WHERE emp_id = $bid AND DATE(created_at) = '$date' ");
        $row = mysqli_fetch_assoc($sql);
        $result =$row;
        
        return $result;
    }


    function getAllEmployee(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM employees WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['dep'] = getDepartmentById($row['department']);
            $row['des'] = getDesignationById($row['designation']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllClient(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM clients WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllSystem(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM `system` WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllCareerDetail(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM sale WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['user_detail'] = getCareerUserById1($row['id']);
            $result[] =$row;
        }
        return $result;
    }

    function getTodayInterviewDetail($date){
        include 'connection.php';
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM interview_history  WHERE DATE(interview_scheduledate)='$date' AND status!=5");
        while($row = mysqli_fetch_assoc($sql)){
            $row['user_detail'] = getCareerUserById($row['user_id']);
            $result[] =$row;
        }
        return $result;
    }
//Update Code by Mohd Zorif
    function chechUserInterviewHistory($bid, $date){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM interview_history WHERE user_id = $bid and interview_scheduledate = '$date' "); 
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        if(isset($result)) {
            return true;
        } else {
            return false;
        }
    }

    function getCareerUserById($id){
        include 'connection.php';
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM sale WHERE status != 5 AND id=$id");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getCareerUserById1($id){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM interview_history WHERE status != 5 AND user_id=$id ORDER BY id DESC");
       $row = mysqli_fetch_assoc($sql);
            $result =$row;
       
        return $result;
    }

    function getTodayMeetingDetail($date){
        include 'connection.php';
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM meeting_history  WHERE DATE(meeting_scheduledate)='$date' AND status!=5");
        while($row = mysqli_fetch_assoc($sql)){
            $row['user_detail'] = getWebsiteUserById($row['user_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllMeetingDetail(){
        include 'connection.php';
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM meeting_history  WHERE meeting_scheduledate IS NOT NULL AND meeting_scheduledate <> '' AND status!=5 ORDER BY meeting_scheduledate ASC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['user_detail'] = getWebsiteUserById($row['user_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getAllInterviewDetail(){
        include 'connection.php';
        $date = date('Y-m-d');
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM interview_history  WHERE interview_scheduledate IS NOT NULL AND interview_scheduledate <> '' AND status != 5 and interview_scheduledate >= '$date' ORDER BY interview_scheduledate DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['user_detail'] = getCareerUserById($row['user_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getWebsiteUserById($id){
        include 'connection.php';
        $result= [];
        $sql = mysqli_query($conn,"SELECT * FROM website_enquiry WHERE status != 5 AND id=$id");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    
    function getCareerDetailByID($id){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM sale WHERE status != 5 AND id=$id");
        $row = mysqli_fetch_assoc($sql);
        $row['hist'] = getinterviewHistoryById($row['id']);
         $result =$row;
        return $result;
    }
    function getinterviewHistoryById($id){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM interview_history WHERE user_id=$id ORDER BY id DESC");
        $row = mysqli_fetch_assoc($sql);
         $result =$row;
        return $result;
    }
    function getCareerDetailByIDAndDate($id, $date){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM sale WHERE status != 5 AND id=$id");
        $row = mysqli_fetch_assoc($sql);
        $row['hist'] = getinterviewHistoryByIdAndDate($row['id'], $date);
         $result =$row;
        return $result;
    }

    function getinterviewHistoryByIdAndDate($id, $date){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM interview_history WHERE user_id=$id and interview_scheduledate = '$date' ORDER BY id DESC");
        $row = mysqli_fetch_assoc($sql);
         $result =$row;
        return $result;
    }

    function getDevelopmentDetailByID($id){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM website_enquiry WHERE status != 5 AND id=$id");
        $row = mysqli_fetch_assoc($sql);
        $row['hist'] = getMeetingHistoryById($row['id']);
         $result =$row;
        return $result;
    }

    function getMeetingHistoryById($id){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM meeting_history WHERE user_id=$id ORDER BY id DESC");
        $row = mysqli_fetch_assoc($sql);
         $result =$row;
        return $result;
    }

    function getCareerHistoryById($id){
        include 'connection.php';
        $result =[];
        $sql = mysqli_query($conn,"SELECT * FROM interview_history WHERE user_id=$id ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getDevelopmentHistoryById($id){
        include 'connection.php';
        $result =[];
        $sql = mysqli_query($conn,"SELECT * FROM meeting_history WHERE user_id=$id ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }
    

    function getAllWebsiteDetail(){
        include 'connection.php';
        $result =[];
        $sql = mysqli_query($conn,"SELECT * FROM website_enquiry WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllContactDetail(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM contact_us WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllEnquiry(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM bigd_model WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllHoliday(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM holiday WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllTask(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM project_task WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllSubtask(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM project_subtask WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }


    function getEmpById($bid){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM `employees` WHERE id = $bid");
       
        while($row = mysqli_fetch_assoc($sql)){
            $row['department'] = getDepartmentById($row['department']);
            $row['designation'] = getDesignationById($row['designation']);
            $result =$row;
        }
        return $result;
    }

    function getAllProject(){
        include 'connection.php';
        $sql = mysqli_query($conn,"SELECT * FROM projects WHERE status != 5 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $result[] =$row;
        }
        return $result;
    }

    function getAllSalaryInfo(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn,"SELECT * FROM emp_salary ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['employee'] = getEmployeeById($row['client_id']);
            $row['designation'] = getDesignationById($row['employee'][0]['designation']);
            $result[] =$row;
        }
        return $result;
    }

    function getDailyTask($id,$date){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn, "SELECT * FROM daily_task WHERE emp_id = $id AND status1 != 5 AND DATE(created_at) = '$date' ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['employee'] = getEmployeeById($row['emp_id']);
            $row['project'] = getProjecById($row['project_name']);
            $row['main_task'] = getMaintaskById($row['main_task']);
            $row['subtask'] = getSubtaskById($row['subtask']);
            // $row['extra'] = getExtraTaskById($row['emp_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getDailyTaskReport($id){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT * FROM daily_task WHERE emp_id = $id AND status1 != 5 AND status = 1 ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($sql)){
            $row['employee'] = getEmployeeById($row['emp_id']);
            $row['project'] = getProjecById($row['project_name']);
            $row['main_task'] = getMaintaskById($row['main_task']);
            $row['subtask'] = getSubtaskById($row['subtask']);
            // $row['extra'] = getExtraTaskById($row['emp_id']);
            $result[] =$row;
        }
        return $result;
    }

    function getAttendenceByDate($date){
        include 'connection.php';
        $sql = mysqli_query($conn, "SELECT * FROM attendance WHERE date = '$date'");
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $row['present'] = json_decode($row['present']);
                $row['absent'] = json_decode($row['absent']);
                $row['half_day'] = json_decode($row['half_day']);
                $result = $row;
            }
        }else{
            $result = false;
        }
        return $result;
    }
    function getAllAttendence(){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn, "SELECT * FROM attendance order by date desc");
        while ($row = mysqli_fetch_assoc($sql)) {
            $row['present'] = json_decode($row['present']);
            $row['absent'] = json_decode($row['absent']);
            $row['half_day'] = json_decode($row['half_day']);
            $row['paid_leave'] = json_decode($row['paid_leave']);
            $result[] = $row;
        }
        return $result;
    }
    function getAttendenceMonth($month){
        include 'connection.php';
        $result = array();
        $sql = mysqli_query($conn, "SELECT * FROM attendance WHERE MONTH(date) = '$month'");
        while ($row = mysqli_fetch_assoc($sql)) {
            $row['present'] = json_decode($row['present']);
            $row['absent'] = json_decode($row['absent']);
            $row['half_day'] = json_decode($row['half_day']);
            $row['paid_leave'] = json_decode($row['paid_leave']);
            $result[] = $row;
        }
        return $result;
    }

    function getAttendenceByMonth($month){
        include 'connection.php';
        $res = "SELECT * FROM attendance WHERE MONTH(date) = '$month'";
        $sql = mysqli_query($conn,$res);

        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $row['present'] = json_decode($row['present']);
                $row['absent'] = json_decode($row['absent']);
                $row['half_day'] = json_decode($row['half_day']);
                $row['paid_leave'] = json_decode($row['paid_leave']);
                $result[] = $row;
            }
        }else{
            $result = false;
        }
        return $result;
    }


    // function getAllProjectsCalender($month ,$id){
    //     include 'connection.php';
    //     $sql = mysqli_query($conn, "SELECT * FROM projects WHERE 
    //     status != 5 AND 
    //     YEAR(start_date) = YEAR(CURRENT_DATE()) AND 
    //     MONTH(start_date) = '$month' AND 
    //     MONTH(end_date) = '$month' AND 
    //     JSON_CONTAINS(team_member, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 
    //     ORDER BY start_date");
    //     $result = array();
    //     while($row = mysqli_fetch_assoc($sql)){
    //         $result[] = $row;
    //     }
    //     return $result;
    // }

    function getAllProjectsCalender($month, $id){
        include 'connection.php';
        $result = array();

        $sql = mysqli_query($conn, "SELECT * FROM projects WHERE 
        status != 5 AND 
        YEAR(start_date) = YEAR(CURRENT_DATE()) AND 
        (MONTH(start_date) = '$month' OR MONTH(end_date) = '$month') AND 
        JSON_CONTAINS(team_member, CAST('[{\"id\":\"$id\"}]' AS JSON), '$') = 1 
        ORDER BY start_date");

            // $sql = mysqli_query($conn, "SELECT * FROM projects WHERE 
            // status != 5 AND 
            // YEAR(start_date) = YEAR(CURRENT_DATE()) AND 
            // (MONTH(start_date) = '$month' OR MONTH(end_date) = '$month') AND 
            // JSON_CONTAINS(team_member, JSON_QUOTE('[{\"id\":\"$id\"}]'), '$') = 1 
            // ORDER BY start_date");

        while($row = mysqli_fetch_assoc($sql)){
            $result[] = $row;
        }
        return $result;
    }
    
    
    

    function isEmployeePresent($attendance, $employeeId, $status){
        return in_array($employeeId, $attendance[$status]);
    }

    function isSelected($attendance, $employeeId, $status){
        return isEmployeePresent($attendance, $employeeId, $status) ? 'selected' : '';
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

// generatePDF(208);
function generatePDF($idd)
{
  include 'config/conn.php';
  require __DIR__ . '/../dompdf/autoload.inc.php';
  $query1 = "select * from salary_slip where id = $idd";
  $result1 = mysqli_query($con, $query1);
  $rows = mysqli_fetch_assoc(($result1));

  $dompdf = new Dompdf();

  $html = '<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <h4 class="payslip-title">Payslip for the month of Feb 2019</h4>
              <div class="row">
                  <div class="col-sm-6 m-b-20">
                      <img src="assets/img/logo2.png" class="inv-logo" alt="Logo">
                      <ul class="list-unstyled mb-0">
                          <li>Dreamguys Technologies</li>
                          <li>3864 Quiet Valley Lane,</li>
                          <li>Sherman Oaks, CA, 91403</li>
                      </ul>
                  </div>
                  <div class="col-sm-6 m-b-20">
                      <div class="invoice-details">
                          <h3 class="text-uppercase">Payslip #49029</h3>
                          <ul class="list-unstyled">
                              <li>Salary Month: <span>March, 2019</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-12 m-b-20">
                      <ul class="list-unstyled">
                          <li><h5 class="mb-0"><strong>John Doe</strong></h5></li>
                          <li><span>Web Designer</span></li>
                          <li>Employee ID: FT-0009</li>
                          <li>Joining Date: 1 Jan 2013</li>
                      </ul>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                      <div>
                          <h4 class="m-b-10"><strong>Earnings</strong></h4>
                          <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                      <td><strong>Basic Salary</strong> <span class="float-end">$6500</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-end">$55</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Conveyance</strong> <span class="float-end">$55</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Other Allowance</strong> <span class="float-end">$55</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total Earnings</strong> <span class="float-end"><strong>$55</strong></span></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="col-sm-6">
                      <div>
                          <h4 class="m-b-10"><strong>Deductions</strong></h4>
                          <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                      <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="float-end">$0</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Provident Fund</strong> <span class="float-end">$0</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>ESI</strong> <span class="float-end">$0</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Loan</strong> <span class="float-end">$300</span></td>
                                  </tr>
                                  <tr>
                                      <td><strong>Total Deductions</strong> <span class="float-end"><strong>$59698</strong></span></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>';


  // Load HTML content from file
  // $html = file_get_contents('_includes/pdf.php');
  $paper_size = 'A4';
  $orientation = 'portrait';
  $output_folder = 'pdf/';
  // $output_folder = 'pdf/';
  $dompdf->loadHtml($html);
  $dompdf->setPaper($paper_size, $orientation);
  $dompdf->render();
  $filename = $idd;
  $output_path = $output_folder . $filename . '.pdf';
  file_put_contents($output_path, $dompdf->output());
  return $output_path;
} 
    
?>