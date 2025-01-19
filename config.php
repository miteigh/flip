<?php 
    $servername = "localhost";
    $username = "root";
    $password = ""; #ใส่รหัสผ่านฐานข้อมูล
    $dbname = "mighty_db"; #ชื่อฐานข้อมูล
 
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
