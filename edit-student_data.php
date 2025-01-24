<?php
require_once "config.php";
session_start();

// เชื่อมต่อฐานข้อมูล
if (isset($_POST['savechange'])) {
    // รับค่าจากฟอร์ม
    $stuid = !empty($_POST['stuid']) ? $_POST['stuid'] : null;
    $pname = !empty($_POST['pname']) ? $_POST['pname'] : null;
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : null;
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : null;
    $tel = !empty($_POST['tel']) ? $_POST['tel'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $major = !empty($_POST['major']) ? $_POST['major'] : null;

    try {
        // ตรวจสอบรูปแบบอีเมล
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email_error'] = 'รูปแบบอีเมลไม่ถูกต้อง!';
            header("Location: edit-student_data.php?stuid=$stuid&email=$email");
            // echo "<script>
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'รูปแบบอีเมลไม่ถูกต้อง!',
            //             text: 'กรุณากรอกอีเมลที่ถูกต้อง.',
            //             confirmButtonText: 'ตกลง'
            //         }).then(() => {
            //             window.location.href = 'edit-student_data.php';
            //         });
            //       </script>";
            exit;
        }

        // ตรวจสอบเบอร์โทรศัพท์ (สามารถปรับรูปแบบที่ต้องการได้)
        if (!preg_match("/^[0-9]{10}$/", $tel)) {
            $_SESSION['tel_error'] = 'เบอร์โทรไม่ถูกต้อง!';
            header("Location: edit-student_data.php?stuid=$stuid");
            // echo "<script>
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง!',
            //             text: 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง (10 หลัก).',
            //             confirmButtonText: 'ตกลง'
            //         }).then(() => {
            //             window.location.href = 'edit-student_data.php';
            //         });
            //       </script>";
            exit;
        }

        // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูล
        $stmt1 = $conn->prepare("UPDATE tb_student 
                                SET pname = :pname, 
                                    firstname = :firstname, 
                                    lastname = :lastname, 
                                    tel = :tel, 
                                    email = :email, 
                                    major = :major 
                                WHERE stuid = :stuid");

        // ผูกค่ากับพารามิเตอร์
        $stmt1->bindParam(':stuid', $stuid);
        $stmt1->bindParam(':pname', $pname);
        $stmt1->bindParam(':firstname', $firstname);
        $stmt1->bindParam(':lastname', $lastname);
        $stmt1->bindParam(':tel', $tel);
        $stmt1->bindParam(':email', $email);
        $stmt1->bindParam(':major', $major);

        // รันคำสั่ง SQL
        if ($stmt1->execute()) {
            $_SESSION['success'] = 'อัปเดตข้อมูลสำเร็จ!';
            // header('Location: student_data.php');
            header('Location: index.php');
            exit;
        } else {
            throw new Exception('เกิดข้อผิดพลาดในการอัปเดตข้อมูล');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: edit-student_data.php?stuid=' . $stuid);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <!-- <link href="https://miteigh.github.io/store/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link href="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- ติดตั้ง SweetAlert ผ่าน CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body id="pasge-top">
    <?php include "header.php" ?>
    <div id="wrapper">
        <?php
        if (isset($_SESSION['email_error'])) {
            echo "<script>
        Swal.fire({
            title: 'เกิดข้อผิดพลาด!',
            // title: 'สำเร็จ!',
            text: 'รูปแบบอีเมล " . (isset($_GET['email']) ? $_GET['email'] : '') . " ไม่ถูกต้อง!',
            // text: 'เข้าสู่ระบบสำเร็จ!',
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    </script>";
            $_SESSION = [];
        } elseif (isset($_SESSION['tel_error'])) {
            echo "<script>
        Swal.fire({
            title: 'เกิดข้อผิดพลาด!',
            text: 'เบอร์โทรไม่ถูกต้อง!',
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    </script>";
            $_SESSION = [];
        } ?>
        <?php
        if (isset($_GET['stuid'])) {
            // รับค่า stuid จาก URL
            $stuid = $_GET['stuid'];
        }
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="contetn">
                <div class="container-fluid mt-3">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM tb_student st
                                        LEFT JOIN tb_major ma on st.major = ma.mid
                                        WHERE stuid = :stuid");
                    // ผูกค่า parameter
                    $stmt->bindParam(':stuid', $stuid, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC)
                    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="p-2 pb-0">
                                    <?php include "breadcrumb.php" ?>
                                </div>
                                <div class="card-header text-primary">
                                    <h4>ข้อมูลนักศึกษา</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" class="form d-flex justify-content-center was-validated" method="post" novalidate>
                                        <?php if (isset($_SESSION['success'])) { ?>
                                            <div class="alert alert-success alcenter" role="alert">
                                                <?php
                                                echo $_SESSION['success'];
                                                unset($_SESSION['success']);
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <div class="col-xl-5">
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="stuid">รหัสนักศึกษา</label><span class="d-none d-lg-inline">:</span>
                                                <input class="col-xl-5 border rounded" type="text" name="stuid" value="<?php echo $row['stuid'] ?>">
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="pname">คำนำหน้าชื่อ</label><span class="d-none d-lg-inline">:</span>
                                                <select class="custom-select mb-1 col-xl-5" name="pname" id="" required>
                                                    <option value="" disabled selected>เลือกคำนำหน้าชื่อ</option>
                                                    <option value="นาย" <?php echo $row['pname'] == "นาย" ? "selected" : "" ?>>นาย</option>
                                                    <option value="นางสาว" <?php echo $row['pname'] == "นางสาว" ? "selected" : "" ?>>นางสาว</option>
                                                    <!-- ตรวจสอบว่ามีสาขาหรือไม่ -->
                                                    <?php //if (!empty($row['pname'])) { 
                                                    ?><!-- ถ้ามีรหัสสาขาวิชา !empty ไม่ไม่มี แปลว่า มี-->
                                                    <!-- <option value="" disabled selected>เลือกคำนำหน้าชื่อ</option>
                                                <option class="text-success" value="<?php //$row['pname'] 
                                                                                    ?>" selected><?php //$row['pname'] 
                                                                                                    ?></option>
                                                <option class="" value="นางสาว">นางสาว</option> -->
                                                    <?php //} else { 
                                                    ?>
                                                    <!-- <option value="" disabled selected>เลือกคำนำหน้าชื่อ</option>
                                                <option value="นาย" >นาย</option>
                                                <option value="นางสาว" >นางสาว</option> -->
                                                    <?php //} 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="firstname">ชื่อจริง</label><span class="d-none d-lg-inline">:</span>
                                                <input class="col-xl-5 border rounded" type="text" name="firstname" value="<?php echo $row['firstname'] ?>" required>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="lastname">นามสกุล</label><span class="d-none d-lg-inline">:</span>
                                                <input class="col-xl-5 border rounded" type="text" name="lastname" value="<?php echo $row['lastname'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="lastname">เบอร์โทร</label><span class="d-none d-lg-inline">:</span>
                                                <input class="col-xl-5 border rounded" id="num" type="text" name="tel" value="<?php echo $row['tel'] ?>" maxlength="10">
                                                <div id="numFeedback" class="text-danger mt-2" style="display: none;">เบอร์โทรต้องประกอบด้วยตัวเลข 0-9</div>
                                            </div>
                                            <div class="col-xl-12" id="form">
                                                <label class="col-xl-4" for="email">อีเมล</label><span class="d-none d-lg-inline">:</span>
                                                <input class="col-xl-5 border rounded" id="email" type="email" name="email" value="<?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                                <div id="emailFeedback" class="text-danger mt-2" style="display: none;">รูปแบบอีเมลไม่ถูกต้อง</div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="col-xl-4" for="lastname">สาขาวิชา</label><span class="d-none d-lg-inline">:</span>
                                                <select class="custom-select col-xl-5" name="major" id="" required>
                                                    <option value="" disabled selected>เลือกสาขาวิชา</option>
                                                    <?php
                                                    $maj = $conn->query("SELECT * FROM tb_major");
                                                    while ($ma = $maj->fetch(PDO::FETCH_ASSOC)) {
                                                        $selected = $row['mid'] == $ma['mid'] ? "selected" : "";
                                                        echo "<option value='{$ma['mid']}' $selected>{$ma['mname']}</option>";
                                                    }
                                                    ?>
                                                    <!-- ตรวจสอบว่ามีสาขาหรือไม่ -->
                                                    <?php //if (!empty($row['mid'])) { 
                                                    ?><!-- ถ้ามีรหัสสาขาวิชา !empty ไม่ไม่มี แปลว่า มี-->
                                                    <!-- <option value="" disabled selected>เลือกสาขาวิชา</option>
                                                <option class="text-success" value="<?php //$row['mid'] 
                                                                                    ?>" selected><?php // $row['mname'] 
                                                                                                    ?></option> -->
                                                    <?php
                                                    // $mnow = $row['mid'];
                                                    // $maj = $conn->prepare("SELECT * FROM tb_major WHERE mid != :mnow");
                                                    // $maj->bindParam(":mnow", $mnow);
                                                    // $maj->execute(); 

                                                    // while ($ma = $maj->fetch(PDO::FETCH_ASSOC)) { 
                                                    ?>
                                                    <!-- <option value="<?php //$ma['mid'] 
                                                                        ?>"><?php // $ma['mname'] 
                                                                            ?></option> -->
                                                    <?php
                                                    // }
                                                    ?>
                                                    <?php //} else { 
                                                    ?>
                                                    <!-- <option value="" disabled selected>เลือกสาขาวิชา</option> -->
                                                    <?php
                                                    //  $major = $conn->query("SELECT * FROM tb_major");
                                                    //  $major->execute();
                                                    //  if ($major->rowCount() > 0) {
                                                    //     while ($majorr = $major->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <!-- <option value="<?php // $majorr['mid'] 
                                                                        ?>"><?php // $majorr['mname'] 
                                                                            ?></option> -->
                                                    <?php
                                                    //}
                                                    //} else {

                                                    // }
                                                    ?>

                                                    <?php //} 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-12 mt-3">
                                                <button type="reset" class="btn btn-secondary">ยกเลิก</button>
                                                <button type="submit" name="savechange" class="btn btn-primary">บันทึก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://miteigh.github.io/store/js/demo/datatables-demo.js"></script>
    <script>
        // new DataTable('#dataTable');
    </script>
    <script src="func.js"></script>
    <script>
    
  </script>
</body>

</html>