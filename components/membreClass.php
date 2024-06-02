<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class membreClass extends component
{

 // fonction de ajouter membres
 public function addActivites ($code, $nom, $dateac,$lieu,$description,$photo)
 {
     try {
         $query = $this->connect->createCommand("INSERT INTO activites(code, nom, dateac,lieu,description,photo)
         VALUES (:code,:nom,:dateac,:lieu, :description, :photo)")
      ->bindValues([':code' => $code, ':nom' => $nom, ':dateact' => $dateac, ':lieu' => $lieu, ':description' => $description, ':photo' => $photo])
      ->execute();

     } catch (\Throwable $th) {
         die($th->getMessage());
     }

 }

    public $connect = Null;

    public function __construct()
    {
        $this->connect = \Yii::$app->db;
    }

    // fonction pour les limites 
    public function getRealLimit($limit)
  {
    $rLimit = Null;
    if (isset($limit)) {
      switch ($limit) {
        case 1:
          $rLimit = 10;
          break;
        case 2:
          $rLimit = 20;
          break;
        case 3:
          $rLimit = 30;
          break;
        case 4:
          $rLimit = 40;
          break;
        case 5:
          $rLimit = 50;
          break;
        case 10:
          $rLimit = 10000;
          break;
      }
    }
    return $rLimit;
  }


  // fonction de ajouter membres
    public function addMembres ($code, $nom, $prenom,$email,$sexe,$tel,$adresse,$photo)
    {
        try {
            $query = $this->connect->createCommand("INSERT INTO membres(code, nom, prenom,email,sexe,tel,adresse,photo)
            VALUES (:code,:nom,:prenom,:email, :sexe, :tel, :adresse, :photo)")
         ->bindValues([':code' => $code, ':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':sexe' => $sexe, ':tel' => $tel, ':adresse' => $adresse, ':photo' => $photo])
         ->execute();
   
        } catch (\Throwable $th) {
            die($th->getMessage());
        }

    }

    // ******************* requette de select des membres ******************************************
   
    public function listeMembres()
    {
        try {
        $req = $this->connect->createCommand('SELECT * FROM membres WHERE  statut=1 ORDER BY id DESC')
        ->queryAll();
        return $req;
        } catch (\Throwable $th) {
        return $th->getMessage();
        }
    
    }

    public function getmembretdata($id)
    {
        $rslt = Null;
        if (isset($id)) {
            $stmt = $this->connect->createCommand('SELECT * FROM membres WHERE code=:id')
            ->bindValue(':id', $id)
            ->queryOne();
            if (sizeof($stmt) > 0) {
            $rslt = $stmt;
            }
        }
        return $rslt;
    }

    public function modifierMembre($data = '', $apprenant, $photo = '')
    {

        try {
        $rslt = $this->connect->createCommand('UPDATE membres SET nom=:nom, prenom=:prenom,email=:email,adresse=:adresse,tel=:tel,etat=:etat,photo=:photo WHERE code=:code')
        ->bindValues([':photo'=>$photo,':code' => $apprenant, ':email' => $data['email'], ':tel' => $data['tel'], ':nom' => $data['nomc'], ':prenom' => $data['nomcp'], ':adresse' => $data['adresse'],':etat' => $data['etat']])
        ->execute();
        return true;
        } catch (\Throwable $th) {
        die(var_dump($th->getMessage()));
        }
    
    }

}
