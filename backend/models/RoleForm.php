<?php
namespace backend\models;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;

class RoleForm extends Model{
    public $name;
    public $description;
    public $permissions=[];

    public function rules()
    {
        return [
            [['name','description'],'required'],
            //可以为空的字段也必须有验证规则
            ['permissions','safe'],//表示该字段不需要验证
        ];
    }
    public function attributeLabels()
    {
        return [
            'name'=>'名称',
            'description'=>'描述',
            'permissions'=>'权限'
        ];
    }
    public static function getPermissionOptions()
    {
        $authManager=\Yii::$app->authManager;
        return ArrayHelper::map($authManager->getPermissions(),'name','description');
    }
    public function addRole()
    {

        $authManager=\Yii::$app->authManager;
        //判断角色是否存在
        if ($authManager->getRole($this->name)){
            $this->addError('name','角色已存在');
        }else{
            $role=$authManager->createRole($this->name);
            $role->description=$this->description;
            if($authManager->add($role)){//保存到数据表
//关联该角色的权限
                foreach ($this->permissions as $permissionName){
                    $permission=$authManager->getPermission($permissionName);
                    if ($permission)$authManager->addChild($role,$permission);
                }
                return true;
            }
        }
        return false;
    }
    public function updateRole($name)
    {
        $authManager=\Yii::$app->authManager;
        $role=$authManager->getRole($name);
        //给角色赋值
        $role->name=$this->name;
        $role->description=$this->description;
        //如果角色名被修改，检查角色名是否存在
        if ($name!=$this->name && $authManager->getRole($this->name)){
            $this->addError('name','角色已存在');
        }else{
            if ($authManager->update($name,$role)){
                //去掉所有与角色关联的权限
                $authManager->removeChildren($role);
                foreach ($this->permissions as $permissionName){
                    $permission=$authManager->getPermission($permissionName);
                    if ($permission)$authManager->addChild($role,$permission);
                }
                return true;
            }
        }
        return false;
    }
    public function loadData(Role $role)
    {
        $this->name = $role->name;
        $this->description = $role->description;
        //权限属性赋值
        //获取该角色对应的权限
        $permissions = \Yii::$app->authManager->getPermissionsByRole($role->name);
        //$this->permissions = ['brand/edit','brand/index'];
        foreach ($permissions as $permission){
            $this->permissions[]=$permission->name;
        }
    }

}