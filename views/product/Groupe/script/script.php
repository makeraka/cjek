<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>


<script>
    function add(){
        //  alert('ddd');

         // recuperation de l'id du bouton
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);

        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['productGrpNames'];
    

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


        
        //**********************************verification de l'unicité du nom de groupe ************************

        var productGrpNames = document.getElementById('productGrpNames').value;


        //  alert(productGrpNames);
        var productCatDescs = document.getElementById('description').value;

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                productGrpNames: productGrpNames,
                action_key: '<?= md5(strtolower('uniciteGrp')) ?>'
            },
            function (response) {
                console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "libexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addgroupe') ?>");
                    $('#kt_productGrp').submit();
                   

                }

            }
        );

    }

      //*************************************** */ mofidification du groupe ******************************
    function productGroupe_update(){

        var button = document.querySelector("#updateproduitup");
		$('#updateproduitup').prop('disabled', true);

		var index = 1;
		var requiredField = ['productGrpNameUpdate'];

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
        
		$('.action_key').val("<?= md5('updateGroupe') ?>");
		$('#GroupeUpdate').submit();
     }

       //*************************************** Filtrer un produit  ******************************
       
       function Filter()
       {

         $('#action_key').val("<?= md5('Filtre_groupe')?>");
         $('#kt_filtre').submit();


       }



</script>