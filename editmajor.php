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
    <!-- <link rel="stylesheet" href="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.css"> -->
    <!-- <link rel="stylesheet" href="https://miteigh.github.io/store/css/sb-admin-2.css"> -->
    <!-- <link rel="stylesheet" href="https://miteigh.github.io/store/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->
    <!-- ติดตั้ง SweetAlert ผ่าน CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
    // แสดงข้อความถ้ามีข้อผิดพลาดหรือสำเร็จ
    if (isset($_SESSION['error'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด!',
                text: '" . addslashes($_SESSION['error']) . "',
                confirmButtonText: 'ตกลง'
            });
          </script>";
        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '" . addslashes($_SESSION['success']) . "',
                confirmButtonText: 'ตกลง'
            });
          </script>";
        unset($_SESSION['success']);
    }
    ?>
    <?php include "header.php" ?>
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
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="addmajor">
                        <h6 class="m-0 font-weight-bold text-primary">ระบบเพิ่มสาขาวิชา</h6>
                    </div>
                    <div class="card-body row d-flex justify-content-around">

                        <div class="col-xl-4 col-lg-4 col-sm-4 d-flex justify-content-center">
                            <form method="post" action="redb.php"> <!-- action="register.php" -->
                                <?php if (isset($_SESSION['error_addmajor'])) { ?>
                                    <div class="alert alert-danger alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['error_addmajor'];
                                        unset($_SESSION['error_addmajor']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($_SESSION['success_addmajor'])) { ?>
                                    <div class="alert alert-success alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['success_addmajor'];
                                        unset($_SESSION['success_addmajor']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($_SESSION['warning_addmajor'])) { ?>
                                    <div class="alert alert-warning alcenter" role="alert">
                                        <?php
                                        echo $_SESSION['warning_addmajor'];
                                        unset($_SESSION['warning_addmajor']);
                                        ?>
                                    </div>
                                <?php } ?>
                                <div class="card" style="width: 25rem;">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOUwbsTyIEc064cdHwhQex04trm6rJXJz7hQ&s" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">เพิ่มข้อมูลสาขาวิชา</h5>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">รหัสคณะ:</label>
                                            <!-- <input type="text" class="form-control" id="recipient-name" name="fid" require> -->
                                            <select class="form-select" name="fid" id="faculty" onchange="toggleInputField(this)" required>
                                                <option value="" selected disabled>เลือกคณะ...</option>
                                                <?php
                                                $stmt = $conn->query("SELECT * FROM tb_faculty");
                                                $stmt->execute();

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <option value="<?php echo $row['FID'] ?>"><?php echo $row['FID'] . ": " . $row['Fname']; ?></option>
                                                <?php } ?>
                                                <option value="other">อื่นๆ</option>
                                            </select>
                                            <!-- ฟอร์มสำหรับพิมพ์คณะใหม่ -->
                                        </div>
                                        <div class="mb-3" id="new-faculty-input" style="display:none;">
                                            <label for="newFaculty" class="col-form-label">กรอกรหัสคณะใหม่:</label>
                                            <input type="text" class="form-control" id="newFaculty" name="newFacultyCode">
                                            <label for="newFaculty" class="col-form-label">กรอกชื่อคณะใหม่:</label>
                                            <input type="text" class="form-control" id="newFaculty" name="newFaculty">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">รหัสสาขาวิชา:</label>
                                            <input class="form-control" id="message-text" name="mid">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">ชื่อสาขาวิชา:</label>
                                            <input class="form-control" id="message-text" name="mname">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">สถานะวิชา:</label>
                                            <select class="form-select" aria-label="Default select example" name="mstatus">
                                                <option selected disabled>สถานะวิชา</option>
                                                <option value="1">เปิด</option>
                                                <option value="2">ปิด</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-primary" name="addmajor">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 ">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">ระบบลงทะเบียน</h6>
                        <?php if (isset($_SESSION['error_update'])) { ?>
                            <div class="alert alert-danger alcenter" role="alert">
                                <?php
                                echo $_SESSION['error_update'];
                                unset($_SESSION['error_update']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['success_update'])) { ?>
                            <div class="alert alert-success alcenter" role="alert">
                                <?php
                                echo $_SESSION['success_update'];
                                unset($_SESSION['success_update']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['warning_update'])) { ?>
                            <div class="alert alert-warning alcenter" role="alert">
                                <?php
                                echo $_SESSION['warning_update'];
                                unset($_SESSION['warning_update']);
                                ?>
                            </div>
                        <?php } ?>
                        <div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger ml-1" id="bulkDeleteButton">
                                    <i class="fas fa-trash fa-sm"></i>
                                    <span class="mr-2 d-none d-lg-inline" onclick="confirmBulkDelete()">ลบที่เลือก</span>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ยืนยันการลบ</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                คุณแน่ใจหรือไม่ว่าต้องการลบ<?php echo $row['mid']; ?>ข้อมูลที่เลือก?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal" form="bulkActionForm">ยืนยัน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-around">
                        <!-- DataTales Example -->
                        <div class="col-lg-11">
                            <table class="" id="dataTable" width="100%" cellspacing="0">
                                <?php
                                // ดึงข้อมูลจากตาราง db_faculty และ db_major ที่เชื่อมโยงกันผ่าน FID
                                $sql = "SELECT * FROM tb_faculty f
                                                        JOIN tb_major m ON f.FID = m.mfact"; // ทำการ JOIN ตาราง tb_faculty กับ tb_major โดยใช้ FID

                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>รหัสคณะ</th>
                                        <th>ชื่อคณะ</th>
                                        <th>รหัสสาขาวิชา</th>
                                        <th>ชื่อสาขาวิชา</th>
                                        <th>สถานะ</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllFooter"></th>
                                        <th>รหัสคณะ</th>
                                        <th>ชื่อคณะ</th>
                                        <th>รหัสสาขาวิชา</th>
                                        <th>ชื่อสาขาวิชา</th>
                                        <th>สถานะ</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // แสดงผลข้อมูลที่ดึงมาจาก JOIN
                                    foreach ($results as $row) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" class="rowCheckbox" name="mid[]" value="<?php echo $row['mid']; ?>"></td>
                                            <td><?php echo $row['FID']; ?></td>
                                            <td><?php echo $row['Fname']; ?></td>
                                            <td><?php echo $row['mid']; ?></td>
                                            <td><?php echo $row['mname']; ?></td>
                                            <td><?php echo $row['mstatus'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                            <td><button type="submit" class="btn btn-warning btn-sm text-gray-900" onclick="openEditModal( 
                                                                '<?php echo addslashes($row['mid']); ?>',
                                                                '<?php echo addslashes($row['mfact']); ?>', 
                                                                '<?php echo addslashes($row['mname']); ?>', 
                                                                '<?php echo addslashes($row['mstatus']); ?>')">แก้ไข</button></td>
                                            <td>
                                                <!-- ปุ่มลบ -->
                                                <!-- <form action="delete.php" method="POST" style="display:inline;"> -->
                                                <!-- <input type="hidden" name="mid" value="<?php echo $row['mid']; ?>"> -->
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete('<?php echo $row['mid']; ?>')">ลบ</button>
                                                <!-- </form> -->
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <script>
                                function confirmDelete(mid) {
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
                                                url: 'delete.php', // URL ที่จะทำการลบข้อมูล
                                                method: 'POST',
                                                data: {
                                                    mid: mid
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
                            <!-- Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูล</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <form id="editForm" action="update.php" method="post">
                                            <div class="modal-body">
                                                <!-- ซ่อนค่า MID -->
                                                <!-- <input type="hidden" id="editMid" value="" name="mid"> -->
                                                <div class="mb-3">
                                                    <label for="editFname" class="form-label">รหัสคณะ</label>
                                                    <input type="text" class="form-control" id="editMfact" name="mfact" value="" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editFname" class="form-label">ชื่อคณะ</label>
                                                    <input type="text" class="form-control" id="editMid" name="mid" value="" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editFname" class="form-label">ชื่อ</label>
                                                    <input type="text" class="form-control" id="editMname" name="mname" value="" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStatus" class="form-label">สถานะ</label>
                                                    <select class="custom-select" id="editStatus" name="mstatus" value="" required>
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary" name="update">บันทึกการเปลี่ยนแปลง</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- End Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">ยืนยันการลบ</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?
                                            <input type="hidden" id="deleteMid"> <!-- ฟิลด์ซ่อนสำหรับเก็บ MID -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteMajor()">ยืนยัน</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

                        </div>
                        <!-- End DataTables Example -->
                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.js"></script>
    <script src="https://miteigh.github.io/store/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://miteigh.github.io/store/js/sb-admin-2.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/jquery-easing/jquery.easing.js"></script>
    <script src="https://miteigh.github.io/store/js/demo/datatables-demo.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script> new DataTable('#dataTable')</script>
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.rowCheckbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
        document.getElementById('selectAllFooter').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.rowCheckbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
        // document.getElementById('bulkDeleteButton').addEventListener('click', function() {
        //     const selected = document.querySelectorAll('input[name="ids[]"]:checked');
        //     if (selected.length > 0) {
        //         const deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        //         deleteModal.show();
        //     } else {
        //         alert("Please select at least one item to delete.");
        //     }
        // });

        // function confirmDelete(mid) {
        //     // เก็บค่า MID ใน input ซ่อน
        //     document.getElementById('deleteMid').value = mid;
        //     // เปิด Modal
        //     $('#confirmDeleteModal').modal('show');
        // }

        function openEditModal(mid, mfact, mname, mstatus) {
            // เติมข้อมูลลงในฟอร์มของ Modal
            document.getElementById('editMid').value = mid;
            document.getElementById('editMfact').value = mfact;
            document.getElementById('editMname').value = mname;
            document.getElementById('editStatus').value = mstatus;

            // เปิด Modal
            $('#editModal').modal('show');
        }

        function deleteMajor() {
            var mid = document.getElementById('deleteMid').value; // ดึงค่า MID จาก input ซ่อน

            // ส่งคำขอ AJAX ไปยังเซิร์ฟเวอร์เพื่อลบข้อมูล
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {
                    mid: mid
                },
                success: function(response) {
                    //     alert('ลบข้อมูลสำเร็จ!');
                    location.reload(); // รีเฟรชหน้าเว็บ
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                }
            });
        }

        function confirmBulkDelete() {
            var selected = [];
            document.querySelectorAll('.rowCheckbox:checked').forEach(function(checkbox) {
                selected.push(checkbox.value);
            });

            if (selected.length === 0) {
                alert('กรุณาเลือกข้อมูลที่ต้องการลบ');
                return;
            }

            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลที่เลือก?')) {
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {
                        mids: selected
                    },
                    success: function() {
                        alert('ลบข้อมูลสำเร็จ!');
                        location.reload();
                    },
                    error: function() {
                        alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                    }
                });
            }
        }
    </script>
    <script>
        function toggleInputField(select) {
            // ตรวจสอบว่าเลือกตัวเลือก "อื่นๆ" หรือไม่
            var inputField = document.getElementById('new-faculty-input');
            if (select.value === 'other') {
                inputField.style.display = 'block'; // แสดงช่องพิมพ์
            } else {
                inputField.style.display = 'none'; // ซ่อนช่องพิมพ์
            }
        }
    </script>
    <script src="func.js"></script>

</body>

</html>
