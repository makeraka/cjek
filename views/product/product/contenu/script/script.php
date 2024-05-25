<?php
$csrf = Yii::$app->request->getCsrfToken();
$url = Yii::$app->request->baseUrl . "/" . md5("achat_ajax");

?>

<script>

   
    function submit() {
        // alert('salut');

        var button = document.querySelector("#kt_ecommerce_add_product_submit");

        //--- @ --- Initialiser variables ---- @ ---//
        const form = document.getElementById('nProduitForm');

        var index = 1;
        var requiredField = ['productName',];

        var search = window.location.search;    

        var formValidation = false;
        button.setAttribute("data-kt-indicator", "on");

        //--- @ --- Validation champs du formulaire ---- @ ---//
        formValidation = formValidator(index, requiredField);
        if (formValidation !== true) {
            button.removeAttribute("data-kt-indicator");

            return false;
        }

        form.submit();

    }

    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

   
    function productCategorie_np() {
        var button = document.querySelector("#addproduit");

        //--- @ --- Initialiser variables ---- @ ---//

        var index = 1;
        var requiredField = ['productCatNames'];

        var search = window.location.search;

        var formValidation = false;
        button.setAttribute("data-kt-indicator", "on");

        //--- @ --- Validation champs du formulaire ---- @ ---//
        formValidation = formValidator(index, requiredField);
        if (formValidation !== true) {
            button.removeAttribute("data-kt-indicator");

            return false;
        }

        var productCatNames = document.getElementById('productCatNames').value;
        var productCatDescs = document.getElementById('productCatDescs').value;


        $.post(
            '<?= Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle") ?>',

            { _csrf: '<?= $csrf ?>', productCatNames: productCatNames, action_key: '<?= md5(strtolower('uniciteCat')) ?>' },
            function (response) {

                if (response) {


                    $.post(
                        '<?= Yii::$app->request->baseUrl . "/" . md5("catalog_cats") ?>',

                        { _csrf: '<?= $csrf ?>', productCatNames: productCatNames, productCatDescs: productCatDescs, action_key: '<?= md5(strtolower('addcatajax')) ?>' },
                        function (response) {
                            console.log(response);
                            $('#productCategory').html(response);
                            $('#newProductCategory').modal('hide');

                        });
                    button.removeAttribute("data-kt-indicator");


                } else {
                    $('#mainErreurMsg').text('<?= Yii::t("app", "Le Libelle ccategorie existe deja") ?>');
                    $('#miraEmptyMsgPopUp').modal({ backdrop: 'static' });
                    $('#miraEmptyMsgPopUp').modal('show');
                }

            }
        );

        setTimeout(function () {
            button.removeAttribute("data-kt-indicator");
        }, 3000);

    }


</script>