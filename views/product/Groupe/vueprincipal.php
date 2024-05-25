    <!-- <form id="kt_filtre" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="post"
	action="<?= Yii::$app->request->baseUrl . "/" . md5("produit_groupe") ?>">
	<input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
	<input type="hidden" name="action_key" id="action_key" value="" />
	<input type="hidden" name="action_on_this" id="action_on_this" value="" /> -->

<div class="app-container container-xxl d-flex">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar  align-self-start" data-kt-drawer="true"
        data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
        data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '225px'}"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Sidebar secondary menu-->
        <div class="card flex-grow-1 py-5 shadow-lg" data-kt-sticky="true" data-kt-sticky-name="app-sidebar-menu-sticky"
            data-kt-sticky-offset="{default: false, xl: '500px'}" data-kt-sticky-width="225px"
            data-kt-sticky-left="auto" data-kt-sticky-top="125px" data-kt-sticky-animation="false"
            data-kt-sticky-zindex="95">
            <div class="hover-scroll-y px-1 px-lg-5" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_header, #kt_app_toolbar, #kt_app_footer"
                data-kt-scroll-wrappers="#kt_app_main" data-kt-scroll-offset="5px">
                <div id="kt_app_sidebar_menu" data-kt-menu="true"
                    class="menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6">
                    <!--begin:Menu item-->
                    <?php Yii::$app->menuactionClass->actionMenu(); ?>



                </div>
            </div>
        </div>
        <!--end::Sidebar secondary menu-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content">
                <!--begin::Card-->
                <div class="card shadow-lg">
                    <!--begin::Card header-->
                    <div class="card-header  bg-primary border-0 pt-2">
                        <!--begin::Card title-->
                        <div class="card-title">

                            <div class="row mb-2 mt-0">
                                
                            <div class="col-md-4 mt-2">
                                <select class="form-select select2 w-md-150px  " id="limit" name="limit">
                                    <option value="1" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 1 ? 'selected' : '' : '' ?>>
                                        1 - 10</option>
                                    <option value="2" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 2 ? 'selected' : '' : '' ?>>
                                        1 - 20</option>
                                    <option value="3" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 3 ? 'selected' : '' : '' ?>>
                                        1 - 30</option>
                                    <option value="4" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 4 ? 'selected' : '' : '' ?>>
                                        1 - 40</option>
                                    <option value="5" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 5 ? 'selected' : '' : '' ?>>
                                        1 - 50</option>
                                    <option value="6" <?= isset($_POST[Yii::$app->params['limit']]) ? $_POST[Yii::$app->params['limit']] == 6 ? 'selected' : '' : '' ?>>
                                        1 - 50 +</option>

                                </select>
                            </div>
                            <!--begin::Search-->
                            <div class="col-md-6 mt-2">
                                <input type="text" data-kt-customer-table-filter="search" id="donneeRecherche"
                                    name="donneeRecherche"
                                    value="<?= isset($_POST['donneeRecherche']) ? $_POST['donneeRecherche'] : Null ?>"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="<?= Yii::t('app', 'donneeRecherche') ?>">
                            </div>
                              <!--end::Search-->

                            <div class="col-md-2 mt-2">
                                <a href="javascript:;" onclick="Filter()" class="btn btn-circle btn-secondary pe-10"
                                    name="afficheBtn" id="afficheBtn">Filtrer</a>
                            </div>
                          
                        </div>
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                <!--begin::Add user-->
                                <a href="javascript:;" onclick="$('#kt_cat_conge').reset()"
									class="btn btn-flex btn-sm btn-body btn-color-gray-600 h-35px bg-body fw-bold"
									data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
									<i class="ki-outline ki-plus fs-2">
									</i>
									<?= Yii::t("app", 'btnajoutGr') ?>
								</a>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->


                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-0">
                        <div id="kt_ecommerce_category_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <!--begin::Table-->
                        <?= Yii::$app->session->getFlash('flashmsg');
                        Yii::$app->session->removeFlash('flashmsg'); ?>

                        <div class="table-responsive">

                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer  scroll-x"
                                id="kt_datatable_zero_configuration">


                            <thead>
                                <?php require_once('contenu/vuePrincipaleLst_tblHeader.php') ?>

                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                <?php require_once('contenu/vuePrincipaleLst_tblBody.php') ?>

                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
</div>
</form>
<!--end::Wrapper container-->


<?php
require_once('contenu/modalAddAction.php');
require_once('contenu/vuePrincipaleUpdateInModal.php');
require_once('script/script.php');
?>