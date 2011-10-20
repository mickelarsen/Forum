<html>
	<head>
		<?php
			echo link_tag('css/style.css');
			echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
		?>
		<title>Dat Forum</title>
	</head>
<body>

<?php
if($this->session->userdata('username')){
	echo 'Logged in as: '.anchor('user/user_profile/'.$this->session->userdata('username'),$this->session->userdata('username'));
	echo nbs(1);
	echo anchor('user/user_logout', 'Logout!');
	echo br(1);
}else{
	echo form_open('user/user_login');
	echo form_label('Username: ', 'username');
	echo form_input('username');
	echo form_label('Password: ', 'password');
	echo form_password('password');
	echo form_submit('submit', 'Login!');
	echo anchor('user/register', 'Register!');
	echo form_close();
}

if($this->uri->segment(1)){
	$this->breadcrumbs->generate_breadcrumbs();
}
echo br(1);