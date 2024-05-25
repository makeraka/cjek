<?php
namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;
use GuzzleHttp\Client;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
use GuzzleHttp\RequestOptions;

class nonSqlClass extends Component
{

  public function listEntite()
  {
    $typeEntite = [

      '1' => 'SARLU',
      '2' => 'SARL',
      '3' => 'SA',
      '4' => 'S ETAT',
      '5' => 'ETS/Ese',
      '6' => 'O.N.G',
      '7' => 'AMBASSADE',
      '8' => 'ASSOCIATION',

    ];
    //  var_dump($mois[3]['code']);die();
    return $typeEntite;
  }

  public function objectToArray($d)
  {
    if (is_object($d)) {
      // Gets the properties of the given object
      // with get_object_vars function
      $d = get_object_vars($d);
    }

    if (is_array($d)) {
      /*
       * Return array converted to object
       * Using __FUNCTION__ (Magic constant)
       * for recursive call
       */
      return array_map(__FUNCTION__, $d);
    } else {
      // Return array
      return $d;
    }
  }


  public function getActiveCodeEnt()
  {

    $userSession = unserialize(isset(Yii::$app->session[Yii::$app->params['userSession']]) ? Yii::$app->session[Yii::$app->params['userSession']] : Null);

    if (isset($userSession['codeEnt'])) {
      $codeEnt = ($userSession['codeEnt'] != Null) ? $userSession['codeEnt'] : Null;
      if ($codeEnt)
        return $codeEnt;
    }
    return;
  }
  #************************************************************************************************
  # FANGNI
  #************************************************************************************************
  //liste des types d'Entite



  public function listeDesPlanification()
  {
    $panifiation = [
      '1' => ['code' => '1', 'libelle' => 'Petit Déjeuner'],
      '2' => ['code' => '2', 'libelle' => 'Déjeuner'],
      '3' => ['code' => '3', 'libelle' => 'Diner'],
    ];
    return $panifiation;
  }
  //retrouver le genre
  public function genderLabel($genderId)
  {
    $genderLabel = Null;
    if (isset($genderId)) {
      switch ($genderId) {
        case '2':
          $genderLabel = Yii::t('app', 'mculin');
          break;

        case '1':
          $genderLabel = Yii::t('app', 'fmin');
          break;

        case '3':
          $genderLabel = Yii::t('app', 'autre');
          break;
      }
      return $genderLabel;
    }

  }


  public function renderView($view, $params = [])
  {
    // Récupérer l'objet View de l'application
    $viewObject = Yii::$app->getView();

    // Utiliser la méthode render de l'objet View
    return $viewObject->render($view, $params);
  }


  public function envoimail($template, $url, $to, $username, $nomExp, $sujet)
  {
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("bonjour@factorieltechnologie.com", $nomExp);
    $email->setSubject($sujet);
    $email->addTo($to, $username);
    $email->addContent(
      "text/html",
      $this->renderView($template, ['url' => $url]),
    );

    $sendgrid = new \SendGrid(Yii::$app->params['keymail']);
    // die(var_dump($sendgrid));

    try {
      $response = $sendgrid->send($email);

    } catch (Exception $e) {
      // die($e->getMessage());
    }
  }




  /** Methode : gener un uniq id **/
  public function generateUniq()
  {
    return strVal(bin2hex(random_bytes(Yii::$app->params['PBKDF2_SALT_BYTE_SIZE'])));
  }

  /** Methode : Charger le message d'erreur **/
  public function afficherNofitication($code = Null, $msg = Null, $color = Null)
  {
    $code = intval($code);
    switch ($code) {

      //Code pour attention
      case 412:
        $color = 'warning';
        break;

      //Code pour erreur
      case 400:
        $color = 'danger';
        break;

      //Code pour succes
      case 200:
        $color = 'success';
        break;

      //Information
      case 100:
        $color = 'info';
        break;

      //
      default:
        return;
        break;
    }

    return '<div class="card-body pt-0">
                  <div class="d-flex align-items-center bg-' . $color . ' rounded p-5 mb-7">
                    <div class="flex-grow-1 me-2">
                      <h3 class="card-title fw-bold text-black"><i class="fa fa-bell white-color text-black">&nbsp;</i> ' . $msg . '</h3>
                    </div>
                  </div>
                </div>';

  }

