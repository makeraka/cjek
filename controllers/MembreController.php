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


            }
        }

        return $this->render('/membre/vueprincipal.php');
    }
}