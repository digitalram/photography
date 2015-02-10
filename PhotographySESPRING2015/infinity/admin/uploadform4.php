<?php

$file_id='file4';
$status='';

$filename=$_FILES[$file_id]['name'];
$tmpfile=$_FILES[$file_id]['tmp_name'];
$extension = pathinfo($filename, PATHINFO_EXTENSION);
$allowed = array('csv');

if(!$_FILES[$file_id]['name']) {
    echo returnStatus("<font color=\'red\'>No file specified!</font>");
    return;
}

if(!in_array(strtolower($extension), $allowed)){
    echo returnStatus("<font color=\'red\'>Wrong file type, please select .csv file</font>");
    return;
}

/*copy file over to tmp directory */
if(move_uploaded_file($tmpfile,'uploads/'.'reviewers_s'.'.'.$extension)){
    $status="<font color=\'green\'>File upload was a success!</font>";
}else{
    $status="<font color=\'red\'>Failed</font>";
}
echo returnStatus($status);

function returnStatus($status){
    return "<html><body><script type='text/javascript'>function init4(){if(top.uploadComplete4) top.uploadComplete4('".$status."');}window.onload=init4;
</script></body></html>";

}

?>