<div class="modal fade" id="updateProductBan" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel"> <?= Yii::t('app', 'modifiebaner') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="RefUpdate" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                action="<?= Yii::$app->request->baseUrl . "/" . md5("produit_reference") ?>" method="post">
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
                            <select class="form-select" name="statutRefUpdate" id="statutRefUpdate">
                                <option value="1">
                                    <?= Yii::t('app', 'active') ?>
                                </option>
                                <option value="2">
                                    <?= Yii::t('app', 'suprime') ?>
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="fv-row mb-12">
                        <label class="col-sm-4 form-label"><?= Yii::t('app', 'Libelle') ?> <span class="asterisk">*</span>
                        </label>
                        <div class="fv-row mb-12">
                            <input type="text" value="" class="form-control" name="productRefNameUpdate"
                                id="productRefNameUpdate" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 form-label"><?= Yii::t('app', 'desc') ?>
                        </label>
                        <div class="col-sm-12">
                            <textarea type="text" class="form-control" name="productRefDescUpdate"
                                id="productRefDescUpdate" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>
            </form>

            <div class="modal-footer">
                <button onClick="productRef_update()" class="btn btn-circle btn-primary" id="updateproduitup"><i
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