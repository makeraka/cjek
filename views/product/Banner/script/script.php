<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>


<script>
    function add(){
         alert('ddd');

         // recuperation de l'id du bouton
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);

        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['productBanNames','productBanTitre','productBanSousTitre'];

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

        var productBanNames = document.getElementById('productBanNames').value;

        //  alert(productBanNames);

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                productBanNames: productBanNames,
                action_key: '<?= md5(strtolower('uniciteBanner')) ?>'
            },
            function (response) {
                 console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "libexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addBanner') ?>");
                    $('#kt_productBan').submit();
                   

                }

            }
        );
    }

    
        //*************************************** */ mofidification du Ref ******************************

    function productRef_update(){
        // alert('fff');
        var button = document.querySelector("#updateproduitup");
		$('#updateproduitup').prop('disabled', true);

		var index = 1;
		var requiredField = ['productBanNameUpdate'];

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
		$('.action_key').val("<?= md5('updateBanner') ?>");
		$('#BanUpdate').submit();
     }
</script>