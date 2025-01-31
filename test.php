<?php
require_once "config.php"; // Include the file to connect to the database
session_start();
// Function to check if a username exists (using mysqli)
function check_user_exists($conn, $stuid)
{
    $stmt = $conn->prepare("SELECT * FROM tb_student WHERE stuid = ?");
    $stmt->bind_param("s", $stuid); // Bind the student ID as a string
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to validate email format
function is_email_valid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (isset($_POST['register'])) {
    //รับค่าจากฟอร์ม
    $stuid = $_POST['stuid'];
    $pname = filter_input(INPUT_POST, 'pname');
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $major = htmlspecialchars($_POST['major']);

    // Form validation
    if (empty($stuid)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
    } else if (empty($pname)) {
        $_SESSION['error'] = 'กรุณาเลือกคำนำหน้า';
    } else if (empty($firstname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'กรุณากรอกนามสกุล';
    } else if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
    } else if (!is_email_valid($email)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
    } else if (empty($tel)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
    } else if (empty($major)) {
        $_SESSION['error'] = 'กรุณาเลือกสาขาวิชา';
    } else {
        try {
            $row = check_user_exists($conn, $stuid);

            if ($row) {
                $_SESSION['warning'] = "มีรหัสนักศึกษานี้อยู่ในระบบแล้ว";
                header("location: index.php");
                exit();
            } else {
                // Prepare statement to insert data
                $stmt = $conn->prepare("INSERT INTO tb_student (stuid, pname, firstname, lastname, email, tel, major) 
                                        VALUES(?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $stuid, $pname, $firstname, $lastname, $email, $tel, $major);
                $stmt->execute();
                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว!";
                header("location: index.php");
                exit();
            }

        } catch (mysqli_sql_exception $e) {
            $_SESSION['error'] = 'มีบางอย่างผิดพลาด: ' . $e->getMessage();
        }
    }
    header("location: index.php");
    exit();
}
?>
