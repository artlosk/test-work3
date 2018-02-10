<?php
namespace app\common\grid;

use yii\base\InvalidConfigException;
use yii\grid\DataColumn;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/**
 * Class DatePickerColumn
 * @package app\common\grid
 */
class DatePickerColumn extends DataColumn
{
    /**
     * @var string
     */
    public $dateFormat = 'yyyy-mm-dd';

    /**
     * @var string
     */
    public $format = 'datetime';

    /**
     * @var null
     */
    public $attributeFilter = null;

    /**
     * @var array
     */
    public $datePickerOptions = [
        'class' => 'form-control',
    ];

    public function init()
    {
        parent::init();

        if (empty($this->attribute)) {
            throw new InvalidConfigException('The "attribute" property must be set.');
        }

        if ($this->attributeFilter === null) {
            $this->attributeFilter = $this->attribute;
        }
    }

    /**
     * @return string
     */
    protected function renderFilterCellContent()
    {
        return DatePicker::widget([
            'model' => $this->grid->filterModel,
            'attribute' => $this->attributeFilter,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => $this->dateFormat,
            ],
            'options' => $this->datePickerOptions,
        ]);
    }
}
