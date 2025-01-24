<?php
// delete_data.php
require_once "config.php";

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
