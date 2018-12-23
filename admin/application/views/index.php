<?=$Head?>
<div id="wrapper">
<?=$TopBar?>
<?=$Menu?>
	<div class="content-page">
		<div class="content">
    	<div class="container-fluid">
				<div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left"><?=end($MenuRoute)?></h4>
                    <ol class="breadcrumb float-right">
												<?foreach($MenuRoute as $row){?>
													<li class="breadcrumb-item <?=($row == end($MenuRoute))?"active":""?>"><?=$row?></li>
												<?}?>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
				<?=$Right_Contents?>
			</div>
		</div>
		<footer class="footer text-right">
			<?=$CopyRight?>
		</footer>
	</div>
</div>
<?=$Footer?>
