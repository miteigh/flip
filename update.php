<?php 
    require_once "config.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // รับข้อมูลจากฟอร์ม
        $mid = $_POST['mid']; // รหัส Major
        $mfact = $_POST['mfact']; // ชื่อ Faculty
        $mname = $_POST['mname']; // ชื่อ Major
        $mstatus = $_POST['mstatus']; // สถานะสาขาวิชา
    
        // ตรวจสอบว่า mstatus เป็นตัวเลข 1 หรือ 0
        if (!in_array($mstatus, [1, 2])) {
            die('Invalid status value');
        }
    
            // คำสั่ง SQL สำหรับอัปเดตข้อมูล
            // $sql = "UPDATE tb_major 
            //     INNER JOIN tb_faculty ON tb_major.mfact = tb_faculty.FID
            //     SET 
            //         tb_faculty.FID = :mfact, 
            //         tb_major.mname = :mname, 
            //         tb_major.mstatus = :mstatus
            //     WHERE 
            //         tb_major.mid = :mid
            // ";
            $sql = "UPDATE tb_major SET mid = :mid, mname = :mname, mfact = :mfact, mstatus = :mstatus WHERE mid = :mid";

            $stmt = $conn->prepare($sql);
    
            // ผูกค่าพารามิเตอร์
            $stmt->bindParam(':mid', $mid, PDO::PARAM_STR);
            $stmt->bindParam(':mfact', $mfact, PDO::PARAM_STR);
            $stmt->bindParam(':mname', $mname, PDO::PARAM_STR);
            $stmt->bindParam(':mstatus', $mstatus, PDO::PARAM_INT);
    
            // ดำเนินการอัปเดต
            $stmt->execute();
    
            // ส่งกลับหน้าหลัก (หรือหน้าเดิม)
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อย";
            header('Location: editmajor.php#dataTable');
            exit;
        }  else {
        echo "Invalid Request";
    }
?>
