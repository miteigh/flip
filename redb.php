<?php 
    require_once "config.php"; // Include the file to connect to the database
    session_start();
    // var_dump($_POST);
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

    // Add Major Functionality
    if (isset($_POST['addmajor'])) {
        // รับค่าจากฟอร์ม
        $fid = filter_input(INPUT_POST, 'fid');
        $mid = filter_input(INPUT_POST, 'mid');
        $mname = htmlspecialchars($_POST['mname']);
        $mstatus = htmlspecialchars($_POST['mstatus']);
    
        if (empty($fid)) {
            $_SESSION['error_addmajor'] = 'กรุณากรอกรหัสคณะ';
        } else {
            try {
                // ตรวจสอบว่าคณะเลือกเป็นคณะที่มีอยู่ในระบบหรือไม่
                if ($fid == 'other') {
                    // ถ้าเลือก "อื่นๆ" ต้องรับค่าชื่อและรหัสคณะใหม่
                    $newFacultyName = htmlspecialchars($_POST['newFaculty']); // ชื่อคณะใหม่
                    $newFacultyCode = htmlspecialchars($_POST['newFacultyCode']); // รหัสคณะใหม่
    
                    // ตรวจสอบว่าคณะใหม่มีอยู่ในฐานข้อมูลหรือยัง
                    $stmt_check_faculty = $conn->prepare("SELECT * FROM tb_faculty WHERE FID = ?");
                    $stmt_check_faculty->bind_param("s", $newFacultyCode);
                    $stmt_check_faculty->execute();
                    $result_check_faculty = $stmt_check_faculty->get_result();
                    $facultyExists = $result_check_faculty->fetch_assoc();
    
                    if ($facultyExists) {
                        $_SESSION['info'] = "คณะนี้มีอยู่ในระบบแล้ว";
                        $fid = $newFacultyCode; // ใช้รหัสคณะใหม่
                        $fname = $newFacultyName; // ใช้ชื่อคณะใหม่
                    } else {
                        // เพิ่มคณะใหม่ในระบบ
                        $stmt1 = $conn->prepare("INSERT INTO tb_faculty (FID, Fname) VALUES(?, ?)");
                        $stmt1->bind_param("ss", $newFacultyCode, $newFacultyName);
                        $stmt1->execute();
    
                        // ใช้ข้อมูลคณะใหม่
                        $fid = $newFacultyCode;
                        $fname = $newFacultyName;
                    }
                }
    
                // ตรวจสอบว่าสาขาวิชามีอยู่ในระบบหรือไม่
                $stmt_check_major = $conn->prepare("SELECT * FROM tb_major WHERE MID = ?");
                $stmt_check_major->bind_param("s", $mid);
                $stmt_check_major->execute();
                $result_check_major = $stmt_check_major->get_result();
                $major = $result_check_major->fetch_assoc();
    
                if ($major) {
                    $_SESSION['warning_addmajor'] = "มีสาขาวิชานี้อยู่ในระบบแล้ว";
                    header("location: em.php");
                    exit();
                } else {
                    // เพิ่มข้อมูลสาขาวิชา
                    $stmt2 = $conn->prepare("INSERT INTO tb_major (MID, Mname, Mstatus, mfact) 
                                            VALUES(?, ?, ?, ?)");
                    $stmt2->bind_param("ssss", $mid, $mname, $mstatus, $fid);
                    $stmt2->execute();
    
                    $_SESSION['success_addmajor'] = "เพิ่มข้อมูลสาขาวิชาเรียบร้อยแล้ว!";
                    header("location: em.php");
                    exit();
                }
    
            } catch (mysqli_sql_exception $e) {
                $_SESSION['error_addmajor'] = 'มีบางอย่างผิดพลาด: ' . $e->getMessage();
            }
        }
        header("location: em.php");
        exit();
    }      
?>
