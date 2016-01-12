<?php
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
?>
<h1>query/index</h1>
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
        <?php foreach ($provinces as $key => $province) : ?>
          <tr>
            <th>
              <?=$province['PROVINCE_NAME']?>
            </th>
            <td>
              <?=$province['total_amphur']?>
            </td>
          </tr>
        <?php endforeach;?>
    </tbody>
    </table>

  </div>
  <div class="col-sm-6">
    <?php
    echo Highcharts::widget([
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
                'data'=> $provinces_pie
            ]]
        ]
    ]);
    ?>
  </div>
</div>
