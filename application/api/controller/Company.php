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
use app\validate\company\Create_Company_Validate;
use app\validate\company\Update_Company_Validate;
use app\validate\CompanyValidate;
use app\validate\MustBePositiveIntValidate;
use app\api\service\BaseToken;
use app\api\model\User as UserModel;

class Company
{

    //普通访问公司信息

    //自己访问自己的信息 -> 根据客户端缓存的token查询客户的uid -> 根据uid查询所关联的公司id,岗位id,简历id

    /*
     * 查询公司详细信息API(并且关联公司发布的所有岗位)
     * @param number  $id
     * @return array | null
     */
    public function get_Company_Detail($id){

        (new MustBePositiveIntValidate())->goCheck();

        $data = CompanyModel::get($id);
        if(!$data){
            throw new QueryDbException(['msg'=>'查询数据不存在,来自查询公司详细信息','code'=>401]);
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

        //查询用户是否存在（感觉没必要）原代码
//        $user = UserModel::get($uid);
//        if(!$user){
//            throw new TokenException(['msg' => '根据uid验证用户不存在，create_Company']);
//        }

        //验证获取的数据，过滤获取的数据
        $companyValidate = new Create_Company_Validate();
        $companyValidate->goCheck();    //验证rule
        $filter_dataArray = $companyValidate->getDataByRule(input('post.'));   //过滤数据

        //过滤后的数据中加入user_id
        $filter_dataArray['user_id'] = $uid;

        //新增记录
        $companyModel = new CompanyModel();
        $result = $companyModel->isUpdate(false)->save($filter_dataArray);  //显式新增，返回写入记录数
        if(!$result){
           throw new QueryDbException(['msg' => '新增公司失败，来自create_company()','code'=>401]);
        }
        return new QueryDbException(['msg' => '新增公司成功,ID='.$companyModel->id.'，来自create_company()']);
    }



    /*
     * 更新公司信息——post(必须传入id)
     * @return json
     * 用户身份验证***
     */
    public function update_Company(){
        //获取更新数据的id
        BaseToken::get_Token_Uid();  //用户验证
//        $company_id = input('company_id');

        //获取并过滤数据
        $companyValidate = new Update_Company_Validate();
        $companyValidate->goCheck();    //验证rule
        $data = $companyValidate->getDataByRule(input('post.'));   //过滤数据

        //更新
        $companyModel = new CompanyModel();
        $result = $companyModel->isUpdate(true)->save($data);  //显式更新，返回写入记录数
        if(!$result){
            throw new QueryDbException(['msg' => '更新公司失败，来自update_company()','code'=>401]);
        }
        return new QueryDbException(['msg' => '更新公司成功,ID='.$companyModel->id.'，来自create_company()']);
    }


    /*
     * 删除公司信息——post(必须传入id)
     * @return json
     * 用户身份验证***
     */
    public function delete_Company(){
        BaseToken::get_Token_Uid();  //用户验证
        $company_id = input('id');
        $result = CompanyModel::destroy($company_id);

        if(!$result){
            throw new QueryDbException(['msg'=>'删除公司信息失败,来自delete_Company()','code'=>401]);
        }
        return new QueryDbException(['msg'=>'删除公司成功,影响数据'.$result.'条，来自delete_Company()']);
    }

}