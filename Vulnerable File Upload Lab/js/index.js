function show_code(){
var url = window.location.href;
if(url.indexOf("?") != -1){
url = url.split("?")[0];
}
To
var e = document.getElementById("show_code");
if(e == null){
window.location.href=url+"?action=show_code";
}else{
window.location.href=url;
}
}

function modify_showcode_name(){
var url = window.location.href;
var btn_showcode = document.getElementById("handle_code");
if(url.indexOf('show_code') >= 0){
btn_showcode.innerHTML = "Hide Source Code";
}else{
btn_showcode.innerHTML = "Show Source Code";
}
}

function get_prompt(){
$.ajax({
type:'get',
url: "helper.php?action=get_prompt",
}).success(function(data) {
Dialog.open(400,200,data);
}).error(function() {
Dialog.open(400,150,"Failed to get prompt!");
});
}

function clean_upload_file(){
$.ajax({
type:'get',
url: "../rmdir.php?action=clean_upload_file",
}).success(function(data) {
Dialog.open(400,200,data);
}).error(function() {
Dialog.open(400,150,"Deletion failed!");
});
}

function update_copyright_time(){
var mydate = new Date();
var now_time = '2018 ~ '+ mydate.getFullYear();
var copyright_time = document.getElementById("copyright_time");
copyright_time.innerHTML = now_time;
}

function setFooter(){
var min_height = window.innerHeight-175;
var obj = document.getElementById("main");
obj.style.minHeight = min_height;
}

var Dialog = {
    mask: $('.mask'),
    dialog: $('.dialog'),
    content: $('.dialog-content'),
    open: function (width, height, appendHtml) {
        Dialog.mask.fadeIn(500);
        Dialog.dialog.css({ width: width, height: (height + 22), marginLeft: -(parseInt(width) / 2) }).addClass('loading').fadeIn(500, function () {
            Dialog.dialog.removeClass('loading');
            Dialog.content.append(appendHtml);
        });
    },
    close: function () {
        Dialog.mask.fadeOut(500);
        Dialog.dialog.fadeOut(500, function () {
            Dialog.content.empty();
        });
    }
}

$(function(){
modify_showcode_name();
update_copyright_time();
setFooter();
window.onresize = function(){
setFooter();
}

var path = window.location.pathname;
var pass_id = path.match(/Pass-\d{2}/i);
$("#"+pass_id).addClass('a_is_selected');

$('.dialog').find('a.close').bind("click", function () {
        Dialog.close();
    });
});