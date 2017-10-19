<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/13 0013
 * Time: 上午 7:19
 */

namespace app\api\controller;

use app\api\model\Company as CompanyModel;
use app\exception\QueryDbException;
use app\exception\TokenException;
use app\validate\CompanyValidate;
use app\validate\MustBePositiveIntValidate;
use app\api\service\BaseToken;
use app\api\model\User as UserModel;

class Company
{

    /*
     * 查询公司详细信息API(并且关联公司发布的所有岗位)
     * @param number  $id
     * @return array | null
     */
    public function get_Company_Detail($id){

        (new MustBePositiveIntValidate())->goCheck();

        $data = CompanyModel::get_Company_Detail_Model($id);
        if(!$data){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询公司详细信息']);
        }
        return $data;
    }



    /*
     * 创建公司信息——post
     * @return json
     */
    public function create_Company(){
        //获取uid
        $uid = BaseToken::get_Token_Uid();

        //查询用户是否存在（感觉没必要）
        $user = UserModel::get($uid);
        if(!$user){
            throw new TokenException(['msg' => '根据uid验证用户不存在，create_Company']);
        }

        //验证获取的数据，过滤获取的数据
        $companyValidate = new CompanyValidate();
        $companyValidate->goCheck();    //验证rule
        $filter_dataArray = $companyValidate->getDataByRule(input('post.'));   //过滤数据

        //过滤后的数据中加入user_id
        $filter_dataArray['user_id'] = $uid;

        //新增记录
        $companyModel = new CompanyModel();
        $result = $companyModel->isUpdate(false)->save($filter_dataArray);  //显式新增，返回写入记录数
        if(!$result){
           throw new QueryDbException(['msg' => '新增公司失败，来自create_company()']);
        }
        return new QueryDbException(['msg' => '新增公司成功,ID='.$companyModel->id.'，来自create_company()']);
    }



    /*
     * 更新公司信息——post(必须传入id)
     * @return json
     */
    public function update_Company(){
        //获取更新数据的id
        $id = input('post.id');

        //获取并过滤数据
        $companyValidate = new CompanyValidate();
        $companyValidate->goCheck();    //验证rule
        $filter_dataArray = $companyValidate->getDataByRule(input('post.'));   //过滤数据

        //更新
        $companyModel = new CompanyModel();
        $result = $companyModel->isUpdate(true)->save($filter_dataArray,['id'=> $id]);  //显式更新，返回写入记录数
        if(!$result){
            throw new QueryDbException(['msg' => '更新公司失败，来自update_company()']);
        }
        return new QueryDbException(['msg' => '更新公司成功,ID='.$id.'，来自create_company()']);
    }


    /*
     * 删除公司信息——post(必须传入id)
     * @return json
     */
    public function delete_Company(){

        $id = input('post.id');
        $deleteData = CompanyModel::destroy($id);

        if(!$deleteData){
            throw new QueryDbException(['msg'=>'删除公司信息失败,来自delete_Company()']);
        }
        return new QueryDbException(['msg'=>'删除公司成功,影响数据'.$deleteData.'条，来自delete_Company()']);
    }

}