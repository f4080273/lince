<!-- Top Bar Start -->
<div class="topbar">

	<!-- LOGO -->
	<div class="topbar-left">
		<a href="<?=_Web_Url?>/admin" class="logo"> <span>
		</span> <i>
		</i>
		</a>
	</div>

	<nav class="navbar-custom">

		<ul class="list-inline float-right mb-0" >
			<li class="list-inline-item dropdown notification-list" style="display:none"><a
				class="nav-link dropdown-toggle arrow-none waves-light waves-effect"
				data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
				aria-expanded="false"> <i class="dripicons-bell noti-icon"></i> <span
					class="badge badge-pink noti-icon-badge">4</span>
			</a>
				<div
					class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg"
					aria-labelledby="Preview">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5>
							<span class="badge badge-danger float-right">5</span>Notification
						</h5>
					</div>

					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<div class="notify-icon bg-success">
							<i class="icon-bubble"></i>
						</div>
						<p class="notify-details">
							Robert S. Taylor commented on Admin<small class="text-muted">1
								min ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<div class="notify-icon bg-info">
							<i class="icon-user"></i>
						</div>
						<p class="notify-details">
							New user registered.<small class="text-muted">1 min ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<div class="notify-icon bg-danger">
							<i class="icon-like"></i>
						</div>
						<p class="notify-details">
							Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min
								ago</small>
						</p>
					</a>

					<!-- All-->
					<a href="javascript:void(0);"
						class="dropdown-item notify-item notify-all"> View All </a>

				</div></li>
			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle waves-effect waves-light nav-user"
				data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
				aria-expanded="false" href="#"> 預覽</a>
				<div class="dropdown-menu dropdown-menu-right profile-dropdown "
					aria-labelledby="Preview">
					<!-- item-->
					<a target="_blank" href="<?=_Img_Url?>" class="dropdown-item notify-item"> <i
						class="zmdi zmdi-account-circle"></i> <span>網站</span>
					</a>
				</div>
			</li>
			<li class="list-inline-item dropdown notification-list"><a
				class="nav-link dropdown-toggle waves-effect waves-light nav-user"
				data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
				aria-expanded="false"> 帳號
			</a>
				<div class="dropdown-menu dropdown-menu-right profile-dropdown "
					aria-labelledby="Preview">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5 class="text-overflow">
							<small>歡迎 ! <?=$SupplierDataByid->account?></small>
						</h5>
					</div>

					<!-- item-->
					<a href="<?=_Web_Url?>/admin/change_passwd" class="dropdown-item notify-item"> <i
						class="zmdi zmdi-account-circle"></i> <span>修改密碼</span>
					</a>
					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item" onclick="logout()"> <i
						class="zmdi zmdi-power"></i> <span>登出</span>
					</a>

				</div></li>

		</ul>

		<ul class="list-inline menu-left mb-0">
			<li class="float-left">
				<button
					class="button-menu-mobile open-left waves-light waves-effect">
					<i class="dripicons-menu"></i>
				</button>
			</li>
		</ul>

	</nav>

</div>
<!-- Top Bar End -->
