<li id="show_code">
     <h3>Code</h3>
<pre>
<code class="line-numbers language-javascript">function checkFile() {
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
     if (allow_ext.indexOf(ext_name + "|") == -1) {
         var errMsg = "The file is not allowed to be uploaded, please upload a file of type "+ allow_ext + ", the current file type is:" + ext_name;
         alert(errMsg);
         return false;
     }
}
</code>
</pre>
</li>