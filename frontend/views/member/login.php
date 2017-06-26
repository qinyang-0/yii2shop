<!-- 登录主体部分start -->
<div class="login w990 bc mt10">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bc">
        <div class="login_form fl">
            <?php
            $form=\yii\widgets\ActiveForm::begin(
                ['fieldConfig'=>[
                    'options'=>[
                        'tag'=>'li',
                    ],
                    'errorOptions'=>[
                        'tag'=>'p',
                    ],
                ]]
            );
            echo '<ul>';
            echo $form->field($model,'username')->textInput(['class'=>'txt']);
            echo $form->field($model,'password')->textInput(['class'=>'txt']);
//            echo $form->field($model,'email')->textInput(['class'=>'txt']);
//            echo $form->field($model,'tel')->textInput(['class'=>'txt']);
//            var_dump($model);exit;
            echo $form->field($model,'code',[
                'options'=>[
                    'class'=>'checkcode'
                ]
            ])->widget(\yii\captcha\Captcha::className(),['template'=>'{input} {image}']);
            //            echo \yii\helpers\Html::submitButton('',['class'=>'login_btn']);
            echo '<li>
                                        <label for="">&nbsp;</label>
                                        <input type="submit" value="" class="login_btn" />
                              </li>';
            echo '</ul>';
            \yii\widgets\ActiveForm::end();
            ?>


            <div class="coagent mt15">
                <dl>
                    <dt>使用合作网站登录商城：</dt>
                    <dd class="qq"><a href=""><span></span>QQ</a></dd>
                    <dd class="weibo"><a href=""><span></span>新浪微博</a></dd>
                    <dd class="yi"><a href=""><span></span>网易</a></dd>
                    <dd class="renren"><a href=""><span></span>人人</a></dd>
                    <dd class="qihu"><a href=""><span></span>奇虎360</a></dd>
                    <dd class=""><a href=""><span></span>百度</a></dd>
                    <dd class="douban"><a href=""><span></span>豆瓣</a></dd>
                </dl>
            </div>
        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>
    </div>
    <!-- 登录主体部分end -->