<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;


class mainClass extends Component
{

  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }

  public function uniciteCategorie($libelle)
  {
    try {
      $req = $this->connect->createCommand ('SELECT COUNT(*) AS count FROM icopub.categorie WHERE libelle = :libelle')
        ->bindValue(':libelle', $libelle)
        ->queryAll();
      if ($req != null)
        return true;
      return false;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  public function unicite($table, $libelle, $columns)
  {
    $query = null;
   
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where $columns = :libelle")
        ->bindValue(':libelle', $libelle)
        ->queryAll();
      if ($query != null)
        return true;
      return false;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }
























  #****************************************************************
  // ATEXT
  #****************************************************************


  //---S33----@---Validation des champs vides----#---//
  public function validerForm($index = 1, $inputArray = Null)
  {
    $formValidated = true;
    $i = $j = 0;

    foreach ($inputArray as $key => $inputVal) {
      if (isset($key) && (is_array($inputArray[$key]) === true)) {

        // //Determiner le type d'input
        // $inputType = get

        $notNullElem = array_filter($inputArray[$key], null);
        $count = count($notNullElem);

        if ($count < 1) {
          $formValidated = false;
        }

      } else {
        if (is_null($inputArray[$key]))
          $formValidated = false;
        ;
      }

      //---- @ ---- Check, si 
      if ($formValidated !== true) {
        //--- @ ----- Set la session flash ----- @ ---//
        Yii::$app->nonsqlClass->preparerFlashMsg("danger", "interruption", "champsObligatoiresVides");
        return false;
      }

      $formValidated = true;
    }

    return $formValidated;
  }


  // ---------- ---------- ---------- INSERT FUNCTION SET ---------- ---------- ---------- //
  public function insertData($tableName, $columnValue)
  {
    try {
      $sql1 = "INSERT INTO $tableName  ";

      foreach ($columnValue as $ca1Column => $ca1Value) {
        $ca1ColumnUpper = strtoupper($ca1Column);
        @$sql2 .= "$ca1Column, ";
      }

      $sql2 = '(' . rtrim(@$sql2, ", ") . ')';

      foreach ($columnValue as $ca1Column => $ca1Value) {
        $ca1ColumnUpper = strtoupper($ca1Column);
        @$sql3 .= ":$ca1ColumnUpper, ";
      }

      $sql3 = '  VALUES(' . rtrim(@$sql3, ", ") . ')';


      $preSQL = $sql1 . $sql2 . $sql3; //

      $query = $this->connect->createCommand($preSQL);

      foreach ($columnValue as $ca2Column => $ca2Value) {
        $ca2ColumnUpper = strtoupper($ca2Column);
        $query->bindValue(":$ca2ColumnUpper", $ca2Value);
        // $postSQL[$ca2ColumnUpper] = $ca2Value;
      }
      return $query->execute();

    } catch (Exception $e) {
      return 0;
    }
  }






  // ---------- ---------- ---------- UPDATE FUNCTION SET ---------- ---------- ---------- //
  public function updateData($tableName, $columnValue, $whereValue = 0)
  {
    try {
      $sql1 = "UPDATE $tableName SET ";

      foreach ($columnValue as $ca1Column => $ca1Value) {
        $ca1ColumnUpper = strtoupper($ca1Column);
        @$sql2 .= "$ca1Column=:$ca1ColumnUpper, ";
      }
      $sql2 = rtrim(@$sql2, ", ");

      if ($whereValue == 0) {
        $preSQL = $sql1 . $sql2;
      } else {
        $sql3 = " WHERE ";
        foreach ($whereValue as $wa1Column => $wa1Value) {
          $wa1ColumnUpper = strtoupper($wa1Column);

          @$sql4 .= "$wa1Column=:$wa1ColumnUpper AND ";
        }
        $sql4 = trim($sql4);
        $sql4 = rtrim($sql4, "AND");
        $sql4 = trim($sql4); // NIRU //

        $preSQL = $sql1 . $sql2 . $sql3 . $sql4;
      }

      $query = $this->connect->createCommand($preSQL);

      if ($whereValue == 0) {
        foreach ($columnValue as $ca2Column => $ca2Value) {
          $ca2ColumnUpper = strtoupper($ca2Column);
          $query->bindValue(":$ca2ColumnUpper", $ca2Value);

        }
      } else {
        foreach ($columnValue as $ca2Column => $ca2Value) {
          $ca2ColumnUpper = strtoupper($ca2Column);
          $query->bindValue(":$ca2ColumnUpper", $ca2Value);
        }

        foreach ($whereValue as $wa2Column => $wa2Value) {
          $wa2WhereUpper = strtoupper($wa2Column);

          $query->bindValue(":$wa2WhereUpper", $wa2Value);

        }
      }

      $dataAdded = $query->execute();

      return $dataAdded;
    } catch (Exception $e) {
      return 0;
    }
  }


  // ---------- ---------- ---------- SELECT FUNCTION SET ---------- ---------- ---------- //
  public function selectJoinData($columnName, $tableName, $whereValue = 0, $formatBy = 0, $paginate = 0)
  {
    try {
      // -- SELECT FROM TABLE -- //
      if ($columnName == "*") {
        $sql1 = "SELECT ";
        $sql2 = "*";
      } else {
        $sql1 = "SELECT ";
        foreach ($columnName as $ca1Column => $ca1Value) {
          @$sql2 .= "$ca1Value, ";
        }
        $sql2 = rtrim(@$sql2, ", ");
      }
      // -- SELECT FROM TABLE -- //
      $sql3 = " FROM ";

      if (is_array($tableName)) {

        foreach ($tableName as $ca1table => $tb1Value) {
          @$sql3 .= "$tb1Value, ";
        }
      } else {
        @$sql3 .= "$tableName, ";
      }
      $sql3 = rtrim(@$sql3, ", ");

      // -- FROM -- //
      // -- FROM -- //
      // -- JOIN QUERY -- //


      // -- FORMAT -- //
      if (@$formatBy['ASC'])
        $sql7 = " ORDER BY " . $formatBy['ASC'] . " ASC";
      else if (@$formatBy['DESC'])
        $sql7 = " ORDER BY " . $formatBy['DESC'] . " DESC";
      else
        $sql7 = "";

      // -- WHERE -- //
      if ($whereValue != 0) {
        $sql5 = " WHERE ";

        foreach ($whereValue as $wa1Column => $wa1Value) {
          @$sql6 .= $wa1Column . " = " . "" . $wa1Value . " AND ";
        }
        $sql6 = trim($sql6);
        $sql6 = rtrim($sql6, "AND");
        $sql6 = trim($sql6); // NIRU //

        $preSQL = $sql1 . $sql2 . $sql3 . $sql5 . $sql6 . $sql7;
      } else {
        $preSQL = $sql1 . $sql2 . $sql3 . $sql7;
      }
      // -- WHERE -- //
      // -- PAGINATION HANDLER -- //
      if ($paginate != 0)
        $preSQL = $preSQL . " LIMIT " . $paginate['POINT'] . ", " . $paginate['LIMIT'];
      // -- PAGINATION HANDLER -- //

      $query = $this->connect->createCommand($preSQL);
      $dataSelected = $query->queryAll();
      return $dataSelected;
    } catch (Exception $e) {
      return 0;
    }
  }

  public function getuniquedatafortable($table, $code, $colun)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where $colun = :code")
        ->bindValue(':code', $code)
        ->queryOne();

      return $query;
    } catch (\PDOException $ex) {
      die(var_dump($ex->getMessage()));
    }
  }

  public function getuniquedata($table, $code)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where code = :code")
        ->bindValue(':code', $code)
        ->queryOne();

      return $query;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }





  public function getuniqdata($code, $table, $colum)
  {
    $query = null;

    try {
      $query = $this->connect->createCommand("SELECT * FROM  $table WHERE $colum=:code")
        ->bindValue(':code', $code)
        ->queryOne();
      return $query;

    } catch (\PDOException $ex) {
      die($ex->getMessage());
    }
  }


  //recher l'inititier d'un donner
  public function verifData($code, $table, $colum)
  {
    $query = null;

    try {
      $query = $this->connect->createCommand("SELECT * FROM  $table WHERE $colum=:code")
        ->bindValue(':code', $code)
        ->queryAll();
      return $query;

    } catch (\PDOException $ex) {
      die($ex->getMessage());
    }
  }

  //unicite de username
  public function verifUser($code, $table, $colum)
  {
    $query = null;

    try {
      $query = $this->connect->createCommand("SELECT * FROM  $table WHERE $colum=:code")
        ->bindValue(':code', $code)
        ->queryAll();
      if ($query != null)
        return true;
      return false;

    } catch (\PDOException $ex) {
      die($ex->getMessage());
    }
  }

  // Fonction de selection des infos d'une table via le
  public function getTableData($code, $table)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table WHERE code=:code")
        ->bindValue(':code', $code)
        ->queryOne();
      if ($query != null)
        return $query;
      return $query;
    } catch (\PDOException $ex) {

    }
  }

  // Fonction pour changer la liste de donner d'une table
  public function getAlltableData($table)
  {
    $codeEntrprise = yii::$app->nonSqlClass->getActiveEnt();
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table  WHERE codeEntrprise= :codeEntrprise")
        ->bindValue(':codeEntrprise', $codeEntrprise)
        ->queryAll();
      return $query;

    } catch (\PDOException $ex) {

    }
  }

  //fonction de verification de l'unicite du libelle

  public function uniLibelle($table, $libelle, $columns)
  {
    $query = null;
    $codeEntrprise = yii::$app->nonSqlClass->getActiveEnt();
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table where $columns = :libelle  AND codeEntrprise = :codeEntrprise")
        ->bindValues([':libelle' => $libelle, ':codeEntrprise' => $codeEntrprise])
        ->queryAll();
      if ($query != null)
        return true;
      return false;
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


  // Fonction pour changer la liste de donner d'une table
  public function getAlltableFournisseursData($table)
  {
    $codeEntrprise = yii::$app->nonSqlClass->getActiveEnt();
    $query = null;
    try {
      $query = $this->connect->createCommand("SELECT * FROM $table  WHERE codeFournisseur=:codeEntrprise")
        ->bindValue(':codeEntrprise', $codeEntrprise)
        ->queryAll();
      if ($query != null)
        return $query;
      return;
    } catch (\PDOException $ex) {

    }
  }






  /** Methode : Afficher le titre des formulaires **/
  public function afficherTitreFormulaire()
  {
    $breadcrumb = $anneeActive = $anneeEts = $anneeRadio = $anneeLabel = Null;
    $activeController = Yii::$app->controller->id;
    $activeAction = Yii::$app->controller->action->id;

    $userSession = unserialize(Yii::$app->session[Yii::$app->params['userSession']]);

    if (isset($userSession) && is_array($userSession)) {
      $anneeActive = (isset($userSession['codeAnneeActive'])) ? (mainClass::getTableData($userSession['codeAnneeActive'], "da_annee_scolaire"))[0]["libelle"] : Null;
    }

    $anneeEts = (isset($userSession['anneeEts'])) ? unserialize($userSession['anneeEts']) : Null;
    $codeFIlieere = (isset($userSession['filiere'])) ? ($userSession['filiere']) : Null;
    $libFiliere = Yii::$app->etsConfigClass->searchfiliere($codeFIlieere);
    $sessionFiliere = '';

    if (!empty($libFiliere['libelle'])) {
      $sessionFiliere = $libFiliere['libelle'];
    }
    //Preparer le 

    $breadcrumb = '
                      <li class="breadcrumb-item pe-3">
                        <a href="' . Yii::$app->request->baseUrl . '/' . md5("site_index") . '" class="pe-3">' . Yii::t('app', 'accueil') . '</a>&nbsp;
                      </li>
                      <li class="breadcrumb-item pe-3">
                        ' . Yii::t('app', $activeController) . '&nbsp;
                      </li>
                      <li class="breadcrumb-item pe-3">
                        ' . Yii::t('app', $activeAction) . '
                      </li>
                                      ';


    //pour les filieres 
    // $codeEts = Yii::$app->nonSqlClass->getActiveCodeEts();
    // $headerFiliere = Yii::$app->etsConfigClass->getListEtsFiliere($codeEts);
    $etsFiliere = '';
    if (isset($headerFiliere)) {

      foreach ($headerFiliere as $key => $value) {

        if ($value['code'] == $codeFIlieere) {
          $checkeds = 'checked';

        } else
          $checkeds = '';

        $etsFiliere .= '
                              <div class="mb-10">
                                <div class="form-check">
                                 
                                  <a href="javascript:;" Class="btnChangefiliere" data-filiere=\'' . $value["code"] . '\'" 
	                              "   on> <input class="form-check-input" type="radio" value="' . $value["code"] . '" id="flexCheckDefault1"  name="rad" ' . $checkeds . '   />
                                <label class="form-check-label" for="flexCheckDefault1">' . $value['libelle'] . '</label>
                                </a>
                                </div>
                              </div>
                            ';


      }
    }

    if (isset($anneeEts) && is_array($anneeEts)) {
      $codeAnneeActive = Yii::$app->nonSqlClass->getActiveAnneeScolaire();
      $value = "";
      foreach ($anneeEts as $key => $eachAnneeEts) {
        $anneeLabel = (isset($eachAnneeEts['code'])) ? (mainClass::getTableData($eachAnneeEts['code'], "da_annee_scolaire"))[0]["libelle"] : Null;

        if ($eachAnneeEts['code'] == $codeAnneeActive) {
          $checked = 'checked';

        } else
          $checked = '';

        $anneeRadio .= '
                              <div class="mb-10">
                                <div class="form-check">
                                 
                                  <a href="javascript:;" Class="btnAnnnee" data-id=\'' . $eachAnneeEts["code"] . '\'" 
	                              "   on> <input class="form-check-input" type="radio" value="' . $eachAnneeEts["code"] . '" id="flexCheckDefault1"  name="radio2"    ' . $checked . '/>
                                <label class="form-check-label" for="flexCheckDefault1">' . $anneeLabel . '</label>
                                </a>
                                </div>
                              </div>
                            ';


      }
    }

    $modal = '     
                        <!-- Modal -->
                        <div class="modal fade text-center" id="modalaneescolaire" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              
                              <div class="modal-body">
                        
                                <div class="mt-10">
                                    <div class="mb-10">
                                      <span><i class="fonticon-notification text-warning fs-5x"></i></span>
                                    </div>
                                    <h5 class="modal-title" id="staticBackdropLabel">Etes-vous sûr de vouloir continuer </h5>
                                </div>
                        
                              </div>
                        
                              <div class="modal-footer text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                <button type="button" class="btn btn-primary" onclick="alert(document.getElementById(\'flexCheckDefault1\').value);">Oui</button>
                              </div>
                        
                            </div>
                          </div>
                        </div>
                        
                        
                        ';
    $urls = Yii::$app->request->baseUrl . "/" . md5("site_usersession");
    $urlFiliere = Yii::$app->request->baseUrl . "/" . md5("site_filiere");

    $csrf = Yii::$app->request->getCsrfToken();
    $formTitle = '
                      
                         
                            <div class="page-title d-flex flex-column me-3">
                            <h1 class="d-flex text-white fw-bold my-1 fs-3">' . Yii::t("app", $activeController) . '</h1>
                 

                     <h1 class="d-flex text-white fw-bold my-1 fs-3">
                  
                     
                      
                      </h1>

                        <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                          ' . $breadcrumb . '
                        </ol>
                      ' . $modal . '  
                   
                      </div>

                      <script type="text/javascript">
                      $(document).ready(function(){
                            $(".btnChangefiliere").click(function(){
                              var codeFiliere = $(this).attr("data-filiere");

                              var changeFiliere=false;
                              $.post(
                                \'' . $urlFiliere . '\', 
                                {codeFiliere: codeFiliere,_csrf:  \'' . $csrf . '\'},
                                function(response)
                                {
                                  changeFiliere = response;
                                  window.location.href="' . yii::$app->request->baseUrl . '/' . md5('site_index') . '";
                                  $("reset").click();
                          
                                }
                            );
                            });
                            
                          $(".btnAnnnee").click(function(){
                         
                            var codeAnnee = $(this).attr("data-id");
                            var changeAnnee=false;
                            $.post(
                              \'' . $urls . '\', 
                              {codeAnnee: codeAnnee,_csrf:  \'' . $csrf . '\'},
                              function(response)
                              {
                                 changeAnnee = response;
                                 console.log(response);
                                  window.location.href="' . yii::$app->request->baseUrl . '/' . md5('site_index') . '";
                                  $("reset").click();
                                

                              }
                           );
                        
                        });
                    
                    });
                  
                      
                  </script>
                  
                       ';
    return $formTitle;
  }

  /** Methode : Charger le code de l'annee active **/



  /** Methode : Charger l'ets actif **/
  public function chargerEntActive($codeUser = Null)
  {
    $codeProduit = yii::$app->params['produitcode'];
    $rslt = $this->connect->createCommand('SELECT * FROM authentification.lien_user_partenaire_prod 
                              WHERE codeindividus=:codeUserAuth 
                              and parDefault=:parDefault
                              and codeproduit  =:codeproduit')
      ->bindValues([':codeUserAuth' => $codeUser, ':parDefault' => 1, ':codeproduit' => $codeProduit])
      ->queryOne();
    if ($rslt)
      return $rslt['codepartenariat'];
    return;
  }


  public function entite($codeUser)
  {
    $rslt = $this->connect->createCommand('SELECT * FROM partenaires.paretenariat 
            WHERE paretenariat.code=:code    
          ')
      ->bindValue(':code', $codeUser)
      ->queryOne();
    if ($rslt)
      return $rslt['codepartenaireglobaldata'];
    return;
  }
  /** Methode : Demarrer le process d'authentification **/
  public function demarrer_auth($identifiant = '')
  {
    $codeProduit = yii::$app->params['produitcode'];
    $auth = $this->connect->createCommand('SELECT * FROM authentification.userauth,authentification.lien_user_partenaire_prod
                                 WHERE identifiant=:identifiant
                                 AND  authentification.lien_user_partenaire_prod.codeindividus = authentification.userauth.code
                                 AND authentification.lien_user_partenaire_prod.codeproduit =:codeproduit
                                 and authentification.userauth.statut=0')
      ->bindValues([':identifiant' => $identifiant, ':codeproduit' => $codeProduit])
      ->queryOne();
    //  dd($auth);
    return $auth;
  }


  /** Methode : Charger la liste des utilisateurs actifs **/
  public function get_active_user()
  {
    $rslt = $this->connect->createCommand('select id from ste_userauth
          where statCmpt=:statCmpt 
          and active_user=:active_user')
      ->bindValues([':statCmpt' => 1, ':active_user' => 1])
      ->queryAll();
    return $rslt;
  }

  //Methode : Charger les utilisateurs connectes
  public function get_active_user_in_entite($entite = '')
  {
    $rslt = $this->connect->createCommand('select ste_userauth.id, typeUser, dteMisJour, active_user from ste_userauth
          join ste_userentite on ste_userentite.userauthId = ste_userauth.id 
          where statCmpt=:statCmpt 
          and active_user=:active_user and ste_userentite.idEntite =:entite')
      ->bindValues([':statCmpt' => 1, ':active_user' => 1, 'entite' => $entite])
      ->queryAll();
    return $rslt;
  }

  //Methode : Activer la presence de l'utilisateur en ligne
  public function update_online_stat($idUniqUser = '', $statut = 0)
  {
    $rslt = $this->connect->createCommand('update ste_userauth set active_user=:active_user
          where id=:id')
      ->bindValues([':id' => $idUniqUser, ':active_user' => $statut])
      ->execute();
    return;
  }

  //Methode : charger les utilisateurs en fonction du type , de l'entite
  public function get_user_in_entite($typeUserRange = '', $entite = 0)
  {
    $cdt = '';
    if (isset($entite) && $entite == 'tout') {
      $cdt = '';
    } else {
      $cdt = ' and ste_userentite.idEntite = ' . $entite;
    }

    $rslt = $this->connect->createCommand('select ste_userauth.id, userauthId from ste_userauth
          join ste_userentite on ste_userauth.id = ste_userentite.userauthId
          where typeUser IN ' . $typeUserRange . ' 
          ' . $cdt . '
          and ste_userentite.userFntStat = :userFntStat')
      ->bindValue(':userFntStat', 1)
      ->queryAll();
    return $rslt;
  }




  /** Methode : CHarger les regions en fonction du pays **/
  public function get_regions($pays = '')
  {
    switch ($pays) {
      case '*':
        $rslt = $this->connect->createCommand('select * from ste_sys_regions')
          ->queryAll();
        break;

      default:
        $rslt = $this->connect->createCommand('select * from ste_sys_regions where pays=:pays')
          ->bindValue(':pays', $pays)
          ->queryAll();
        break;
    }

    return $rslt;
  }


  /** Methode : renvoie le label du pays **/
  public function payslabel($pays)
  {
    $rslt = Null;
    if (isset($pays)) {
      $rslt = $this->connect->createCommand('select nom from da_pays where code=:code')
        ->bindValue(':code', $pays)
        ->queryOne();
      if (sizeof($rslt) > 0)
        $rslt = $rslt['nom'];
    }
    return $rslt;
  }


  /** Methode : get La liste des medecin dans une entite **/
  public function getuser_in_entite($usertype)
  {
    $userSessionDtls = Yii::$app->session[Yii::$app->params['userSessionDtls']];
    $userAuthDtlsArray = unserialize($userSessionDtls);

    $entite = (isset($userAuthDtlsArray['listCorpMedHostos']) && !empty($userAuthDtlsArray['ListCorpMedHostos'])) ? unserialize($userAuthDtlsArray['ListCorpMedHostos']) : '';
    $entite = unserialize($userAuthDtlsArray['ListCorpMedHostos']);

    $entite = isset(Yii::$app->session[Yii::$app->params['activeEntiveUserEnFnct']]) ? Yii::$app->session[Yii::$app->params['activeEntiveUserEnFnct']] : $entite['0']['idEntite'];
    $rslt = $this->connect->createCommand("SELECT DISTINCT (ste_userauth.id) , ste_userentite.idEntite , ste_userauth.typeUser
                                              FROM
                                                ste_userauth
                                              JOIN ste_userentite on ste_userentite.userauthId=ste_userauth.id
                                              WHERE
                                                ste_userentite.idEntite =:idEntite 
                                              and ste_userentite.userFntStat=:userFntStat
                                              and ste_userauth.typeUser in " . Yii::$app->params[$usertype])
      ->bindValues([':idEntite' => $entite, ':userFntStat' => '1'])
      ->queryAll();
    return $rslt;
  }



  /** Methode : Validation du code de creation de compte **/
  public function verifercodemodifmotpasse($code, $tel)
  {
    $rslt = Null;
    if (isset($code)) {
      $stmt = $this->connect->createCommand('SELECT id FROM ste_code WHERE code=:code AND status=:status AND genererPourTel=:genererPourTel')
        ->bindValues([':code' => $code, ':status' => '1', ':genererPourTel' => $tel])
        ->queryOne();
      if (isset($stmt) && $stmt != Null && $stmt != false && sizeof($stmt) > 0) { //Update le code
        $stmt = $this->connect->createCommand('UPDATE ste_code SET status=:status WHERE id=:id')
          ->bindValues([':status' => '2', ':id' => $stmt['id']])
          ->execute();
        $rslt = '2604';
      }
    }
    return $rslt;
  }


  /** Methode : Get all pays data **/
  public function getPays()
  {
    $rslt = Null;
    $rslt = $this->connect->createCommand('SELECT * FROM `da_pays` order by nomFr ASC ')
      ->queryAll();
    return $rslt;
  }



  /** Methode : analyser la validation du nom d'utilisateur **/
  public function checkuservalidation($username)
  {
    $email = Null;
    if (isset($username)) {
      $stmt = $this->connect->createCommand('SELECT email FROM ste_userauth WHERE userName=:user')
        ->bindValue(':user', $username)
        ->queryAll();
      if (isset($stmt) && sizeof($stmt) > 0) {
        $email = $stmt[0]['email'];
      } else
        $email = '1985';
    }
    return $email;
  }

  /** Methode : renvoyer la validity du compte existant a jouter **/
  public function getuseravailability($iduser, $testentite)
  {
    $entite = '2604';
    if (isset($iduser)) {
      $stmt = $this->connect->createCommand('SELECT idEntite FROM ste_userentite WHERE userauthId=:user and idEntite=:entite')
        ->bindValues([':user' => $iduser, ':entite' => $testentite])
        ->queryAll();
      if (isset($stmt) && sizeof($stmt) > 0) {
        $entite = $stmt[0]['idEntite'];
      }
    }
    return $entite;
  }

  /** Methode : renvoyer l'id uniq de l'utilisateur **/
  public function getuseruniqid($username)
  {
    $iduniq = '1985';
    if (isset($username)) {
      $stmt = $this->connect->createCommand('SELECT id FROM ste_userauth WHERE userName=:user')
        ->bindValue(':user', $username)
        ->queryAll();
      if (isset($stmt) && sizeof($stmt) > 0) {
        $iduniq = $stmt[0]['id'];
      }
    }
    return $iduniq;
  }


  /** Methode : get user type base on his id **/
  public function getusertype($user)
  {
    if (isset($user)) {
      $usertype = $this->connect->createCommand('select typeUser from ste_userauth where id=:id')
        ->bindValue(':id', $user)
        ->queryOne();
      if (isset($usertype) && sizeof($usertype) > 0)
        $usertype = $usertype['typeUser'];
    }
    return $usertype;
  }

  /** Methode : Renvoyer le libeller du type d'utilisateur **/
  public function libelle_typeuser($typeUser = '')
  {
    $rslt = $this->connect->createCommand('select typeUser from ste_usertype where id=:id')
      ->bindValue(':id', $typeUser)
      ->queryOne();
    if ($rslt) {
      return $rslt['typeUser'];
    }
    return;
  }

  /** Methode : renvoyer le tableau des type d'utilisateur **/
  public function getTbletypeuser()
  {
    $rsl = Null;
    $rslt = $this->connect->createCommand('SELECT * FROM ste_usertype ORDER BY id ASC')
      ->queryAll();
    return $rslt;
  }

  /** Methode : renvoyer les renseignements sur un service **/
  public function get_service_data($service_id = 0)
  {
    $rslt = $this->connect->createCommand('select * from ste_entite_hosto_services where id=:service_id')
      ->bindValue(':service_id', $service_id)
      ->queryOne();

    if ($rslt)
      return $rslt;
    return;
  }


  /** Methode : Check if user must change his passsword **/
  public function usermustechangepswrd($usr)
  {
    $mustchange = Null;
    if (isset($usr)) {
      $stmt = $this->connect->createCommand('SELECT mustchangepswrd FROM ste_userauth WHERE userName=:userName')
        ->bindValue(':userName', $usr)
        ->queryOne();
      if (isset($stmt)) {
        $mustchange = $stmt['mustchangepswrd'];
      }
    }
    return $mustchange;
  }



  /** FUNCTION : RENVOIS LE NOM & PRENOM DE L'UTILISATEUR **/
  public function UsrPnomNom($typeUser = Null, $idUniq = 0)
  {
    $pnomNom = $tbl = $chamNom = $chamPnom = $chamComp = Null;
    if (!empty($idUniq)) {
      switch ($typeUser) {
        case Yii::$app->params['santeyahka']:
          $champs = 'nom, prenom';
          $tbl = 'ste_usersanteyakah';
          $chamComp = 'idUniq';
          break;

        default:
          $champs = 'nom, prenom, genre';
          $tbl = 'ste_nonsteyakahbiodata';
          $chamComp = 'idUserAuth';
          break;
      }

      if (!empty($tbl)) {
        $connect = $this->connect;
        $rslt = $connect->createCommand('SELECT ' . $champs . ' FROM ' . $tbl . ' WHERE ' . $chamComp . '=:id')
          ->bindValue(':id', $idUniq)
          ->queryOne();
        if ($rslt) {
          $pnomNom = $rslt['prenom'] . '&nbsp;' . $rslt['nom'];
        }
      }
    }
    return $pnomNom;
  }


  #**************************************************************
  # FUNCTION :RENVOI LE NOM & LE PRENOM DE L'UTILIATEUR CONNECTED
  #**************************************************************
  public function nomPrenomUserauth($idUserauth)
  {
    $nomPrenom = Null;
    if (isset($idUserauth)) {
      # RECUPERONS LE TYPE D'UTILISATEUR EN FONCTION DE L'ID AUTHENTIFICATION
      $typeUser = mainClass::getTypeIdUniqUser($idUserauth);
      # RECUPERONS LE NOM DE LA TABLE AINSI QUE LE NOM DE LA COLUM CIBLE
      switch ($typeUser) {
        default:
          $tbleName = 'ste_nonsteyakahbiodata';
          break;
      }
      if (isset($tbleName)) {
        #PASSONS A LA REUETE SQL
        $connect = $this->connect;
        $rslt = $connect->createCommand('SELECT nom, prenom, titreprofessionel FROM ' . $tbleName . '
                                              WHERE idUserAuth=:idUserAuth ')
          ->bindValue(':idUserAuth', $idUserauth)
          ->queryOne();
        if (sizeof($rslt) > 0) {
          $nomPrenom = yii::$app->nonSqlClass->medecintitle($rslt['titreprofessionel']) . '&nbsp;' . $rslt['nom'] . '&nbsp;' . $rslt['prenom'];
        } else
          $nomPrenom = Null;
      } else
        $nomPrenom = Null;

    }
    return $nomPrenom;
  }


  /** Methode : Renvoie la denomination du type d'entite  **/
  public function entitetype_label($entitetype)
  {
    $rslt = Null;
    if (isset($entitetype) && sizeof($entitetype) > 0) {
      $rslt = $this->connect->createCommand('select nom from ste_typeentite where id=:id')
        ->bindValue('id', $entitetype)
        ->queryOne();
      if (sizeof($rslt) > 0)
        $rslt = $rslt['nom'];
    }
    return $rslt;
  }

  /** Methode : renvoie la liste des type entite **/
  public function allentitetype()
  {
    $rslt = $this->connect->createCommand('select * from ste_typeentite')
      ->queryAll();
    return $rslt;
  }

  /****************************************************/
  /** FUnction : recuperons le detail sur une entite **/
  /****************************************************/
  public function getEntiteDtls($typeEntite, $idEntite)
  {
    $hostoData = $joinedTble_suffix = Null;
    if (isset($idEntite) && isset($typeEntite)) {
      //Determinons la table et le change destinee a faire le join statement
      switch ($typeEntite) {
        case '2':
          $joinedTble_suffix = 'hosto';

          break;
      }
      $connect = $this->connect;
      $stmt = $connect->createCommand('SELECT ste_entite.id As entiteid, nom, ste_entite.enid, description, mode_traitement_pathologie, dteCreation, geoLocation, tel, adresse, email, directionType, directionDe
                                          FROM ste_entite
                                          JOIN ste_entite_' . $joinedTble_suffix . ' ON ste_entite_' . $joinedTble_suffix . '.id_entite = ste_entite.id
                                          WHERE ste_entite.id =:id')
        ->bindValue(':id', $idEntite)
        ->queryOne();
      if (sizeof($stmt) > 0) {
        $hostoData = json_encode($stmt);
      }
    }
    return $hostoData;
  }

  #*************************************************************
  # FUNCTION : RENVOIS LE NOM DE L'ENTITE EN FONCTION DE SON ID
  #************************************************************
  public function nomEntite($idEntite)
  {
    if (isset($idEntite)) {
      $connect = $this->connect;
      $rslt = $connect->createCommand('SELECT nom FROM ste_entite WHERE id =:id')
        ->bindValue(':id', $idEntite)
        ->queryOne();
      if (is_array($rslt)) {
        $nomEntite = $rslt['nom'];
      }
    } else
      $nomEntite = Null;
    return $nomEntite;
  }

  #*******************************************************
  # FUNCTION : LISTE DES ENTITES OU USER EST EN FUNCTIONS
  #*******************************************************
  public function activeEntiveUserEnFnct($tbleauEntiteUserEnFnct)
  {
    if (is_array($tbleauEntiteUserEnFnct)) {

      if (isset(Yii::$app->session[Yii::$app->params['activeEntiveUserEnFnct']])) { #### ACTIF ENTITE EST DEJA DANS LA SESSION
        $activeEntiveUserEnFnct = Yii::$app->session[Yii::$app->params['activeEntiveUserEnFnct']];
        #### LOOPONS LE TABLEAU DES HOPITAUX RECU EN PARAMETRE #####
        foreach ($tbleauEntiteUserEnFnct as $value) {
          if ($activeEntiveUserEnFnct == $value['idEntite']) {
            return $activeEntiveUserEnFnct;
          }
        }
      } else {
        Yii::$app->session->set(Yii::$app->params['activeEntiveUserEnFnct'], $tbleauEntiteUserEnFnct[0]['idEntite']);
        $activeEntiveUserEnFnct = Yii::$app->session[Yii::$app->params['activeEntiveUserEnFnct']];
      }
    } else
      $activeEntiveUserEnFnct = Null;

    Yii::$app->session->set(Yii::$app->params['activeEntiveUserEnFnct'], $activeEntiveUserEnFnct);
    return $activeEntiveUserEnFnct;
  }

  #*******************************************************
  # FUNCTION : LISTE DES ENTITES OU USER EST EN FUNCTIONS
  #*******************************************************
  public function tbleauEntiteUserFnct($userAuthId)
  {
    $data = Null;
    $connect = $this->connect;
    $rslt = $connect->createCommand('SELECT ent.nom, ent.tel, uent.idEntite, uent.jourrdv FROM ste_userentite uent
                                          JOIN ste_entite ent ON ent.id = uent.idEntite
                                          WHERE uent.userauthId =:userauthId
                                          AND userFntStat=:userFntStat')
      ->bindValues([':userauthId' => $userAuthId, ':userFntStat' => '1'])
      ->queryAll();
    if (is_array($rslt)) {
      $data = $rslt;
    }
    return $data;
  }



  #******************************************************************************************
  # FUNCTION : OPTION DU NIS : MODIFICATION DE L'ALGORITHME DE MAURICE KRAITCHIK (18882-1957)
  #******************************************************************************************
  public function steNIS($q = Null, $m = Null, $a = Null)
  {
    $Pcode = $Fcode = Null;
    $q = date('d');
    $m = date('m');
    $a = date('Y');
    # ON IDENTIFIE L'ANNEE
    switch ($a) {
      case 1:
        $a = 13;
        break;

      case 2:
        $a = 14;
        break;
    }
    # GENERONS LE PREMIER CODE
    $c1 = intVal(($m + 1) / 5);
    $c2 = intVal($a / 4);
    $c3 = intVal($a / 100);
    $c4 = intVal($a / 400);
    $c = $q + (2 * $m) + $c1 + $a + $c2 - $c3 + $c4 + 2;
    $Pcode = intVal($c / 7);
    return $Fcode = $Pcode . rand(111, 999) . $a;
  }


  //Methode : Retrouver un utilisateur par son username ou son email
  public function finduser($indice)
  {
    $rslt = Null;
    if (isset($indice) && !empty($indice)) {
      $rslt = $this->connect->createCommand('select id, telCompt from ste_userauth where (userName=:indice or email=:indice)')
        ->bindValue(':indice', $indice)
        ->queryOne();
    }
    return $rslt;
  }



  #**********************************
  # RENVOIS ID DU TYPE D'UTILISATEUR
  #**********************************
  public function getTypeIdUniqUser($idUniqUser)
  {
    $rslt = Null;
    $connect = $this->connect;
    if (!empty($idUniqUser)) {
      $stmt = $connect
        ->createCommand('SELECT typeUser FROM ste_userauth
                                   WHERE id=:idUniqUser')
        ->bindValue(':idUniqUser', $idUniqUser);
      $rslt = $stmt->queryOne();
      if (is_array($rslt)) {
        $rslt = $rslt['typeUser'];
      }
    }
    return $rslt;
  }

  #***************************************************************
  # RENVOIS LIST DES ID HOPITALS DONT CORPS MEDICAL EST EMBAUCHE
  #***************************************************************
  public function ListCorpMedHostos($idCorpsMed)
  {
    $connect = $this->connect;
    $rslt = Null;
    if (isset($idCorpsMed) && !empty($idCorpsMed)) {
      $rslt = $connect
        ->createCommand('SELECT idEntite, nom FROM ste_userentite USERENTITE
                                    JOIN
                                    ste_entite ENTITE ON USERENTITE.idEntite = ENTITE.id
                                   WHERE USERENTITE.userFntStat="1"
                                   AND USERENTITE.userauthId =:idMedHosto')
        ->bindValue(':idMedHosto', $idCorpsMed)
        ->queryAll();
    }
    return $rslt;
  }

  #***************************************************
  # RENVOIS TRUE SI TOKEN DU USER AUTHETIFIE EST VALID
  #***************************************************
  public function validiteToken($token)
  {
    if (!empty($token)) {
      $userSessionDtls = Yii::$app->session[Yii::$app->params['userSessionDtls']];
      $userAuthDtlsArray = unserialize($userSessionDtls);
      $userAuthToken = base64_encode(md5($userAuthDtlsArray['userName']));
      if ($token == $userAuthToken) {
        return true;
      } else
        return false;
    }
  }

  #************************************
  # RENVOIS LES DETAILS SUR UN SERVEUR
  #************************************
  public function renvoisDtlsServeur()
  {
    $server = $_SERVER;
    $str_array = array('PATH', 'PATHEXT', 'SystemRoot', 'SERVER_ADMIN', 'DOCUMENT_ROOT', 'SERVER_SOFTWARE', 'SERVER_SIGNATURE', 'CONTEXT_DOCUMENT_ROOT', 'COMSPEC', 'WINDIR', 'SCRIPT_FILENAME');
    foreach ($str_array as $key) {
      unset($server[$key]);
    }
    $server = serialize($server);
    return $server;
  }

  #************************************
  # ENREGISTRER L'EVENEMENT DANS LA DB
  #************************************
  public function creerEvent($eventCode, $eventDesc)
  {
    $server = $_SERVER;
    $str_array = array('PATH', 'PATHEXT', 'SystemRoot', 'SERVER_ADMIN', 'DOCUMENT_ROOT', 'SERVER_SOFTWARE', 'SERVER_SIGNATURE', 'CONTEXT_DOCUMENT_ROOT', 'COMSPEC', 'WINDIR', 'SCRIPT_FILENAME');
    foreach ($str_array as $key) {
      unset($server[$key]);
    }

    $server = serialize($server);
    $userSessionDtls = Yii::$app->session['userSessionDtls'];
    $userAuthDtlsArray = unserialize($userSessionDtls);
    #RENVOIS ID DU TYPE D'UTILISATEUR
    $typeUser = mainClass::getTypeIdUniqUser($userAuthDtlsArray['idUniqUser']);
    $infoUserAuth = mainClass::usersAuthInfos($typeUser, $userAuthDtlsArray['idUniqUser']);

    # DEBUT DETERMINER L'HOPITAL PAR DEFAULT OU ACTIF POUR LE CORPS MEDICAL QUI AUTHENTIFIE
    if (in_array($typeUser, Yii::$app->params['hostoUsr'])) { ### DETERMINER SI CORPS MEDICAL

      if (is_array($arrayCorpMedHostos = mainClass::ListCorpMedHostos($userAuthDtlsArray['idUniqUser']))) { ### DETERMINER LIST HOPITOS CORPS MEDICAL
        $actifHosto = mainClass::actifHopitoParmiHostos($arrayCorpMedHostos);
      } else
        $actifHosto = Null;

    } else
      $actifHosto = Null;

    # FIN DETERMINER L'HOPITAL PAR DEFAULT OU ACTIF POUR LE CORPS MEDICAL QUI AUTHENTIFIE

    # DETERMINONS ID DE L'ENTITE
    $idEntite = !empty(Yii::$app->session['activeEntiveUserEnFnct']) ? Yii::$app->session['activeEntiveUserEnFnct'] : Null;

    # INSERT CES VALEUR DANS LA DB : ste_eventdetails
    $connect = $this->connect;
    #$corpMedicalHosto = (!empty(Yii::$app->session[Yii::$app->params['medHost']])) ? Yii::$app->session[Yii::$app->params['medHost']] : Null;
    $rslt = $connect
      ->createCommand()->insert('ste_eventdetails', [
          'actorIdEntite' => $idEntite,
          'actorIdUserAuthType' => $userAuthDtlsArray['typeUser'],
          'actorIdUserAuth' => $userAuthDtlsArray['idUniqUser'],
          'eventTypeCode' => $eventCode,
          'eventDesc' => $eventDesc,
          'eventDte' => date('Y-m-d h:i:s'),
          'serverDtls' => $server
        ])
      ->execute();
    return true;

  }

  #***********************
  # RENVOIS TOUS LES PAYS
  #***********************
  public function renvTtPays()
  {
    $connect = $this->connect;
    $stmt = $connect
      ->createCommand('SELECT id, nom, monaie, telCode FROM dapay');
    $rslt = $stmt->queryAll();
    if (is_array($rslt) && count($rslt)) {
      return $rslt;
    }
  }

  #************************************
  # RENVOIS TOUS LES TYPES D'ACTIVITES
  #************************************
  public function renvEventType()
  {
    $connect = $this->connect;
    $stmt = $connect
      ->createCommand('SELECT * FROM eventtype');
    $rslt = $stmt->queryAll();
    if (is_array($rslt) && count($rslt)) {
      return $rslt;
    }
  }


  /** Methode : Renvois les antecedents d'un utilisateur/santeyakah **/
  public function usersantecedents($userauth)
  {
    $rslt = Null;
    if (isset($userauth)) {
      $rslt = $this->connect->createCommand('select * from ste_usersanteyakah_antecedents where idUniq=:idUniq')
        ->bindValue(':idUniq', $userauth)
        ->queryOne();
    }
    if ($rslt) {
      return $rslt;
    }
    return;
  }


  /** RENVOIS INFOS UTILISATEUR EN FONCTION : TYPE UTILISATEUR, ID UNIQUE D L'UTILISATEUR **/
  public function usersAuthInfos($typeUser, $userAuthId)
  {
    $typeUser = (isset($typeUser)) ? $typeUser : Null;
    $userAuthId = (isset($userAuthId)) ? $userAuthId : Null;
    $rslt = (isset($rslt)) ? $rslt : Null;
    $nomTle = $nomColum = Null;

    switch ($typeUser) {
      case '99': # Cas des Santeyahka
        $nomTle = 'usersanteyakah';
        $nomColum = 'idUniq';
        break;

      case '1': # Cas des Santeyahka
        $nomTle = 'usersanteyakah';
        $nomColum = 'id';
        break;

      default:
        $nomTle = 'nonsteyakahbiodata';
        $nomColum = 'idUserAuth';
        break;
    }
    # REQUETTE INFOS DES UTILISATEURS
    $connect = $this->connect;

    $stmt = $connect
      ->createCommand('SELECT * FROM ste_' . $nomTle . ' WHERE ' . $nomColum . ' =:userAuthId')
      ->bindValue(':userAuthId', $userAuthId);
    $rslt = $stmt->queryOne();
    if (is_array($rslt) && sizeof($rslt) > 0) {
      return $rslt;
    }
    return false;
  }

  //Methode : santeyakah save its own data
  public function createnewsanteyakah($request, $nis, $menu, $realpass, $cryptedPass, $dteLimitAccess, $actor = 0)
  {
    $rslt = $rslt1 = $rslt3 = $msg_alert = $msg = Null;
    if (isset($request) && !empty($request)) {
      $data = unserialize($request);

      //Identifions le nom d'utilisateur
      $username = isset($data['usrname']) && $data['usrname'] != "" ? $data['usrname'] : $nis;
      $stmt = $this->connect->createCommand('INSERT INTO ste_userauth (userName, motPasse, typeUser, dteCreation, dteLimit, statCmpt, telCompt, mustchangepswrd)
                                                  VALUES (:userName, :motPasse, :typeUser, :dteCreation, :dteLimit, :statCmpt, :telCompt, :mustchangepswrd)')
        ->bindValues([':userName' => $username, ':motPasse' => $cryptedPass, ':typeUser' => '1', ':dteCreation' => date('Y-m-d'), ':dteLimit' => $dteLimitAccess, ':statCmpt' => '1', ':telCompt' => $data['cnt'], ':mustchangepswrd' => '1']);
      $rslt = $stmt->execute();
    }

    if ($rslt) {
      # SELECTIONNER L'ID DE L'ENREGISTREMENT JUST EFFECTUER
      $stmt = $this->connect->createCommand('SELECT id FROM ste_userauth WHERE userName =:userName AND statCmpt=:statCmpt')
        ->bindValues([':userName' => $username, ':statCmpt' => '1']);
      $rslt1 = $stmt->queryOne();
    }

    #****************************************************************
    # INSERONS LES DONNNEES DANS LA TBLE DES UTILISATEURS SANTEYAKAH
    # - ANALYSONS SI LES CHAMPS DES INFOS SANITAIRES SONT REMPLIS
    #****************************************************************
    if (is_array($rslt1)) {


      //Convertir la date au format sql
      $datenaissance = Yii::$app->nonSqlClass->convert_date_to_sql_form($data['datenaissance'], 'D/M/Y');

      //initialiser l'id du patient
      $santeyahkaIdUniq = $rslt1['id'];


      //Enregistrer les infos relatives à la source de financement de sa PC
      $this->connect->createCommand('INSERT INTO ste_sateyahka_sourcefinancement_pc (
                                          code_sourcefinancement, 
                                          id_patient,
                                          nom_financier, 
                                          keyed_in_date, 
                                          keyed_in_by, 
                                          statut
              ) 
            VALUES (
                                          :code_sourcefinancement,
                                          :id_patient,
                                          :nom_financier,
                                          :keyed_in_date,
                                          :keyed_in_by,
                                          :statut
                    )
            ')

        ->bindValues([
          ':code_sourcefinancement' => $data['sourcefinancement'],
          ':id_patient' => $santeyahkaIdUniq,
          ':nom_financier' => $data['denomination_financier'],
          ':keyed_in_date' => date('Y-m-d'),
          ':keyed_in_by' => $actor,
          ':statut' => 1
        ])
        ->execute();


      //Determiner la profession
      $profession = ($data['profession'] == 'ZERO') ? $data['new1526profession'] : $data['profession'];

      # Demarrer l'insertion des données
      $rslt2 = $this->connect->createCommand('INSERT INTO ste_usersanteyakah 
              (
                        idUniq, NIS, nom, prenom, genre, 
                        
                        tel, cntCasUrgence, email,  
                        
                        dteNaiss, lieuNaiss, 
                        
                        profession, 
                        
                        stmatrimoniale, nbre_enfant,
                        
                        dteEnregitrement, 
                        
                        pays_residence, region_residence, prefecture_residence, adresse,

                        niveaudinstruction, lateralite, statut
              )

            VALUES (

                        :idUniq, :NIS, :nom, :prenom, :genre, 
                        
                        :tel, :cntCasUrgence,:email,  
                        
                        :dteNaiss, :lieuNaiss, 
                        
                        :profession, 
                        
                        :stmatrimoniale, :nbre_enfant,
                        
                        :dteEnregitrement, 
                        
                        :pays_residence, :region_residence, :prefecture_residence, :adresse,

                        :niveaudinstruction, :lateralite, :statut
                    )
            ')

        ->bindValues([

          ':idUniq' => $santeyahkaIdUniq,
          ':NIS' => $nis,
          ':nom' => $data['nom'],
          ':prenom' => $data['pnom'],
          ':genre' => $data['genre'],

          ':tel' => $data['cnt'],
          ':cntCasUrgence' => $data['cnt_urgence'],
          ':email' => $data['sonmail'],

          ':dteNaiss' => $datenaissance,
          ':lieuNaiss' => $data['lieunaissance'],

          ':profession' => $profession,

          ':stmatrimoniale' => $data['stmatrimoniale'],
          ':nbre_enfant' => $data['nbreenfant'],

          ':dteEnregitrement' => date('Y-m-d'),

          ':pays_residence' => $data['paysresidence'],
          ':region_residence' => $data['regionresidence'],
          ':prefecture_residence' => $data['prefectureresidence'],
          ':adresse' => $data['adresse'],

          ':niveaudinstruction' => $data['niveauscolaire'],
          ':lateralite' => $data['lateralite'],
          ':statut' => '1'
        ])

        ->execute();
    }
    #************************************************************************************************
    # INSERONS LES DONNNEES DANS LA TBLE :  DE MENUET ACTION DES SANTEYAKAH : ste_userauthmenuaction
    #************************************************************************************************
    if ($rslt2) {
      $rslt3 = $this->connect->createCommand('INSERT INTO ste_userauthmenuaction (
                                  idUniq, 
                                  idUserType,
                                  idEntite, 
                                  menu) 

                                  VALUES (:idUniq, 
                                    :idUserType, 
                                    :idEntite, 
                                    :menu)')

        ->bindValues([
          ':idUniq' => $santeyahkaIdUniq,
          ':idUserType' => '1',
          ':idEntite' => Null,
          ':menu' => $menu
        ])
        ->execute();
    }
    if ($rslt3) {
      #*****************************************************
      # INSERONS LES DONNNEES DANS LA TBLE :  D'EVENEMENTS :
      #*****************************************************
      Yii::$app->session->set(Yii::$app->params['tok2'], $_POST[Yii::$app->params['tok2']]);
      #### EVENEMENT : TYPE : CREATION COMPTE SANTEYAKAH ###
      $event_msg = 'newsanteyakahajouteavecsuccess' . $nis;
      Yii::$app->mainClass->creerEvent('005', $event_msg);
    }
    return $msg_alert;
  }

  //generateur de code 
  public function get_code()
  {

    $last_rec = $prefixe = $newCode = $genCode = Null;

    $last_rec = $this->connect->createCommand('SELECT code  from da_code  order by id desc limit 1')
      //  ->bindValues([':id'=>$id])
      ->queryOne();

    //Générer le nouveaux code                         
    if (isset($last_rec['code'])) {
      $last_rec = $last_rec['code'];
    }

    if (isset($last_rec) && ($last_rec != Null)) {
      $lastCode = substr($last_rec, 2, 6);
      $newCode = $lastCode + 1;

      if (strlen($newCode) == 1) {
        $genCode = "00000" . $newCode;
      } elseif (strlen($newCode) == 2) {
        $genCode = "0000" . $newCode;
      } elseif (strlen($newCode) == 3) {
        $genCode = "000" . $newCode;
      } elseif (strlen($newCode) == 4) {
        $genCode = "00" . $newCode;
      } elseif (strlen($newCode) == 5) {
        $genCode = "0" . $newCode;
      } else {
        $genCode = $newCode;
      }
    } else {
      $genCode = '00001';
    }
    return $genCode;
  }

  //generation du code
  public function genered_code($statut)
  {
    $code = Yii::$app->mainClass->get_code();

    $req = $this->connect->createCommand('INSERT INTO `da_code`(`code`,`statut`)
            VALUES (:code,:statut)')
      ->bindValues([':code' => $code, ':statut' => $statut])
      ->execute();
    return $code;
  }

  //verification de l'email
  public function verifie_mail($mail)
  {

    $verifie = false;
    $APIUrl = 'https://api.email-validator.net/api/verify';
    $Params = array('EmailAddress' => $mail, 'APIKey' => Yii::$app->params['keyvalidator']);

    $Request = http_build_query($Params, '', '&');
    $ctxData = array(
      'method' => "POST",
      'header' => "Connection: close\r\n" .
        "Content-Type: application/x-www-form-urlencoded\r\n" .
        "Content-Length: " . strlen($Request) . "\r\n",
      'content' => $Request
    );
    $ctx = stream_context_create(array('http' => $ctxData));

    try {
      //code...

      // send API request
      $result = json_decode(file_get_contents($APIUrl, false, $ctx));

      // check API result
      if ($result && $result->{'status'} > 0) {
        switch ($result->{'status'}) {
          // valid addresses have a {200, 207, 215} result code
          // result codes 114 and 118 need a retry
          case 200:
          case 207:
          case 215:
            $verifie = true;

            // 215 - can be retried to update catch-all status
            break;
          case 114:
            // greylisting, wait 5min and retry
            break;
          case 118:
            // api rate limit, wait 5min and retry
            break;
          default:
            $verifie = false;
            break;
        }
      } else {
        $verifie = false;
      }
    } catch (\Throwable $th) {
      $verifie = false;
    }
    return $verifie;

  }

  //envoi de mail

  public function envoi_mail($to, $content)
  {
    $verifie = null;
    $client = new Client([
      'base_uri' => "https://2k3q5l.api.infobip.com/",
      'headers' => [
        'Authorization' => "App 9c95c6d77e4bed3a07a0201522cd2799-1373c43a-e820-48b0-b63c-a12765c22789",
        'Content-Type' => 'multipart/form-data',
        'Accept' => 'application/json',
      ]
    ]);
    try {
      $response = $client->request(

        'POST',
        'email/2/send',
        [
          RequestOptions::MULTIPART => [
            ['name' => 'from', 'contents' => "jc224@selfserviceib.com"],
            ['name' => 'to', 'contents' => $to],
            ['name' => 'subject', 'contents' => 'This is a sample email subject'],
            ['name' => 'text', 'contents' => $content],
            ['name' => 'html', 'contents' => $this->render('')],
            // example how to attach a file
            /*[
                'Content-type' => 'multipart/form-data',
                'name' => 'file',
                'contents' => fopen('/tmp/testfile.pdf', 'r'),
                'filename' => 'testfile.pdf',
            ],*/
          ],
        ]
      );
      echo ("HTTP code: " . $response->getStatusCode() . PHP_EOL);
      echo ("Response body: " . $response->getBody()->getContents() . PHP_EOL);

      $verifie = true;
    } catch (\Throwable $th) {
      $verifie = false;
    }
    //  return $verifie;
  }

  // Enregistrement de l'admin de l'établissement  
  public function create_admin_user_ent($code, $identifiant = "", $motPass = "", $typeUser = "", $menuAction = "")
  {
    $query = null;
    try {

      $motPassCrypte = Yii::$app->accessClass->create_pass($identifiant, $motPass);

      // $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $this->connect->createCommand('INSERT INTO atext.userauth(code,identifiant,motPass,modifierMotPass,typeUser,menuAction,statut,userActif) 
                                                  VALUES(:code,:identifiant,:motPass,:modifierMotPass,:typeUser,:menuAction,:statut,:userActif)')
        ->bindValues([':code' => $code, ':identifiant' => $identifiant, ':motPass' => $motPassCrypte, ':modifierMotPass' => '0', ':typeUser' => $typeUser, ':menuAction' => $menuAction, ':statut' => '1', ':userActif' => '0'])
        ->execute();
    } catch (\PDOException $ex) {

    }
  }


  // fonction de génération du code qr
  public function genered_qrcode($nom, $prenom, $ets, $tel, $mat, $gs, $allergie, $reference)
  {
    $dataEncode = "
             *** Detenteur / rice *** %0A
            Nom : $nom $prenom %0A
            Société : $ets %0A
            Tel : $tel %0A
            Mat : $mat %0A
            Groupe Sanguin : $gs %0A
            Allergie(s) : $allergie %0A%0A


             **** Autres Infos *** %0A
            
      ";
    foreach ($reference as $key => $value) {
      $dataEncode .= $value['libelle'] . ":  " . $value['contenue'] . " %0A";
    }
    $imgSize = "150x150";
    $url = "http://api.qrserver.com/v1/create-qr-code/?data=" . $dataEncode . "&size=" . $imgSize;
    return $url;

  }

  // Fonction qui calcule la difference de jour entre deux date 

  public function getNbDaybetweenTwoDate($validateDate)
  {
    $firstDate = new \DateTime($validateDate);
    $secondDate = new \DateTime(date('Y-m-d'));
    $intVal = $firstDate->diff($secondDate);
    if ($intVal->d >= 3) {
      return true;
    } else {
      return false;
    }
  }


  // Methode de selection des parents de l'encadré
  public function getpersonelBadgeData($codeIndividu, $codeAnneeScolaire, $codeEts, $codeClasse)
  {
    $query = null;
    try {
      $query = $this->connect->createCommand('SELECT * FROM da_badge  WHERE da_badge.codeIndividus = :code
                                              AND da_badge.codeClasse = :codeClasse
                                              AND da_badge.codeAnneeScolaire = :codeAnneeScolaire
                                              AND  da_badge.codeEts =  :codeEts')
        ->bindValues([':code' => $codeIndividu, ':codeClasse' => $codeClasse, ':codeEts' => $codeEts, ':codeAnneeScolaire' => $codeAnneeScolaire])
        ->queryOne();

    } catch (\Throwable $th) {
      die($th->getMessage());
    }
    if ($query != null)
      return $query;
    return;
  }

  /** Methode : enregistre le nouveau codebar genere **/
  public function saveBarcodeTag($tag, $numero)
  {
    $rslt = $this->connect->createCommand('INSERT INTO  individus.barcode_tag(tag, numero) VALUES(:tag, :numero)')
      ->bindValues([':tag' => $tag, ':numero' => $numero])
      ->execute();
    return;
  }

  /** Methode : Charger le code de l'annee active **/
  public function getLastTagAndNumber()
  {
    $rslt = $this->connect->createCommand('SELECT tag, numero FROM individus.barcode_tag ORDER BY id DESC LIMIT 1')
      ->queryOne();
    if ($rslt)
      return $rslt;
    $rslt['tag'] = 'AA';
    $rslt['numero'] = '0';
    return $rslt;
  }

  // Selectionner la bonne combinaison du code codeAlpha
  public function checkAvalaibleAlphabet($codeAlpha, $alphabet, $number)
  {
    $value = "";
    for ($i = 0; $i < sizeof($alphabet); $i++) {
      for ($j = 0; $j < sizeof($alphabet); $j++) {
        $value = $alphabet[$i] . '' . $alphabet[$j];
        if ($codeAlpha == $value) {
          echo 'hello code alpha trouvé';
          if ($number == "9999") {
            $value = $alphabet[$i] . '' . $alphabet[$j + 1];
          }
          return $value;
        }
      }
    }
  }


  // selectionner le bon numero et concatener avec le code codeAlpha
  public function checkAvlaibleNumber($number, $value)
  {
    $NumericNumber = intVal($number);
    $NumericNumber++;
    if ($number == "9999") {
      $NumericNumber = 1;
    }
    $stringNumber = strval($NumericNumber);
    switch (strlen($stringNumber)) {
      case 1:
        $result = $value . '000' . $stringNumber;
        break;
      case 2:
        $result = $value . '00' . $stringNumber;
        break;
      case 3:
        $result = $value . '0' . $stringNumber;
        break;
      case 4:
        $result = $value . '' . $stringNumber;
        break;
    }
    return ['barcode' => $result, 'tag' => $value, 'value' => $stringNumber];

  }

  // gerneration du codebare
  public function generUniqueBarcode()
  {
    $barcodeTag = mainClass::getLastTagAndNumber();
    $number = $barcodeTag['numero'];
    $codeAlpha = $barcodeTag['tag'];

    $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    // $number = "99";
    $value = mainClass::checkAvalaibleAlphabet($codeAlpha, $alphabet, $number);
    $data = mainClass::checkAvlaibleNumber($number, $value);
    // var_dump($barcode); die('');
    return $data;

  }

}
