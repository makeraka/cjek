<?php

$url = Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle");
$csrf = Yii::$app->request->getCsrfToken();
// $caseValue = md5(strtolower('uniciteCat'));


?>


<script>



document.getElementById('kt_client').addEventListener('submit', function (event) {
    event.preventDefault();
  });


    function add(){
         alert('ddd');

         // recuperation de l'id du bouton
        var button = document.querySelector("#btnadd");
        $("#btnadd").prop("disabled", true);

        //--- @ --- Initialiser variables et verification si les champs exisés sont remplie ---- @ ---//
        var index = 1;
        var requiredField = ['nom','prenom','email','tel','sexe'];

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


        
        //**********************************verification de l'unicité du membre ************************

        var email = document.getElementById('email').value;

          alert(email);

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                email: email,
                action_key: '<?= md5(strtolower('uniciteMembre')) ?>'
            },
            function (response) {
                 console.log(response);
                if (response) {
                    message('<?= Yii::t("app", "adressemailexiste") ?>', 'error');
                    button.removeAttribute("data-kt-indicator");
                    $("#btnadd").prop("disabled", false);
                   
                } else {

                    $('#action_key').val("<?= md5('addMembre') ?>");
                    $('#kt_client').submit();
                   

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