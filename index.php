
<?php
    session_start();
            if(isset($_SESSION['student_regno']))
            {
                unset($_SESSION['student_regno']);
            }
            if(isset($_SESSION['staff_id']))
            {
                unset($_SESSION['staff_id']);
            }
            if(isset($_SESSION['gmt_no']))
                                    {
                unset($_SESSION['gmt_no']);
            }
            if(isset($_SESSION['student_subject']))
                                    {
                unset($_SESSION['student_subject']);
            }
            if(isset($_SESSION['st_code_staff']))
                                    {
                unset($_SESSION['st_code_staff']);
            }
            if(isset($_SESSION['type']))
                                    {
                unset($_SESSION['type']);
            }
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>GMT Login Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">
     <!-- <link rel="stylesheet" href="scss/style.scss">-->

  
</head>

<body>
  <div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check"></div>
      <div class="login__form">
       
        <form method="post">
         <div class="login__row">
         
          <svg class="login__icon list " viewBox="0 0 20 20">
            I'm<path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <select class="login__input list" name="select"><label>Type</label>
        <option class="login__input name" value="2">Staff</option>
        <option class="login__input name" value="1">Student</option>
        <option class="login__input name" value="3">HOD</option>
        <option class="login__input name" value="4">Principal</option>
        </select>
          </div>
        
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" class="login__input name" placeholder="Username" name="id" pattern="[a-zA-Z0-9]+" title="Staff ID| Register No." required/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="password" class="login__input pass" placeholder="Password"/>
        </div>
        <input type="hidden" name="login" value="1">
        <p><input class="login__submit"  type="submit" value="Login" name="subs"></p>

    
    </form>
    <?php
    include("./Config.php");
    $_SESSION['staff_id']="0";
    if ($_SERVER["REQUEST_METHOD"] == "POST" )
    {


        if(isset($_POST['login']) && isset($_POST['select']))
        {
            

            if(trim($_POST['login'])=="1")
            {
                if(trim($_POST['select'])=="2")
                {
                    
                    $w=$_POST['id'];
                    $p=$_POST['password'];
                    $sql="SELECT staff_id FROM table_staff_details WHERE staff_id='$w' AND staff_password='$p' AND type='1' AND access='' ";
                    $result=mysql_query($sql) or die (mysql_error());
                    $count=mysql_num_rows($result);
                    if($count=='0' or $count>'1')
                    {   
                        sleep(.25);
                        echo "<p class='login__signup'>Invalid Username or Password<p>";
                    }
                    elseif($count == '1')
                    {
                        while($row=mysql_fetch_array($result)){
                            $staff_id =addslashes($row['staff_id']);
                            $type =addslashes($row['type']);
                        }
                         $_SESSION['type']=$type;

                        $_SESSION['staff_id']=$staff_id;
                        sleep(.25);
                        header("location: staff_select.php");

                    }
                }
                if(trim($_POST['select'])=="1")
                {
                    echo $w=$_POST['id'];
                    echo $p=$_POST['password'];
                    echo $student_regno=substr($w, 4);
                    $sql="SELECT student_regno FROM table_student_details WHERE student_regno='$student_regno' AND student_password='$p' ";
                    $result=mysql_query($sql) or die (mysql_error());
                    $count=mysql_num_rows($result);
                    if($count=='0' or $count>'1')
                    {   sleep(.25);
                        echo "<p class='login__signup'>Invalid Username or Password<p>";
                    }
                    elseif($count == '1')
                    {
                        while($row=mysql_fetch_array($result))
                            $student_regno =addslashes($row['student_regno']);

                        $_SESSION['student_regno']=$student_regno;
                        sleep(.25);
                        header("location: student_display_select.php");

                    }
                }
                if(trim($_POST['select'])=="3")
                {
                    $w=$_POST['id'];
                    $p=$_POST['password'];
                    $sql="SELECT staff_id,type FROM table_staff_details WHERE staff_id='$w' AND staff_password='$p' AND type='2' AND access='' ";
                    $result=mysql_query($sql) or die (mysql_error());
                    $count=mysql_num_rows($result);
                    if($count=='0' or $count>'1')
                    {   
                        sleep(.25);
                        echo "<p class='login__signup'>Invalid Username or Password<p>";
                    }
                    elseif($count == '1')
                    {
                        while($row=mysql_fetch_array($result)){
                            $staff_id =addslashes($row['staff_id']);
                            $type =addslashes($row['type']);
                        }
                        $_SESSION['staff_id']=$staff_id;
                        

                        $_SESSION['type']=$type;
                        sleep(.50);
                        header("location: hp_select.php");

                    }
                }
                if(trim($_POST['select'])=="4")
                {
                    $w=$_POST['id'];
                    $p=$_POST['password'];
                    $sql="SELECT staff_id,type FROM table_staff_details WHERE staff_id='$w' AND staff_password='$p' AND type='3' ";
                    $result=mysql_query($sql) or die (mysql_error());
                    $count=mysql_num_rows($result);
                    if($count=='0' or $count>'1')
                    {   
                        sleep(.25);
                        echo "<p class='login__signup'>Invalid Username or Password<p>";
                    }
                    elseif($count == '1')
                    {
                        while($row=mysql_fetch_array($result)){
                            $staff_id =addslashes($row['staff_id']);
                            $type =addslashes($row['type']);
                        }
                        $_SESSION['staff_id']=$staff_id;
                        
                        $_SESSION['type']=$type;
                        sleep(.50);
                        header("location: princi_select.php");

                    }
                }
            }
        }
        
    }
    ?>
    </div>
    </div>
    </div>
  </div>
</div>
  <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>-->

</body>
</html>
