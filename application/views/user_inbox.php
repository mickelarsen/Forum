<?php

foreach($messages as $message){
	echo anchor('user/user_profile/'.$message['sender'],$message['sender']);
	echo nbs(5);
	echo anchor('user/view_message/'.$message['message_id'],substr($message['message'], 0, 40));
	echo br(1);
}
