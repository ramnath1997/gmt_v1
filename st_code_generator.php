<?php
							if(isset($_POST['student_year'])){
								$s_year=$_POST['student_year'];
								$s_year=substr($s_year, 2);
							}
									$s_deg='';
									$s_cou=$_POST['student_course'];
									$s_dep=$_POST['student_dept'];
									$s_dep_code="";
									$dep_name=mysql_query("SELECT `code_branch` FROM `table_branch` WHERE `id_branch`= '$s_dep'");
									while($row=mysql_fetch_array($dep_name))
									{
		 								$s_dep_code=$row['code_branch'];
									}
									$deg_name=mysql_query("SELECT `id_degree` FROM `table_course` WHERE `id_course`= '$s_cou'");
									while($row=mysql_fetch_array($deg_name))
									{
		 								$s_deg=$row['id_degree'];
									}
									$s_sem=$_POST['student_sem'];
									$s_section=$_POST['s_section'];
									
									$reg_yr='';

									if($s_sem==1){
										$reg_yr=$year;
									}
									if($s_sem==3){
										$reg_yr=$year-1;
									}
									if($s_sem==5){
										$reg_yr=$year-2;
									}
									if($s_sem==7){
										$reg_yr=$year-3;
									}
									if($s_sem==2){
									if($month>7){
										$reg_yr=$year;
									}
									else {
										$reg_yr=$year-1;
									}
									}
									if($s_sem==4){
									if($month>7){
										$reg_yr=$year-1;
									}
									else {
										$reg_yr=$year-2;
									}
									}
									if($s_sem==6){
									if($month>7){
										$reg_yr=$year-2;
									}
									else {
										$reg_yr=$year-3;
									}
									}
									if($s_sem==8){
									if($month>7){
										$reg_yr=$year-3;
									}
									else {
										$reg_yr=$year-4;
									}
									}
									$reg_yr;
									$reg_yr=substr($reg_yr, 2);
									if($s_year=='' OR strlen($year)!=4){
										$s_year=$reg_yr;
									}
							

			?>