<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class typelimit {
    static public $treeList = array(); //存放无限分类结果如果一页面有多个无限分类可以使用 Too
    //l::$treeList = array(); 清空
    /**
     * 无限级分类
     * @access public
     * @param Array $data     //数据库里获取的结果集
     * @param Int $pid
     * @param Int $count       //第几级分类
     * @return Array $treeList

     */
    static public function tree(&$data,$pid = 0,$count = 1) {
        foreach ($data as $key => $value){
            if($value->PId==$pid){
                $value->Count = $count;
                $value->SU = self::word($count,'&nbsp;&nbsp;');
                self::$treeList[]=$value;
                unset($data[$key]);
                self::tree($data,$value->Id,$count+1);
            }
        }
        return self::$treeList;
    }
    public function word($Num = 0,$Word = '&nbsp;&nbsp;') {
      $WordData = '';
      while ($Num > 1) {
      $WordData = $WordData.$Word;
        $Num--;
      }
      return $WordData."┖";
    }
    static public function downtree(&$data,$id = 0) {
        foreach ($data as $key => $value){
            if($value->PId == $id ){
                self::$treeList[]=$value;
                unset($data[$key]);
                self::downtree($data,$value->Id);
            }
        }
        return self::$treeList;
    }
}
