<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

class MembreController extends Controller
{


    //*********************************************** fonction du traitement des membres********************************************/
    public function actionMembre()
    {
        if (Yii::$app->request->isPost) {
            $request = $_POST;
            $params = Yii::$app->params;
            // die(var_dump($_POST));
            switch ($_POST['action_key']) {

                case md5('addMembre'):

                    // die(var_dump($_POST));
                    
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
                    // die(var_dump($code));

                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $email = $_POST['email'];
                    $sexe = $_POST['sexe'];
                    $tel = $_POST['tel'];
                    $adresse = $_POST['adresse'];

                    Yii::$app->membreClass->addMembres($code, $nom, $prenom,$email,$sexe,$tel,$adresse,$photo);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                break;

                case md5('selectMembre') :
                    die(var_dump($_POST));
                    break;


            }
        }
        $listeMembres = Yii::$app->membreClass->listeMembres();

        return $this->render('/membre/vueprincipal.php',['listeMembres' => $listeMembres]);
    }


    //*********************************************** fonction du traitement du profil des membres********************************************/

    public function actionProfil(){
        // die('ok');
        if (yii::$app->request->isPost) {
            $request = $_POST;
      
            /** Analysons la valeur attribue a action_key **/
            switch ($request['action_key']) {
                
              /** Modifier les informations du client **/
              case md5(strtolower('modifier_membre')):
                    // die(var_dump($_POST));
    
                $photo = $_POST['avatar_remove'];
                if ($_POST['photo'] != null) {
                    $uploadFile = $_POST['photo'];
                    $link_to_upload = Yii::$app->params["linkToUploadIndividusProfil"];
                    $file_uni_name = Yii::$app->fileuploadClass->upload_image64($link_to_upload, $uploadFile);
                    if ($file_uni_name != null) {
                        $photo = $file_uni_name;
                    }
                }
      
                  // Enregistre les modifications effectuees
                  $membre = $request['action_on_this'];
                  $rslt = yii::$app->membreClass->modifierMembre($request, $membre,$photo);
                  Yii::$app->session->setFlash('flashmsg', '<div class="alert alert-success"> <strong> <i class="fa fa-exclamation-circle">&nbsp;</i> </strong>&nbsp;' . Yii::t("app", "enrgSuccess") . '</div>');
                  return $this->redirect(Yii::$app->request->referrer);
                
                break;
            }
        }

        if (yii::$app->request->isGet) {
         
            $membre = (isset($_GET['code']) && $_GET['code'] != '') ? $_GET['code'] : '';
             //Charger renseignements généraux du moniteur
             $membre_id = $membre;
             $membre = yii::$app->membreClass->getmembretdata($membre_id);
             return $this->render('/membre/contenu/profil.php', ['membre' => $membre]);
       
         }
     
    }

      
    
}
