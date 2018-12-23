<div class="single-sidebar category-widget">
  <h3 class="title"><?=$AboutType_Name?></h3><!-- /.title -->
  <ul>
    <?foreach ($DataList as $row){?>
    <li><a href="<?=_Web_Url?>/about/detail/<?=$row->About_MemberId?>/<?=$row->About_Id?>"><?=$row->About_Title?></a></li>
    <?}?>
  </ul>
</div><!-- /.single-sidebar category-widget -->
