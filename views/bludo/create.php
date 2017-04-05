<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bludo */

$this->title = 'Create Bludo';
$this->params['breadcrumbs'][] = ['label' => 'Bludos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bludo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredient' => $ingredient, 
    ]) ?>

</div>
