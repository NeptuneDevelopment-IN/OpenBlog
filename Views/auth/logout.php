<?php
include(__DIR__ . '/../../OpenBlog/Loader.php');

session_destroy();
header('Location: /');
exit('Logged Out');