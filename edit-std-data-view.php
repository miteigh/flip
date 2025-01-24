<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Bangkok');
include 'config.php';

// Get the student ID
$id = $_GET['q'] ?? null;
if (!$id || !is_numeric($id)) {
    die("Invalid or missing ID.");
}

$objResultdata = null; // Initialize the variable

try {
    $stmt = $conn->prepare("SELECT * FROM tb_student s LEFT JOIN tb_major m ON s.major = m.mid
    WHERE s.stuid = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $objResultdata = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($objResultdata) {
        // Access the data
?>
        <div id="editpicControl" class="d-none mb-3 col-12 d-flex justify-content-center">
            <img id="editpicUpload" class="img-fluid my-3">
        </div>
        <div class="mb-3 col-12 d-flex justify-content-center">
            <div class="col-6">
                <?php
                $imagePath = !empty($objResultdata["stu_pic"]) && file_exists('./uploads/' . $objResultdata["stu_pic"])
                    ? './uploads/' . $objResultdata["stu_pic"]
                    : '';
                ?>
                <!-- ภาพโปรไฟล์ -->
                <img id="profilePic" src="<?php echo $imagePath; ?>" alt="<?php echo $imagePath; ?>" class="img-fluid my-3">
            </div>
        </div>
        <div class="mb-3">
            <label for="picfileeditcourse" class="col-form-label">ภาพประจำตัว</label>
            <input class="form-control" type="file" accept="image/*" name="stu_pic" id="picfileeditcourse" onchange="readURLPIC(this)">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Student_ID:</label>
            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($objResultdata['stuid']); ?>" name="stuid">
        </div>
        <div class="mb-3">
            <label class="col-form-label" for="pname">คำนำหน้าชื่อ</label>
            <select class="form-select mb-1 col-xl-5" name="pname" id="" required>
                <option value="" disabled selected>เลือกคำนำหน้าชื่อ</option>
                <option value="นาย" <?php echo $objResultdata['pname'] == "นาย" ? "selected" : "" ?>>นาย</option>
                <option value="นางสาว" <?php echo $objResultdata['pname'] == "นางสาว" ? "selected" : "" ?>>นางสาว</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($objResultdata['firstname']) . " " . htmlspecialchars($objResultdata['lastname']); ?>" name="fullname">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">tel:</label>
            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($objResultdata['tel']); ?>" name="tel">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">email:</label>
            <input type="text" class="form-control" id="" value="<?= htmlspecialchars($objResultdata['email']); ?>" name="email">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">major:</label>
            <select class="form-select col-xl-5" name="major" id="" required>
                <option value="" disabled selected>เลือกสาขาวิชา</option>
                <?php
                $maj = $conn->query("SELECT * FROM tb_major");
                while ($ma = $maj->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $objResultdata['mid'] == $ma['mid'] ? "selected" : "";
                    echo "<option value='{$ma['mid']}' $selected>{$ma['mname']}</option>";
                }
                ?>
            </select>
        </div>
<?php
    } else {
        echo "No data found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<script>
    function readURLPIC(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            // แสดงภาพตัวอย่างใน HTML
            document.getElementById('editpicUpload').src = e.target.result;
            document.getElementById('editpicControl').classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]); // อ่านไฟล์ภาพเป็น Base64 URL
    }
}
</script>