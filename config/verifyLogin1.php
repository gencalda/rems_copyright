<?php
		session_start();
		require_once 'connection.php';
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con) 
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db($db_database,$con);	
		
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		
		$sql = mysql_query("SELECT userAccUsername as user, userAccPassword as pass, userAccRole as pos, userAccFirstName,userAccMiddleName,userAccLastName FROM useraccount");
		
		while($row = mysql_fetch_assoc($sql))
		{
			$a = $row['user'];
			$b = $row['pass'];
			$c = $row['pos'];
			$f = $row['userAccFirstName'];
			$m = $row['userAccMiddleName'];
			$l = $row['userAccLastName'];
			if ($a == $username && $b == $password)
			{
				$uName = $a;
				$uPass = $b;
				$pos = $c;
				$fname = $f;
				$mname = $m;
				$lname = $l;
			}
		}
		//echo $uName, $uPass, $pos;
		if($_REQUEST['username']== $uName && $_REQUEST['password']==$uPass && $pos == "admin")
		{
			$_SESSION['username']=$uName;
			$_SESSION['password']=$uPass;
			$_SESSION['userAccRole']=$pos;
			$_SESSION['fname'] = $fname;
			$_SESSION['mname'] = $mname;
			$_SESSION['lname'] = $lname;
			header('Location: ../user/admin');
		}
		if($_REQUEST['username']== $uName && $_REQUEST['password']==$uPass && $pos == "hrd")
		{
			$_SESSION['login_name']=$uName;
			$_SESSION['pass_word']=$uPass;
			$_SESSION['accountRole'] = $pos;
			header('location:/getchs/user/hrd/');
		}
		if($_REQUEST['username']== $uName && $_REQUEST['password']==$uPass && $pos == "finance")
		{
			$_SESSION['login_name']=$uName;
			$_SESSION['pass_word']=$uPass;
			$_SESSION['accountRole'] = $pos;
			header('location:/getchs/user/finance/');
		}
		if($_REQUEST['username']== $uName && $_REQUEST['password']==$uPass && $pos == "client")
		{
			$_SESSION['login_name']=$uName;
			$_SESSION['pass_word']=$uPass;
			$_SESSION['accountRole'] = $pos;
			header('location:/getchs/user/client/');
		}
		if($_REQUEST['username']!= $uName && $_REQUEST['password']!=$uPass)
		{
			$_SESSION['login_name']=$uName;
			$_SESSION['pass_word']=$uPass;
			$_SESSION['accountRole'] = $pos;
			header('location:../user/guest/login.php');
		}
	
?>