<?php
 $form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'pwd')->passwordInput();
echo $form->field($model,'remember')->checkbox();
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);


\yii\bootstrap\ActiveForm::end();

