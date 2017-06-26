<?=\yii\bootstrap\Html::a('添加',['goods/add'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>简介</th>
            <th>LOGO</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <!--    --><?php //var_dump($brands);exit;?>
        <?php foreach ($goodss as $goods):?>
            <tr>
                <td><?=$goods->id?></td>
                <td><?=$goods->name?></td>
                <td><?=$goods->sn?></td>
                <td><img src="<?=$goods->logo?>" width="200"></td>
                <td><?=$goods->brand_id?></td>
                <td><?=$goods->market_price?></td>
                <td><?=$goods->shop_price?></td>
                <td><?=$goods->stock?></td>
                <td><?=$goods->is_on_sale?></td>
                <td><?=$goods->status?></td>
                <td><?=$goods->sort?></td>
                <td><?=$goods->create_time?></td>
                <td><?=\yii\bootstrap\Html::a('修改',['goods/edit','id'=>$goods->id],['class'=>'btn btn-info'])?>
                    <?=\yii\bootstrap\Html::a('删除',['goods/delete','id'=>$goods->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

<?php
$this->registerJsFile('@web/js/test.js',['position'=>\yii\web\View::POS_HEAD]);