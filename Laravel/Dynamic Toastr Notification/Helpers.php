<?php
// toastr
function toastr_message() {
$data=array(
'page_access_error' => "You Cannot Access This Page",
'added' => "Record Added successfully",
'updated' => "Record Updated successfully",
'deleted' => "Record Deleted successfully",
);
return $data;
}

function toastr_notification($message=null, $error_type)
{
        $notification = array(
'message' => $message,
'alert-type' => $error_type
);
return $notification;
}
