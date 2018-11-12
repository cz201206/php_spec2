<?php

include 'ChinesePinyin.class.php';

$Pinyin = new ChinesePinyin();

$words = '汉字转成拼音类闫君军均菌深圳（前置）';
echo '<h2>'.$words.'</h2>';



echo '<p>转成带有声调的汉语拼音<br/>';
$result = $Pinyin->TransformWithTone($words);
echo $result,'</p>';



echo '<p>转成带无声调的汉语拼音<br/>';
$result = $Pinyin->TransformWithoutTonedeleteCode($words,' ');
echo($result),'</p>';



echo '<p>转成汉语拼音首字母<br/>';
$result = $Pinyin->TransformUcwords($words);
echo($result),'</p>';