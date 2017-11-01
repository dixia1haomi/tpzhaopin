<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/21 0021
 * Time: 下午 12:26
 */

namespace app\api\model;


class Resume extends BaseModel
{


    //查询简历【列表】API
    public static function get_Resume_List_Model($area)
    {

        if ($area == 0) {
            $data = self::select();
        } else {
            $data = self::where('work_place', $area)->order('update_time desc,create_time desc')->select();
        }
        return $data;
    }



    //获取器-> 查出数据来处理
    // 性别
//    public function getSexAttr($value)
//    {
//        $status = ['男', '女'];
//        return $status[$value];
//    }
//
//    // 工作经验
//    public function getWorkExpAttr($value)
//    {
//        $status = [0 => '无经验', 1 => '应届生', 2 => '1年以下', 3 => '1-3年', 4 => '3-5年', 5 => '5-10年', 6 => '10年以上'];
//        return $status[$value];
//    }
//
//    // 学历
//    public function getEducationAttr($value)
//    {
//        $status = [0 => '高中以下', 1 => '高中', 2 => '中专/技校', 3 => '大专', 4 => '本科', 5 => '硕士', 6 => '博士', 7 => 'MBA/EMBA'];
//        return $status[$value];
//    }
//
//    // 意向职位
//    public function getExpectationPositionAttr($value)
//    {
//        $status = [
//            '销售', '客服', '普工/技工', '人事/行政/后勤', '餐饮', '旅游', '酒店', '超市/百货/零售', '美容/美发', '保健/按摩', '运动健身',
//            '服装/纺织/食品', '生产管理/研发', '建筑', '物业管理', '房产中介', '家政保洁/安保', '司机/交通服务', '物流/仓储', '贸易/采购',
//            '汽车制造/服务', '淘宝职位', '美术/设计/创意', '化工', '市场/媒介/公关', '广告/会展/咨询', '娱乐/休闲', '教育/培训',
//            '财务/审计/统计', '法律', '翻译', '编辑/出版/印刷', '计算机/互联网/通信', '电子/电器', '机械/仪器仪表', '金融/银行/证劵/投资',
//            '保险', '医院/医疗/护理', '环保/能源', '制药/生物工程', '质控/安防', '农/林/牧/渔业', '其他职位'
//        ];
//        return $status[$value];
//    }
//
//    // 期望薪资
//    public function getExpectationPayAttr($value)
//    {
//        $status = [
//            '面议', '1000元以下', '1000-2000元', '2000-3000元', '3000-5000元', '5000-8000元', '8000-12000元', '12000-20000元', '20000元以上'
//        ];
//        return $status[$value];
//    }
//
//    // 求职区域
//    public function getWorkPlaceAttr($value)
//    {
//        $status = [0 => '曲靖', 1 => '麒麟', 2 => '沾益'];
//        return $status[$value];
//    }
//
//    // 工作性质
//    public function getWorkNatureAttr($value)
//    {
//        $status = ['全职', '兼职', '全职/兼职'];
//        return $status[$value];
//    }
//
//    // 到岗时间
//    public function getReportTimeAttr($value)
//    {
//        $status = ['随时到岗', '一周以内', '两周以内', '一月以内', '无法确定'];
//        return $status[$value];
//    }
//
//    // 目前状态
//    public function getCurrentStateAttr($value)
//    {
//        $status = ['已离职', '暂未离职'];
//        return $status[$value];
//    }


}