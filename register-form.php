<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,goes,here" />
	<meta name="author" content="Your Name" />
	<link rel="stylesheet" type="text/css" href="css/wstmgt.css" title="m4" media="screen,projection" />
</head>
<body>
<div id="container" >
	<div id="header">
		<h1>WASTE MANAGEMENT SYSTEM</h1>
		<h2>Asystem intended to improve solid waste management activities</h2>
	</div>

	<div id="navigation">
		<ul>
			<li class="selected"><a href="index.php">LOGIN</a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href=""></a></li>
                     <li><a href=""></a></li>
			<li><a href=""></a></li>
		</ul>
	</div>

	<div id="content">
			<div class="met_fet">
            <div id="met_fet-header">User Registration</div>
            <div id="met_fet-main" class="clearfix">
		<?php
		
			//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
		
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo'validation errors';
		echo '<ul class="err">';

		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
	
		//Create query
	$qry="SELECT * FROM members WHERE role='admin'";
	$resu=mysql_query($qry);
	$role = mysql_fetch_array($resu);
	
        ?>

<form id="loginForm" name="loginForm" method="post" action="register-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <th>First Name </th>
      <td><input name="fname" type="text" class="textfield" id="fname" /></td>
    </tr>
    <tr>
      <th>Last Name </th>
      <td><input name="lname" type="text" class="textfield" id="lname" /></td>
    </tr>
    <tr>
      <th width="124">Login</th>
      <td width="168"><input name="login" type="text" class="textfield" id="login" /></td>
    </tr>
      <tr>
      <th width="124">Role</th>
      <td width="168"><select name ="role" class ="combo">
      <option value = "truck_driver">Truck Driver</option>
      <?php if($role == 0) {
		  echo'<option value ="admin">admin</option>';
		  }
		  else{}
	?>
      </select>
      </td>
    </tr>
    <tr>
      <th>Password</th>
      <td><input name="password" type="password" class="textfield" id="password" /></td>
    </tr>
    <tr>
      <th>Confirm Password </th>
      <td><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Register" /></td>
    </tr>
  </table>
</form>
            	</div>
				</div>
	</div>
  <div id="footer">
  <div id="copyright">
<p>&copy; 2017 | Resilient African Network Hackathon</p>
</div>
<!--end copyright-->
</div>
</div>
</body>
</html>