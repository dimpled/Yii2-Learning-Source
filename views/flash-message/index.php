<?php


use yii\helpers\Html;

?>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
<?php
echo \kartik\widgets\Growl::widget([
    'type' => ($message['type']) ? $message['type'] : 'danger',
    'title' => ($message['title']) ? $message['title'] : 'Title Not Set!',
    'icon' => ($message['icon']) ? $message['icon'] : 'fa fa-info',
    'body' => ($message['message']) ? $message['message'] : 'Message Not Set!',
    'showSeparator' => true,
    'delay' => 1,//This delay is how long before the message shows
    'pluginOptions' => [
        'delay' => ($message['duration']) ? $message['duration'] : 3000,//This delay is how long the message shows for
        'placement' => [
            'from' => ($message['positonY']) ? $message['positonY'] : 'top',
            'align' => ($message['positonX']) ? $message['positonX'] : 'right',
        ]
    ]
]);
?>
<?php endforeach; ?>
<h1>flash-message/index</h1>

<p>
 <?= Html::a('Create',['/flash-message/save'],['class'=>'btn btn-success btn-lg']);?>
</p>
