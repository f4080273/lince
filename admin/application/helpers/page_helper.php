<?
function PageCongig($config)
{
  /*分頁樣式設定*/
  $config['full_tag_open'] = '<div class="col-12 text-right"><ul class="pagination justify-content-end">';
  $config['full_tag_close'] = '</ul></div>';

  $config['first_link'] = '&laquo;';//自訂開始分頁連結名稱
  $config['first_tag_open'] = '<li class="prev page">';
  $config['first_tag_close'] = '</li>';

  $config['last_link'] = '&raquo;'; //自訂結束分頁連結名稱
  $config['last_tag_open'] = '<li class="next page">';
  $config['last_tag_close'] = '</li>';

  $config['next_link'] = '下一頁 ';
  $config['next_tag_open'] = '<li class="paginate_button page-item next">'; //自訂下一頁標籤
  $config['next_tag_close'] = '</li>';

  $config['prev_link'] = '上一頁';
  $config['prev_tag_open'] = '<li class="paginate_button page-item previous disabled">';
  $config['prev_tag_close'] = '</li>';

  $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
  $config['cur_tag_close'] = '</a></li>';

  $config['num_tag_open'] = '<li class="paginate_button page-item">';
  $config['num_tag_close'] = '</li>';
  $config['anchor_class'] = "class='page-link'";

  return $config;
}
