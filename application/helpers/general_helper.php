<?
function fafa_text_limit($Str='',$Num=10,$text='')
{
  $Str = strip_tags($Str);
  $data = ((mb_strlen($Str, "UTF8")>$Num) ? mb_substr($Str,0,$Num, "UTF8") : $Str).' '.((mb_strlen($Str, "UTF8")>$Num) ? nl2br($text) : nl2br(''));
  return  $data;
}
function fafa_http_build_query($DataArray)
{
  if($DataArray != '' ){
    $DataArray = http_build_query($DataArray);
  }

  return  $DataArray;
}
function errors_code($Value = '')
{
  $data = '';
  switch ($Value) {
    case '1717':
      $data = "此網站已被關閉";
      break;
    case '5045':
      $data = "網站已到期請至後台繼續付款使用";
      break;
    default:
      $data = "未知錯誤";
      break;
  }
  return $data;
}
