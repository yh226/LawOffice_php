<?php
require_once("linksql.php");
?>




<?php
//$fileName=$_POST['txtFileName'];

$Caseid=$_POST['txtCaseId'];
$Caseid='"'.$Caseid.'"';




// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf", "txt", "doc", "docx", "dot","xlsx");
$temp = explode(".", $_FILES["file"]["name"]);

//echo "文件size: " . $_FILES["file"]["size"]. "<br>";
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")

        ||($_FILES["file"]["type"] == "application/pdf")
        || ($_FILES["file"]["type"] == "application/plain")
        || ($_FILES["file"]["type"] == "text/plain")
        || ($_FILES["file"]["type"] == "application/msword")

        || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
        || ($_FILES["file"]["type"] ==  "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")

    )
    && ($_FILES["file"]["size"] < 500000)   // 小于 200 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        //echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            //move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            $filePath=   "upload/" . $_FILES["file"]["name"];

           // echo "upload" . $_FILES["file"]["name"];
            echo "文件临时存储的位置: " .$filePath."<br>";
            $filePath='"'.$filePath.'"';
          //  if($fileName==null){
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                $fileName= $_FILES["file"]["name"];
                $fileName='"'.$fileName.'"';

                $sql = "INSERT INTO tbldocument VALUES ('',$fileName,$filePath,$Caseid)";
           // }
//            else{
//
//                $fileName=$_POST['txtFileName'];
//                echo $_FILES["file"]["type"];
//                //move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $fileName . $_FILES["file"]["type"]);
//                $fileName='"'.$fileName.'"';
//
//                $sql = "INSERT INTO tbldocument VALUES ('',$fileName,$filePath,$Caseid)";
//            }




            if ($conn->query($sql) === TRUE) {
                echo "successful";


            }

            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


    }
}
else
{

    echo "非法的文件格式";
}


$conn->close();//对象中有一个close（）方法可以关闭数据库。
?>