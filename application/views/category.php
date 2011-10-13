<?php

echo heading($category[0]['name'], 2);

echo br(3);

echo anchor('posts/new_topic/'.$category[0]['id'], 'New topic');

echo br(2);

foreach($topics as $topic){
	echo anchor('posts/topic/'.$topic['id'], $topic['title']);
	echo br(1);
	echo anchor('user/user_profile/'.$topic['author'], $topic['author']);
	echo nbs(3);
	echo $topic['creation_date'];
	echo br(3);
}
