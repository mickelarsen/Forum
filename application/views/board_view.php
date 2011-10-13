<?php

foreach($subforums as $subforum){
	
	echo heading(anchor('posts/subforum/'.$subforum['id'],$subforum['name']));
	echo br(1);
	foreach($categories as $category){
		if($category['subforum_id'] == $subforum['id']){
			echo anchor('posts/category/'.$category['id'],$category['name']);
			echo br(1);
		}
	}
}
