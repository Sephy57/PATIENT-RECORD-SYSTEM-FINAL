<?php

include '../config/index.php';

header('Content-Type: text/plain');
echo csrf_token();
