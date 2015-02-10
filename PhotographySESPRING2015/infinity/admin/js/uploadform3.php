<?php

$file_id='file3';
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
if(move_uploaded_file($tmpfile,'uploads/'.'reviewers_f'.'.'.$extension)){
    $status="<font color=\'green\'>File upload was a success!</font>";
}else{
    $status="<font color=\'red\'>Failed</font>";
}
echo returnStatus($status);

function returnStatus($status){
    return "<html><body><script type='text/javascript'>function init3(){if(top.uploadComplete3) top.uploadComplete3('".$status."');}window.onload=init3;
</script></body></html>";

}

?>