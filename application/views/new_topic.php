<?php

echo form_open('posts/create_topic');

echo form_hidden('category_id', $this->uri->segment(3));

echo form_label('Title: ', 'title');
echo form_input('title', '');

echo br(1);

echo form_label('Opening post', 'op');
echo br(1);
echo form_textarea('op', '');

echo form_submit('submit', 'Create topic');

echo form_close();