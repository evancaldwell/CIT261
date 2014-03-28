<?php
$hashMap = array(
  'signInUser' => 'testing'
, 'getUserList' => getUserList
, 'getSubItems' => getSubItems
);



echo $hashMap['signInUser'];

echo '<br>';



$json = '[{"firstName":"John","lastName":"Doe"},{"firstName":"Jane","lastName":"Doe"}]';
$newarray = json_decode($json, true);
print_r($newarray);
echo '<br>';
//$humor = $newarray[0];
//print_r($humor);

print_r($newarray[0]);
echo '<br>';

echo $newarray[0]['firstName'];




?>