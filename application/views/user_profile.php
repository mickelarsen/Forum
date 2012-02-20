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
	$unread = 0;
	foreach($messages as $message){
		if($message['read'] == 0){
			$unread+=1;
		}
	}
	echo anchor('user/user_inbox', 'My inbox('.$unread.')');
	echo nbs(1);
	echo anchor('user/view_friends', 'My friends');
}
if($this->session->userdata('username') != $this->uri->segment(3) && $this->session->userdata('username')){
	echo anchor('user/new_message/'.$profile[0]['username'], 'Send a message to this user!');
	echo br(1);
	if($friends[0]['user2'] != $this->uri->segment(3) && !empty($friends[0])){
		echo form_open('user/friend_request');
		echo form_hidden('user2',$profile[0]['username']);
		echo form_submit('submit', 'Add as friend');
		echo form_close();
	}else{
		echo form_open('user/remove_friend/'.$profile[0]['username']);
		echo form_hidden('user2', $profile[0]['username']);
		echo form_submit('submit', 'Remove from friends');
		echo form_close();
	}
}

if($this->session->userdata('admin') == 1){
	echo anchor('user/moderator_promotion/'.$profile[0]['username'], 'Promote this user to moderator.');
}
