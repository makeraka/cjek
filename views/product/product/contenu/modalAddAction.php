<div id="kt_app_content" class="app-content flex-column-fluid" data-select2-id="select2-data-kt_app_content">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl"
        data-select2-id="select2-data-kt_app_content_container">
        <!--begin::Form-->
        <?= Yii::$app->session->getFlash('flashmsg'); Yii::$app->session->removeFlash('flashmsg'); ?>

        <form action="<?= Yii::$app->request->baseUrl . '/' . md5("produit_productadd") ?>" id="nProduitForm"
            name="nProduitForm" enctype="multipart/form-data" method="post"
            class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
            data-kt-redirect="#"
            data-select2-id="select2-data-kt_ecommerce_add_product_form">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
            <input type="hidden" name="action_key" id="action_key" value="<?= md5('newProduct') ?>" />
            <input type="hidden" name="action_on_this" id="action_on_this" value="" />
            <input type="hidden" name="ajax_action_key" id="ajax_action_key" value="" />
            <input type="hidden" name="msg" id="msg" value="" />
            <!--begin::Aside column-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <!--begin::Thumbnail settings-->
                <div class="card card-flush py-4 shadow-lg">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Image</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body text-center pt-0">
                        <!--begin::Image input-->
                        <!--begin::Image input placeholder-->
                        <style>
                        .image-input-placeholder {
                            background-image: url('assets/media/svg/files/blank-image.svg');
                        }

                        [data-theme="dark"] .image-input-placeholder {
                            background-image: url('assets/media/svg/files/blank-image-dark.svg');
                        } 
                        </style>
                        <!--end::Image input placeholder-->
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                            data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                                  <!--begin::Preview existing avatar-->
                                  <div id="image-cropper-result" class="image-input-wrapper w-150px  h-150px">
                                                <img style="width:150px; height:150px;">
                                            </div>
                                            <!--end::Preview existing avatar-->
                            <!--end::Preview existing avatar-->
                                       <!--begin::Label-->
                                       <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="
															<?= yii::t("app",'changephoto')?>">
                                                <a href="javascript:;" Class="btn " data-bs-toggle="modal"
                                                    data-bs-target="#vuePrincipaleAddInModal">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                </a>
                                                <!--begin::Inputs-->
                                                <input type="hidden" name="avatar_remove" />
                                                <input type="text" id="photo" value="" name="photo"
                                                    accept=".png, .jpg, .jpeg" />
                                                <br>
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                                data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar"
                                data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Définir l’image miniature du produit. Seuls les fichiers d’image
                            *.png, *.jpg et *.jpeg sont acceptés</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Thumbnail settings-->

                <!--begin::Category & tags-->
                <div class="card card-flush py-4 shadow-lg">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Recherche rapide</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <label class="form-label">Mots Cles</label>
                        <input class="form-control" value="" name="motscles" id="kt_tagify_1"/>
                       

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category & tags-->


            </div>
            <!--end::Aside column-->
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 shadow-lg ">
                <!--begin:::Tabs-->
                <ul class="nav mx-5 pt-5 nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2 "
                    role="tablist">
                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab"><?= Yii::t('app', 'generalite') ?></a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation" id="qte">
                    </li>
                    <!--end:::Tab item-->
                   
                    <!--begin:::Tab item-->
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_supl" aria-selected="true" role="tab">
                            <?= Yii::t('app', 'infosup') ?></a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2><?= Yii::t('app', 'generalite') ?></h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                     
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="col-sm-4 form-label required"><?= Yii::t('app', 'denomination') ?> :</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text"
                                            value="<?= (isset($_POST[Yii::$app->params['productName']])) ? $_POST['productName'] : Null ?>"
                                            class="form-control" name="productName" id="productName"
                                            autocomplete="off" />
                                        <span class="input-group-addon hidden-md hidden-lg"></span>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <!--end::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class=" row fv-plugins-icon-container">

                                        <!--begin::Input group-->
                                        <!--begin::Label-->
                                        <label class="form-label required"><?= Yii::t('app', 'categorie') ?></label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <div class="col-sm-11">
                                        <select id="productCategory" name="productCategory"  data-control="select2"
                                            class="form-control form-select mb-5">
                                            <option value="" hidden><?= Yii::t('app', 'selectionner..') ?></option>
                                            <?php
                                    
                                                    if (isset($listeCategorie) && is_array($listeCategorie) && sizeof($listeCategorie) > 0) {
                                                        //  die(var_dump($listeCategorie));
                                                    foreach ($listeCategorie as $data) : ?>
                                                                    <option value="<?= $data['code'] ?>"
                                                                        <?= (isset($_POST[Yii::$app->params['productCategory']]) && $_POST[Yii::$app->params['productCategory']] == $data['code']) ? 'selected' : '' ?>>
                                                                        <?= $data['libelle'] ?></option>;
                                                                    <?php endforeach;
                                                    }
                                                    ?>
                                        </select>
                                        </div>
                                        
                                        <!--end::Select2-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7 mb-7 col-md-1">
                                        <!--end::Description-->
                                        <!--end::Input group-->

                                        <!--begin::Button-->
                                        <a onClick="$('#newProductCategory').modal('show')"
                                            class="btn btn-light-primary btn-sm mb-10" name="addproduit"
                                            id="addproduit">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                                        transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor">
                                                    </rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--end::Button-->
                                        <!--begin::Input group-->
                                        <!--begin::Label-->
                                        </div>

                                    </div>

                                    <!--end::Input group-->
                               
                                    <!--begin::Input group-->
                                    <div class="mb-10 row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="col-sm-12 form-label mb-5 required"><?= Yii::t('app', 'groupe') ?>
                                          </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="col-sm-11">
                                            <select name="productGroup" id="productGroup"  class="form-control form-select"  data-control="select2">
                                                <option value=""><?= Yii::t('app', 'select') ?></option>
                                                <?php
                                                 if (isset($listeGroupe) && sizeof($listeGroupe)) {
                                                    foreach ($listeGroupe as  $groupe) :
                                                        echo '<option value="' . $groupe['code'] . '">' . $groupe["libelle"] . ' </option>';
                                                      endforeach;
                                                 }?>
                                            </select>
                                        </div>
                                        <div class="col-sm-1">
                                            <a onClick="$('#newProductGroup').modal('show')"
                                                class="btn btn-light-primary input-group-addon" name="addCategory"
                                                id="addCategory">
                                            
                                             <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                                        transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor">
                                                    </rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            </a>

                                        </div>


                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <!--end::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label"><?= Yii::t('app', 'prixvente') ?></label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="number" min="0"
                                            value="<?= (isset($_POST[Yii::$app->params['productPrixVente']])) ? $_POST[Yii::$app->params['productPrixVente']] : 0 ?>"
                                            class="form-control " name="productPrixVente" id="productPrixVente"
                                            autocomplete="off" />
                                        <span class="input-group-addon hidden-md hidden-lg"></span>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <!--end::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>



                                     <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="required form-label"><?= Yii::t('app', 'dateajout') ?></label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="date"class="form-control " name="dateajout" id="dateajout"
                                            autocomplete="off" />
                                        <span class="input-group-addon hidden-md hidden-lg"></span>
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <!--end::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                      
                                    
                                 
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->


                        </div>
                    </div>
                  
                    
                 
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_add_product_supl" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2><?= Yii::t('app', 'infosup') ?></h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div>
                                        <!--begin::Label-->
                                        <label class="form-label"><?= Yii::t('app', 'desc') ?></label>
                                        <textarea class="form-control" name="description" id="description"></textarea>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Variations-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2><?= Yii::t('app', 'ref') ?></h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                            <!--begin::Label-->
                                            <label class="form-label"><?= Yii::t('app', 'autreinfo') ?></label>
                                            <!--end::Label-->
                                            <!--begin::Repeater-->
                                            <div id="kt_ecommerce_add_product_options">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <!--begin::Row-->
                                                    <div class="row">
                                                        <!--begin::Repeater-->
                                                        <div id="kt_docs_repeater_basic">
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="kt_docs_repeater_basic">
                                                                    <div data-repeater-item>
                                                                        <div class="form-group row">
                                                                            <div class="col-md-5 ">
                                                                                <label
                                                                                    class="form-label"><?= yii::t("app",'Ref')?></label>
                                                                                <select
                                                                                    class="form-select mb-4 border-dark"
                                                                                    name="reference"
                                                                                    data-kt-repeater="select2"
                                                                                    id="seleceValue"
                                                                                    data-placeholder="Select an option">
                                                                                    <option></option>
                                                                                    <?php
																							if(isset($listeRef)){
																								foreach( $listeRef as $each_liste ){
																									
																									echo '<option value="'.$each_liste['code'].'" class="seleceValue" >'.$each_liste['libelle'].'</option>'; 

																									}
																							}
																						?>

                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <label
                                                                                    class="form-label"><?= yii::t("app",'contenu')?></label>
                                                                                <input type="text" name="contenue"
                                                                                    class="form-control mb-4  border-dark mb-md-0" />
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <a href="javascript:;"
                                                                                    data-repeater-delete
                                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                                    <i
                                                                                        class="la la-trash-o"></i><?= yii::t("app",'btnSup')?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->

                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-5">
                                                                <a href="javascript:;" data-repeater-create
                                                                    class="btn btn-light-primary">
                                                                    <i
                                                                        class="la la-plus"></i><?= yii::t("app",'Ajouter d\'autre information')?>
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Variations-->
                            </div>
                            <!--end::Media-->

                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
                <div class="d-flex justify-content-end mx-5 mb-10">
                    <!--begin::Button-->
                    <a href="#" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5"><?= Yii::t('app', 'retour') ?></a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="javascript:;" id="kt_ecommerce_add_product_submit" onclick="submit()"
                        class="btn btn-primary">
                        <span class="indicator-label"><?= Yii::t('app', 'ajouter') ?></span>
                        <span class="indicator-progress"><?= Yii::t('app', 'veillez') ?>
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </a>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content container-->
</div>



