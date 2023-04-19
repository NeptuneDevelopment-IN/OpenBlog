<?php

/*
 * This class handles the image uploading of the
 * images that are inserted in the text box...
 */


// Check if any files were uploaded
if (!empty($_FILES['images']['name'])) {
    // Set the upload directory and create it if it doesn't exist
    $upload_dir = 'Assets/userassets';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }

    // Loop through the uploaded files
    $image_urls = array();
    foreach ($_FILES['images']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $name = basename($_FILES['images']['name'][$key]);
            $upload_path = $upload_dir . $name;

            // Move the file to the upload directory
            move_uploaded_file($tmp_name, $upload_path);

            // Add the file URL to the response array
            $image_urls[] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $upload_path;
        }
    }

    // Return the image URLs as a JSON response
    $response = array('data' => $image_urls);
    echo json_encode($response);
} else {
    // No files were uploaded
    http_response_code(400);
    echo 'No files were uploaded.';
}
?>
