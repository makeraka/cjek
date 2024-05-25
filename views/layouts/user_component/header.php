<style>
	* {
		text-transform: none;
	}

	.bg-primary {
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.text-primary {
		color: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.btn-primary {
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.badge-primary {
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
	}

	.btn-bg-primary {
		background-image: linear-gradient(to bottom, rgba(50, 111, 155), rgba(50, 111, 155, 0.5));
		color: white;
	}


	/* CSS for hiding the div on mobile devices */
	@media (max-width: 767px) {
		#mobilebreacump {
			display: none;

		}

		#header {
			margin-top: -8px;
		}
	}
</style>


<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
	<!--begin::Page-->
	<!--begin::Header-->
	<div id="kt_app_header" class="app-header  shadow-lg" data-kt-sticky="true"
		data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
		data-kt-sticky-offset="{default: false, lg: '300px'}">
		<!--begin::Header container-->
		<div class="app-container container-xxl d-flex align-items-stretch justify-content-between "
			id="kt_app_header_container">
			<!--begin::Header mobile toggle-->
			<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
				<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
					<i class="ki-outline ki-abstract-14 fs-2"></i>
				</div>
			</div>
			<!--end::Header mobile toggle-->
			<!--begin::Logo-->
			<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-1 me-lg-13">
				<a href="">
					<?php
					echo '<img alt="Logo" src="' . yii::$app->request->baseUrl . '/web/assets/media/logo/pierredfacto.png" class="h-60px h-lg-60px theme-light-show" />';


					?>
				</a>
			</div>
			<!--end::Logo-->
			<!--begin::Header wrapper-->
			<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
				<!--begin::Menu wrapper-->
				<div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
					<!--begin::Menu holder-->
					<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
						data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
						data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
						data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle"
						data-kt-swapper="true" data-kt-swapper-mode="prepend"
						data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
						<!--begin::Menu-->
						<div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-600 menu-state-dark menu-arrow-gray-400 fw-semibold fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0"
							id="#kt_app_header_menu" data-kt-menu="true">
							<?= Yii::$app->menuactionClass->menuConstructeur(''); ?>
						</div>
						<!--end::Menu-->
					</div>
					<!--end::Menu holder-->
				</div>
				<!--end::Menu wrapper-->
				<!--begin::Navbar-->
				<div class="app-navbar-item" id="kt_header_user_menu_toggle">
					<!--begin::Menu wrapper-->
					<div class="d-flex align-items-center border border-dashed border-gray-300 rounded  mt-md-10 p-1"
						data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
						data-kt-menu-placement="bottom-end">
						<!--begin::User-->
						<div class="cursor-pointer symbol me-3 symbol-35px symbol-lg-45px ">
							<img class=""
								src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/media/uploads/photo/"
								alt="user" />
						</div>
						<!--end::User-->

					</div>
					<!--begin::User account menu-->
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
						data-kt-menu="true">
						<!--begin::Menu item-->
						<div class="menu-item px-3">
							<div class="menu-content d-flex align-items-center px-3">
								<!--begin::Avatar-->
								<div class="symbol symbol-50px me-5">
									<img alt="Logo"
										src="<?= yii::$app->request->baseUrl ?>/web/mainAssets/media/uploads/photo/" />
								</div>
								<!--end::Avatar-->
								<!--begin::Username-->
								<div class="d-flex flex-column">
									<div class="fw-bold d-flex align-items-center fs-5">
										BANGALY CAMRA
										<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">En
											ligne</span>
									</div>
									<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
										BANGALY@GMAIL.COM
									</a>
								</div>
								<!--end::Username-->
							</div>
						</div>
						<!--end::Menu item-->
						<!--begin::Menu separator-->
						<div class="separator my-2"></div>
						<!--end::Menu separator-->
						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<a href="<?= yii::$app->request->baseUrl . '/' . md5('site_profil') ?>"
								class="menu-link px-5">Mon profil</a>
						</div>
						<!--end::Menu item-->


						<!--begin::Menu separator-->
						<div class="separator my-2"></div>
						<!--end::Menu separator-->
						<!--begin::Menu item-->
						<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
							data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
							<a href="#" class="menu-link px-5">
								<span class="menu-title position-relative">Mode
									<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
										<i class="ki-outline ki-night-day theme-light-show fs-2"></i>
										<i class="ki-outline ki-moon theme-dark-show fs-2"></i>
									</span></span>
							</a>
							<!--begin::Menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
								data-kt-menu="true" data-kt-element="theme-mode-menu">
								<!--begin::Menu item-->
								<div class="menu-item px-3 my-0">
									<a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
										data-kt-value="light">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-night-day fs-2"></i>
										</span>
										<span class="menu-title">Light</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3 my-0">
									<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-moon fs-2"></i>
										</span>
										<span class="menu-title">Dark</span>
									</a>
								</div>
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<div class="menu-item px-3 my-0">
									<a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
										data-kt-value="system">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-screen fs-2"></i>
										</span>
										<span class="menu-title">System</span>
									</a>
								</div>
								<!--end::Menu item-->
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Menu item-->


						<!--begin::Menu item-->
						<div class="menu-item px-5">
							<a href="<?= yii::$app->request->baseUrl . '/' . md5('site_deconnecter') ?>"
								class="menu-link px-5">Deconnection</a>
						</div>
						<!--end::Menu item-->
					</div>
					<!--end::User account menu-->
					<!--end::Menu wrapper-->
				</div>
			</div>
			<!--end::Header wrapper-->
		</div>
		<!--end::Header container-->
	</div>
	<!--end::Header-->
</div>