<?php
use yii\web\View;
use yii\helpers\Html;
?>
<h1>Formatter</h1>

<?php
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$time =  time();

echo Yii::$app->thaiYearFormatter->asDate($time,'medium')."<br>";
Yii::$app->thaiYearFormatter->locale = 'en-US';
echo Yii::$app->thaiYearFormatter->asDate($time,'medium')."<br>";
?>

<h3>asDate</h3>
<?php
//"short", "medium", "long", or "full",
echo Yii::$app->formatter->locale = 'en-US'."<br>";
echo Yii::$app->formatter->asDate($time, 'short')."<br>";
echo Yii::$app->formatter->asDate($time, 'medium')."<br>";
echo Yii::$app->formatter->asDate($time, 'long')."<br>";
echo Yii::$app->formatter->asDate($time, 'full')."<br>";
echo '<hr>';
echo Yii::$app->formatter->locale = 'th'."<br>";
echo Yii::$app->formatter->asDate($time, 'short')."<br>";
echo Yii::$app->formatter->asDate($time, 'medium')."<br>";
echo Yii::$app->formatter->asDate($time, 'long')."<br>";
echo Yii::$app->formatter->asDate($time, 'full')."<br>";
echo '<hr>';
// // ICU format
echo Yii::$app->formatter->asDate($time, 'yyyy-MM-dd')."<br>";
// PHP date()-format
echo Yii::$app->formatter->asDate($time, 'php:Y-m-d')."<br>";
?>


<h3>asTime</h3>
<?php

// echo '<hr>';
// //date timez
// //"short", "medium", "long", or "full",
Yii::$app->formatter->locale = 'en-US';
echo Yii::$app->formatter->asTime($time, 'short')."<br>";
echo Yii::$app->formatter->asTime($time, 'medium')."<br>";
echo Yii::$app->formatter->asTime($time, 'long')."<br>";
echo Yii::$app->formatter->asTime($time, 'full')."<br>";
echo '<hr>';
Yii::$app->formatter->locale = 'th';
echo Yii::$app->formatter->asTime($time, 'short')."<br>";
echo Yii::$app->formatter->asTime($time, 'medium')."<br>";
echo Yii::$app->formatter->asTime($time, 'long')."<br>";
echo Yii::$app->formatter->asTime($time, 'full')."<br>";
echo '<hr>';
// Yii::$app->timeZone;
// // ICU format
echo Yii::$app->formatter->asDateTime($time, 'kk:mm:ss') ."<br>";
// PHP date()-format
echo Yii::$app->formatter->asDateTime($time, 'php:H:i:s'); // 2014-10-06

?>
<h3>asDateTime</h3>
<?php
// //date timez
// //"short", "medium", "long", or "full",
Yii::$app->formatter->locale = 'en-US';
echo Yii::$app->formatter->asDateTime($time, 'short')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'medium')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'long')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'full')."<br>";
echo '<hr>';
Yii::$app->formatter->locale = 'th';
echo Yii::$app->formatter->asDateTime($time, 'short')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'medium')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'long')."<br>";
echo Yii::$app->formatter->asDateTime($time, 'full')."<br>";

echo '<hr>';

echo Yii::$app->formatter->asDateTime($time, 'yyyy-MM-dd kk:mm:ss')."<br>";
// PHP date()-format
echo Yii::$app->formatter->asDateTime($time, 'php:Y-m-d H:i:s');