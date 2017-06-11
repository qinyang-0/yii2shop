<?php
$form=\yii\bootstrap\ActiveForm::begin();
//var_dump($model2);exit;
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();

echo $form->field($model,'article_category_id')->dropDownList(\yii\helpers\ArrayHelper::map($model2,'id','name'),['prompt'=>'--请选择文章分类--']);
echo $form->field($model,'sort');

echo $form->field($model,'status')->radioList([1=>'正常',0=>'隐藏']);

echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();