<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
	<div class="slimscroll-menu" id="remove-scroll">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu" id="side-menu">
				<?
					foreach ($MenuList as $val1) {
				?>
					<?if($val1['just_btn'] == 1){?>
					<li class="<?=$val1['active']?>" ><a href="javascript: void(0);"><?=$val1['menu_img']?> <span>
								<?=$val1['model_title']?></span> <span class="menu-arrow"></span></a>
						<?if(count($val1['sub']) > 0){?>
						<ul class="nav-second-level" aria-expanded="false">
							<?foreach ($val1['sub'] as $val2){?>
								<li class="<?=$val2['active']?>"><a href="<?=_Web_Url?>/<?=$val2['url']?>"><?=$val2['menu_img']?> <?=$val2['model_title']?></a></li>
							<?}?>
						</ul>
						<?}?>
					</li>
					<?}else{?>
						<li class="<?=$val1['active']?>"><a href="<?=_Web_Url?>/<?=$val1['url']?>"><?=$val1['menu_img']?> <span>
									<?=$val1['model_title']?></span>
								</a>
						</li>
					<?}?>
				<?}?>
			</ul>
		</div>
		<!-- Sidebar -->
		<div class="clearfix"></div>

	</div>
	<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
