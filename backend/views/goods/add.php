<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
//echo $form->field($model,'sn');
//var_dump($model->parent_id);exit;
//echo $form->field($model2,'id')->hiddenInput();
echo  '<ul id="treeDemo" class="ztree"></ul>';
echo $form->field($model,'goods_category_id')->hiddenInput();
echo $form->field($model,'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map($model3,'id','name'),['prompt'=>'--请选择品牌分类--']);

echo $form->field($model,'market_price');
echo $form->field($model,'shop_price');
echo $form->field($model,'stock');
echo $form->field($model,'is_on_sale')->radioList([1=>'在售',0=>'下线']);
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
    echo \yii\bootstrap\Html::img('@web'.$model->logo,['id'=>'img']);
}else{
    echo \yii\bootstrap\Html::img(' ',['style'=>'display:none','id'=>'img','height'=>'80']);
}
echo $form->field($model,'status')->radioList([1=>'正常',0=>'隐藏']);
echo $form->field($model,'sort');
echo $form->field($model4, 'countent')->widget(\crazyfd\ueditor\Ueditor::className(),[]);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();

$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);
$zNodes=\yii\helpers\Json::encode($categories);
$js= new \yii\web\JsExpression(
    <<<JS
          var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting = {
         data: {
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "parent_id",
                    rootPId: 0
                }
            },
            callback:{
            onClick:function(event,treeId,treeNode){
              // console.log(treeNode.id+","+treeNode.name);
           $("#goods-goods_category_id").val(treeNode.id);
           // console.log(adc);
            }
         }
    };
    
    
         // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes = {$zNodes};
        // console.log(zNodes);


zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
zTreeObj.expandAll(true);
// 获取当前节点的父节点
var node=zTreeObj.getNodeByParam("id",$("#goods-goods_category_id").val(),null)
zTreeObj.selectNode(node);
JS

);
$this->registerJs($js);
?>
