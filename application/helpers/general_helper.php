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
function fafa_contract_ask($Id)
{
  switch ($Id) {
    case '1':
      $data = '聯絡主旨';
      break;
    case '2':
      $data = '聯絡主旨';
      break;
    case '3':
      $data = '聯絡主旨';
      break;
    case '4':
      $data = '聯絡主旨';
      break;
    case '5':
      $data = '聯絡主旨';
      break;
    case '6':
      $data = '聯絡主旨';
      break;
    case '7':
      $data = '聯絡主旨';
      break;
    case '8':
      $data = '聯絡主旨';
      break;
    case '9':
      $data = '聯絡主旨';
      break;
      default:
      $data = '請在新增 helpers/fafa_contract_ask 之參數';
      break;
  }
  return $data;
}
