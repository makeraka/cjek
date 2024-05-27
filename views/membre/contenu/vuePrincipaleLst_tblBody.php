<div class="row">
    <?php
    // die('ok');
    if (is_array($listeMembres) && sizeof($listeMembres) > 0) {
        
        foreach ($listeMembres as $key => $data) {

            $compte_btn = '<a href="' . yii::$app->request->baseUrl . '/' . md5('membre_profil') . '/' . $data["code"] . '" Class="btn  btn-primary"> Accéder au profil</a>';

            if (isset($data['etat']) && $data['etat'] == 1) {
                $statut = '<a href="javascript:;" Class="badge  badge-success" >Actif</a>';
            } else {
                $statut = '<span class="badge badge-warning">Archivé</span>';
            }
            //  die(var_dump($data));
    
            echo '

            <div class="col-lg-4 col-xl-3 col-md-4  mb-10 ">
            <!-- begin::card -->
            <div class="card shadow-lg h-100 " style="margin-top: 10px;">
                <!-- begin::body -->
                <div class="card-body d-flex-center flex-column" >
                    <div class="row" >
                        <div class="col-12" >
                        <div class="symbol symbol-75px symbol-card mb-2 " style="padding-left: 30%;" >
                        <img src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '" alt="" style=" padding-lef:40%">
                        <div class="bg-succes position-absolute  rounded-circle translate-middle start-100 top-100 border-4 border-bo "></div>
                        </div>
                     <!-- end::avatar -->
                        </div>
     
                        <div class="col-12" >
                            <div class="fw-semibold text-gray-900 fs-1  text-center">' .$data["prenom"].' '. $data["nom"] . '</div>
                        </div>

                        <div class="col-12 justify-content-center">
                            <table class="mb-5 align-items-center  m-auto mt-2 mx-5px">
                
                                <tr>
                                    <td  class="fw-semibold text-gray-400  text-start">Adresse :&nbsp </td>
                                    <td class="text-stard"> '.$data['adresse'] . '</td>
                                </tr>

                                <tr>
                                    <td  class="fw-semibold text-gray-400  text-start">Phone :&nbsp </td>
                                    <td class="text-stard">'.$data['tel'] . '</td>
                                </tr>

                                <tr>
                                    <td  class="fw-semibold text-gray-400  text-start">Membres :&nbsp </td>
                                    <td class="text-stard"> '.$statut . '</td>
                                </tr>
                            </table>
                        </div>

                      
                    </div>


                </div>
                
                <div class="card-footer">
                   
                <div class="row">
                <div class="col-12">
                        <div class="menu-item px-2">
                        <table>
                        <tr>
                        <td class="text-stard"> '.$compte_btn. '</td>
                        </tr>

                        
                        </table>
                           
                        </div>
                       
                </div>
                </div>
        </div>
                   
            </div>

          
        </div> ';


        }
    }
    ?>

</div> <!--end::Table-->

<script>
     function   updatebackground(photo){
    $("#imgbackground").css("background-image", "url("+photo+")");
    
    }
</script>