<div class="row mt-10">
    <?php
     $csrf = Yii::$app->request->getCsrfToken();
     $url = Yii::$app->request->baseUrl."/".md5("activite_ajax");

    // die(var_dump($_POST));
    if (is_array($listeActivites) && sizeof($listeActivites) > 0) {
        foreach ($listeActivites as $key => $data) {

            $key2 = $key + 1;

            $detailbtn = '<a href="javascript:;"  class="menu-link px-3 badge badge-primary" onclick="document.getElementById(\'action_key\').value=\'' . md5(strtolower("detailvente")) . '\'; document.getElementById(\'action_on_this\').value=\'' .$data["code"] . '\'; details(' . $data['id'] . ');"  data-bs-toggle="modal" data-bs-target="#modalId">Détail</a> ';

            if (isset($data['etat']) && $data['etat'] == 1) {
                $statut = '<a href="javascript:;" Class="badge badge-light-success" >Terminer</a>';
            } else if (isset($data['etat']) && $data['etat'] == 2){
                $statut = '<span class="badge badge-light-primary">En cours</span>';
            }

            else{
                $statut = '<span class="badge badge-warning"></span>';

            }

            echo '
        <div class="col-md-4 mb-4 ">
        <div class="card shadow">
            <img  src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '" class="card-img-top" style="width: 100%;
            height: 200px;">
            <div class="card-body text-center">
                <h5 class="card-title">' . $data['nom'] . '</h5>
                
                <span class="fw-bold me-auto px-4 py-3">' . $statut. '</span>
                
                <a href="#" class="badge badge-primary">'.$detailbtn.'</a>
            </div>
        </div>
    </div>
        ';
        }
    }
    ?>
</div>

<div class=" modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content  h-100 scroll-y">
            <div class="modal-header bg-primary">
                <h2 class="modal-title text-white" id="modalTitleId">Details Activités</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="content"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                    <?= Yii::t('app', 'btnRetour') ?>
                </button>
            </div>
        </div>
    </div>
</div>




<script>


function details(id) {
    // alert('dd');
   
   info =$('#action_on_this').val();

   $.post(
       '<?= $url ?>',

       {
           _csrf: '<?= $csrf ?>',
           info: info,
           action_key: '<?=md5(strtolower('detailmembre')) ?>'
       },
       function(response) {

           if (response) {
               $('#content').html(response);
           }

       }
   );
}

    function updatebackground(photo) {
        $("#imgbackground").css("background-image", "url(" + photo + ")");

    }
</script>