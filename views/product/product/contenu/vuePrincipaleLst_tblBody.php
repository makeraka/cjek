<div class="row">
    <?php
    if (is_array($listeproduct) && sizeof($listeproduct) > 0) {
        foreach ($listeproduct as $key => $data) {
            // die(var_dump($data['code']));
    
            echo '

            <div class="col-lg-4 col-xl-3 col-md-4  mb-10 ">
            <!-- begin::card -->
            <div class="card shadow-lg h-100" style="margin-top: 10px;">
                <!-- begin::body -->
                <div class="card-body d-flex-center flex-column" >
                    <div class="row" >
                        <div class="col-12" >
                        <div class="symbol symbol-65px symbol-circle mb-2 " style="padding-left: 30%;" >
                        <img src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '" alt="" style=" padding-lef:40%">
                        <div class="bg-succes position-absolute  rounded-circle translate-middle start-100 top-100 border-4 border-bo"></div>
                        </div>
                     <!-- end::avatar -->
                        </div>

                        <div class="col-12" >
                            <div class="fw-semibold text-gray-900 fs-1  text-center">' . $data["libelle"] . '</div>
                        </div>

                        <div class="col-12 justify-content-center  " >
                            <table class="mb-5 align-items-center  m-auto mt-2 mx-5px">
                
                                <tr>
                                    <td  class="fw-semibold text-gray-400  text-start"> Prix V.U :&nbsp </td>
                                    <td class="text-stard">  :' . number_format($data["prixunitairevente"], 0, '.', '.') . ' ' . yii::t("app", 'gf') . '</td>
                                </tr>
                            </table>
                        </div>

                      
                    </div>


                </div>
                <div class="card-footer">
                   
                        <div class="row">
                        <div class="col-12 text-center ">
                            <a href="#" class="btn btn-sm btn-primary  btn-flex btn-center btn-active-light-primary"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" style="padding-left: 10%;"> ' .
                                yii::t("app",
                                'Option') . '
                                <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-2">
                                    <a href="' . yii::$app->request->baseUrl . '/' . md5('produit_productupdate').'/'.$data["code"] . '" Class="menu-link px-3">Modifier</a>;
                                    &nbsp;
                                </div>
                            </div>
                            <!--end::Menu-->
                        </div>
                        </div>
                </div>
            </div>
        </div> ';


        }
    }
    ?>

</div> <!--end::Table-->