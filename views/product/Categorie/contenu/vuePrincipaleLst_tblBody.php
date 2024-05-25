<?php
// die(var_dump($_POST));
if (is_array($listeCategorie) && sizeof($listeCategorie) > 0) {
    foreach ($listeCategorie as $key => $data) {
        $key2 = $key + 1;
        echo '
            <tr>
                <td>' . $key2 . '</td>
                <td>
                <div class="symbol symbol-65px symbol-circle mb-2 ">
                    <img src="' . yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] . '" alt="" style=" padding-lef:40%">
                    <div class="bg-succes position-absolute  rounded-circle translate-middle start-100 top-100 border-4 border-bo"></div>
                    
                </div>
                </td>
                <td>' . $data["libelle"] . '</td>
                <td>' . $data["description"] . '</td>
                <td>
                <a href="javascript:;" Class="btn btn-circle btn-primary " onClick="updatebackground(\''.yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] .'\');$(\'#action_key\').val(\'' . md5('catalog_updateCat') . '\');$(\'#avatar_remove\').val(\'' .$data['photo']. '\');$(\'#productCatNameUpdate\').val(\'' . $data["libelle"] . '\'); $(\'#productCatDescUpdate\').val(\'' . ($data["description"]) . '\'); $(\'#statutCatUpdate\').val(\'' . $data["statut"] . '\'); $(\'.action_on_this\').val(\''.$data["code"].'\'); $(\'#updateProductCategory\').modal(\'show\');"><i class="fa fa-indent"></i>' . Yii::t("app", "edit") . '</a>
                </td>
            </tr>
            ';
    }
}
?>



<script>
 function   updatebackground(photo){
    $("#imgbackground").css("background-image", "url("+photo+")");
    
    }
</script>