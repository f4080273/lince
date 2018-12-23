<div class="news-widget">
  <div class="title">
    <h4>熱門新聞</h4>
  </div>
  <?foreach ($DataList as $row){?>
  <div class="news-item">
    <figure>
      <img src="<?=_Web_Url?>/images/news/right/<?=$row->News_Img?>" alt="<?=$row->News_Title?>">
    </figure>
    <div class="text-box">
      <h5><a href="<?=_Web_Url?>/news/detail/<?=$row->News_MemberId?>/<?=$row->News_Id?>"><?=$row->News_Title?></a></h5>
      <p>
        <?=$row->News_PulTime?>
      </p>
    </div>
  </div>
  <?}?>
</div>