<!--begin::Modal - Support Center - Create Ticket-->
<div class="modal fade" id="vuePrincipaleAddInModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 mt-15">
                <div style="display: flex;">
                    <div id="image-cropper" style="border:1px solid #ccc; margin: 5px; width:120px; height:120px;">
                        <?= yii::t("app","selectImage")?> </div>
                </div>
                <p>
                    <input type="button" value="<?= yii::t("app","validecrop")?>" id="image-getter"
                        data-bs-toggle="modal" data-bs-target="#vuePrincipaleAddInModal" class="btn btn-primary">
                </p>
                <a href="javascript:;" Class="btn btn-light me-3" id="retour" data-bs-toggle="modal"
                    data-bs-target="#vuePrincipaleAddInModal"></a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="newProductGroup" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">

                <!--begin::Modal title-->
                <h2 class="fw-bold"><?= yii::t("app",'Ajouter Un Groupes')?></h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--  end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <div class="modal-body">
                <form id="catgorieadd" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                    action="<?= Yii::$app->request->baseUrl."/".md5("catalog_groups") ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                    <input type="hidden" name="action_key" id="action_key" value="<?= md5('addgroupe')?>" />
                    <input type="hidden" name="action_on_this" id="action_on_this" value="" />
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="col-sm-4 form-label required">Nom du Group :
                        </label>
                        <div class="col-sm-12">
                            <input type="text" value="" class="form-control " name="productGroupName"
                                id="productGroupName" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 form-label">Description :
                        </label>
                        <div class="col-sm-12">
                            <textarea rows="3" type="text" class="form-control" name="productGroupDesc"
                                id="productGroupDesc" autocomplete="off"></textarea>
                        </div>
                    </div>
                  </form>
            </div>

            <div class="modal-footer">
                <a href="javascript:;" id="addGroup" type="button" onClick="productGroup_np()" class="btn btn-circle btn-primary"> <i
                        class="fa fa-plus" aria-hidden="true"></i>
                         <span class="indicator-label">
                          
                                <?= Yii::t('app','ajouter');?>
                            </span>
                            <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span></a>
                <button type="button" class="btn btn-circle btn-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close" data-dismiss="modal"> <i
                        class="fa fa-close" aria-hidden="true"></i>  <?= Yii::t('app','fermer');?></button>
            </div>
        </div>
    </div>
