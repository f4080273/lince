<?
function PageCongig($Config)
{
  $Config['full_tag_open'] = '<div class="col-lg-12"><div class="navigation"><ul>';
  $Config['full_tag_close'] = '</ul></div></div>';
  $Config['first_link'] = '<i class="fa fa-angle-left"></i> first';//自訂開始分頁連結名稱
  $Config['last_link'] = 'last <i class="fa fa-angle-right"></i>'; //自訂結束分頁連結名稱
  $Config['prev_link'] = false;
  $Config['next_link'] = false;
  $Config['cur_tag_open'] = '<li class="actiwve"><a href="javascript:void">';
  $Config['cur_tag_close'] = '</a></li>';
  $Config['num_tag_open'] = '<li>';
  $Config['num_tag_close'] = '</li>';

  return $Config;
}
