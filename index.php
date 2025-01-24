<?php
require_once "config.php";
session_start();
// var_dump($_POST);
// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://miteigh.github.io/store/css/sb-admin-2.min.css"> -->
  <title>หน้าหลัก</title>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Datables.net CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/3.0.0/css/select.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.bulma.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bulma.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css"> 
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css"> 

  <!-- Datables.net highcharts CSS -->
  <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">

  <!-- Include Bootstrap Icons -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> -->

  <!-- ติดตั้ง SweetAlert ผ่าน CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="assets/css/preload.css">

</head>

<body>
  <!-- พื้นที่แสดงพรีโหลด -->
  <div class="preload" id="preload">
    <!-- <div class="loader" role="status"> -->
    <!-- <span class="visually-hidden">Loading...</span> -->
    <?php include "components/preload.php" ?>
    <!-- </div> -->
  </div>
  <!-- <div class="preload" id="preload-screen">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div> -->
  <script>
    function readURLPIC(input) {
      if (input.files[0]) {
        let reader = new FileReader();
        document.querySelector('#editpicControl').classList.replace("d-none", "d-block");
        reader.onload = function(e) {
          let element = document.querySelector('#editpicUpload');
          element.setAttribute("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <?php if (isset($_SESSION['error'])): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด',
        text: '<?php echo $_SESSION['error']; ?>',
        confirmButtonText: 'ตกลง'
      });
    </script>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: '<?php echo $_SESSION['success']; ?>',
        confirmButtonText: 'ตกลง'
      });
    </script>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>
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
          <div class="row mt-3 px-3 justify-content-center">
            <?php
            $tab1 = $conn->prepare("SELECT * FROM tb_student st
                                LEFT JOIN tb_major ma
                                ON st.major = ma.mid
                                ");
            $tab1->execute();
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="row justify-content-center" id="tab">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>ข้อมูลนักศึกษา</h4>
                    <div class="d-flex">
                      <button type="button" class="btn text-gray-700 text-decoration-none btn-primary" data-bs-toggle="modal" data-bs-target="#addstd" id=""
                        data-bs-whatever="<?php
                                          $adstd = $conn->prepare("SELECT *
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
                                            echo "64414402000";
                                          }
                                          ?>">
                        <i class="bi bi-person-fill-add fs-1 d-lg-none"></i>
                        <h5 class="d-none d-lg-inline">เพิ่มข้อมูลนักศึกษา</h5>
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
                                <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">รหัสนักศึกษา</span>
                                  <input type="text" class="form-control" id="stuid" aria-label="Username" name="stuid" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                  <label class="input-group-text" for="inputGroupSelect01">คำนำหน้า</label>
                                  <select class="form-select" id="inputGroupSelect01" name="pname">
                                    <option value="" disabled selected>เลือกคำนำหน้าชื่อ</option>
                                    <option value="นาย"> นาย </option>
                                    <option value="นาง"> นาง </option>
                                    <option value="นางสาว"> นางสาว </option>
                                  </select>
                                </div>
                                <div class="form-floating mb-3">
                                  <input type="text" class="form-control" id="floatingfirstname" name="firstname" placeholder="">
                                  <label for="floatingfirstname">ชื่อ</label>
                                </div>
                                <div class="form-floating mb-3">
                                  <input type="text" class="form-control" id="floatingsurname" name="lastname" placeholder="">
                                  <label for="floatingsurname">นามสกุล</label>
                                </div>
                                <div class="form-floating mb-3">
                                  <input type="email" class="form-control" id="floatingemail" name="email" placeholder="">
                                  <label for="floatingemail">อีเมล</label>
                                </div>
                                <div class="form-floating mb-3">
                                  <input type="tel" class="form-control" id="floatingtel" name="tel" placeholder="" maxlength="10">
                                  <label for="floatingtel">เบอร์โทร</label>
                                </div>
                                <div class="input-group mb-3">
                                  <label class="input-group-text">สาขาวิชา</label>
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
                      <!-- <span class="d-flex align-items-center fs-2 py-2">|</span> -->
                      <!--  -->
                      <button type="button" class="btn ml-2 text-gray-700 text-decoration-none" data-bs-toggle="modal" data-bs-target="#oaddmajor" id="addmajor">
                        <i class="bi bi-file-earmark-plus-fill fs-2 d-lg-none"></i>
                        <h5 class="d-none d-lg-inline">เพิ่มข้อมูลสาขาวิชา</h5>
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
                    <table id="myTable" class="display responsive table table-striped nowrap" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                      <thead>
                        <tr>
                          <th></th>
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
                          <th></th>
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
                            <td></td>
                            <td><?php echo $tab['stuid'] ?></td>
                            <td><?php echo $tab['pname'] . $tab['firstname'] . " " . $tab['lastname'] ?></td>
                            <td><?php echo $tab['mname'] ?></td>
                            <td><?php echo $tab['email'] ?></td>
                            <td><?php echo $tab['tel'] ?></td>
                            <!-- <td class="d-flex justify-content-center align-items-center"><a class="btn btn-warning" href="edit-student_data.php?stuid=<?php //$tab['stuid'] 
                                                                                                                                                            ?>">แก้ไข</a><span class="mx-1">|</span><button class="btn btn-danger" onclick="deleteData(<?php //echo $tab['stuid'] 
                                                                                                                                                                                                                                                        ?>)">ลบ</button></td> -->
                            <td><button type="button" class="btn btn-warning" onclick="showHintdataeditstudent(<?php echo $tab['stuid']; ?>)" data-bs-toggle="modal" data-bs-target="#editstd">แก้ไข</button><span class="mx-1">|</span><button class="btn btn-danger" onclick="deleteData(<?php echo $tab['stuid'] ?>)">ลบ</button></td>
                            <!-- class="d-flex justify-content-center align-items-center" -->
                          </tr>
                        <?php
                        }
                        // } else {
                        //     echo '<span class="text-danger">ไม่พบข้อมูล</span>';
                        // }
                        ?>
                      </tbody>
                    </table>
                    <div class="">
                    </div>
                  </div>
                </div>
              </div>
              <!-- editstd -->
              <?php
              if (isset($_SESSION['success'])) {
                echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: '" . $_SESSION['success'] . "',
            confirmButtonText: 'ตกลง'
        });
    </script>";
                unset($_SESSION['success']);
              }

              if (isset($_SESSION['error'])) {
                echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ข้อผิดพลาด!',
            text: '" . $_SESSION['error'] . "',
            confirmButtonText: 'ตกลง'
        });
    </script>";
                unset($_SESSION['error']);
              }
              ?>
              <div class="modal fade" id="editstd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขข้อมูลนักศึกษา</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="test.php" method="post" enctype="multipart/form-data">
                        <div id="editst"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="send">Send message</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end editstd -->
              <div id="demo-output" style="margin-bottom: 1em;" class="chart-display"></div>
            </div>

          </div>

        </div>

      </div>
      <!-- End Main Content -->

    </div>
    <!-- End Content Wrapper -->

  </div>
  <!-- End Page Wrapper -->

  <!-- Include jQuery  -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

  <!-- Datatables.net JS -->
  <!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script> --> 
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>

  <!-- Datatables.net highcharts JS -->
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <!-- <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <?php
  $data = []; // สร้าง array สำหรับเก็บข้อมูล
  $index = 1;
  while ($tab = $tab1->fetch(PDO::FETCH_ASSOC)) {
    // สะสมข้อมูลสาขาวิชา
    $major = $tab['mname'];
    if (!isset($data[$major])) {
      $data[$major] = 0; // เริ่มนับที่ 0 ถ้ายังไม่มีข้อมูลของสาขานี้
    }
    $data[$major]++;
  }

  // แปลงเป็น JSON เพื่อส่งไป JavaScript
  $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
  ?>

  <script>
    // ลบพรีโหลดหลังจากหน้าเว็บโหลดเสร็จ
    window.onload = function() {
      document.getElementById("preload").style.display = "none";
    };
    // window.onload = function() {
    //   setTimeout(function() {
    //     document.getElementById("preload").style.display = "none";
    //   }, 2000); // รอ ... มิลลิวินาที (... วินาที)
    // };
  </script>

  <script>
    const table = new DataTable('#myTable', {
       responsive: true, // เปิดใช้งานการตอบสนอง (Responsive)
      responsive: {
        details: {
            type: 'column'
        }
    },
    columnDefs: [
        { 
          className: 'dtr-control',
          targets: 0, // คอลัมน์แรกสำหรับการควบคุมโหมด responsive
          orderable: false
        },
        {
            responsivePriority: 1, // ความสำคัญสูงสุด ให้แสดงเสมอ
            targets: 1 // คอลัมน์แรก
        },
        {
            responsivePriority: 2, // ความสำคัญรองลงมา
            targets: 2 // คอลัมน์ที่สอง
        },
        {
            responsivePriority: 10000, // ซ่อนคอลัมน์ที่ไม่ต้องการในโหมด responsive
            targets: '_all' // คอลัมน์อื่น ๆ ทั้งหมด
        }
    ],
    order: [1, 'asc'],
      language: {
        search: 'ค้นหา:', //_ENTRIES_
        lengthMenu: '_MENU_ แถว',
        entries: {
          _: 'นักศึกษา',
          1: 'person'
        }
      },
      layout: {
        topStart: {
          pageLength: {
            menu: [
              [10, 25, 50, -1],
              ['10', '25', '50', 'ALL']
            ]
          }
        }
      },
      buttons: ['pageLength'],

      colReorder: true,
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            let column = this;
            let columnIndex = column.index(); // ดัชนีของคอลัมน์

            // ตรวจสอบว่าคอลัมน์นี้ควรมี select หรือไม่
            if (columnIndex === 3) { // กำหนดคอลัมน์ที่ต้องการ เช่น คอลัมน์ 1 และ 3
              // สร้าง select element
              let select = document.createElement('select');
              select.add(new Option('')); // ค่าเปล่าสำหรับตัวเลือกเริ่มต้น
              column.footer().replaceChildren(select); // วาง select ไว้ใน footer

              // เพิ่ม listener สำหรับเมื่อมีการเปลี่ยนค่าใน select
              select.addEventListener('change', function() {
                column
                  .search(select.value, {
                    exact: true
                  }) // ใช้ค่าใน select เป็นตัวกรอง
                  .draw();
              });

              // เพิ่มรายการตัวเลือกใน select
              column
                .data()
                .unique()
                .sort()
                .each(function(d) {
                  select.add(new Option(d));
                });
            }
          });
      },
      columnDefs: [{
        targets: 0,          // เลือกคอลัมน์ที่ต้องการซ่อนในหน้าจอเล็ก
        // visible: false,      // ซ่อนคอลัมน์นี้
        orderable: false,     // ไม่อนุญาตให้เรียงลำดับ
        // className: 'dtr-control'
    },
    ],
      // order: [
      //   [1, 'asc']
      // ]
    });

    table
      .on('order.dt search.dt', function() {
        let i = 1;

        table
          .cells(null, 0, {
            search: 'applied',
            order: 'applied'
          })
          .every(function(cell) {
            this.data(i++);
          });
      })
      .draw();
      
    table.on('responsive-resize', function(e, datatable, columns) {
      var count = columns.reduce(function(a, b) {
        return b === false ? a + 1 : a;
      }, 0);

      console.log(count + ' column(s) are hidden');
    });

    // Create chart
    const chart = Highcharts.chart('demo-output', {
      chart: {
        type: 'column',
        styledMode: true,
        animation: {
          duration: 1500,
          easing: 'easeInOutQuad'
        }
      },
      title: {
        text: 'จำนวนนักศึกษาในแต่ละสาขา'
      },
      // xAxis: {
      //   title: {
      //     text: 'Major'
      //   },
      //   labels: {
      //     style: {
      //       fontSize: '14px',
      //       color: '#333'
      //     }
      //   }
      // },
      xAxis: {
        type: 'category',
        title: {
          text: 'สาขาวิชา'
        }
      },
      plotOptions: {
        series: {
          colorByPoint: true,
          colors: ['#ff5733', '#33ff57', '#3357ff', '#f1c40f']
        }
      },
      yAxis: {
        title: {
          text: 'จำนวนนักศึกษา'
        }
      },
      tooltip: {
        formatter: function() {
          return `<b>สาขา:</b> ${this.key}<br><b>จำนวน:</b> ${this.y} คน`;
        }
      },
      legend: {
        enabled: true, // เปิดหรือปิด Legend
        layout: 'horizontal', // แนวนอนหรือแนวตั้ง
        align: 'center', // จัดตำแหน่ง
        verticalAlign: 'bottom', // จัดแนว
        itemStyle: {
          color: '#000',
          fontSize: '12px'
        }
      },
      series: [{
        data: chartData(table)
      }]
    });

    // On each draw, update the data in the chart
    table.on('draw', function() {
      chart.series[0].setData(chartData(table));
    });

    function chartData(table) {
      var counts = {};

      // Count the number of entries for each position
      table
        .column(3, {
          search: 'applied'
        })
        .data()
        .each(function(val) {
          if (counts[val]) {
            counts[val] += 1;
          } else {
            counts[val] = 1;
          }
        });

      return Object.entries(counts).map((e) => ({
        name: e[0],
        y: e[1]
      }));
    }
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
      addmajor.addEventListener('show.bs.modal', even => {
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
  <script>
    // const editstu = document.getElementById('editstd')
    // if (editstu) {
    //   editstu.addEventListener('show.bs.modal', event => {
    //     // Button that triggered the modal
    //     const button = event.relatedTarget
    //     // Extract info from data-bs-* attributes
    //     const recipient = button.getAttribute('data-bs-whatever')
    //     // If necessary, you could initiate an Ajax request here
    //     // and then do the updating in a callback.

    //     // Update the modal's content.
    //     const modalTitle = editstu.querySelector('.modal-title')
    //     const modalBodyInput = editstu.querySelector('.modal-body input')

    //     modalTitle.textContent = `New message to ${recipient}`
    //     modalBodyInput.value = recipient
    //   })
    // }
  </script>
  <script>
    function showHintdataeditstudent(str) {
      if (str.length == 0) {
        document.getElementById("editst").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("editst").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "edit-std-data-view.php?q=" + str, true);
        xmlhttp.send();
      }
    }
  </script>

</body>

</html>