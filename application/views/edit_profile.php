<?php

if($this->session->userdata('username') == $this->uri->segment(3)){
echo form_open('user/submit_profile');

echo 'Hurr';
echo form_label('Name: ','real_name');
echo form_input('real_name', $this->session->userdata('real_name'));
echo br(1);

echo form_label('Lastname: ','real_lastname');
echo form_input('real_lastname', $this->session->userdata('real_lastname'));
echo br(1);

echo form_label('Email: ','email');
echo form_input('email', $this->session->userdata('email'));
echo br(1);

echo form_label('Location: ','location');
echo form_input('location', $this->session->userdata('location'));
echo br(1);

echo form_label('Birthday: ','birthday');
echo form_input('birthday', $this->session->userdata('birthday'));
echo br(1);

echo form_label('Gravatar url: ','gravatar');
echo form_input('gravatar', $this->session->userdata('gravatar'));
echo br(1);

$signature_array = array('name' => 'signature',
						 'value' => $this->session->userdata('signature'),
						 'rows' => '2',
						 'cols' => '80'
						 );
echo form_label('Signature (80 characters)','signature');
echo form_textarea($signature_array);
echo br(1);

echo form_submit('submit', 'Update');
echo form_close();
}else{
	echo 'And what do you think you are up to?';
}
