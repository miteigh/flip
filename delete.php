<?php
require_once "config.php";
// ตรวจสอบว่าได้รับค่าจากการส่งข้อมูลหรือไม่
// if (isset($_POST['mid'])) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mid = $_POST['mid'];

    try {
        
        $conn->beginTransaction();

        // ลบข้อมูลใน tb_student ที่อ้างถึง mid
        // $sql_delete_students = "DELETE FROM tb_student WHERE major = :mid";
        $sql_delete_students = "UPDATE tb_student SET major = NULL WHERE major = :mid";
        $stmt1 = $conn->prepare($sql_delete_students);
        $stmt1->bindParam(':mid', $mid);
        $stmt1->execute();

        // ลบข้อมูลใน tb_major
        $sql_delete_major = "DELETE FROM tb_major WHERE mid = :mid";
        $stmt2 = $conn->prepare($sql_delete_major);
        $stmt2->bindParam(':mid', $mid);
        $stmt2->execute();

        $conn->commit();
        // ส่งกลับหน้าหลัก (หรือหน้าเดิม)
        $_SESSION['success'] = "ลบข้อมูลเรียบร้อย";
        header('Location: editmajor.php#dataTable');
        exit;
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
} else {
    echo "ไม่มีรหัสสาขาวิชาที่จะลบ";
}

if (isset($_POST['mids'])) {
    $mids = $_POST['mids'] ?? [];

    if (!empty($mids)) {
        try {
            $placeholders = implode(',', array_fill(0, count($mids), '?'));
            $sql = "DELETE FROM tb_major WHERE mid IN ($placeholders)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($mids);
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ไม่มีข้อมูลที่ถูกเลือก']);
    }
}

?>