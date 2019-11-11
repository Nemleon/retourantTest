<?php
function write_errors($time, $error) {
	$file = 'applications/core/errors_log/errors_log.txt';
	$message = $time . $error;
	file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
}