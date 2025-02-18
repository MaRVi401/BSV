<?php
// Database connection
$servername = "localhost";
$username = "traproje_proyek1_bsv"; // your database username
$password = "Cf07mJELniTA"; // your database password
$dbname = "traproje_proyek1_bsv";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $photo = null;
    $success = false;

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_ext = pathinfo($photo_name, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($photo_ext), $allowed_ext)) {
            $photo_new_name = uniqid('profile_', true) . '.' . $photo_ext;
            $photo_upload_dir = 'profiles';
            $photo_upload_path = $photo_upload_dir . '/' . $photo_new_name;

            // Check if the directory exists, create it if not
            if (!is_dir($photo_upload_dir)) {
                mkdir($photo_upload_dir, 0755, true);
            }

            // Upload photo
            if (move_uploaded_file($photo_tmp, $photo_upload_path)) {
                $photo = $photo_new_name;
            } else {
                $error_message = "Upload profile gagal, silahkan ulangi kembali.";
            }
        } else {
            $error_message = "Invalid file type. Please upload an image.";
        }
    }

    // Check if the username already exists in the database
    $stmt = $conn->prepare("SELECT photo FROM profiles WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists, update the record
        $stmt->bind_result($existing_photo);
        $stmt->fetch();

        // Delete the old photo if a new one is uploaded
        if ($photo !== null && $existing_photo) {
            $old_photo_path = $photo_upload_dir . '/' . $existing_photo;
            if (file_exists($old_photo_path)) {
                unlink($old_photo_path);
            }
        }

        // Update the record
        $stmt_update = $conn->prepare("UPDATE profiles SET email = ?, photo = ? WHERE username = ?");
        $stmt_update->bind_param("sss", $email, $photo, $username);

        if ($stmt_update->execute()) {
            $success = true;
        } else {
            $error_message = "Error: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        // Username does not exist, insert a new record
        $stmt_insert = $conn->prepare("INSERT INTO profiles (username, email, photo) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $username, $email, $photo);

        if ($stmt_insert->execute()) {
            $success = true;
        } else {
            $error_message = "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt->close();
    $conn->close();

    // Redirect or display message
    if ($success) {
        header("Location: client_dashboard.php");
        exit;
    } else {
        echo isset($error_message) ? $error_message : "Upload profile gagal, silahkan ulangi kembali.";
    }
}
?>
