<?php

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Select Ingredients:' ;

?>
<div class="bludo-update">

    <h2><?= Html::encode($this->title) ?></h2>

<div class="site-menu">
	<p class="lead"></p>
    <?php $form = ActiveForm::begin([
	    'id' => 'sform',
        'enableClientValidation'=>true,
 	]) ?>
    
	<?= BaseHtml::checkboxList('ingredient', $post,
		ArrayHelper::map($ingredient, 'id', 'ingred_name'),
		[
			    'multiple' => true,
			    'separator' => '<br>'
		]
	) ?>
	<p class="lead"></p>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
    <?php 
        if ($post) {
    ?>
        <div class="bludo-found">
                <div class="bludo-found-title">
                    <p class="lead"> <?php echo $result ? "Bludos found:" : "Nothing found!" ?> </p>
                </div>
                <div class="bludo-found-list">
                    <p class="lead"> <?php echo $result ?> </p>
                </div>
        </div>

    <?php } ?>


</div>

<script type="text/javascript">

$(document).ready(function() {
	$('#sform').on('beforeSubmit', function (e) {
		var checked = $('input:checkbox:checked').length; 
	    if (checked<2) {
	    	alert('Please, select more ingredients');
	        return false;
	    }
	    if (checked>5) {
	    	alert('Please, select up to 5 ingredients');
	        return false;
	    }
	    return true;
	});	

});
</script>

