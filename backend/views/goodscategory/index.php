<?=\yii\bootstrap\Html::a('添加',['goodscategory/add'],['class'=>'btn btn-info'])?>

    <table class="cate table table-bordered table-responsive">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>操作</th>
    </tr>
    <?php foreach($goodss as $goods):?>
        <tr data-lft="<?=$goods->lft?>" data-rgt="<?=$goods->rgt?>" data-tree="<?=$goods->tree?>">
        <td><?=$goods->id?></td>
        <td><?=str_repeat('➣',$goods->depth).$goods->name?>
        <span class="toggle_cate glyphicon glyphicon-chevron-down" style="float: right"></span>
        </td>
        <td><?=\yii\bootstrap\Html::a('修改',['goodscategory/edit','id'=>$goods->id],['class'=>'btn btn-info'])?>
            <?=\yii\bootstrap\Html::a('删除',['goodscategory/delete','id'=>$goods->id],['class'=>'btn btn-danger'])?>
        </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
    $js=<<<JS
    $('.toggle_cate').click(function(){
        //查找当前分类的z子分类
        var tree=parseInt($(this).closest('tr').attr('data-tree'));
        var lft=parseInt($(this).closest('tr').attr('data-lft'));
        var rgt=parseInt($(this).closest('tr').attr('data-rgt'));
        //显示或隐藏
        var show=$(this).hasClass('glyphicon-chevron-up');
        //切换图标
        $(this).toggleClass('glyphicon-chevron-down');
        $(this).toggleClass('glyphicon-chevron-up');
        $(".cate tr").each(function(){
            //同一棵树 左直大于lft 右值下雨rgt
            //      console.log(rgt);
            
            if( $(this).attr('data-tree')==tree && parseInt($(this).attr('data-lft'))>lft && parseInt($(this).attr('data-rgt'))<rgt)
            {
                // console.log($(this).attr('data-rgt'));
                show?$(this).show():$(this).hide();
            }
        });
    });
JS;
    $this->registerJs($js);