  /** Methode : Ajouter des années sur une date  **/
  public function topup_year($date_given = Null, $incrementeur = 5)
  {
    $date_gotten = Null;
    if (isset($incrementeur)) {
      $date_given = explode('-', $date_given);
      $date_gotten = mktime(0, 0, 0, $date_given['1'], $date_given['2'], $date_given['0'] + $incrementeur);
      $date_gotten = date('Y-m-d', $date_gotten);
    }
    return $date_gotten;
  }


  /** Methode : Libeller les categories de client **/
  public function libeller_categorie_client($categorie_id = '')
  {
    $rslt = '';
    switch ($categorie_id) {
      case 1:
        $rslt = 'Prospect Froid';
        break;

      case 2:
        $rslt = 'Prospect Tiede';
        break;

      case 3:
        $rslt = 'Prospect Chaud';
        break;

      case 4:
        $rslt = 'Client';
        break;

      default:
        $rslt = 'N/S';
        break;
    }
    return $rslt;
  }

  /** Methode : Libeller du mode de paiement **/
  public function libeller_mode_paiement($id = '')
  {
    $rslt = '';
    switch ($id) {
      case 1:
        $rslt = 'Cash';
        break;

      case 2:
        $rslt = 'Chèque';
        break;

      case 3:
        $rslt = 'Virement Bancaire';
        break;

      default:
        $rslt = 'N/S';
        break;
    }
    return $rslt;
  }

  /** Methode : Libeller la raison sociale des fournisseurs **/
  public function libeller_raison_sociale($id = '')
  {
    $rslt = '';
    switch ($id) {
      case 1:
        $rslt = yii::t('app', 'particulier');
        break;

      case 2:
        $rslt = yii::t('app', 'entreprise');
        break;

      default:
        $rslt = 'N/S';
        break;
    }
    return $rslt;
  }

  public function convertinttableautostrg($tableau)
  {
    $strg = Null;
    if (sizeof($tableau) > 0) {
      for ($i = 0; $i < sizeof($tableau); $i++) {
        $minitableau[] = $tableau[$i]['id'];
      }
      $strg = implode(',', $minitableau);
    }
    return $strg;
  }

  public function convertdatetolimitforfait($dateinsqlformat)
  {
    $dateinlicenceformat = Null;
    if (isset($dateinsqlformat)) {
      $dfl_array = explode('-', $dateinsqlformat);
      $dfl_strg = $dfl_array['0'] . $dfl_array['1'] . $dfl_array['2'];
      $dateinlicenceformat = base64_encode($dfl_strg);
    }
    return $dateinlicenceformat;
  }

  public function convertArraytoString($monarray, $indexaselect)
  {
    $data = Null;
    $cmpt = 0;
    if (sizeof($monarray) > 0) {
      foreach ($monarray as $key => $value) {
        $space = ($key == 0) ? '' : ',';
        $data .= $space . $value[$indexaselect];
      }
      //$data = str_replace('','","',$data);
    }
    return $data;
  }
  public function convert_to_moneyformat($number)
  {
    $number = 1000000000;
    $output = Null;
    if (isset($number)) {
      $numberlen = strlen($number);
      $divider = $numberlen / 3;
      for ($i = 1; $i < $divider; $i++) {
        $output .= $number[$i] . '_';
      }
    }
    return $number[1];
  }
  /*********************************************/
  // Cette fonction compare deux date entre elle
  /*********************************************/
  public function date_compare($startDate, $endDate)
  {
    $cmptaror = false;
    $startDate = nonSqlClass::convert_date_to_sql_form($startDate, "M/D/Y");
    $endDate = nonSqlClass::convert_date_to_sql_form($endDate, "M/D/Y");

    if (strtotime($startDate) < strtotime($endDate)) {
      $cmptaror = true;
    } else {
      $cmptaror = false;
    }
    return $cmptaror;
  }

