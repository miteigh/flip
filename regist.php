<?php
include "config.php";
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ลงทะเบียนใช้งานระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://www.checkinreru.lnw.mn/assets/vendor/datatables/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="https://miteigh.github.io/store/css/sb-admin-2.css">
    <!-- <link rel="stylesheet" href="https://miteigh.github.io/store/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
</head>

<body>
    <div class="container-fluid mt-3">
        <?php
        // $istuid = (isset($_POST['stuid'])) ? $_POST['stuid'] : '';
        // $ipname = (isset($_POST['pname'])) ? $_POST['pname'] : '';
        // $ifname = (isset($_POST['fname'])) ? $_POST['fname'] : '';
        // $ilname = (isset($_POST['lname'])) ? $_POST['lname'] : '';
        // $iemail = (isset($_POST['email'])) ? $_POST['email'] : '';
        // $itel = (isset($_POST['tel'])) ? $_POST['tel'] : '';
        // $imajor = (isset($_POST['major'])) ? $_POST['major'] : '';
        // $itxtsub = (isset($_POST['txtsub'])) ? $_POST['txtsub'] : '';
        // if ($itxtsub = 'turesave') {
        //     if ($istuid != '') {
        //         $sql = "INSERT INTO tb_student (stuid, pname, firstname, lastname, email, tel, major) 
        //                 value('$istuid', '$ipname', '$ifname', '$ilname', '$iemail', '$itel', '$imajor')";
        //         if ($conn->query($sql) === true) {
        //             echo "บันทึกข้อมูลเรียบร้อยแล้ว";
        //         } else {
        //             echo "ไม่สามารถบันทึกข้อมูลได้";
        //         }
        //     }
        // }
        ?>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 mb-3">
                <div class="card">
                    <div class="p-2 pb-0">
                        <?php include "breadcrumb.php" ?>
                    </div>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ระบบลงทะเบียน</h6>
                    </div>
                    <div class="card-body row d-flex justify-content-around">
                        <div class="col-xl-4 d-flex justify-content-center">
                            <form method="post" action="redb.php"> <!-- action="register.php" -->
                                <?php if (isset($_SESSION['error'])) { ?>
                                    <div class="alert alert-danger alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($_SESSION['success'])) { ?>
                                    <div class="alert alert-success alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($_SESSION['warning'])) { ?>
                                    <div class="alert alert-warning alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['warning'];
                                        unset($_SESSION['warning']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <div class="card" style="width: 25rem;">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOUwbsTyIEc064cdHwhQex04trm6rJXJz7hQ&s" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">ลงทะเบียนใช้งานระบบ</h5>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">รหัสนักศึกษา</label>
                                                <input class="form-control" type="text" name="stuid" id="stuid" maxlength="11" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">คำนำหน้าชื่อ</label>
                                                <select class="form-select" name="pname" id="slepname" required>
                                                    <option value="" selected disabled>เลือกคำนำหน้าชื่อ</option>
                                                    <option value="นาย"> นาย </option>
                                                    <option value="นาง"> นาง </option>
                                                    <option value="นางสาว"> นางสาว </option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">ชื่อ</label>
                                                <input class="form-control" type="text" name="fname" id="fname" maxlength="150" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">นามสกุล</label>
                                                <input class="form-control" type="text" name="lname" id="lname" maxlength="150" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">อีเมลล์</label>
                                                <input class="form-control" type="email" name="email" id="email" maxlength="150" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">เบอร์โทร</label>
                                                <input class="form-control" type="tel" name="tel" id="tel" maxlength="10" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-labal">สาขาวิชา</label>
                                                <select class="form-select" name="major" id="slemajor" required>
                                                    <option value="" selected disabled>เลือกสาขาวิชา...</option>
                                                    <?php
                                                    $stmt = $conn->query("SELECT * FROM tb_major WHERE mstatus = 1");
                                                    $stmt->execute();

                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <option value="<?php echo $row['mid'] ?>"><?php echo $row['mname']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    // $sqlcar = "SELECT * FROM tb_major";
                                                    // $resultcar = mysqli_query($conn, $sqlcar) or die(mysqli_error($sqlcar));
                                                    // $numcar = mysqli_num_rows($resultcar);
                                                    // if ($numcar <> 0) {
                                                    //     while ($objResultcar = mysqli_fetch_array($resultcar)) {
                                                    ?>
                                                    <!-- <option value="<?php echo $objResultcar['mid'] ?>"><?php echo $objResultcar['mname']; ?></option> -->
                                                    <?php
                                                    //     }
                                                    // }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <button type="" onclick="window.open('editmajor.php');" class="btn btn-outline-secondary">เพิ่มสาขาวิชา</button>
                                                <input type="text" class="from-control" name="txtsub" id="txtsub" value="turesave" hidden>
                                                <button type="reset" class="btn btn-outline-danger">ยกเลิก</button>
                                                <button type="submit" name="register" class="btn btn-outline-primary">บันทึกข้อมูล</button>
                                            </div>
                                        </div>
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

    <script src="https://miteigh.github.io/store/vendor/jquery/jquery.js"></script>
    <script src="https://miteigh.github.io/store/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://miteigh.github.io/store/js/sb-admin-2.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/jquery-easing/jquery.easing.js"></script>
    <!-- <script src="https://www.checkinreru.lnw.mn/assets/js/demo/datatables-demo.js"></script>
    <script src="https://www.checkinreru.lnw.mn/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://www.checkinreru.lnw.mn/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
</body>

</html>
