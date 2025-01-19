<?php
require_once "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://miteigh.github.io/store/css/sb-admin-2.min.css"> -->
    <title>Document</title>

    <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <!-- <link href="https://miteigh.github.io/store/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <!-- <link href="assets/css/bootstrap5.3.3.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- ติดตั้ง SweetAlert ผ่าน CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php include "header.php"  ?>
    <div class="container-fluid mt-3">
        <?php
        $stmt = $conn->prepare("SELECT * FROM tb_student st 
                                LEFT JOIN tb_major ma
                                ON st.major = ma.mid
                                LIMIT 10");
        $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php
        // ตัวอย่างการแสดง SweetAlert หลังจากทำการบันทึกข้อมูล
        if (isset($_SESSION['success'])) {
            echo "<script>
        Swal.fire({
            title: 'สำเร็จ!',
            text: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    </script>";
            $_SESSION = [];
        } elseif (isset($_SESSION['error'])) {
            echo "<script>
        Swal.fire({
            title: 'เกิดข้อผิดพลาด!',
            text: 'ไม่สามารถบันทึกข้อมูลได้',
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    </script>";
            $_SESSION = [];
        } else {
        }
        ?>
        <div class="row justify-content-center" id="tab">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>ข้อมูลนักศึกษา</h4>
                        <!-- <div class="d-flex">
                            <a class="text-gray-700 text-decoration-none" href="regist.php">
                                <h5 class="">เพิ่มข้อมูลนักศึกษา</h5>
                            </a>
                            <a class="ml-2 text-gray-700 text-decoration-none" href="editmajor.php">
                                <h5 class="">เพิ่มข้อมูลสาขาวิชา</h5>
                            </a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="" id="dataTable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัสนักศึกษา</th>
                                        <th>ชื่อนามสกุล</th>
                                        <th>สาขาวิชา</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทร</th>
                                        <th>จัดการข้อมูล</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัสนักศึกษา</th>
                                        <th>ชื่อนามสกุล</th>
                                        <th>สาขาวิชา</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทร</th>
                                        <th>จัดการข้อมูล</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // if (count($result) > 0) {
                                    $index = 1;
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><?php echo $row['stuid'] ?></td>
                                            <td><?php echo $row['pname'] . $row['firstname'] . " " . $row['lastname'] ?></td>
                                            <td><?php echo $row['mname'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['tel'] ?></td>
                                            <td class="d-flex justify-content-center align-items-center"><a class="btn btn-warning" href="edit-student_data.php?stuid=<?= $row['stuid'] ?>">แก้ไข</a>|<button class="btn btn-danger" onclick="deleteData(<?php echo $row['stuid'] ?>)">ลบ</button></td>
                                        </tr>
                                    <?php
                                    }
                                    // } else {
                                    //     echo '<span class="text-danger">ไม่พบข้อมูล</span>';
                                    // }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            new DataTable('#dataTable', {
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ]
            });
        </script>
        <script>
            function deleteData(stuid) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // เรียกใช้การทำงานในการลบข้อมูล
                        // ตัวอย่างการลบข้อมูลโดยการใช้ AJAX หรือการรีเฟรชหน้า
                        // หากต้องการให้เป็น PHP ให้ส่งคำร้องขอจาก JavaScript ไปยัง PHP

                        // ตัวอย่างใช้ AJAX ส่งคำร้องไปลบข้อมูล
                        $.ajax({
                            url: 'student_data.php', // URL ที่จะทำการลบข้อมูล
                            method: 'POST',
                            data: {
                                stuid: stuid
                            }, // ส่ง ID ของข้อมูลที่ต้องการลบ
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // รีเฟรชหน้าเพื่อแสดงข้อมูลล่าสุด
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }
        </script>
        <?php
        // ตรวจสอบว่ามีการส่ง ID มาหรือไม่
        if (isset($_POST['stuid'])) {
            $id = $_POST['stuid'];

            // เตรียมคำสั่ง SQL เพื่อลบข้อมูล
            $stmt = $conn->prepare("DELETE FROM tb_student WHERE stuid = :id");
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo 'Data deleted successfully';
            } else {
                echo 'Failed to delete data';
            }
        }
        ?>
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
        <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
        <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
        <!-- <script src="https://miteigh.github.io/store/js/demo/datatables-demo.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.min.js"></script> -->
        <!-- <script>$(document).ready(function() {
        $('#dataTable').DataTable({
            paging: true,        // Enable pagination
            searching: true,     // Enable search bar
            ordering: true,      // Enable column sorting
            language: {
                lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
                zeroRecords: "ไม่พบข้อมูลที่ตรงกัน",
                info: "แสดงหน้า _PAGE_ จาก _PAGES_",
                infoEmpty: "ไม่มีข้อมูล",
                search: "ค้นหา:",
                paginate: {
                    next: "ถัดไป",
                    previous: "ก่อนหน้า"
                }
            }
        });
    });</script> -->
        <script>
            // new DataTable('#dataTable');
        </script>
        <script src="func.js"></script>
</body>

</html>
