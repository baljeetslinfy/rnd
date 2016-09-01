<?php
$a = preg_replace('([a-zA-Z_.,!"?0-9]+(?![^<]*>))', '"$0"', $a);
$a = str_replace(array('=',';','""','(',')',' '),array(':',',','"','[',']',''),$a);
$a = preg_replace('/\\s/','',$a);
echo str_replace(',}','}',$a);
?>