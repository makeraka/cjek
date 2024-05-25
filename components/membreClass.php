<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class membreClass extends component
{
    public $connect = Null;

    public function __construct()
    {
        $this->connect = \Yii::$app->db;
    }

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
}
