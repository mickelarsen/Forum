<?php

echo form_open('user/send_messages');
echo form_label('To:', 'receiver');
echo form_input('receiver', $receiver);
echo form_label('Message:', 'message');
echo form_textarea('message', '', 50, 70);
echo form_submit('submit', 'Send!');
echo form_close();