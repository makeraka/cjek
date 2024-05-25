<?php
// die(var_dump($_POST));
if (is_array($listeRef) && sizeof($listeRef) > 0) {
    foreach ($listeRef as $key => $data) {
        $key2 = $key + 1;
        echo '
            <tr>
                <td>' . $key2 . '</td>
                <td>' . $data["libelle"] . '</td>
                <td>' . $data["description"] . '</td>
                <td>
                <a href="javascript:;" Class="btn btn-circle btn-primary " onClick="$(\'#action_key\').val(\'' . md5('produit_reference') . '\');$(\'#productRefNameUpdate\').val(\'' . $data["libelle"] . '\'); $(\'#productRefDescUpdate\').val(\'' . ($data["description"]) . '\'); $(\'#statutRefUpdate\').val(\'' . $data["statut"] . '\'); $(\'.action_on_this\').val(\'' . $data["code"] . '\'); $(\'#updateProductRef\').modal(\'show\');"><i class="fa fa-indent"></i>&nbsp;' . Yii::t("app", "edit") . '</a>
                </td>
            </tr>
            ';
    }
}
?>