  /***************************************/
  /** Get le label du type de l'article **/
  /***************************************/
  public function articleTypeLabel($typeId)
  {
    $typeLabel = Null;
    if (isset($typeId)) {
      switch ($typeId) {
        case '2':
          $typeLabel = 'Service';
          break;

        case '1':
        default:
          $typeLabel = 'Stock';
          break;

      }
      return $typeLabel;
    }

  }

  /***************************/
  /** Get le label du genre **/
  /***************************/
  public function genderLabels($genderId)
  {
    $genderLabel = Null;
    if (isset($genderId)) {
      switch ($genderId) {
        case '2':
          $genderLabel = Yii::t('app', 'mculin');
          break;

        case '1':
          $genderLabel = Yii::t('app', 'fmin');
          break;

        case '3':
          $genderLabel = Yii::t('app', 'autre');
          break;
      }
      return $genderLabel;
    }

  }


  public function gSanguin()
  {

    return $gSanguin = [
      '1' => 'A+',
      '2' => 'A-',
      '3' => 'B+',
      '4' => 'B-',
      '5' => 'AB+',
      '6' => 'O-',
      '7' => 'O+',
      '8' => 'AB-'

    ];


  }

  #************************************************************************************************
  # FUNCTION QUI RENVOIS LE CODE QUI INITIE LA CREATION DE COMPTE D'UN SANTEYAKAH ET OPTIENT LE NIS
  #************************************************************************************************
  public function genNouveauCode()
  {
    $j = $code = $holder = Null;
    $code = array();
    $j = (strlen(date('j')) < 2) ? date('jj') : date('j');
    /*
    for ($i=0; $i < 100; $i++) {
      $holder = rand(10,99).$j.rand(10,99);
      $code[$i] = $holder;
    }*/
    return $holder = $j . rand(100, 999);
  }

  #********************************************
  # FUNCTION QUI RENVOIS LE NIS D'UN SANTEYAKAH
  #********************************************
  public function codeNis($dteNaissance)
  {
    if (isset($dteNaissance)) {
      # DETERMINATION DES VARIABLES
      $j = $q = $m = $a = Null;
    } else
      return false;
  }

  #***************************************************************************
  # CETTE FUNCTION RENVOIS UN HIDDEN IMPUT CONTRE LA DUPLICATION DE VALIDATION
  #***************************************************************************
  public function getHiddenFormTokenField()
  {
    $token = Yii::$app->getSecurity()->generateRandomString();
    $token = str_replace('+', '.', base64_encode($token));
    Yii::$app->session->set('postToken', $token);
    return Html::hiddenInput('postToken', $token);
  }

  #****************************************************************************************
  # FUNCTION : RENVOIS LE NUMEROS DU JOUR DE LA SEMAINE EN FUNCTION DU JOUR DE LA SEMAINE
  #****************************************************************************************
  public function findDayNum($DayOfWeek)
  {
    $dayNum = Null;
    switch (strtolower($DayOfWeek)) {
      case 'sat':
        $dayNum = 0;
        break;

      case 'sun':
        $dayNum = 1;
        break;

      case 'mon':
        $dayNum = 2;
        break;

      case 'sat':
        $dayNum = 3;
        break;

      case 'wed':
        $dayNum = 4;
        break;

      case 'thu':
        $dayNum = 5;
        break;

      default:
        $dayNum = Null;
        break;
    }
    return $dayNum;
  }

