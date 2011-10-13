<?php

foreach($messages as $message){
	echo anchor('user/user_profile/'.$message['sender'],$message['sender']);
	echo nbs(5);
	echo anchor('user/message/'.$message['message_id'],substr($message['message'], 0, 40));
}
