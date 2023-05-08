<?php
include(__DIR__. '/../utils/loader.php');
if (!isset($_FILES['file'])) {
    http_response_code(400);
    echo 'No file uploaded';
    exit;
}

$file = $_FILES['file'];
$targetDir = 'Assets/userassets/';

// Check if the uploaded file size is less than or equal to 8 MB
if ($file['size'] > 8 * 1024 * 1024) {
    http_response_code(400);
    echo 'File size should be less than or equal to 8 MB';
    exit;
}


// Check if the uploaded file is an image
$imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    http_response_code(400);
    echo 'Only image files are allowed';
    exit;
}


$targetFile = $targetDir . basename($file['name']);

if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    echo 'File uploaded successfully';
} else {
    http_response_code(500);
    echo 'Error uploading file';
}
?>
