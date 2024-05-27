<!-- BEGIN FORM-->
<form class="form" action="" name="countbook_form" id="countbook_form" action="<?= yii::$app->request->baseurl . '/' . md5('membre_profil') ?>" method="post">

  <!-- DEBUT : BASIC HIDDEN IMPUT FOR THE FORM -->
  <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
  <input type="hidden" name="action_key" id="action_key" value="" />
  <input type="hidden" name="action_on_this" id="action_on_this" value="<?= $membre['code'] ?>" />
  <input type="hidden" name="action_on_this_val" id="action_on_this_val" value="" />


  <div id="kt_app_content_container" class="app-container container-xxl mt-10">
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xxl-8">
      <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
          <!--begin: Pic-->
          <div class="me-7 mb-4">
            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
              <img src="<?= yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $membre['photo'] ?>" alt="image">
            </div>
          </div>
          <!--end::Pic-->
          <!--begin::Info-->
          <div class="flex-grow-1">
            <!--begin::Title-->
            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
              <!--begin::User-->
              <div class="d-flex flex-column">
                <!--begin::Name-->
                <div class="d-flex align-items-center mb-2">
                  <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                    <?= isset($membre['prenom']) ? $membre['prenom'] : '' ?> <?= isset($membre['nom']) ? $membre['nom'] : '' ?>
                  </a>
                  <a href="#">

                  </a>
                </div>
                <!--end::Name-->
                <!--begin::Info-->
                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                  <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                    <span class="svg-icon svg-icon-4 me-1">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                        <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <?= isset($membre['tel']) ? $membre['tel'] : '' ?>
                  </a>
                  <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                    <span class="svg-icon svg-icon-4 me-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <?= isset($membre['adresse']) ? $membre['adresse'] : '' ?>
                  </a>
                  <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                    <span class="svg-icon svg-icon-4 me-1">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <?= isset($membre['email']) ? $membre['email'] : '' ?>

                  </a>
                </div>
                <!--end::Info-->
              </div>
              <!--end::User-->
              <!--begin::Actions-->
              <div class="d-flex my-4">
                <div class="row">
                  <div class="col-12">
                    <p>
                      <span class="stat-label fw-bold">PRESENCE</span><br><span style="font-size: 28px;">

                      </span>

                    </p>
                  </div>
                  <div class="col-12">
                    <p>
                      <span class="stat-label fw-bold">ABSCENCE</span><br><span class="text-danger" style="font-size: 28px;">

                      </span>

                    </p>
                  </div>
                  <!--begin::Button-->
                  <a href="<?= yii::$app->request->baseUrl . '/' . md5('membre_liste') ?>" class="btn btn-icon btn-primary btn-md ms-auto me-lg-n7">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                    <span class="svg-icon svg-icon-2">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"></path>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </a>
                </div>

              </div>
              <!--end::Actions-->
            </div>
            <!--end::Title-->
          </div>

          <!--end::Info-->
        </div>


        <!--end::Details-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto" role="tablist" style="width: 100%; margin-left: -25px;">
          <!--begin:::Tab item-->
          <li class="nav-item" role="presentation">
            <a class="nav-link  text-active-primary ms-0 me-10 py-5 fs-3 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_history" aria-selected="false" role="tab" tabindex="-1">
              <?= Yii::t('app', 'historiquepresence') ?>
            </a>
          </li>
          <!--end:::Tab item-->

          <!--begin:::Tab item-->
          <li class="nav-item" role="presentation">
            <a class="nav-link  text-active-primary ms-0 me-10 py-5 fs-3 " data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary" aria-selected="true" role="tab">
              <?= Yii::t('app', 'infosmembre') ?>
            </a>
          </li>

        </ul>
        <!--end:::Tabs-->

      </div>
    </div>
    <!--end::Navbar-->
    <!--begin::Row-->
    <div class="tab-content">
      <div class="tab-pane active fade show card" id="kt_ecommerce_sales_order_history" role="tab-panel">
        <!--begin::Card head-->
        <div class="card-header bg-primary card-header-stretch">
          <!--begin::Title-->
          <div class="card-title d-flex align-items-center">

            <!--end::Svg Icon-->
            <h3 class="fw-bold m-0 text-white">
              <?= Yii::t('app', 'histcours') ?>
            </h3>
          </div>
          <!--end::Title-->

        </div>
        <!--end::Card head-->
        <!--begin::Card body-->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_datatable_zero_configuration">

              <!--begin::Table body-->
              <tbody class="fw-semibold text-gray-600">
                <?php
                // if (is_array($bills) && sizeof($bills) > 0) {
                //   foreach ($bills as $key => $each_bill) {
                //     $badge = "success";
                //     $tt_paid = $dette = Null;
                //     $key2 = $key + 1;
                //     $paiement_btn = '';

                //     if (isset($each_bill_ttpaid)) {
                //       foreach ($each_bill_ttpaid as $data_ttpaid) {
                //         if (isset($data_ttpaid['bill_id']) && $data_ttpaid['bill_id'] == $each_bill["id"]) {
                //           $tt_paid = $data_ttpaid['tt_paid'];
                //           $dette = $each_bill["montanttotalpayer"] - $tt_paid;
                //           if (isset($dette) && $dette > 0) {
                //             $badge = "danger";

                //             $paiement_btn = '<a href="javascript:;" Class="btn btn-circle btn-success" onclick="document.getElementById(\'action_key\').value=\'' . md5(strtolower("preparer_rembourssement_membre")) . '\';  document.getElementById(\'action_on_this\').value=\'' . $each_bill["bill_number"] . '\'; document.getElementById(\'action_on_this_val\').value=\'' . $each_bill["id"] . '\'; $(\'#countbook_form\').attr(\'action\',\'' . md5("paiement_themain") . '\'); $(\'#countbook_form\').submit();">Paiement</a>';
                //           }
                //         }
                //       }
                //     }
                //     $voirplus_btn = '<a href="javascript:;" Class="btn btn-circle btn-primary" onclick="document.getElementById(\'action_key\').value=\'' . md5(strtolower("charger_facture_data")) . '\';  document.getElementById(\'action_on_this\').value=\'' . $each_bill["id"] . '\';  document.getElementById(\'action_on_this_val\').value=\'' . "2" . '\'; $(\'#countbook_form\').attr(\'action\',\'' . md5("paiement_themain") . '\'); $(\'#countbook_form\').submit();"> Ouvrtir</a>';

                //     echo '
                //   <tr>
                //   <td>' . $key2 . '</td>
                //   <td>' . Yii::$app->nonSqlClass->convert_date_to_sql_form($each_bill["date_topup"], 'Y-M-D', 'D/M/Y') . '</td>
                //   <td style="font-size: 16px; font-weight: bold;">' . $each_bill["bill_number"] . '</td>
                //   <td>' . number_format($each_bill["montanttotalpayer"]) . '</td>
                //   <td>' . number_format($tt_paid) . '</td>
                //   <td><span class="badge badge-' . $badge . '">' . number_format($dette) . '</span></td>

                //   ';
                //   }
                // }
                ?>
              </tbody>
              <!--end::Table head-->
            </table>
            <!--end::Table-->
          </div>
        </div>
        <!--end::Card body-->
      </div>
      <!--end::Row-->

    </div>
    <div class="tab-content">
      <!--begin::Row-->
      <div class="tab-pane fade card" id="kt_ecommerce_sales_order_summary" role="tab-panel">
        <!--begin::Card head-->
        <div class="card-header bg-primary card-header-stretch">
          <!--begin::Title-->
          <div class="card-title d-flex align-items-center">

            <!--end::Svg Icon-->
            <h3 class="fw-bold m-0 text-white">
              <?= Yii::t('app', 'infosmembre') ?>
            </h3>
          </div>
          <!--end::Title-->

        </div>
        <!--end::Card head-->
        <!--begin::Card body-->
        <div class="card-body">

          <!--begin::Input group-->
          <div class="fv-row mb-7 fv-plugins-icon-container">
            <style>
              .image-input-placeholder {
                background-image: url('<?= yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $membre['photo'] ?>');
              }
            </style>
            <!--end::Image input placeholder-->
            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
              <!--begin::Preview existing avatar-->
              <!--begin::Preview existing avatar-->
              <div id="image-cropper-result" class="image-input-wrapper w-150px  h-150px">
                <img style="width:150px; height:150px;">
              </div>
              <!--end::Preview existing avatar-->
              <!--end::Preview existing avatar-->
              <!--begin::Label-->
              <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="
                                                                            <?= yii::t("app", 'changephoto') ?>">
                <a href="javascript:;" Class="btn " data-bs-toggle="modal" data-bs-target="#vuePrincipaleAddInModal">
                  <i class="bi bi-pencil-fill fs-7"></i>
                </a>
                <!--begin::Inputs-->
                <input type="hidden" name="avatar_remove" value="<?= $membre['photo'] ?>" />
                <input type="text" id="photo" value="" name="photo" accept=".png, .jpg, .jpeg" />
                <br>
                <!--end::Inputs-->
              </label>
              <!--end::Label-->
              <!--begin::Cancel-->
              <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-kt-initialized="1">
                <i class="bi bi-x fs-2"></i>
              </span>
              <!--end::Cancel-->
              <!--begin::Remove-->
              <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-kt-initialized="1">
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
          <!--begin::Input group-->
          <div class="fv-row row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <div class="col-md-6">

              <label class="fs-5 fw-semibold form-label mb-5 required">
                <?= yii::t("app", 'nom') ?>
              </label>
            </div>
            <div class="col-md-6">
              <!--end::Label-->
              <!--begin::Input-->
              <input class="form-control form-control-solid " name="nomc" id="nomc" value="<?= isset($membre['nom']) ? $membre['nom'] : '' ?>" autocomplete="off">
              <!--end::Input-->
            </div>
          </div>

          <!--begin::Input group-->
          <div class="fv-row row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <div class="col-md-6">

              <label class="fs-5 fw-semibold form-label mb-5 required">
                <?= yii::t("app", 'prenom') ?>
              </label>
            </div>
            <div class="col-md-6">
              <!--end::Label-->
              <!--begin::Input-->
              <input class="form-control form-control-solid " name="nomcp" id="nomcp" value="<?= isset($membre['prenom']) ? $membre['prenom'] : '' ?>" autocomplete="off">
              <!--end::Input-->
            </div>
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-md-6">
              <label class="fs-5 fw-semibold form-label mb-2 ">
                <?= yii::t("app", 'email') ?>
              </label>
              <!--end::Label-->
            </div>
            <div class="col-md-6">
              <!--end::Label-->
              <!--begin::Input-->
              <input class="form-control form-control-solid " name="email" id="email" value="<?= isset($membre['email']) ? $membre['email'] : '' ?>" autocomplete="off">
              <!--end::Input-->
            </div>
          </div>
          <!--end::Input group-->
          <!--begin::Input group-->
          <div class="row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-md-6">
              <label class="fs-5 fw-semibold form-label mb-5 required">
                <?= yii::t("app", 'tel') ?>
              </label>
              <!--end::Label-->
            </div>
            <div class="col-md-6">
              <!--end::Label-->
              <!--begin::Input-->
              <input class="form-control form-control-solid " name="tel" value="<?= isset($membre['tel']) ? $membre['tel'] : '' ?>" autocomplete="off">
              <!--end::Input-->
            </div>
          </div>
          <!--end::Input group-->

          <div class="row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-md-6">
              <label class="fs-5 fw-semibold form-label mb-2">
                <?= yii::t("app", 'adresse') ?>
              </label>
            </div>
            <div class="col-md-6">
              <input class="form-control form-control-solid " name="adresse" value="<?= isset($membre['adresse']) ? $membre['adresse'] : '' ?>">
              <!--end::Input-->
            </div>
          </div>

          <div class="row mb-5 fv-plugins-icon-container">
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-md-6">
              <label class="fs-5 fw-semibold form-label mb-2">
                <?= yii::t("app", 'etat') ?>:
              </label>
            </div>
            <div class="col-md-6">
              <input class="form-control form-control-solid " name="etat" value="<?= isset($membre['etat']) ? $membre['etat'] : '' ?>">
              <!--end::Input-->
            </div>
          </div>
        </div>




