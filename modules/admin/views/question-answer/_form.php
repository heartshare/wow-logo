<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\QuestionAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-answer-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'is_published')->checkbox() ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'comment')->widget(Widget::classname(), [
        'settings' => [
            'buttonSource' => true,
            'plugins' => [
                'fontsize',
                'fontfamily',
                'fontcolor',
                'imagemanager',
            ],
            'imageUpload' => Url::to(['/admin/question-answer/comment-upload']),
        ],
    ]) ?>
    <?= $form->field($model, 'avatar')->widget(FileInput::classname(), [
        'options'=> ['accept' => 'image/*'],
        'pluginOptions' => [
            'showUpload' => false,
            'showRemove' => false,
            'showCaption' => false,
            'allowedFileExtensions' => ['jpg','gif','png'],
            'initialPreview'=>[
                Html::img($model->getImageUrl(), ['class'=>'file-preview-image']),
            ],
            'msgInvalidFileType' => Yii::t('app', 'Invalid type for file "{name}". Only "{types}" files are supported.'),
            'msgInvalidFileExtension' => Yii::t('app', 'Invalid extension for file "{name}". Only "{extensions}" files are supported.'),
            'msgLoading' => Yii::t('app', 'Loading file {index} of {files} &hellip;'),
            'msgProgress' => Yii::t('app', 'Loading file {index} of {files} - {name} - {percent}% completed.'),
        ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>