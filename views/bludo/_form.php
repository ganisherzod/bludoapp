<?php

use app\models\Bludo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bludo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bludo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bludo_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'ingreds')->checkboxList(
		ArrayHelper::map($ingredient, 'id', 'ingred_name'),
		[
			    'multiple' => true
		]
	) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
