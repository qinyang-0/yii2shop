<?php
namespace backend\controllers;

use backend\models\PermissionForm;
use backend\models\RoleForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RbacController extends RoootController
{

    public function actionAddPermission()
    {
        $model=new PermissionForm();
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
            if ($model->addPermission()){
                \Yii::$app->session->setFlash( 'success','权限添加成功');
                return $this->redirect(['permission-index']);
            }
        }
        return $this->render('add-permission',['model'=>$model]);
    }
    public function actionPermissionIndex()
    {
        $models=\Yii::$app->authManager->getPermissions();
        return $this->render('permission-index',['models'=>$models]);
    }
    public function actionEditPermission($name)
    {
        $permission = \Yii::$app->authManager->getPermission($name);
        if ($permission == null) {
            throw new NotFoundHttpException('权限不存在');
        }
        $model = new PermissionForm();
        //将要修改的权限的值赋值给表单模型
        $model->loadData($permission);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->updatePermission($name)) {
                \Yii::$app->session->setFlash('success', '权限修改成功');
                return $this->redirect(['permission-index']);
            }
        }
        return $this->render('add-permission',['model'=>$model]);
    }
    public function actionDelPermission($name)
    {
        $permission=\Yii::$app->authManager->getPermission($name);
        if($permission==null){
            throw new NotFoundHttpException('权限不存在');
        }
        \Yii::$app->authManager->remove($permission);
        \Yii::$app->session->setFlash('success','权限删除成功');
        return $this->redirect(['permission-index']);
    }
    //角色增删改查
    //创建角色
    public function actionAddRole()
    {
        $model=new RoleForm();
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
            if($model->addRole()){
                \Yii::$app->session->setFlash('success','角色添加成功');
                return$this->redirect(['role-index']);
            }
        }
        return $this->render('add-role',['model'=>$model]);
    }
    public function actionEditRole($name)
    {
        $role=\Yii::$app->authManager->getRole($name);
        if ($role==null){
            throw new NotFoundHttpException('角色不存在');
        }
        $model=new RoleForm();
        $model->loadData($role);
        if ($model->load(\Yii::$app->request->post())&&$model->validate()){
            if ($model->updateRole($name)){
                \Yii::$app->session->setFlash('name','角色修改成功');
                return $this->redirect(['role-index']);
            }
        }
        return $this->render('add-role',['model'=>$model]);
    }
    public function actionDelRole($name)
    {
        $role=\Yii::$app->authManager->getPermission($name);
        if($role==null){
            throw new NotFoundHttpException('角色不存在');
        }
        \Yii::$app->authManager->remove($role);
        \Yii::$app->session->setFlash('success','权限删除成功');
        return $this->redirect(['role-index']);
    }
    public function actionRoleIndex()
    {
        $models=\Yii::$app->authManager->getRoles();
        return $this->render('role-index',['models'=>$models]);
    }
    /*
    * 给用户关联角色的方法
    */
    public function actionUser()
    {
        $authManager = \Yii::$app->authManager;
        //获取所有角色
        $authManager->getRoles();
        //将id为1的用户，添加管理员角色
        $role= $authManager->getRole('管理员');
        $authManager->assign($role,1);
        //修改用户关联的角色
        //去掉当前用户的所以关联角色
        $authManager->revokeAll(1);
    }
}