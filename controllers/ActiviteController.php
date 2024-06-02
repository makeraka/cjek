<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

class ActiviteController extends Controller
{
    public function actionActivite()
    {

        if (Yii::$app->request->isPost) {
            $request = $_POST;
            $params = Yii::$app->params;
            // die(var_dump($_POST));

            switch ($_POST['action_key']) {

                case md5('addActivite'):

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
                    // die(var_dump($code));

                    $nom = $_POST['nom'];
                    $lieu = $_POST['lieu'];
                    $date = $_POST['dateact'];
                    $desc = $_POST['desc'];


                    Yii::$app->activiteClass->addActivites($code, $nom, $date, $lieu, $desc, $photo);
                    $notification = yii::$app->nonSqlClass->afficherNofitication(yii::$app->params['succes'], yii::t('app', 'enrgSuccess'));
                    Yii::$app->session->setFlash('flashmsg', $notification);
                    return $this->redirect(Yii::$app->request->referrer);
                    break;

                case md5('selectMembre'):
                    die(var_dump($_POST));
                    break;
            }
        }

        $listeActivites = Yii::$app->activiteClass->listeActivites();

        return $this->render('/activite/vueprincipal.php', ['listeActivites' => $listeActivites]);
    }



    public function actionAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        //analyse de l'imput action_key
        if (Yii::$app->request->isPost) {
            $request = $_POST;
           
            /** Analysons la valeur attribue a action_key **/
            switch ($request['action_key']) {

                case md5('detailmembre'):
                    // die(var_dump($_POST));
                    $id = ($request['info']);
                    // die(var_dump($id));

                    $act = Yii::$app->activiteClass->getActivite($id);
                    // die(var_dump($act));

                    
                    $content = $this->renderPartial('/activite/contenu/detailactivite.php', ['act' => $act]);
                    // die(var_dump($content));

                    return $content;
                    break;
            }
        }
    }
}