  #**********************************************************
  # THIS FUNCTION CONVERT A FRIENDLY DATE TO SQL DATE FORMAT
  #**********************************************************
  public static function convert_date_to_sql_form($indate, $inputformat, $format = 'Y-M-D')
  {
    $output = Null;
    $output = $indate;
    $year = '';
    $month = '';
    $day = '';
    if (isset($inputformat) && !empty($inputformat) && isset($indate) && !empty($indate)) {
      switch (strtoupper($inputformat)) {
        case "M/D/Y":
          $split = explode('/', $indate);
          $year = $split[2];
          $month = $split[0];
          $day = $split[1];
          break;

        case "Y-D-M":
          $split = explode('-', $indate);
          $year = $split[0];
          $month = $split[2];
          $day = $split[1];
          break;

        case "D/M/Y":
          $split = explode('/', $indate);
          $year = $split[2];
          $month = $split[0];
          $day = $split[1];
          break;

        case "Y-M-D":
          $split = explode('-', $indate);
          $year = $split[0];
          $month = $split[1];
          $day = $split[2];
          break;
      }

      switch (strtoupper($format)) {
        case "Y-M-D":
          $output = $year . '-' . $month . '-' . $day;
          break;

        case "D/M/Y":
          $output = $day . '/' . $month . '/' . $year;
          break;

        case "M/D/Y":
          $output = $month . '/' . $day . '/' . $year;
          break;
      }
    }
    return $output;
  }

  #*********************************
  # THIS FUNCTION GET SERVER DETAILS
  #*********************************
  public static function get_server_dtls()
  {
    $server = $_SERVER;
    $str_array = array('PATH', 'PATHEXT', 'SystemRoot', 'SERVER_ADMIN', 'DOCUMENT_ROOT', 'SERVER_SOFTWARE', 'SERVER_SIGNATURE', 'CONTEXT_DOCUMENT_ROOT', 'COMSPEC', 'WINDIR', 'SCRIPT_FILENAME');
    foreach ($str_array as $key) {
      unset($server[$key]);
    }
    $server = serialize($server);
    return $server;
  }



  #**********************************************#
  # FUNCTION : GENERATE UNIQUE STAFF ID FOR USER #
  #**********************************************#
  public static function generate_unique_id()
  {
    $staffid = Yii::$app->params['staff_id_prefix'] .
      substr(rand(), 0, Yii::$app->params['gen_key1_length']) .
      substr(date("i"), 1, 2) . substr(date("sa"), 1, 1) .
      substr(date("D"), 0, 1);
    $is_unique = Yii::$app->mainClass->check_staffid_if_unique($staffid);
    if ($is_unique == true or $is_unique == 1) {
      return $staffid;
    }

    $staffid = Yii::$app->params['staff_id_prefix'] .
      substr(rand(), 0, Yii::$app->params['gen_key1_length']) .
      substr(date("i"), 1, 2) . substr(date("sa"), 1, 1) .
      substr(date("D"), 0, 1);
    $is_unique = Yii::$app->mainClass->check_staffid_if_unique($staffid);
    if ($is_unique == true or $is_unique == 1) {
      return $staffid;
    }


    $staffid = Yii::$app->params['staff_id_prefix'] .
      substr(rand(), 0, Yii::$app->params['gen_key1_length']) .
      substr(date("i"), 1, 2) . substr(date("sa"), 1, 1) .
      substr(date("D"), 0, 1);
    $is_unique = Yii::$app->mainClass->check_staffid_if_unique($staffid);
    if ($is_unique == true or $is_unique == 1) {
      return $staffid;
    }

    return false;

  }


  public function getActiveUserCode()
  {

    $userSession = unserialize(isset(Yii::$app->session[Yii::$app->params['userSession']]) ? Yii::$app->session[Yii::$app->params['userSession']] : Null);
    if (isset($userSession['userCode'])) {
      $userCode = ($userSession['userCode'] != Null) ? $userSession['userCode'] : Null;
      if ($userCode)
        return $userCode;
    }

    return;
  }

