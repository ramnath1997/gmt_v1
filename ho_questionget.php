<?php
  session_start();
  if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") {
    echo "Page Not Found :(<br>";
    include("./logout.php");
    echo "<a href='./logout.php'>Back to Home</a>";
    exit();
  }if (!isset($_SESSION['st_code'])) {
    echo "Class Not Selected :(<br>";
    echo "<a href='./staff_select.php'>Back to Select</a>";
    exit();
  }
  if (!isset($_SESSION['type']) || $_SESSION['type']!="2") {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
  if (!isset($_SESSION['gmt_no'])) {
    echo "GMT No. is not Entered :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }
  if (!isset($_SESSION['student_subject'])) {
    echo "Subject Not Selected :(<br>";
    echo "<a href='student_display_select.php'>Back to Previous Page</a>";
    exit();
  }
  $st_code_staff=$_SESSION['st_code'];
  $staff_id=$_SESSION['staff_id'];
   $gmt_no=$_SESSION['gmt_no'];
   $student_subject=$_SESSION['student_subject'];
  include("./Config.php");
  $get_access_code=mysql_query("SELECT access FROM table_staff_details WHERE staff_id='$staff_id'");
                        while($row=mysql_fetch_array($get_access_code))
                        {
                            $access=$row['access'];
                            if ($access!='0') {
                                echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
                            }
                        }
  $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
  while($row=mysql_fetch_array($get_staff_id_name))
  {
    $staff_id_name=$row['staff_name'];
  }

    echo "Hi ".$staff_id_name."...";
  echo "  <br>";
  include("./headerselection.php");

  $sub_name="";
              $sub_query=mysql_query("SELECT subject_code, subject_title FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 echo "<br><center> SUBJECT CODE:".$sub_name=$row['subject_code']; echo "|TITLE: ".$row['subject_title'];echo "<br>GMT NO.:".$gmt_no."</center>";
              }
//Check Already Entered Qsn
  $question_pre=$f_up=$q_up="";
              $question_pre_query=mysql_query("SELECT question FROM table_question WHERE id_subject='$student_subject' AND st_code='$st_code_staff' AND gmt_no='$gmt_no' ");
              while($row=mysql_fetch_array($question_pre_query))
              {
                 $question_pre=$row['question'];
              }
  ?>


      <!--php for form uploading-->
    <?php
          
          /*For Document Uploading*/
          
      $question_pre_query=mysql_query("SELECT question FROM table_question WHERE id_subject='$student_subject' AND st_code='$st_code_staff' AND gmt_no='$gmt_no' ");
              while($row=mysql_fetch_array($question_pre_query))
              {
                 $question_pre=$row['question'];
              }
          /*Variable Declarations*/
          /*

          $question = $_POST["gmt_question"];
          $filename = $_FILES["doc"]["name"];
          $filepath = "../doc_dir/".$filename;*/
          /*Query*/
          /*$sql = "INSERT INTO table_question(gmt_no, question, doc_dir) 
                  VALUES ('$gmt_no','$question','$filepath')";
          $result = mysql_query($sql);
          echo 'File Uploaded<br><br>'; */ ?>
      
		<html>
  <head>
    <title>Question Viewing Portal</title>
  </head>
  <body>
    <!--form for question uploading-->
    

     Question:<br> <textarea  rows="20" cols="100" readonly><?php echo $question_pre; ?></textarea> <br><br>
      
    Attachments:
  </body>
</html>
<?php
  
              $location = "./doc_dir/".$d_n."/".$c_n."/".$b_n."/".$y_n."/".$s_n."/".$student_subject."/";
              $sub_name="";
              $sub_query=mysql_query("SELECT subject_code FROM table_subject WHERE id_subject='$student_subject' AND st_code='$st_code_staff'");
              while($row=mysql_fetch_array($sub_query))
              {
                 $sub_name=$row['subject_code'];
              }
              $gz=$dz='';
              if($gmt_no<'10')
              {
                $gz='0';
              }
              if(date('n')<'10')
              {
                $dz='0';
              }
              $f_name = $sub_name."GMT".$gz.$gmt_no."KeSiG".date('Y');

              $data=$f_name;
              if(is_dir($location)){
              $dirHandle = opendir($location);
                  while ($file = readdir($dirHandle)) {
                    $f_reduced=substr($file, 0,20);
                   if($f_reduced==$data) {
                      
                      echo "<a href='".$location.$file."' name='".$f_name."'>".$f_reduced."</a>";
                    }
                  }
              }
    
  ?>
<br><br>
<a href="ho_in_sub.php"><button>Back</button></a>