<?php
namespace app\components;

use yii;
use yii\base\component;
use yii\web\controller;
use yii\base\invalidconfigexception;

class menuactionClass extends Component
{

  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }

  #***********************************************
  # RENVOIS ACTIVE SI MENU CONTIENT ACTIVE ACTION
  #***********************************************
  public function colorActiveMenu($menuAction, $identifier)
  {

    switch ($identifier) {
      #****************************************************************
      # IDENTIFICATION DU TYPE DE MENU : SIMPLE MENU OU AVEC SOUS MENU
      #****************************************************************
      case 1: # CASE DE SIMPLE MENU
        if (isset($menuAction)) {
          if (Yii::$app->controller->id . '_' . Yii::$app->controller->action->id == $menuAction) {
            return "here show menu-here-bg";
          }
        }
        break;

      case 2: # CAS DES SUB / MENUS
        for ($i = 1; $i < sizeof($menuAction); $i++) {
          #*************************************************************
          # ANALYSE SI LE SUB_MENU CLIQUER EST AUTORISER A L'UTILISATEUR
          #*************************************************************
          if ($menuAction[$i] == Yii::$app->controller->id . '_' . Yii::$app->controller->action->id) {
            return "here show menu-here-bg";
          }
        }
        break;

      default:
        return Null;
        break;
    }
    return Null;
  }


  #*****************************************
  # RENVOIS LA CHAINE DE CHARACTERE DE MENU
  #*****************************************
  public function menuString($codeUser)
  {
    $typeuser = menuactionClass::gettypeuser($codeUser);
    // dd($typeuser);
    $menuArray = 'site_index';

    if ($typeuser != null) {
      try {
        $rslt = $this->connect->createCommand('SELECT  action
        FROM authentification.typeuser where code=:code ')
          ->bindValue(':code', $typeuser)
          ->queryOne();
      } catch (\Throwable $th) {
        die(var_dump($th->getMessage()));
      }


      if (is_array($rslt)) {
        return $rslt['action'];
      }
    }

    return $menuArray;
  }

  public function actionMenu()
  {
    // $userCode = unserialize(Yii::$app->session[Yii::$app->params['userSession']])['userCode'];

    // $menuString = menuactionClass::menuString($userCode);
    // die(var_dump($menuString));
    $menuString = Yii::$app->params['menuadmin'];

    if (isset($menuString)) {
      $ajaxAction = Yii::$app->params['ajaxActions'];

      $menuArray = explode(Yii::$app->params['menuSeperator'], $menuString); # ON FORME LA LIGNE PRICI[ALE DES MENUS

      foreach ($menuArray as $value) {
        $subMenuArray = explode(Yii::$app->params['subMenuSeperator'], $value);

        if (!(in_array($subMenuArray[0], $ajaxAction))) {
          $cont = Yii::$app->controller->id;
          if ($subMenuArray[0] ==$cont) {
             
            for ($i = 1; $i < sizeof($subMenuArray); $i++) {
              if (!(in_array($subMenuArray[$i], $ajaxAction))) {
                if (!empty($subMenuArray[$i])) {
                                                    // die(var_dump($subMenuArray));a

                echo '
                              <div class="menu-item  ' . menuactionClass::colorActiveMenu($subMenuArray, 2) . '">
                              <!--begin:Menu link-->
                              <a class="menu-link" href="' . Yii::$app->request->baseUrl . '/' . md5($subMenuArray[$i]) . '">
                                <span class="menu-bullet">
                                  <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">' . Yii::t("app", $subMenuArray[$i]) . '</span>
                              </a>
                              <!--end:Menu link-->
                            </div>
                            ';
              }
            }
            }

          }


        }
      }
    }


  }



  public function gettypeuser($codeUser)
  {
    $verifiemail = Yii::$app->configClass->getuserbycode($codeUser);
    $codeproduit = yii::$app->params['produitcode'];
    // die(var_dump($verifiemail));
    try {
      $rslt = $this->connect->createCommand('SELECT  typeuser
      FROM authentification.lien_user_partenaire_prod where codeindividus=:codeindividus and codeproduit=:codeproduit  and codepartenariat=:codepartenariat')
        ->bindValues([':codeproduit' => $codeproduit, ':codepartenariat' => $verifiemail['codepartenariat'], ':codeindividus' => $codeUser])
        ->queryOne();
      if ($rslt)
        return $rslt['typeuser'];
      return;
    } catch (\Throwable $th) {
      //throw $th;
    }

  }

  #**********************
  # CONSTRUCTEUR DE MENU
  public function menuConstructeur($codeUser = '')
  {
    $subMenu = $menuString = Null;
    $menuString = Yii::$app->params['menuadmin'];

    if (isset($menuString)) {
      $ajaxAction = Yii::$app->params['ajaxActions'];
      $menuArray = explode(Yii::$app->params['menuSeperator'], $menuString); # ON FORME LA LIGNE PRICI[ALE DES MENUS
      foreach ($menuArray as $value) {

        /* Empechons la vue des actions ajax */
        $subMenuArray = explode(Yii::$app->params['subMenuSeperator'], $value);
        if (!(in_array($subMenuArray[0], $ajaxAction))) {
          if (is_array($subMenuArray) and sizeof($subMenuArray) > 2) {
            # DANS CE CAS , CEST UN MENU AVEC SOUS MENU


            echo '
                <div data-kt-menu-trigger="{default: \'click\', lg: \'hover\'}"
                data-kt-menu-placement="bottom-start" data-kt-menu-offset="22,0"
                class=" menu-item  ' . menuactionClass::colorActiveMenu($subMenuArray, 2) . ' menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-4 text-center">
                <!--begin:Menu link-->
                <span class="menu-link">
                  <span class="menu-icon">
                  ' . menuactionClass::getIcon($subMenuArray[0]) . '
                  </span>
                  <span class="menu-title fs-6 " >' . Yii::t("app", $subMenuArray[0]) . '</span>
                  <span class="menu-arrow d-lg-none"></span>
                </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">';
            for ($i = 1; $i < sizeof($subMenuArray); $i++) {
              if (!(in_array($subMenuArray[$i], $ajaxAction))) {
                if (!empty($subMenuArray[$i])) {
                  echo '
                              <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="' . Yii::$app->request->baseUrl . '/' . md5($subMenuArray[$i]) . '">' . Yii::t("app", $subMenuArray[$i]) . '
                                </a>
                              </div>
                            ';

                }
              }
            }

            echo '
                      </div>
                  </div>';
          } else {
            if (isset($value) && !empty($value)) {
              // die(var_dump($value));

              echo '
                  <div
                  data-kt-menu-placement="bottom-start" data-kt-menu-offset="-220,0" class="menu-item   ' . menuactionClass::colorActiveMenu($value, 1) . '  menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                  <!--begin:Menu link-->
    
                  <a class="menu-link"  href="' . Yii::$app->request->baseUrl . '/' . md5($value) . '">
                      <span class="menu-icon">
    
                      ' . menuactionClass::getIcon($value) . '
                 
                      </span>
                      <span class="menu-title">' . Yii::t("app", $subMenuArray[0]) . '</span>
                      <span class="menu-arrow d-lg-none"></span>
                  </a>
            
                  <!--end:Menu link-->
                  <!--begin:Menu sub-->
    
                </div>';

            }
          }
        }
      }
      ;
    }
  }



  // RENVOIS TITRE DE PAGE EN FONCTION DE CONTROLLER ID
  public function getPageTitle($controllerId)
  {
    $pTitle = Null;
    if (!empty($controllerId)) {
      switch ($controllerId) {

        case 'bondcommand':
        case 'bondcommand_themain':
          $pTitle = Yii::t('app', 'bondcommand_themain');
          break;

      }
    }
    return $pTitle;
  }

  // RENVOIS LES DIFFERENTS ICONS DU MENU
  public function getIcon($controller)
  {
    $icon = Null;
    switch ($controller) {


      case 'site_index':
        return '<i class="fa fa-home fs-1 " aria-hidden="true " style="margin-right :10px;"></i> ';
        break;


      case 'config':
        // return '<i class="bi bi-gear fs-2x "></i>';
        return '<i class="bi bi-gear fs-2 "></i>

        ';
        break;

      case 'produit':
        return '<i class="ki-duotone ki-
          shop                        ">
<span class="path1"></span>
<span class="path2"></span>
<span class="path3"></span>
<span class="path4"></span>
<span class="path5"></span>
</i>';
        break;


    }
    return $icon;
  }




}