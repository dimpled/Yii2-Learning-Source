<?php
use yii\helpers\VarDumper;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
//VarDumper::dump($data,10,true);
$provinceName = [];
$series = ['name'=>'จำนวนอำเภอ'];
$pieData=[];
foreach ($data as $key => $value) {
  $provinceName[] = $value['PROVINCE_NAME'];
  $series['data'][] = (int)$value['total_amphur'];
  $pieData[] = ['name'=>$value['PROVINCE_NAME'],
  'y'=>(int)$value['total_amphur']];
}
//VarDumper::dump($series,10,true);
?>
<h1>query1/index</h1>

<div class="row">
  <div class="col-sm-6">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <td>
            จังหวัด
          </td>
          <td>
            จำนวนอำเภอ
          </td>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($data as $key => $row): ?>
        <tr>
          <td>
            <?=$row['PROVINCE_NAME']?>
          </td>
          <td>
            <?=$row['total_amphur']?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <?= Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Fruit Consumption'],
      'xAxis' => [
         //'categories' => ['Apples', 'Bananas', 'Oranges','TEST']
         'categories' => $provinceName
      ],
      'yAxis' => [
         'title' => ['text' => 'Fruit eaten']
      ],
      'series' => [
        $series
        //  ['name' => 'Jane', 'data' => [1, 0, 4,9]],
        //  ['name' => 'John', 'data' => [5, 7, 3,2]]
      ]
   ]
   ]);?>

  </div>
</div>

<?= Highcharts::widget([
  'options' => [
    'chart'=> [
           'plotBackgroundColor'=> null,
           'plotBorderWidth'=> null,
           'plotShadow'=> false,
           'type'=> 'pie'
       ],
       'title'=> [
           'text'=> 'Browser market shares January, 2015 to May, 2015'
       ],
       'tooltip'=> [
           'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>'
       ],
       'plotOptions'=> [
           'pie'=> [
               'allowPointSelect'=> true,
               'cursor'=> 'pointer',
               'dataLabels'=> [
                   'enabled'=> false
               ],
               'showInLegend'=> true
           ]
       ],
       'series'=> [[
           'name'=> "Brands",
           'colorByPoint'=> true,
           'data'=> $pieData
       ]]
   ]
]);
