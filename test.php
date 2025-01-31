<?php
session_start();
require_once "config.php";

function resize_image_keep_aspect($file, $max_width, $max_height)
{
    list($original_width, $original_height, $image_type) = getimagesize($file);

    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($file);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($file);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($file);
            break;
        default:
            return false; // Unsupported file type
    }

    // คำนวณขนาดใหม่
    $aspect_ratio = $original_width / $original_height;
    if ($original_width > $original_height) {
        $new_width = $max_width;
        $new_height = $max_width / $aspect_ratio;
    } else {
        $new_height = $max_height;
        $new_width = $max_height * $aspect_ratio;
    }

    // ตรวจสอบว่าขนาดใหม่ไม่เกินขนาดที่กำหนด
    if ($new_width > $max_width) {
        $new_width = $max_width;
        $new_height = $new_width / $aspect_ratio;
    }
    if ($new_height > $max_height) {
        $new_height = $max_height;
        $new_width = $new_height * $aspect_ratio;
    }

    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Preserve transparency for PNG and GIF
    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
    }

    imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

    // Save the resized image
    $resized_file = $file;
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            imagejpeg($new_image, $resized_file, 85); // Quality: 85%
            break;
        case IMAGETYPE_PNG:
            imagepng($new_image, $resized_file, 8); // Compression level: 8
            break;
        case IMAGETYPE_GIF:
            imagegif($new_image, $resized_file);
            break;
    }

    imagedestroy($source);
    imagedestroy($new_image);

    return true;
}

// Helper function to validate email
function is_email_valid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (isset($_POST['send'])) {
    // Get form data
    $pname = $_POST['pname'] ?? null;
    $fullname = $_POST['fullname'] ?? null;
    $tel = $_POST['tel'] ?? null;
    $email = $_POST['email'] ?? null;
    $major = $_POST['major'] ?? null;
    $stuid = $_POST['stuid'] ?? null;

    // Split name into first and last names
    $nameParts = explode(' ', $fullname);
    $firstname = $nameParts[0] ?? '';
    $lastname = $nameParts[1] ?? '';

    // Handle file upload
    $uploadedFileName = null;
    if (isset($_FILES['stu_pic']) && $_FILES['stu_pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['stu_pic']['tmp_name'];
        $fileName = $_FILES['stu_pic']['name'];
        $fileSize = $_FILES['stu_pic']['size'];
        $fileType = $_FILES['stu_pic']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            // Fetch current student picture from the database
            $query = "SELECT stu_pic FROM tb_student WHERE stuid = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'i', $stuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $existingPic = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            // Remove old image if it exists
            if ($existingPic && file_exists('./uploads/' . $existingPic['stu_pic'])) {
                unlink('./uploads/' . $existingPic['stu_pic']);
            }

            // Generate new file name and move the uploaded file
            $uploadedFileName = $stuid . '_' . time() . '.' . $fileExtension;
            $destination = './uploads/' . $uploadedFileName;

            // Move the uploaded file to the destination
            if (!move_uploaded_file($fileTmpPath, $destination)) {
                $_SESSION['error'] = "Error uploading the image.";
                header("Location: index.php");
                exit;
            }

            // Resize the image to a max width and height of 300x300 (you can change these values)
            $resize_success = resize_image_keep_aspect($destination, 300, 300);
            if (!$resize_success) {
                $_SESSION['error'] = "Error resizing the image.";
                unlink($destination); // Delete the file if resizing fails
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid file type.";
            header("Location: index.php");
            exit;
        }
    }

    // Validate email format (if provided)
    if (!empty($email) && !is_email_valid($email)) {
        $_SESSION['email_error'] = $email;
        header("Location: index.php");
        exit;
    }

    // Validate phone number format (if provided)
    if (!empty($tel) && !preg_match("/^[0-9]{10}$/", $tel)) {
        $_SESSION['tel_error'] = $tel;
        header("Location: index.php");
        exit;
    }

    // Prepare SQL query for updating student data
    $query = "UPDATE tb_student SET pname = ?, firstname = ?, lastname = ?, tel = ?, email = ?, major = ?, stu_pic = COALESCE(?, stu_pic) WHERE stuid = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sssssssi", $pname, $firstname, $lastname, $tel, $email, $major, $uploadedFileName, $stuid);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Student information updated successfully!";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: index.php");
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: index.php");
}
?>
