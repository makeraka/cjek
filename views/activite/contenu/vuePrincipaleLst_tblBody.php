<div class="row mt-10">
    <?php
    // die(var_dump($_POST));
    if (is_array($listeActivites) && sizeof($listeActivites) > 0) {
        foreach ($listeActivites as $key => $data) {

            $key2 = $key + 1;

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
        <div class="card shadow-lg">
            <img  src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '" class="card-img-top" style="width: 100%;
            height: 200px;">
            <div class="card-body text-center">
                <h5 class="card-title">' . $data['nom'] . '</h5>
                
                <span class="fw-bold me-auto px-4 py-3">' . $statut. '</span>
                
                <a href="#" class="badge badge-primary">Détail</a>
            </div>
        </div>
    </div>
        ';
        }
    }
    ?>
</div>



<script>
    function updatebackground(photo) {
        $("#imgbackground").css("background-image", "url(" + photo + ")");

    }
</script>