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
				header('Location: index.php');
				exit();
                
									
									?>