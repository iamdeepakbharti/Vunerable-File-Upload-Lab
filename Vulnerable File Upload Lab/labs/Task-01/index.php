<?php
include'../config.php';
include'../head.php';
include'../menu.php';

$is_upload = false;
$msg = null;
if (isset($_POST['submit'])) {
    if (file_exists(UPLOAD_PATH)) {
        $temp_file = $_FILES['upload_file']['tmp_name'];
        $img_path = UPLOAD_PATH.'/'. $_FILES['upload_file']['name'];
        if (move_uploaded_file($temp_file, $img_path)){
            $is_upload = true;
        } else {
            $msg ='Upload error! ';
        }
    } else {
        $msg = UPLOAD_PATH.'The folder does not exist, please create it manually! ';
    }
}
?>

<div id="upload_panel">
    <ol>
        <li>
            <h3><u>Task-01</u></h3>
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
include'../footer.php'
?>


<script type="text/javascript">
    function checkFile() {
        var file = document.getElementsByName('upload_file')[0].value;
        if (file == null || file == "") {
            alert("Please select the file to upload!");
            return false;
        }
        //Define the file types allowed to upload
        var allow_ext = ".jpg|.png|.gif";
        //Extract the type of uploaded file
        var ext_name = file.substring(file.lastIndexOf("."));
        //Determine whether the upload file type is allowed to upload
        if (allow_ext.indexOf(ext_name) == -1) {
            var errMsg = "The file is not allowed to be uploaded, please upload a file of type "+ allow_ext + ", the current file type is:" + ext_name;
            alert(errMsg);
            return false;
        }
    }
</script>