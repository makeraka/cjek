<?php
// die(var_dump($_POST));
if (is_array($listeBanner) && sizeof($listeBanner) > 0) {
    foreach ($listeBanner as $key => $data) {
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
                <td>' . $data["titre"] . '</td>
                <td>' . $data["sous_titre"] . '</td>
                <td>
                <a href="javascript:;" Class="btn btn-circle btn-primary " onClick="updatebackground(\''.yii::$app->request->baseUrl . '/web/assets/media/uploads/photo/' . $data['photo'] .'\');$(\'#action_key\').val(\'' . md5('produit_banner') . '\');$(\'#avatar_remove\').val(\'' .$data['photo']. '\');$(\'#productBanNameUpdate\').val(\'' . $data["libelle"] . '\'); $(\'#productBanTitreUpdate\').val(\'' . ($data["titre"]) . '\');$(\'#productBanStitreUpdate\').val(\'' . $data["sous_titre"] . '\');$(\'#statutBanUpdate\').val(\'' . $data["statut"] . '\'); $(\'.action_on_this\').val(\'' . $data["code"] . '\'); $(\'#updateProductBan\').modal(\'show\');"><i class="fa fa-indent"></i>&nbsp;' . Yii::t("app", "edit") . '</a>
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