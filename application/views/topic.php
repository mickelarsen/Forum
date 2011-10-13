<?php

echo heading($topic[0]['title']);

echo $topic[0]['author'];
echo br(1);
echo $topic[0]['op'];
echo br(2);
foreach($topic_responses as $topic_response){
	
	echo anchor('user/user_profile/'.$topic_response['user'], $topic_response['user']);
	echo br(2);
	echo $topic_response['response'];
	echo br(2);
	
}

echo anchor('posts/new_response/'.$topic[0]['id'], 'New response');
