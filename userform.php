<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign Up Form</title>
   <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
   <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
   <style>
    *, *:before, *:after {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  
  body {
    font-family: 'Nunito', sans-serif;
    color: #384047;
  }
  
  form {
    max-width: 300px;
    margin: 10px auto;
    padding: 10px 20px;
    background: #f4f7f8;
    border-radius: 8px;
  }
  
  h1 {
    margin: 0 0 30px 0;
    text-align: center;
  }
  
  input[type="text"],
  input[type="password"],
  input[type="date"],
  input[type="datetime"],
  input[type="email"],
  input[type="number"],
  input[type="search"],
  input[type="tel"],
  input[type="time"],
  input[type="url"],
  textarea,
  select {
    background: rgba(255,255,255,0.1);
    border: none;
    font-size: 16px;
    height: auto;
    margin: 0;
    outline: 0;
    padding: 10px;
    width: 100%;
    background-color: #e8eeef;
    color: #8a97a0;
    box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
    margin-bottom: 30px;
  }
  
  input[type="radio"],
  input[type="checkbox"] {
    margin: 0 4px 8px 0;
  }
  
  select {
    padding: 6px;
    height: 32px;
    border-radius: 2px;
  }
  
  button {
    padding: 19px 39px 18px 39px;
    color: #FFF;
    background-color: #4bc970;
    font-size: 18px;
    text-align: center;
    font-style: normal;
    border-radius: 5px;
    width: 100%;
    border: 1px solid #3ac162;
    border-width: 1px 1px 3px;
    box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
    margin-bottom: 10px;
  }
  
  fieldset {
    margin-bottom: 30px;
    border: none;
  }
  
  legend {
    font-size: 1.4em;
    margin-bottom: 10px;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
  }
  
  label.light {
    font-weight: 300;
    display: inline;
  }
  
  .number {
    background-color: #5fcf80;
    color: #fff;
    height: 30px;
    width: 30px;
    display: inline-block;
    font-size: 0.8em;
    margin-right: 4px;
    line-height: 30px;
    text-align: center;
    text-shadow: 0 1px 0 rgba(255,255,255,0.2);
    border-radius: 100%;
  }
  
  @media screen and (min-width: 480px) {
  
    form {
      max-width: 480px;
    }
  
  }
  .fresher_hide {
    display: none;
 }

 .fresher_hide_h {
    display: none;
 }
  
.checkbox{
  width: 130px;
}
   </style>
</head>

<body>
   
   <div class="row">
      <div class="col-md-12">

         <form class="form form-horizontal" method="post">
            <img class="navbar-brand-logo" src="assets/img/nipralo_logo.png" alt="" style="height: 40px;"><br><br>
            <h1>User Application Form</h1><hr>
            <div class="form-group">
               <label class="col-sm-3 control-label" for="form-control-1">Name</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="text" name="name" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label" for="form-control-1">Email</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="email" name="email" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label" for="form-control-1">Number</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="number" name="number" required>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label" for="form-control-1">Address</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="text" name="address" required>
               </div>
            </div>
            <div class="form-group ">
               <label class="col-sm-3 control-label">Choose Technology</label>
               <div class="col-sm-9">
                  <div class="row" style="display: flex; justify-content: space-between;">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="HTML" required>HTML
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="CSS">CSS
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="Javascript">Javascript
                        </label>
                     </div>
                  </div>
                  <div class="row" style="display: flex; justify-content: space-between;">

                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="PHP">PHP
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="Laravel">Laravel
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="Angular js">Angular js
                        </label>
                     </div>
                  </div>
                  <div class="row" style="display: flex; justify-content: space-between;">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="React js">React js
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="Node js">Node js
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="ionic">ionic
                        </label>
                     </div>
                  </div>
                  <div class="row" style="display: flex; justify-content: space-between;">
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="Android native">Android native
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="flutter">flutter
                        </label>
                     </div>
                     <div class="checkbox">
                        <label>
                           <input type="checkbox" name="techno[]" value="codeigeitener">codeigeitener
                        </label>
                     </div>
                  </div>
               </div>
            </div>
            <hr>
            <div class="form-check mb-3" style="display: flex;">
               <label class="col-sm-3 control-label"></label>

               <input class="form-check-input toggler" type="radio" name="flexRadioDefault" id="flexRadioDefault1" required>
               <label class="form-check-label" for="flexRadioDefault1">
                  Fresher&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               </label>
               <input class="form-check-input togglert" type="radio" name="flexRadioDefault" id="choice-animals-dogs">
               <label class="form-check-label" for="flexRadioDefault2">
                  Experienced
               </label>
            </div>
           
            <div class="form-group fresher_hide_h">
               <label class="col-sm-3 control-label" for="form-control-1">Expected Salary</label>
               <div class="col-sm-9" id="div-1" class="hide">
                  <input id="form-control-1" class="form-control" type="text" name="expectedsalary">
               </div>
            </div>
            <div class="form-group fresher_hide">

               <label class="col-sm-3 control-label" for="form-control-1">Currrent Salary</label>
               <div class="col-sm-9" id="div-2" class="hide">
                  <input id="form-control-1" class="form-control" type="text" name="ctc" value="0">
               </div>
            </div>
            <div class="form-group fresher_hide">
               <label class="col-sm-3 control-label" for="form-control-1">Expected Salary</label>
               <div class="col-sm-9" id="div-3" class="hide">
                  <input id="form-control-1" class="form-control" type="text" name="expectedsalary" value="0">
               </div>
            </div>
            <div class="form-group fresher_hide">
               <label class="col-sm-3 control-label" for="form-control-1">Experience</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="text" name="experience" value="0">
               </div>
            </div>
            <div class="form-group fresher_hide">
               <label class="col-sm-3 control-label" for="form-control-1">Notice Period</label>
               <div class="col-sm-9">
                  <input id="form-control-1" class="form-control" type="text" name="noticeperiod" value="0">
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-3 control-label" for="form-control-1"></label>
               <div class="col-sm-9">
                  <button class="btn btn-outline-info btn-sm" type="submit" name="submit">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
   <script type="text/javascript">
      $(function () {
         $(".toggler").click(function () {
            console.log('hi');
            $('.fresher_hide_h').show();
            $('.fresher_hide').hide();
            $(".fresher_hide").prop("checked", true);


            //  $("#div-" + $(this).val()).show();
         });
         $(".togglert").click(function () {
            $('.fresher_hide').show();
            $('.fresher_hide_h').hide();
            $(".fresher_hide_h").prop("checked", true);



         });
      });
   </script>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php
 include './includes/connection.php';

   if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $number = $_POST['number'];
      $address = $_POST['address'];
      $expectedsalary = $_POST['expectedsalary'];
      $ctc = $_POST['ctc'];
      $experience = $_POST['experience'];
      $noticeperiod = $_POST['noticeperiod'];
      $checkbox1 = $_POST['techno'];
      $techno1 = implode(",", $checkbox1);

      $insertquery = "INSERT INTO `appliedcandidate`(`name`, `email`, `number`, `address`, `technology`, `expectedsalary`, `ctc`, `experience`, `noticeperiod`) VALUES('$name','$email','$number','$address',' $techno1','$expectedsalary','$ctc','$experience','$noticeperiod')";
      // var_dump($insertquery);
      $iquery = mysqli_query($conn, $insertquery);


      if($iquery){
         ?>
         <script>
         toastr.success('Added Successfully!');
			setTimeout(function() {
			window.location = "userform.php";
			}, 1000);
   
          </script>
          <?php
          }
            else{
               ?><script>
                toastr.error('Error!');
			setTimeout(function() {
			window.location = "userform.php";
			}, 1000);
               </script><?php
              };
   }
   ?>