</div>



<!--begin::Modal - Add task-->
<div class="modal fade" id="newProductCategory" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">

                <!--begin::Modal title-->
                <h2 class="fw-bold">
                    <?= yii::t("app", 'Ajouter Un Catagorie') ?>
                </h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y ">
                <!--begin::Form-->
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                    style="max-height: 457px;">
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">
                            <?= yii::t("app", 'Libelle') ?>
                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="text" value="" class="form-control" name="productCatNames" id="productCatNames"
                            autocomplete="off" />
                        <!--end::Input-->

                    </div>

                    <!--end::Input group-->
                    <div class="fv-row mb-10">
                        <label class=" fw-semibold fs-6 mb-2">
                            <?= yii::t("app", 'Description') ?>
                        </label>

                        <textarea rows="3" type="text" class="form-control" name="productCatDescs" id="productCatDescs"
                            autocomplete="off"></textarea>

                    </div>
                    <!--end::Input group-->


                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->

                <div class="modal-footer">
                    <a href="javascript:;" id="addproduit" type="button" onClick="productCategorie_np()"
                        class="btn btn-circle btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="indicator-label">

                            <?= Yii::t('app', 'ajouter'); ?>
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span></a>
                    <button type="button" class="btn btn-circle btn-primary" data-bs-dismiss="modal"
                        data-kt-users-modal-action="close" data-dismiss="modal"> <i class="fa fa-close"
                            aria-hidden="true"></i>
                        <?= Yii::t('app', 'fermer'); ?>
                    </button>
                </div>

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->

<script>
cropper(document.getElementById('image-cropper'), {
    area: [500, 400],
    crop: [302, 302],
    allowResize: false,
})
document.getElementById('image-getter').onclick = function() {
    document.getElementById('image-cropper-result').children[0].src = document.getElementById('image-cropper').crop
        .getCroppedImage().src;
    var image = document.getElementById('image-cropper-result').children[0].src;
    document.getElementById('photo').value = image;
    // var image =  document.getElementById('image-cropper').crop.getImage().src;;
    // console.log(image);
}
</script>
<?php
require('script/script.php');


?>