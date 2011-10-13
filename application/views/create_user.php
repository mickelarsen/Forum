<?php

echo form_open('user/create_user');
echo form_label('Username','username');
echo form_input('username', '');
echo form_label('Password', 'password');
echo form_password('password','');

echo form_reset('reset', 'Reset');
echo form_submit('submit', 'Submit');
echo form_close();