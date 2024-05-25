<?php

namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;

class notificationCLass extends Component
{
  public $connect = Null;

  public function __construct()
  {
    $this->connect = \Yii::$app->db;
  }
  public function insertMessage($code, $message, $codeEntite, $type, $acteur)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO atext.notification(code, codeEntite, message,type,dateEnvoi,acteur) 
                                             VALUES (:code, :codeEntite, :message,:type,:dateEnvoi,:acteur)")
        ->bindValues([':code' => $code, ':codeEntite' => $codeEntite, ':message' => $message, ':type' => $type, ':dateEnvoi' => date('Y-m-d'), ':acteur' => $acteur])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selectEvenement($codeuser)
  {
    try {
      $query = $this->connect->createCommand("SELECT   evenement.nomeven as title,datefin as end,   
                                datedebut as start,heurefin,heureebut
                             from atext.evenement where  atext.evenement.codeuser =:codeuser")
        ->bindValue(':codeuser', $codeuser)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }




  public function insertevenement($code, $nomeven, $codeEntite, $description, $datedebut, $datefin, $heureebut, $heurefin, $codeuser)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO atext.evenement (code,codeentite,nomeven,description,datedebut,datefin,heureebut,heurefin,codeuser)
                              values(:code,:codeentite,:nomeven,:description,:datedebut,:datefin,:heureebut,:heurefin,:codeuser)")
        ->bindValues([':code' => $code, ':codeentite' => $codeEntite, ':nomeven' => $nomeven, ':description' => $description, ':datedebut' => $datedebut, ':datefin' => $datefin, ':heureebut' => $heureebut, ':heurefin' => $heurefin, ':codeuser' => $codeuser])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function insertMessagedirect($code, $codepersonnel, $message, $codeEntite, $type, $acteur)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO atext.messagedirect(code,codepersonnel, codeEntite, message,type,dateEnvoi,acteur) 
                                             VALUES (:code, :codepersonnel,:codeEntite, :message,:type,:dateenvoi,:acteur)")
        ->bindValues([':code' => $code, ':codepersonnel' => $codepersonnel, ':codeEntite' => $codeEntite, ':message' => $message, ':type' => $type, ':dateenvoi' => date('Y-m-d'), ':acteur' => $acteur])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function addEntite($code, $codeEntite, $libelle, $acteur)
  {
    try {
      $query = $this->connect->createCommand("INSERT INTO atext.groupe(code, codeentrprise, libelle,acteur,dateajout) 
                                             VALUES (:code, :codeentrprise, :libelle,:acteur,:dateajout)")
        ->bindValues([':code' => $code, ':codeentrprise' => $codeEntite, ':libelle' => $libelle, ':acteur' => $acteur, ':dateajout' => date('Y-m-d')])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function addpersgroupe($code, $codegroupe, $codepersonnel)
  {
    try {
      $query = $this->connect->createCommand("INSERT into atext.lien_personnel_groupe (code,codegroupe,codepersonnel)
                                             VALUES (:code, :codegroupe, :codepersonnel)")
        ->bindValues([':code' => $code, ':codegroupe' => $codegroupe, ':codepersonnel' => $codepersonnel])
        ->execute();
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function select($codeentite)
  {
    try {
      $query = $this->connect->createCommand("SELECT * from atext.notification WHERE codeentite=  :codeentite 
    order by notification.dateenvoi  asc  LIMIT 20")
        ->bindValue(':codeentite', $codeentite)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function countMembre($groupe)
  {
    try {
      $query = $this->connect->createCommand("SELECT count(atext.lien_personnel_groupe.codepersonnel)  as membre from
            atext.lien_personnel_groupe
            where atext.lien_personnel_groupe.codegroupe=:groupe")
        ->bindValue(':groupe', $groupe)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function Msgdirect($codeEntite)
  {
    try {
      $query = $this->connect->createCommand("SELECT nom ,prenom,photo,message , dateenvoi  ,type
                          from atext.messagedirect,atext.personnel
                          where atext.personnel.code = atext.messagedirect.codepersonnel
                          AND atext.messagedirect.codeEntite=:codeEntite
                          limit 15 ")
        ->bindValue(':codeEntite', $codeEntite)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }


  public function comptMessage($codegroupe)
  {
    try {
      $query = $this->connect->createCommand("SELECT count(atext.lien_groupe_notification.code) as messge from 
                                      atext.lien_groupe_notification where atext.lien_groupe_notification.codegroupe=:codegroupe")
        ->bindValue(':codegroupe', $codegroupe)
        ->queryOne();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }




  public function selectGroupe($codeEntite, $statut)
  {
    try {
      $query = $this->connect->createCommand("SELECT * from atext.groupe WHERE statut = :statut and codeentrprise=:codeentrprise")
        ->bindValues([':statut' => $statut, ':codeentrprise' => $codeEntite])
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      die($th->getMessage());
    }
  }

  public function selecpesrnonnelGroup($code)
  {
    try {
      $query = $this->connect->createCommand("SELECT * from atext.personnel ,atext.lien_personnel_groupe
                              where atext.personnel.code = lien_personnel_groupe.codepersonnel
                              and lien_personnel_groupe.codegroupe=:code ")
        ->bindValue(':code', $code)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return ($th->getMessage());
    }
  }


  public function addmessagegroup($code, $codegroupe, $message, $codeentite, $type, $acteur)
  {
    try {
      $query = $this->connect->createCommand("INSERT into  atext.lien_groupe_notification (code,codegroupe,message,type,dateenvoi,acteur,codeentite)
                                             VALUES (:code,:codegroupe,:message,:type,:dateenvoi,:acteur,:codeentite)")
        ->bindValues([':code' => $code, ':codegroupe' => $codegroupe, ':message' => $message, ':type' => $type, ':dateenvoi' => date('Y-m-d'), ':acteur' => $acteur, ':codeentite' => $codeentite])
        ->execute();
    } catch (\Throwable $th) {
      return ($th->getMessage());
    }
  }


  public function selecallmessagegroupe($codegroupe)
  {
    try {
      $query = $this->connect->createCommand("SELECT * from  atext.lien_groupe_notification
                            where  lien_groupe_notification.codegroupe=:codegroupe 
                            ORDER BY lien_groupe_notification.id desc   ")
        ->bindValue(':codegroupe', $codegroupe)
        ->queryAll();
      return $query;
    } catch (\Throwable $th) {
      return ($th->getMessage());
    }
  }

}


