<div class="modal fade" id="updateProductCategory" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px" data-select2-id="select2-data-130-0luo">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Modification Categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="CategorieUpdate" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                action="<?= Yii::$app->request->baseUrl . "/" . md5("produit_categories") ?>" method="post">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <input type="hidden" name="action_key" class="action_key" value="" />
                <input type="hidden" name="action_on_this" class="action_on_this" value="" />
                <div class="modal-body">


                    <!--begin::Input group-->
                    <div class="fv-row mb-12">
                        <label class="col-sm-4 form-label">
                            <?= Yii::t('app', 'statut') ?> :
                        </label>
                        <div class="col-sm-12">
                            <select class="form-select" name="statutCatUpdate" id="statutCatUpdate">
                                <option value="1">
                                    <?= Yii::t('app', 'active') ?>
                                </option>
                                <option value="2">
                                    <?= Yii::t('app', 'suprime') ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
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
                            data-kt-image-input="true" id="imgbackground">
                            <!--begin::Preview existing avatar-->
                            <!--begin::Preview existing avatar-->
                            <div id="image-cropper-resultUpdate" class="image-input-wrapper w-150px  h-150px">
                                <img style="width:150px; height:150px;">
                            </div>
                            <!--end::Preview existing avatar-->
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="
                                                                            <?= yii::t("app", 'changephoto') ?>">
                                <a href="javascript:;" Class="btn " data-bs-toggle="modal"
                                    data-bs-target="#vuePrincipaleUpdateInModal">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                </a>
                                <!--begin::Inputs-->
                                <input type="hidden" name="avatar_removeupdate" />
                                <input type="text" id="updatephoto" value="" name="updatephoto" accept=".png, .jpg, .jpeg" />
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
                        <div class="text-muted fs-7">
                            *.png, *.jpg et *.jpeg</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->


                    <div class="fv-row mb-12">
                        <label class="col-sm-4 form-label"> <?= Yii::t('app', 'nomcategorie') ?> : <span class="asterisk">*</span>
                        </label>
                        <div class="fv-row mb-12">
                            <input type="text" value="" class="form-control" name="productCatNameUpdate"
                                id="productCatNameUpdate" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 form-label"> <?= Yii::t('app', 'desc') ?> :
                        </label>
                        <div class="col-sm-12">
                            <textarea rows="3" type="text" class="form-control" name="productCatDescUpdate"
                                id="productCatDescUpdate" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>
            </form>

            <div class="modal-footer">
                <button onClick="productCategorie_update()" class="btn btn-circle btn-primary" id="updateproduitup"><i
                        class="fa fa-edit"></i>
                    <span class="indicator-label">
                        &nbsp;
                        <?= Yii::t('app', 'Modifier'); ?>
                    </span>
                    <span class="indicator-progress">
                        <?= Yii::t('app', 'veuillez'); ?><span
                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span></button>
                </button>
                <button type="button" onClick="cancel()" class="btn btn-circle btn-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close"><i class="fa fa-close"></i>&nbsp;
                    <?= Yii::t('app', 'fermer'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="vuePrincipaleUpdateInModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
	data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-750px">
		<!--begin::Modal content-->
		<div class="modal-content rounded">
			<div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 mt-15">
				<div style="display: flex;">
					<div id="image-cropperupdate" style="border:1px solid #ccc; margin: 5px; width:120px; height:120px;">
						<?= yii::t("app", "selectImage") ?>
					</div>
				</div>
				<p>
					<input type="button" value="<?= yii::t("app", "validecrop") ?>" id="image-getterupdate"
						data-bs-target="#updateProductCategory" data-bs-toggle="modal"
						data-bs-target="#vuePrincipaleUpdateInModal" class="btn btn-primary">
				</p>
				<a href="javascript:;" Class="btn btn-light me-3" id="retour" data-bs-toggle="modal"
					data-bs-target="#vuePrincipaleUpdateInModal"></a>
			</div>
		</div>
	</div>
</div>

<script>
	cropper(document.getElementById('image-cropperupdate'), {
		area: [500, 400],
		crop: [302, 302],
		allowResize: false,
	})
	document.getElementById('image-getterupdate').onclick = function () {
		document.getElementById('image-cropper-resultUpdate').children[0].src = document.getElementById('image-cropperupdate').crop
			.getCroppedImage().src;
		var image = document.getElementById('image-cropper-resultUpdate').children[0].src;
		document.getElementById('updatephoto').value = image;
		// var image =  document.getElementById('image-cropper').crop.getImage().src;;
		// console.log(image);
	}
</script>