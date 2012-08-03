<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Goryo: Form Errors Page</title>
</head>
<body>
<img src="../images/goryologo.jpg" alt="Goryo logo"
	height="70px" width="70px" />
<h2>There are some problems sending your message.</h2>
<p>Please check errors below.</p>

<?php echo validation_errors(); ?><br />
<a href="<?php echo base_url(); ?>goryo_c">Click here to go back to mainpage.</a>

</body>
</html>