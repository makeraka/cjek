<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

class ProduitController extends Controller
{
    private $pg = Null;
    private $msg = Null;


    public function actionProduct()
    {
        if (Yii::$app->request->isPost) {
            $request = $_POST;
            $params = Yii::$app->params;


            switch ($_POST['action_key']) {

            }
        }

        $listeproduct = Yii::$app->productClass->listeproduct();

        return $this->render('/product/product/product.php', ['listeproduct' => $listeproduct]);


    }



    public function actionProductupdate()
    {
        $produitDtls = null;


    if (yii::$app->request->isPost) {

      $request = $_POST;
      $params = Yii::$app->params;

      if ($_POST['action_key'] == md5('updateproduit')) {
         die(var_dump($_POST));
        $photo = $_POST['avatar_remove'];
        if ($_POST['photo'] != null) {
          $uploadFile = $_POST['photo'];
          $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
          // yii::$app->request->baseUrl. '/web/mainAssets/media/auth/bg/auth-bg.png'
          $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
          if ($file_uni_name != null) {
            $photo = $file_uni_name;
          }
        }
        $stmt = Yii::$app->catalogClass->updateProduct($_POST['action_on_this'], $request['type'], $request[Yii::$app->params['productName']], $request[Yii::$app->params['productCategory']], $request[Yii::$app->params['group']], $request[Yii::$app->params['productPrixAchat']], $request[Yii::$app->params['productPrixVente']], $photo);

        $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
        Yii::$app->session->setFlash('flashmsg', $notification);
        return $this->redirect(Yii::$app->request->referrer);
      }
    
    }



        
        if (Yii::$app->request->isGet) {
            $request = $_GET;
            $code = $_GET['code'];

            $produitDtls = Yii::$app->productClass->listeproductupdate($code);
        }

        
        $productCategories = Yii::$app->productClass->listeCategorie();
        $listeGroupe = Yii::$app->productClass->listeGroupe();
        $listeRef = Yii::$app->productClass->listeRef();
        $listeproduct = Yii::$app->productClass->listeproduct();

       

        return $this->render('/product/product/contenu/vuePrincipaleUpdateInModal.php',['productCategories' => $productCategories,'produitDtls' => $produitDtls, 'listeGroupe' => $listeGroupe, 'listeRef' => $listeRef, 'listeproduct' => $listeproduct]);


    }

