<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>

<script>

    // script d'ajout d'une catégorie
    function add() {
    
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);
        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['productCatNames'];
        var search = window.location.search;
        var formValidation = false;
        button.setAttribute("data-kt-indicator", "on");
        //--- @ --- Validation champs du formulaire ---- @ ---//
        formValidation = formValidator(index, requiredField);
        if (formValidation !== true) {
            button.removeAttribute("data-kt-indicator");
            $("#btnadd").prop("disabled", false);
            return false;
        }
        //**********************************verification de l'unicité du nom de catégorie************************
        var productCatNames = document.getElementById('productCatNames').value;
        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                productCatNames: productCatNames,
                action_key: '<?= md5(strtolower('uniciteCat')) ?>'
            },
            function (response) {
                // console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "libexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addcategorie') ?>");
                    $('#kt_productCats').submit();
                   

                }

            }
        );
    }


    function productCategorie_update(){
        // alert('dd');

      
		var button = document.querySelector("#updateproduitup");
		$('#updateproduitup').prop('disabled', true);

		var index = 1;
		var requiredField = ['productCatNameUpdate'];

		var search = window.location.search;

		var formValidation = false;
		button.setAttribute("data-kt-indicator", "on");

		//--- @ --- Validation champs du formulaire ---- @ ---//
		formValidation = formValidator(index, requiredField);
		if (formValidation !== true) {
			button.removeAttribute("data-kt-indicator");
			$('#updateproduitup').prop('disabled', false);

			return false;
		}
		$('.action_key').val("<?= md5('updateCategorie') ?>");
		$('#CategorieUpdate').submit();
    }

</script>