  public function getActiveEnt()
  {
    $userSession = unserialize(isset(Yii::$app->session[Yii::$app->params['userSession']]) ? Yii::$app->session[Yii::$app->params['userSession']] : Null);

    if (isset($userSession['codeEnt'])) {
      $activeENt = ($userSession['codeEnt'] != Null) ? $userSession['codeEnt'] : Null;
      if ($activeENt)
        return $activeENt;
    }
    return;
  }

  public function getActiveFiliere()
  {
    $userSession = unserialize(isset(Yii::$app->session[Yii::$app->params['userSession']]) ? Yii::$app->session[Yii::$app->params['userSession']] : Null);
    if (isset($userSession['filiere'])) {
      $activeFiliere = ($userSession['filiere'] != Null) ? ($userSession['filiere']) : Null;
      if ($activeFiliere)
        return $activeFiliere;
    }
    return;
  }

  public function getActiveAnneeScolaire()
  {
    $userSession = unserialize(isset(Yii::$app->session[Yii::$app->params['userSession']]) ? Yii::$app->session[Yii::$app->params['userSession']] : Null);
    if (isset($userSession['codeAnneeActive'])) {
      $activeCodeAnnee = ($userSession['codeAnneeActive'] != Null) ? $userSession['codeAnneeActive'] : Null;
      if ($activeCodeAnnee)
        return $activeCodeAnnee;
    }
    return;
  }
  //liste des mois
  public function listmois()
  {
    $mois = [

      '1' => ['code' => '1', 'libelle' => 'janvier'],
      '2' => ['code' => '2', 'libelle' => 'février'],
      '3' => ['code' => '3', 'libelle' => 'mars'],
      '4' => ['code' => '1', 'libelle' => 'avril'],
      '5' => ['code' => '2', 'libelle' => 'mai'],
      '6' => ['code' => '3', 'libelle' => 'juin'],
      '7' => ['code' => '1', 'libelle' => 'juillet'],
      '8' => ['code' => '2', 'libelle' => 'août'],
      '9' => ['code' => '3', 'libelle' => 'septembre'],
      '10' => ['code' => '1', 'libelle' => 'octobre'],
      '11' => ['code' => '2', 'libelle' => 'novembre'],
      '12' => ['code' => '3', 'libelle' => 'décembre'],
    ];
    //  var_dump($mois[3]['code']);die();
    return $mois;
  }

  //function pour retourner le mois de l'annee
  public function getNumberMonth($mois)
  {
    switch ($mois) {
      case 'janvier':
        return '1';
        break;
      case 'février':
        return '2';
        break;
      case 'mars':
        return '3';
        break;
      case 'avril':
        return '4';
        break;
      case 'mai':
        return '5';
        break;
      case 'juin':
        return '6';
        break;
      case 'juillet':
        return '7';
        break;
      case 'août':
        return '8';
        break;
      case 'septembre':
        return '9';
        break;
      case 'octobre':
        return '10';
        break;
      case 'novembre':
        return '11';
        break;
      case 'décembre':
        return '12';
        break;
    }
  }

  //public function envoi msg
  public function envoieSms($from, $message, $to)
  {
    $client = new Client([
      'base_uri' => "https://mpvvk6.api.infobip.com/",
      'headers' => [
        'Authorization' => yii::$app->params['keysmsinfobib'],

        'Accept' => 'application/json',
      ]
    ]);
    try {

      $response = $client->request(
        'POST',
        'sms/2/text/advanced',
        [
          RequestOptions::JSON => [
            'messages' => [
              [
                'from' => $from,
                'destinations' => [
                  ['to' => $to]
                ],
                'text' => $message,
              ]
            ]
          ],
        ]
      );
      // echo("HTTP code: " . $response->getStatusCode() . PHP_EOL);
      // echo("Response body: " . $response->getBody()->getContents() . PHP_EOL);
      // die();
      //code...
    } catch (\Throwable $th) {
      return false;
    }

  }


}

