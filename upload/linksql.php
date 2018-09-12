<?php
$servername = "localhost";
$username = "root";
$password = "55923";
$dbname = "lawoffice";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);//使用new mysqli（）来创建连接。
// 检测连接
if ($conn->connect_error) {//对象$conn有一个connect_error属性。
    die("连接失败: " . $conn->connect_error);
}




//$conn->close();//对象中有一个close（）方法可以关闭数据库。
?>