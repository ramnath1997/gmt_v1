<?php
    session_start();
    if (!isset($_SESSION['staff_id']) || $_SESSION['staff_id']=="0") 
    {
        echo "Page Not Found :(<br>";
        include("./logout.php");
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    if (!isset($_SESSION['type']) || $_SESSION['type']!="3")
    {
        echo "Unauthorized Access :(<br>";
        echo "<a href='./logout.php'>Back to Home</a>";
        exit();
    }
    $staff_id=$_SESSION['staff_id'];
    include("./Config.php");
    $get_staff_id_name=mysql_query("SELECT staff_name FROM table_staff_details WHERE staff_id='$staff_id'");
    while($row=mysql_fetch_array($get_staff_id_name))
    {
        $staff_id_name=$row['staff_name'];
    }


    $echo_user= "Hi ".$staff_id_name."...";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="scss/style.scss">-->
        <title>Password Changing Portal</title>
    </head>
    <body>
        <div class="cont">
            <div class="demo">
                <div class="login">
                    <div class="login__check_user" >
                        <?php echo " ".$echo_user." ";
                        ?>   
                    </div>
                    <div class="login__form_select">

                        <form method="POST">
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white"> 
                                        
                                    
                                    </text>
                                </svg>
                            </div>
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white"> 
                                        
                                    
                                    </text>
                                </svg>
                            </div>
                            
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Enter Old Password:
                                        
                                    </text>
                                </svg>
                            </div>
                           
                           <div class="login__row">
                                <input type="password" name="old_password" class="login__input pass" placeholder="Password"/>
                            </div>
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white"> 
                                        
                                    
                                    </text>
                                </svg>
                            </div>
                           
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Enter New Password:

                                    </text>
                                </svg>
                            </div>
                            
                            <div class="login__row">
                                <input type="password" name="new_password" class="login__input pass" placeholder="Password"/>
                            </div>
                            <div class="login__row_title">
                                <svg>
                                    <text x="0" y="5" style="font-size: 13px" text-anchor="start" alignment-baseline="start" fill="white">Re-Enter New Password:

                                    </text>
                                </svg>
                            </div>
                            
                            <div class="login__row">
                                <input type="password" name="re_new_password" class="login__input pass" placeholder="Password"/>
                            </div>
                            <center> <input class="login__submit" type="submit" name="change_pass" value="Change Password"></center>
                        </form>
                        
                            <svg>
                                <text x="0" y="5" style="font-size: 12px" text-anchor="start" alignment-baseline="start" fill="white">
                                    <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST" )
                                        {
                                            if(isset($_POST['change_pass']))
                                            {   
                                                if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['re_new_password']))
                                                {
                                                    if(trim($_POST['old_password'])!="" && trim($_POST['new_password'])!='0' && trim($_POST['re_new_password'])!='0')
                                                    {
                                                        $ops=$_POST['old_password'];
                                                        $nps=$_POST['new_password'];
                                                        $rnps=$_POST['re_new_password'];
                                                        $ap_query=mysql_query("SELECT staff_password FROM table_staff_details WHERE staff_id='".$staff_id."'");
                                                        
                                                        if($nps == $rnps)
                                                        {    
                                                            while($row=mysql_fetch_array($ap_query))
                                                            {
                                                                $ap=$row['staff_password'];
                                                            }
                                                            if ($ap == $ops)
                                                            {
                                                                mysql_query("UPDATE table_staff_details SET staff_password='".$nps."' WHERE staff_id='".$staff_id."' ");
                                                                echo "Password Changed";
                                                            }
                                                            else
                                                            {
                                                                echo "Old Password is Wrong";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo "New Passwords not match";
                                                        }
                                                        
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </text>
                            </svg>
                        
                    </div>
                    <!--back and logout buttons-->   
                    <a href="./princi_select.php" ><button class="login__submit_back">Back</button></a>
                </div>
                <a href="logout.php">
                    <button class="app__logout">
                    <svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
                        <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12"/>
                    </svg>
                    </button>
                </a>
            </div>
        </div>
    </body>
</html>