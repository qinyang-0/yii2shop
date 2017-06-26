<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'pwd');
echo $form->field($model,'repwd');
//var_dump(Yii::$app->authManager->getRoles());exit;
echo $form->field($model,'roles')->dropDownList(\backend\models\User::getRole());
echo $form->field($model,'logo')->hiddenInput(['id'=>'logo_id']);
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo \xj\uploadify\Uploadify::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        //上传成功之后，将图片回显为img标签条件src属性
        $('#img').attr('src',data.fileUrl).show();
        $('#img').attr('src',data.fileUrl);
        //将文件地址保存到隐藏域
        $('#logo_id').val(data.fileUrl);

    }
}
EOF
        ),
    ]
]);
if($model->logo){
    echo \yii\bootstrap\Html::img($model->logo,['id'=>'img']);
}else{
    echo \yii\bootstrap\Html::img(' ',['style'=>'display:none','id'=>'img','height'=>'200']);
}
//echo $form->field($model,'sort');
//echo $form->field($model,'status')->radioList([1=>'正常',0=>'隐藏']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();