<?php
echo heading($subforum[0]['name'], 2);

foreach($categories as $category){
	echo anchor('posts/category/'.$category['id'], $category['name']);
	echo br(1);
}