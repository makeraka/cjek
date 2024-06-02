<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;

class activiteClass extends Component
{
    public $connect = Null;

    public function __construct()
    {
        $this->connect = \Yii::$app->db;
    }



    public function addActivites($code, $nom, $dateac,$lieu,$description,$photo)
    {
        try {
            $query = $this->connect->createCommand("INSERT INTO activites(code, nom, dateac,lieu,description,photo)
            VALUES (:code,:nom,:dateac,:lieu, :description, :photo)")
         ->bindValues([':code' => $code, ':nom' => $nom, ':dateac' => $dateac, ':lieu' => $lieu, ':description' => $description, ':photo' => $photo])
         ->execute();
   
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }


    // ******************* requette de select des membres ******************************************
   
    public function listeActivites()
    {
        try {
        $req = $this->connect->createCommand('SELECT * FROM activites WHERE  statut=1 ORDER BY id DESC')
        ->queryAll();
        return $req;
        } catch (\Throwable $th) {
        return $th->getMessage();
        }
    
    }

}
