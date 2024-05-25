<?php
$csrf = Yii::$app->request->getCsrfToken();
$url = Yii::$app->request->baseUrl . "/" . md5("achat_ajax");

?>

<script>
    $(document).ready(function () {
       
    var input1 = document.querySelector("#kt_tagify_1");
        new Tagify(input1);
       
        type = $('#type').val();
       
        if (type == '2') {
            $('#dateexp').html("<label class='col-sm-4 form-label '>Date Expiration :</label> <input type='date' min='<?= date('Y-m-d') ?>' value='<?= (isset($produitDtls['dateexp'])) ? $produitDtls['dateexp'] : Null ?>'   class='form-control' name='dateexp' id='dateexp'  autocomplete='off' /><span class='input-group-addon hidden-md hidden-lg'></span>");
            $('#qte').html('<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced" aria-selected="false" role="tab" tabindex="-1">STOCK</a>');
        } else if (type == '1') {
            $('#qte').html('');
            $('#dateexp').html('');
        }

    });

    function submit() {
        alert('salut');

        var button = document.querySelector("#kt_ecommerce_add_product_submit");

        //--- @ --- Initialiser variables ---- @ ---//
        const form = document.getElementById('nProduitForm');

        var index = 1;
        var requiredField = ['productCategory', 'nom', 'productName', 'type',
            'kt_ecommerce_add_product_description', 'productPrixVente'];


        type = $('#type').val();

        if (type == '2') {
            requiredField = ['productCategory', 'nom', 'productName', 'type',
                'productPrixVente', 'productPrixAchat', 'prodcutQte', 'udm'];
        } else if (type == '1') {
            requiredField = ['productCategory', 'nom', 'productName', 'type',
                'productPrixVente'];
        }
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

    function verifiedate() {
        selectedDate = $('#datp').val();
        var minDate = '<?= date('Y-m-d')?>'; // Date minimale (aujourd'hui)

        // alert(minDate);
        // var selectedDate = new Date(this.value);

        if (selectedDate < minDate) {
            alert("La date sélectionnée est antérieure à la date minimale.");
            $('#datp').val(''); // Effacer la date
        }
    }
    function selecttype() {
        type = $('#type').val();

        if (type == '2') {
            $('#dateexp').html("<label class='col-sm-4 form-label '>Date Expiration :</label> <input type='date' min='<?= date('Y-m-d') ?>' value='<?= (isset($produitDtls['dateexp'])) ? $produitDtls['dateexp'] : Null ?>'   class='form-control' name='dateexp' onchange='verifiedate()' id='datp'  autocomplete='off' /><span class='input-group-addon hidden-md hidden-lg'></span>");
            $('#qte').html('<a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced" aria-selected="false" role="tab" tabindex="-1">STOCK</a>');
        } else if (type == '1') {
            $('#qte').html('');
            $('#dateexp').html('');
        }

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

    function selecfournisseurs() {
        fourn = $('#fournisseurs').val();

        $.post(
            '<?= $url ?>',

            {
                _csrf: '<?= $csrf ?>',
                fourn: fourn,
                action_key: '<?= md5('3') ?>'
            },
            function (response) {
                console.log(response);

            }
        );
        // alert(client);
    }

    //ajouter un client
    function submitadduser() {
        var button = document.querySelector("#kt_modal_add_customer_submit");

        //--- @ --- Initialiser variables ---- @ ---//

        var index = 1;
        var requiredField = ['rsociale', 'Tel'];

        var search = window.location.search;
        var formValidation = false;
        button.setAttribute("data-kt-indicator", "on");

        //--- @ --- Validation champs du formulaire ---- @ ---//
        formValidation = formValidator(index, requiredField);
        if (formValidation !== true) {
            button.removeAttribute("data-kt-indicator");

            return false;
        }
        tel = $('#Tel').val();
        rsociale = $('#rsociale').val();
        email = $('#email').val();
        adresse = $('#Adresse').val();
        $.post(
            '<?= Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle") ?>',

            {
                _csrf: '<?= $csrf ?>',
                tel: tel,
                email: email,
                rsociale: rsociale,
                action_key: '<?= md5(strtolower('unifournissuer')) ?>'
            },
            function (response) {
                if (response) {


                    $.post(
                        '<?= $url ?>',

                        {
                            _csrf: '<?= $csrf ?>',
                            Tel: tel,
                            email: email,
                            rsociale: rsociale,
                            adresse: adresse,
                            action_key: '<?= md5('2') ?>'
                        },
                        function (response) {

                            $('#kt_modal_add_customer_cancel').click();
                            $('#fournisseurs').html(response);
                            selecfournisseurs();

                        });






                } else {
                    $('#mainErreurMsg').text('<?= Yii::t("app", "fourisseuexiste") ?>');
                    $('#miraEmptyMsgPopUp').modal({
                        backdrop: 'static'
                    });
                    $('#miraEmptyMsgPopUp').modal('show');
                }

            }
        );

        setTimeout(function () {
            button.removeAttribute("data-kt-indicator");
            return;
        }, 3000);

    }


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




    function productUdm_np() {
        var button = document.querySelector("#addproduitudm");

        //--- @ --- Initialiser variables ---- @ ---//
        const form = document.getElementById('formaddudm');

        var index = 1;
        var requiredField = ['productUdmNa'];

        var search = window.location.search;

        var formValidation = false;
        button.setAttribute("data-kt-indicator", "on");

        //--- @ --- Validation champs du formulaire ---- @ ---//
        formValidation = formValidator(index, requiredField);
        if (formValidation !== true) {
            button.removeAttribute("data-kt-indicator");

            return false;
        }


        var value = document.getElementById('productUdmNa').value;
        var desc = document.getElementById('productUdmDe').value;


        $.post(
            '<?= Yii::$app->request->baseUrl . "/" . md5("visiteur_unicitelibelle") ?>',

            {
                _csrf: '<?= $csrf ?>',
                productUdmNames: value,
                action_key: '<?= md5(strtolower('uniciteUdmst')) ?>'
            },
            function (response) {

                if (response) {
                    //  \.submit();
                    // alert(desc);

                    $.post(
                        '<?= Yii::$app->request->baseUrl . "/" . md5("catalog_udms") ?>',

                        { _csrf: '<?= $csrf ?>', nom: value, desc: desc, action_key: '<?= md5(strtolower('addajax')) ?>' },
                        function (response) {
                            console.log(response);
                            $('#udm').html(response);
                            $('#newProductUdm').modal('hide');

                        });



                    console.log(response);
                    button.removeAttribute("data-kt-indicator");


                } else {
                    $('#mainErreurMsg').text('<?= Yii::t("app", "Le Libelle  existe deja") ?>');
                    $('#miraEmptyMsgPopUp').modal({
                        backdrop: 'static'
                    });
                    $('#miraEmptyMsgPopUp').modal('show');
                }

            }
        );

        setTimeout(function () {
            button.removeAttribute("data-kt-indicator");
        }, 3000);

    }

</script>