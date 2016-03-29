<?php
$result = $_REQUEST["res"];
echo "<pre>";
print_r($result);
echo "</pre>";
echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
$log_file=$_SERVER["DOCUMENT_ROOT"]."/upload/pay.log";
$log = "";
foreach($_REQUEST as $key=>$val){
    $log .= $key.": ".$val."\n";
}
$log .= "\n ******** \n";
$f=fopen($log_file,"wb");
fputs($f, $log);
fclose($f);
?>