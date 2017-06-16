<?=\yii\bootstrap\Html::a('添加',['user/add'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>密码</th>
            <th>头像</th>
            <th>最后登陆时间</th>
            <th>最后登陆ip</th>
            <th>操作</th>
        </tr>

        <?php foreach ($users as $user):?>
            <tr>
                <td><?=$user->id?></td>
                <td><?=$user->name?></td>
                <td><?=$user->pwd?></td>

                <td><img src="<?=$user->logo?>" width="100"></td>
                <td><?=date('Y-m-d H-i-s',$user->login_time)?></td>

                <td><?=\yii\bootstrap\Html::a('修改',['user/edit','id'=>$user->id],['class'=>'btn btn-info'])?>
                    <?=\yii\bootstrap\Html::a('删除',['user/delete','id'=>$user->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

<?php

$this->registerJsFile('@web/js/test.js',['position'=>\yii\web\View::POS_HEAD]);