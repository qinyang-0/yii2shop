<?=\yii\bootstrap\Html::a('添加',['article/add'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>简介</th>
            <th>文章类型</th>
            <th>排序</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        <!--    --><?php //var_dump($brands);exit;?>
        <?php foreach ($articles as $article):?>
            <tr>
                <td><?=$article->id?></td>
                <td><?=$article->name?></td>
                <td><?=$article->intro?></td>
                <td><?=$article->article_category_id?></td>
                <td><?=$article->sort?></td>
                <td><?=$article->status?></td>
                <td><?=date('Y-m-d',$article->create_time)?></td>
                <td><?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$article->id],['class'=>'btn btn-info'])?>
                    <?=\yii\bootstrap\Html::a('删除',['article/delete','id'=>$article->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

<?php
$this->registerJsFile('@web/js/test.js',['position'=>\yii\web\View::POS_HEAD]);