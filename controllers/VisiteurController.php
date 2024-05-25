<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class VisiteurController extends Controller
{

  public function actionUnicitelibelle()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;
    $verifieUniciter = false;
      // die(var_dump($_POST));
    switch ($_POST['action_key']) {

      case md5(strtolower('uniciteMembre')):
        $email = $_POST['email'];

        $verifieUniciter = Yii::$app->mainClass->unicite('membres', $email, 'email');
        // die(var_dump($verifieUniciter));
        return $verifieUniciter;
        break;



      case md5(strtolower('uniciteGrp')):

        $productGroupName = $_POST['productGrpNames'];

        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.groupe', $productGroupName, 'libelle');
        return $verifieUniciter;
        break;

        case md5(strtolower('uniciteGrpUpdate')):

        $productGrpNameUpdate = $_POST['productGrpNameUpdate'];

        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.groupe', $productGrpNameUpdate, 'libelle');
        return $verifieUniciter;
        break;



      case md5(strtolower('uniciteBanner')):

        // die(var_dump($_POST));

        $productBanNames = $_POST['productBanNames'];
        // return $productBanNames;

        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.banner', $productBanNames, 'libelle');
        return $verifieUniciter;

        break;
      case md5(strtolower('unirefUpdate')):

        $productRefNameUpdate = $_POST['productRefNameUpdate'];

        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.reference', $productRefNameUpdate, 'libelle');
        return $verifieUniciter;
        break;
      case md5(strtolower('uniref')):

        $ref = $_POST['productRefNames'];

        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.reference', $ref, 'libelle');
        return $verifieUniciter;
        break;
      case md5(strtolower('uniciteClient')):
        // return $_POST;
        $email = $_POST['email'];
        $verifieUniciter = Yii::$app->mainClass->unicite('icopub.client', $email, 'email');
        return $verifieUniciter;
        break;
      case md5(strtolower('verifiermail')):

        $email = $_POST['email'];
        $verifie = yii::$app->mainCLass->verifData($email, 'individus.individus_contactdata', 'email');
        if ($verifie) {
          // $verifieUniciter = Yii::$app->mainCLass->verifie_mail($email);

        }

        return true;

        break;
      case md5(strtolower('uniclient')):

        return Yii::$app->clientClass->uniclient($_POST['tel'], $_POST['email']);
        break;
      case md5(strtolower('unifournissuer')):

        return Yii::$app->fournisseurClass->unifournissurs($_POST['tel'], $_POST['rsociale'], $_POST['email']);
        break;

      default:
        # code...

        break;

        return $verifieUniciter;
    }

  }




}