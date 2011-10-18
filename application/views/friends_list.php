<?php

echo heading('Friend requests', 4);
echo br(1);
foreach($friend_requests as $friend_request){
	echo $friend_request['user1'];
	echo nbs(5);
	echo form_open('user/friendship');
	echo form_hidden('user2', $friend_request['user1']);
	echo form_submit('submit', 'Accept');
	echo form_close();
	echo form_open('user/friendship_declined');
	echo form_hidden('user_denied', $friend_request['user1']);
	echo form_submit('submit', 'Decline');
	echo form_close();
	echo br(2);
}

echo heading('Friends list', 4);
echo br(1);
foreach ($friends as $friend){
	echo anchor('user/user_profile/'.$friend['user2'], $friend['user2']);
	echo br(1);
}