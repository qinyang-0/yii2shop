<?=\yii\bootstrap\Html::a('添加',['articlecategory/add'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>文章类型</th>
            <th>简介</th>
            <th>排序</th>
            <th>状态</th>
            <th>文档类型</th>
            <th>操作</th>
        </tr>
        <!--    --><?php //var_dump($brands);exit;?>
        <?php foreach ($types as $type):?>
            <tr>
                <td><?=$type->id?></td>
                <td><?=$type->name?></td>
                <td><?=$type->intro?></td>
                <td><?=$type->sort?></td>
                <td><?=$type->status?></td>
                <td><?=$type->is_help?></td>
                <td><?=\yii\bootstrap\Html::a('修改',['articlecategory/edit','id'=>$type->id],['class'=>'btn btn-info'])?>
                    <?=\yii\bootstrap\Html::a('删除',['articlecategory/delete','id'=>$type->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

<?php
$this->registerJsFile('@web/js/test.js',['position'=>\yii\web\View::POS_HEAD]);