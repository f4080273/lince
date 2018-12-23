<div class="contact">
  <h4>聯絡我們</h4>
  <?if(isset($contract1->varE) && $contract1->varE != ''){?>
  <p>Email：<?=$contract1->varE?></p>
  <?}?>
  <?if(isset($contract1->varA) && $contract1->varA != ''){?>
  <p>電&nbsp;&nbsp;話：<?=$contract1->varA?></p>
  <?}?>
  <?if(isset($contract1->varB) && $contract1->varB != ''){?>
  <p>傳&nbsp;&nbsp;真：<?=$contract1->varB?></p>
  <?}?>
  <?if(isset($contract1->varD) && $contract1->varD != ''){?>
  <p>地&nbsp;&nbsp;址：<?=$contract1->varD?></p>
  <?}?>
  <a href="<?=_Web_Url?>/contact">聯絡我們</a>
</div>
