<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>


<script>
    function add(){
        // alert('ddd');

         // recuperation de l'id du bouton
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);

        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['productRefNames'];

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


        
        //**********************************verification de l'unicité du nom de Ref ************************

        var productRefNames = document.getElementById('productRefNames').value;

        // alert(productGrpNames);
        var productCatDescs = document.getElementById('description').value;

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                productRefNames: productRefNames,
                action_key: '<?= md5(strtolower('uniref')) ?>'
            },
            function (response) {
                // console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "libexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addRef') ?>");
                    $('#kt_productRef').submit();
                   

                }

            }
        );
    }

    
        //*************************************** */ mofidification du Ref ******************************

    function productRef_update(){
        var button = document.querySelector("#updateproduitup");
		$('#updateproduitup').prop('disabled', true);

		var index = 1;
		var requiredField = ['productRefNameUpdate'];

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
        
		$('.action_key').val("<?= md5('updateRef') ?>");
		$('#RefUpdate').submit();
     }
</script>