</form>

<div class="panel-footer">
  <!--begin::Actions-->
  <div class="text-center mb-5">
    <button type="submit" id="kt_subscriptions_export_submit" data-senus class="btn btn-primary" onclick="modifier()">
      <span class="indicator-label">
        <?= Yii::t('app', 'edit') ?>
      </span>
      <span class="indicator-progress">>
        <?= Yii::t('app', 'veillez') ?>
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
      </span>
    </button>
  </div>
</div>
<!-- .PIEDS DU FORMULAIRE -->

</div>
<!--end::Row-->
</div>
</div>




<!-- Modal -->




<div class="modal fade" id="vuePrincipaleAddInModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <!--begin::Modal dialog-->
  <div class="modal-dialog modal-dialog-centered mw-750px">
    <!--begin::Modal content-->
    <div class="modal-content rounded">
      <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 mt-15">
        <div style="display: flex;">
          <div id="image-cropper" style="border:1px solid #ccc; margin: 5px; width:120px; height:120px;">
            <?= yii::t("app", "selectImage") ?> </div>
        </div>
        <p>
          <input type="button" value="<?= yii::t("app", "validecrop") ?>" id="image-getter" data-bs-target="#kt_modal_add_customer" data-bs-toggle="modal" data-bs-target="#vuePrincipaleAddInModal" class="btn btn-primary">
        </p>
        <a href="javascript:;" Class="btn btn-light me-3" id="retour" data-bs-toggle="modal" data-bs-target="#vuePrincipaleAddInModal"></a>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('countbook_form').addEventListener('submit', function(event) {
    event.preventDefault();
  });


  function modifier() {
    alert('dd');
    var button = document.querySelector("#kt_subscriptions_export_submit");
    $("#kt_subscriptions_export_submit").prop("disabled", true);

    var nomc = $("#nomc").val();
    var tel = $("#email").val();

    if (nomc == '' || email == '') {

      message('<?= Yii::t("app", "rienamodifier") ?>', 'error');
      $("#kt_subscriptions_export_submit").prop("disabled", false);
      return false;

    }

    $('#action_key').val('<?= md5('modifier_membre') ?>');
    $('#countbook_form').submit();


  }



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

  $('#kt_datatable_zero_configuration').dataTable();
</script>