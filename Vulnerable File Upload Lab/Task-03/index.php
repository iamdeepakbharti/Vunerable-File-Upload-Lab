<?php
include'../config.php';
include'../common.php';
include'../head.php';
include'../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $deny_ext = array('.asp','.aspx','.php','.jsp');
        $file_name = trim($_FILES['upload_file']['name']);
        $file_name = deldot($file_name);//Delete the dot at the end of the file name
        $file_ext = strrchr($file_name,'.');
        $file_ext = strtolower($file_ext); //convert to lowercase
        $file_ext = str_ireplace('::$DATA','', $file_ext);//Remove string::$DATA
        $file_ext = trim($file_ext); //End to empty

        if(!in_array($file_ext, $deny_ext)) {
            $temp_file = $_FILES['upload_file']['tmp_name'];
            $img_path = UPLOAD_PATH.'/'.date("YmdHis").rand(1000,9999).$file_ext;
            if (move_uploaded_file($temp_file,$img_path)) {
                 $is_upload = true;
            } else {
                $msg ='Upload error! ';
            }
        } else {
            $msg ='It is not allowed to upload .asp, .aspx, .php, .jsp suffix files! ';
        }
    } else {
        $msg = UPLOAD_PATH.'The folder does not exist, please create it manually! ';
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3><u>Task-03</u></h3>
            <p>Upload a <code>webshell</code> to the server. </p>
        </li>
        <li>
            <h3>Upload area</h3>
            <form enctype="multipart/form-data" method="post" onsubmit="return checkFile()">
                <p>Please select the picture to upload:<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="Upload"/>
            </form>
            <div id="msg">
                <?php
                    if($msg != null){
                        echo "hint:".$msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo'<img src="'.$img_path.'" width="250px" />';
                    }
                ?>
            </div>
        </li>
        <?php
            if($_GET['action'] == "show_code"){
                include'show_code.php';
            }
        ?>
    </ol>
</div>

<?php
include'../footer.php';
?>