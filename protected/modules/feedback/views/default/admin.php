<?php $this->pageTitle = Yii::t('feedback', 'Сообщения с сайта'); ?>

<?php
$this->breadcrumbs = array(
    Yii::t('feedback', 'Сообщения с сайта') => array('admin'),
    Yii::t('feedback', 'Управление'),
);

$this->menu = array(
    array('label' => Yii::t('feedback', 'Добавить сообщение'), 'url' => array('create')),
    array('label' => Yii::t('feedback', 'Список сообщений'), 'url' => array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('feed-back-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $this->module->getName();?></h1>

<?php $this->widget('YModuleInfo'); ?>

<?php echo CHtml::link(Yii::t('feedback', 'Поиск сообщений'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
                                               'model' => $model,
                                          )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
                                                       'id' => 'feed-back-grid',
                                                       'dataProvider' => $model->search(),
                                                       'columns' => array(
                                                           'id',
                                                           array(
                                                               'name' => 'theme',
                                                               'type' => 'raw',
                                                               'value' => 'CHtml::link($data->theme,array("/feedback/default/update/","id" => $data->id))'
                                                           ),
                                                           array(
                                                               'name' => 'type',
                                                               'value' => '$data->getType()'
                                                           ),
                                                           'name',
                                                           'email',
                                                           array(
                                                               'name' => 'status',
                                                               'value' => '$data->getStatus()',
                                                               'filter' => CHtml::activeDropDownList($model, 'status', $model->getTypeList())
                                                           ),
                                                           'creation_date',
                                                           'change_date',
                                                           array(
                                                               'class' => 'CButtonColumn',
                                                           ),
                                                       ),
                                                  )); ?>
