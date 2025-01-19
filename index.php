<?php
require_once "config.php";
session_start();
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://miteigh.github.io/store/css/sb-admin-2.min.css"> -->
  <title>หน้าหลัก</title>

  <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
  <!-- <link href="https://miteigh.github.io/store/css/sb-admin-2.min.css" rel="stylesheet"> -->
  <!-- <link href="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <!-- Include Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- ติดตั้ง SweetAlert ผ่าน CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

</head>

<body>
  <?php
  if (isset($_SESSION['success_addmajor'])) {
    echo "<script>
        Swal.fire({
            title: 'สำเร็จ!',
            text: 'ข้อมูลถูกบันทึกเรียบร้อยแล้ว',
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    </script>";
    unset($_SESSION['success_addmajor']);
  } elseif (isset($_SESSION['error_addmajor'])) {
    echo "<script>
        Swal.fire({
            title: 'เกิดข้อผิดพลาด!',
            text: 'ไม่สามารถบันทึกข้อมูลได้',
            icon: 'error',
            confirmButtonText: 'ตกลง'
        });
    </script>";
    unset($_SESSION['error_addmajor']);
  } else if (isset($_SESSION['warning_addmajor'])) {
    echo "<script>
      Swal.fire({
          title: 'เกิดข้อผิดพลาด!',
          text: 'มีสาขาวิชานี้อยู่ในระบบแล้ว',
          icon: 'warning',
          confirmButtonText: 'ตกลง'
      });
  </script>";
    unset($_SESSION['error_addmajor']);
  }
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
  }
  ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper">

      <!-- Main Content -->
      <div id="content">

        <?php include "header.php" ?>

        <div class="container-fluid container-xxl bd-gutter flex-wrap flex-lg-nowrap">

          <!-- Content Row -->
          <div class="row mt-3">
            <?php
            $tab1 = $conn->prepare("SELECT * FROM tb_student st
                                LEFT JOIN tb_major ma
                                ON st.major = ma.mid
                                LIMIT 10");
            $tab1->execute();
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="row justify-content-center" id="tab">
              <div class="col-xl-12 col-lg-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>ข้อมูลนักศึกษา</h4>
                    <div class="d-flex">
                      <button type="button" class="btn text-gray-700 text-decoration-none" data-bs-toggle="modal" data-bs-target="#addstd" id=""
                        data-bs-whatever="<?php
                                          $adstd = $conn->prepare("SELECT stuid 
                                                    FROM tb_student 
                                                    ORDER BY stuid DESC 
                                                    LIMIT 1");
                                          $adstd->execute();
                                          $row = $adstd->fetch(PDO::FETCH_ASSOC);
                                          // ตรวจสอบว่ามีผลลัพธ์หรือไม่
                                          $latestStdId = $row['stuid'];
                                          if ($row) {
                                            $newStdId = $latestStdId + 1;
                                            echo htmlspecialchars($newStdId);
                                          } else {
                                            echo "ไม่พบข้อมูลนักศึกษา";
                                          }
                                          ?>">
                        <h5 class="">เพิ่มข้อมูลนักศึกษา</h5>
                      </button>
                      <!-- Modal adstd -->
                      <div class="modal fade" id="addstd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลนักศึกษา</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="redb.php" method="post">
                                <div class="mb-3">
                                  <label for="recipient-name" class="col-form-label">รหัสนักศึกษา:</label>
                                  <!-- ฟิลด์สำหรับแสดงค่าที่เพิ่มขึ้น -->
                                  <input type="text" id="stuid" class="form-control" name="stuid" readonly>
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
                                  </select>
                                </div>
                                <!--  -->
                            </div>
                            <div class="modal-footer">
                              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                              <button type="submit" class="btn btn-primary" name="register">บันทึกข้อมูล</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- End Modal adstd-->
                      <!-- vertic line -->
                      <span class="btn">|</span>
                      <!--  -->
                      <button type="button" class="btn ml-2 text-gray-700 text-decoration-none" data-bs-toggle="modal" data-bs-target="#oaddmajor" id="addmajor">
                        <h5 class="">เพิ่มข้อมูลสาขาวิชา</h5>
                      </button>
                      <!-- addmajor Modal -->
                      <div class="modal fade" id="oaddmajor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลสาขาวิชา</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="redb.php" method="post">
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
                                    <option value="other">เพิ่มข้อมูลคณะใหม่</option>
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
                                <!--  -->
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                              <button type="submit" class="btn btn-primary" name="addmajor">บันทึกการเปลี่ยนแปลง</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- End addmajor Modal -->
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="">
                      <table id="myTable" class="display" width="100%" cellspacing="0"> <!-- id="dataTable" -->
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
                          while ($tab = $tab1->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                            <tr>
                              <td><?php echo $index++ ?></td>
                              <td><?php echo $tab['stuid'] ?></td>
                              <td><?php echo $tab['pname'] . $tab['firstname'] . " " . $tab['lastname'] ?></td>
                              <td><?php echo $tab['mname'] ?></td>
                              <td><?php echo $tab['email'] ?></td>
                              <td><?php echo $tab['tel'] ?></td>
                              <td class="d-flex justify-content-center align-items-center"><a class="btn btn-warning" href="edit-student_data.php?stuid=<?= $tab['stuid'] ?>">แก้ไข</a><span class="mx-1">|</span><button class="btn btn-danger" onclick="deleteData(<?php echo $tab['stuid'] ?>)">ลบ</button></td>
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

          </div>

        </div>

      </div>
      <!-- End Main Content -->

    </div>
    <!-- End Content Wrapper -->

  </div>
  <!-- End Page Wrapper -->

  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
  <!-- <script src="https://miteigh.github.io/store/vendor/jquery/jquery.min.js"></script>
        <script src="https://miteigh.github.io/store/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="https://miteigh.github.io/store/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="https://miteigh.github.io/store/js/demo/datatables-demo.js"></script> -->
  <!-- Include jQuery  -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
    new DataTable('#myTable');
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
            url: 'index.php', // URL ที่จะทำการลบข้อมูล
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
  <script>
    $(document).ready(function() {
      // ฟังก์ชันเพื่อเปลี่ยนธีม
      function setTheme(theme) {
        let themeIcon;

        if (theme === 'auto') {
          const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
          $('html').attr('data-bs-theme', isDarkMode ? 'dark' : 'light');
          themeIcon = isDarkMode ? '#moon-stars-fill' : '#sun-fill'; // เลือกไอคอนตามโหมด
        } else {
          $('html').attr('data-bs-theme', theme);
          themeIcon = theme === 'dark' ? '#moon-stars-fill' : '#sun-fill'; // เลือกไอคอนตามธีม
        }

        // เปลี่ยนไอคอนในปุ่ม
        $('#bd-theme svg').attr('href', themeIcon);

        // ทำเครื่องหมายปุ่มที่เลือก
        $('.dropdown-item').removeClass('active');
        $(`button[data-bs-theme-value="${theme}"]`).addClass('active');

        // บันทึกธีมที่เลือกใน localStorage
        localStorage.setItem('theme', theme);
      }

      // ตรวจสอบธีมที่เก็บใน localStorage หรือใช้ค่าเริ่มต้นเป็น 'auto'
      const savedTheme = localStorage.getItem('theme') || 'auto';
      setTheme(savedTheme);

      // อัปเดตธีมเมื่อผู้ใช้เปลี่ยนการตั้งค่าในระบบ (เช่นจาก Light ไป Dark หรือกลับกัน)
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'auto') {
          setTheme('auto');
        }
      });

      // เมื่อคลิกที่ปุ่มใน dropdown ให้เปลี่ยนธีม
      $('.dropdown-item').click(function() {
        const selectedTheme = $(this).data('bs-theme-value');
        setTheme(selectedTheme);
      });
    });
    $(document).ready(function() {
      // เมื่อหน้าโหลด ให้ตรวจสอบและตั้งค่า theme และไอคอน
      function setThemeFromLocalStorage() {
        var storedTheme = localStorage.getItem('theme') || 'dark'; // ถ้าไม่มีค่า theme เก็บไว้ จะตั้งค่าเป็น 'dark'
        var iconElement = $('#theme-icon');

        // ตั้งค่าไอคอนตามธีมที่เก็บไว้
        switch (storedTheme) {
          case 'light':
            iconElement.attr('href', '#sun-fill');
            break;
          case 'dark':
            iconElement.attr('href', '#moon-stars-fill');
            break;
          case 'auto':
            iconElement.attr('href', '#circle-half');
            break;
        }

        // ตั้งค่าปุ่ม active ตามธีมที่เก็บไว้
        $('[data-bs-theme-value]').removeClass('active');
        $('[data-bs-theme-value="' + storedTheme + '"]').addClass('active');
      }

      // เมื่อผู้ใช้เลือกธีม
      $('[data-bs-theme-value]').on('click', function() {
        var themeValue = $(this).attr('data-bs-theme-value');
        var iconElement = $('#theme-icon');

        // เปลี่ยนไอคอนในปุ่มตามธีมที่เลือก
        switch (themeValue) {
          case 'light':
            iconElement.attr('href', '#sun-fill');
            break;
          case 'dark':
            iconElement.attr('href', '#moon-stars-fill');
            break;
          case 'auto':
            iconElement.attr('href', '#circle-half');
            break;
        }

        // เก็บค่าธีมที่เลือกใน localStorage
        localStorage.setItem('theme', themeValue);

        // เปลี่ยนสถานะ active ของเมนู
        $('[data-bs-theme-value]').removeClass('active');
        $(this).addClass('active');
      });

      // ตั้งค่าธีมและไอคอนเมื่อโหลดหน้าใหม่
      setThemeFromLocalStorage();
    });
  </script>
  <script>
    const exampleModal = document.getElementById('addstd')
    if (exampleModal) {
      exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('#stuid')

        modalTitle.textContent = `เพิ่มข้อมูลนักศึกษา ${recipient}`
        modalBodyInput.value = recipient
      })
    }
    const addmajor = document.getElementById('oaddmajor')
    if (addmajor) {
      addmajor.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = addmajor.querySelector('.modal-title')
        const modalBodyInput = addmajor.querySelector('#stuid')

        // modalTitle.textContent = `เพิ่มข้อมูลนักศึกษา ${recipient}`
        modalBodyInput.value = recipient
      })
    }

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
</body>

</html>
