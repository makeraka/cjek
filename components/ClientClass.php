<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class ClientClass extends Component {
    public $connect = Null;

    public function __construct()
    {
        $this->connect = \Yii::$app->db;
    }

    // fonction qui permet d'ajouter un client
    public function addClient (){}

}