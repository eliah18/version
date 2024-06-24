<?php
include "conn.php";
ob_start();
session_start();
$session = date('Y');

if(isset($_POST['btnSubmit'])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	 if($username == '' OR $password == ''){
		echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('Please enter the correct username or password')
	 javascript:history.go(-1)
		</SCRIPT>");  
	 
	 }
	
	$sql = "SELECT a.email, a.level , b.access,a.company as company_code,a.Objects, case when a.company = '01' THEN 'ZETDC' WHEN a.company='02' THEN 'ALLIED TIMBERS' ELSE 'BANTU TRACK' END as comp FROM users a  join access_level b on a.level = b.ID WHERE email = '$username' And password='$password'";
			$query = $connection->query($sql);
	
			if($query->num_rows < 1){
				echo("<SCRIPT LANGUAGE='JavaScript'> window.alert('Cannot find account with the username')
				javascript:history.go(-1)
				 </SCRIPT>"); 
			
			}
			else{
				while($row = $query->fetch_assoc())
				{
					$useraccess=$row['access'];
					$access=$row['level'];
					$Company_code=$row['company_code'];
					$Company=$row['comp'];
					$email=$row['email'];
					$Objects=unserialize($row['Objects']);
					
					
					$_SESSION['useraccess']=$useraccess;
					$_SESSION['username']=$email;
					$_SESSION['access']=$access;
					$_SESSION['Objects'] =$Objects;
					$_SESSION['Company'] = $Company;
					$_SESSION['Company_code'] = $Company_code;
	
					if($access =="2" ){
						header("location:../main/GenerateReport.php");
					}
					if( $access =="3" ){
						header("location:../main/Generate.php");
					}

					if( $access =="1" ){
						header("location:../main/users.php");
					}
                    
			
				}
			
			}
			
			
		}
		
	
		
	?>