    public function actionProductadd()
    {
        if (Yii::$app->request->isPost) {
            $request = $_POST;
            $params = Yii::$app->params;
            // *die(var_dump($_POST));
            switch ($_POST['action_key']) {

            }


            if (!empty($request[$params['productName']]) && !empty($request[$params['productCategory']])) {
                #LETS FINDOUT MORE ABOUT THE STATUT OF THE PRODUCT

                # PREPARATION DE L'IMAGE
                $photo = $_POST['avatar_remove'];
                if ($_POST['photo'] != null) {
                    $uploadFile = $_POST['photo'];
                    $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                    // yii::$app->request->baseUrl. '/web/mainAssets/media/auth/bg/auth-bg.png'
                    $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                    if ($file_uni_name != null) {
                        $photo = $file_uni_name;
                    }
                }
                # SAVING BASIC DATA
                $connect = \Yii::$app->db;
                $code = $codeproduit = Yii::$app->nonSqlClass->generateUniq();
                $mocles = "";

                $dateajout = (!empty($_POST['dateajout']) ? $_POST['dateajout'] : null);

                $addproduct = Yii::$app->productClass->addproduct($_POST['productName'], $_POST['productPrixVente'], $_POST['description'], $photo, $dateajout, $_POST['motscles'], $code, $_POST['productGroup'], $_POST['productCategory']);

                // die(var_dump($addproduct));
                if (sizeof($_POST['kt_docs_repeater_basic']) > 0) {
                    foreach ($_POST['kt_docs_repeater_basic'] as $key => $value) {
                        $codelien = Yii::$app->nonSqlClass->generateUniq();

                        Yii::$app->productClass->addrefproduit($codelien, $code, $value['reference'], $value['contenue']);
                    }
                }

                $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                Yii::$app->session->setFlash('flashmsg', $notification);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        $listeCategorie = Yii::$app->productClass->listeCategorie();
        $listeGroupe = Yii::$app->productClass->listeGroupe();
        $listeRef = Yii::$app->productClass->listeRef();
        $listeproduct = Yii::$app->productClass->listeproduct();
        //  die(var_dump($listeCategorie));

        return $this->render('/product/product/contenu/modalAddAction.php', ['listeCategorie' => $listeCategorie, 'listeGroupe' => $listeGroupe, 'listeRef' => $listeRef, 'listeproduct' => $listeproduct]);



    }



    /*********************************************************************************************
     *                              FONCTION DE LA CATEGORIE
     * *******************************************************************************************
     */
    public function actionCategories()
    {

        if (Yii::$app->request->isPost) {
            $request = $_POST;
            switch ($_POST['action_key']) {
                case md5('addcategorie'):

                    $photo = $_POST['avatar_remove'];
                    if ($_POST['photo'] != null) {
                        $uploadFile = $_POST['photo'];
                        $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                        $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                        if ($file_uni_name != null) {
                            $photo = $file_uni_name;
                        }
                    }
                    $code = Yii::$app->nonSqlClass->generateUniq();
                    $libelle = $_POST['productCatNames'];
                    $desc = $_POST['description'];

                    $reqAddCategorie = Yii::$app->productClass->addCategorie($code, $libelle, $desc, $photo);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                case md5('updateCategorie'):
                //  die(var_dump($_POST));

                    $photo = $_POST['avatar_removeupdate'];
                    if ($_POST['updatephoto'] != null) {
                        $uploadFile = $_POST['updatephoto'];
                        $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                        // yii::$app->request->baseUrl. '/web/mainAssets/media/auth/bg/auth-bg.png'
                        $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                        if ($file_uni_name != null) {
                            $photo = $file_uni_name;
                        }
                    }

                    
                    // Enregistre les modifications effectuees
                    $code  = $_POST['action_on_this'];
                    // die(var_dump($code));
                    $libelle  = $_POST['productCatNameUpdate'];
                    $desc = $_POST['productCatDescUpdate'];
                    $statut  = $_POST['statutCatUpdate'];
                    

                    $modifiercategorie = yii::$app->productClass->updateCategorie($libelle,$desc,$statut, $photo,$code);

                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['information'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

            }
        }

        $listeCategorie = Yii::$app->productClass->listeCategorie();

        // die(var_dump($listeCategorie));

        return $this->render('/product/Categorie/vueprincipale.php', ['listeCategorie' => $listeCategorie]);
    }



    /*********************************************************************************************
     *                              FONCTION DU GROUPE
     * *******************************************************************************************
     */

    public function actionGroupe()
    {

        if (Yii::$app->request->isPost) {
            $request = $_POST;
            switch ($_POST['action_key']) {

                // *********************************case d'ajout d'un groupe *****************************
                case md5('addgroupe'):
                    // die(var_dump($_POST));
                    $code = Yii::$app->nonSqlClass->generateUniq();
                    $libelle = $_POST['productGrpNames'];
                    $desc = $_POST['description'];

                    $reqAddGroup = Yii::$app->productClass->addGroupe($code, $libelle, $desc);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;

                //********************************case de modifier un groupe */
                case md5('updateGroupe'):
                    // die(var_dump($_POST));
                    $code = $_POST['action_on_this'];
                    //  die(var_dump($code));

                    $libelle = $_POST['productGrpNameUpdate'];
                    $desc = $_POST['productGrpDescUpdate'];
                    $statut = $_POST['statutGrpUpdate'];

                    //  die(var_dump($statut));


                    $reqUpdateGroup = Yii::$app->productClass->updateProductgroup($libelle, $desc, $statut, $code);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                // filtrer un groupe
                case md5('Filtre_groupe'):

                    $donneeRecherche = (isset($request[Yii::$app->params['donneeRecherche']])) ? $_POST[Yii::$app->params['donneeRecherche']] : '';

                    $limit = (isset($request[Yii::$app->params['limit']])) ? $_POST[Yii::$app->params['limit']] : 1;

                    $listeGroupe = yii::$app->productClass->searchgroupe($_POST['donneeRecherche'], $limit);
                    // die(var_dump($filtregroupe));

                    return $this->render('/product/Groupe/vueprincipal.php', ['listeGroupe' => $listeGroupe, 'donneeRecherche' => $donneeRecherche, 'limit' => $limit]);
                    break;




            }
        }

        $listeGroupe = Yii::$app->productClass->listeGroupe();

        return $this->render('/product/Groupe/vueprincipal.php', ['listeGroupe' => $listeGroupe]);

    }



    /*********************************************************************************************
     *                              FONCTION DE LA REFERENCE
     * *******************************************************************************************
     */
    public function actionReference()
    {

        if (Yii::$app->request->isPost) {
            $request = $_POST;
            switch ($_POST['action_key']) {

                // *********************************case d'ajout d'une reference *****************************
                case md5('addRef'):
                    //  die(var_dump($_POST));
                    $code = Yii::$app->nonSqlClass->generateUniq();
                    $libelle = $_POST['productRefNames'];
                    $desc = $_POST['description'];

                    $reqAddRef = Yii::$app->productClass->addRef($code, $libelle, $desc);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;

                //********************************case de modifier une Reférence*****************/
                case md5('updateRef'):
                    //  die(var_dump($_POST));
                    $code = $_POST['action_on_this'];
                    //  die(var_dump($code));

                    $libelle = $_POST['productRefNameUpdate'];
                    $desc = $_POST['productRefDescUpdate'];
                    $statut = $_POST['statutRefUpdate'];

                    $reqUpdateRef = Yii::$app->productClass->updateProductref($libelle, $desc, $statut, $code);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

            }
        }

        $listeRef = Yii::$app->productClass->listeRef();

        return $this->render('/product/reference/vueprincipal.php', ['listeRef' => $listeRef]);

    }


    /*********************************************************************************************
     *                              FONCTION DU BANNER
     * *******************************************************************************************
     */

    public function actionBanner()
    {

        if (Yii::$app->request->isPost) {
            $request = $_POST;
            switch ($_POST['action_key']) {

                // *********************************case d'ajout d'une banner *****************************
                case md5('addBanner'):
                    //  die(var_dump($_POST));
                    $photo = $_POST['avatar_remove'];
                    if ($_POST['photo'] != null) {
                        $uploadFile = $_POST['photo'];
                        $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                        $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                        if ($file_uni_name != null) {
                            $photo = $file_uni_name;
                        }
                    }
                    $code = Yii::$app->nonSqlClass->generateUniq();
                    $libelle = $_POST['productBanNames'];
                    $titre = $_POST['productBanTitre'];
                    $soustitre = $_POST['productBanSousTitre'];

                    $reqAddBanner = Yii::$app->productClass->addBanner($code, $libelle, $titre, $soustitre, $photo);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);

                    break;

                //********************************case de modifier une banner */
                case md5('updateBanner'):
                    //  die(var_dump($_POST));
                    $code = $_POST['action_on_this'];
                    //  die(var_dump($code));
                    $photo = $_POST['avatar_removeupdate'];
                    if ($_POST['updatephoto'] != null) {
                        $uploadFile = $_POST['updatephoto'];
                        $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                        // yii::$app->request->baseUrl. '/web/mainAssets/media/auth/bg/auth-bg.png'
                        $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                        if ($file_uni_name != null) {
                            $photo = $file_uni_name;
                        }
                    }
                    $libelle = $_POST['productBanNameUpdate'];
                    $titre = $_POST['productBanTitreUpdate'];
                    $soustitre = $_POST['productBanStitreUpdate'];

                    $statut = $_POST['statutBanUpdate'];

                    //  die(var_dump($statut));


                    $reqUpdateBanner = Yii::$app->productClass->updateProductbanner($libelle, $titre, $soustitre, $photo,  $statut, $code);
                    // die(var_dump($reqUpdateBanner));
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                // filtrer un groupe
                case md5('Filtre_Banner'):

                    $donneeRecherche = (isset($request[Yii::$app->params['donneeRecherche']])) ? $_POST[Yii::$app->params['donneeRecherche']] : '';

                    $limit = (isset($request[Yii::$app->params['limit']])) ? $_POST[Yii::$app->params['limit']] : 1;

                    $listeBanner = yii::$app->productClass->searchgroupe($_POST['donneeRecherche'], $limit);
                    // die(var_dump($filtregroupe));

                    return $this->render('/product/Banner/vueprincipal.php', ['listeBanner' => $listeBanner, 'donneeRecherche' => $donneeRecherche, 'limit' => $limit]);
                    break;




            }
        }

        $listeBanner = Yii::$app->productClass->listeBanner();

        return $this->render('/product/Banner/vueprincipal.php', ['listeBanner' => $listeBanner]);

    }

}