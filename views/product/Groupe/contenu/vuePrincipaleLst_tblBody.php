<?php
// die(var_dump($_POST));
if (is_array($listeGroupe) && sizeof($listeGroupe) > 0) {
    foreach ($listeGroupe as $key => $data) {
        // die(var_dump($data['code']));
        $key2 = $key + 1;
        echo '
            <tr>
                <td>' . $key2 . '</td>
                <td>' . $data["libelle"] . '</td>
                <td>' . $data["description"] . '</td>
                <td>
                <a href="javascript:;" Class="btn btn-circle btn-primary " onClick="$(\'#action_key\').val(\'' . md5('produit_groupe') . '\');$(\'#productGrpNameUpdate\').val(\'' . $data["libelle"] . '\'); $(\'#productGrpDescUpdate\').val(\'' . ($data["description"]) . '\'); $(\'#statutCatUpdate\').val(\'' . $data["statut"] . '\'); $(\'.action_on_this\').val(\''.$data["code"].'\'); $(\'#updateProductGroupe\').modal(\'show\');"><i class="fa fa-indent"></i>&nbsp;' . Yii::t("app", "edit") . '</a>
                </td>
            </tr>
            ';
    }
}
?>