<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>


<script>

    // scripte qui permet d'eviter l' auto submit
    
    document.getElementById('kt_productBan').addEventListener('submit', function (event) {
        event.preventDefault();
    });



    function add(){
       

         // recuperation de l'id du bouton
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);

        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['nom','lieu','dateact'];
      
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

        var nom = document.getElementById('nom').value;

        //  alert(productBanNames);

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                nom: nom,
                action_key: '<?= md5(strtolower('uniciteActivite')) ?>'
            },
            function (response) {
                 console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "libexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addActivite') ?>");
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