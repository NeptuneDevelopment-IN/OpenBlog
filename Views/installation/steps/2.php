<?php 
if (isset($_POST)) {
    // Loop over the $_POST array and process the form data
    foreach ($_POST as $key => $value) {
      echo $_POST['website_name'];
    }
  } else {
    // Handle the case where the $_POST array is not set
    echo "No form data received.";
  }


?>