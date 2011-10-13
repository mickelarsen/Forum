<?php

echo heading($profile[0]['username'], 2);

echo '<div class="profile_gravatar"';
echo '<img src="'.$profile[0]['gravatar'].'">';
echo '</div>';

echo '<div class="profile_attribute">';
echo 'Name: '.$profile[0]['real_name'].' '.$profile[0]['real_lastname'];
echo '</div>';

echo '<div class="profile_attribute">';
echo 'Email: '.$profile[0]['email'];
echo '</div>';

echo '<div class="profile_attribute">';
echo 'Location: '.$profile[0]['location'];
echo '</div>';

echo '<div class="profile_attribute">';
echo 'Birthday: '.$profile[0]['birthday'];
echo '</div>';

echo '<div class="profile_attribute">';
echo 'Signature';
echo br(1);
echo $profile[0]['signature'];
echo '</div>';

if($this->session->userdata('username') == $this->uri->segment(3)){
	echo anchor('user/edit_profile/'.$this->session->userdata('username'), 'Edit profile');
	echo nbs(1);
	echo anchor('user/user_inbox', 'My inbox');
}
echo nbs(1);
if($this->session->userdata('username') != $this->uri->segment(3)){
	echo anchor('user/new_message/'.$profile[0]['username'], 'Send a message to this user!');
}