<?php

  namespace app\components;
  use Yii;
  use yii\base\component;
  use yii\web\Controller;
  use yii\base\InvalidConfigException;
  Class fournisseurClass extends Component 
  {
    public $connect = Null;

    Public function __construct(){
        $this->connect = \Yii::$app->db;
    }


    //verifier l'unicite d'un client
    public function unifournissurs($tel,$raisonsociale,$email){
      try {
        $req = $this->connect->createCommand('SELECT * FROM countbook.fournisseur WHERE (telephone=:tel or email=:email) and raison_sociale=:raisonsociale')
        ->bindValues([':raisonsociale'=>$raisonsociale, ':tel'=>$tel,':email'=>$email])
        ->queryOne();
        if($req){  return false;
        }else{
        return true;}
      return  $req ;
      } catch (\Throwable $th) {
          return $th->getMessage();
      }
    }



    /** Methode : charger les informations concernant un fournisseur **/
    public function get_fournisseur($fournisseur_id='')
    {
      $rslt = $this->connect->createCommand('select * from countbook.fournisseur where id=:id')
      ->bindValue(':id', $fournisseur_id)
      ->queryAll();
      if($rslt) return $rslt;
      return;
    }

    /** Methode : enregistrer les modifications renseignements généraux **/
    public function update_renseignement_gnr($data='', $fournisseur='', $idactor='')
    {
      $rslt = Null;
      if(isset($data) && is_array($data))
      {
        $rslt = $this->connect->createCommand('update countbook.fournisseur set raison_sociale=:raison_sociale,  telephone=:telephone, adresse_physique=:adresse_physique,  codeuser=:idactor where code=:id')
        ->bindValues([':id'=>$fournisseur,':idactor'=>$idactor, ':adresse_physique'=>$data['Adresse'], ':telephone'=>$data['Tel'], ':raison_sociale'=>$data['rsociale']])
        ->execute();
      }
      if($rslt) return $rslt;
      return;
    }


    /** Methode : Charger les renseignements sur un fournisseur **/
    public function charger_fournisseur($fournisseur='')
    {
      $rslt =  $this->connect->createCommand('select * from countbook.fournisseur where code=:id')
      ->bindValue(':id', $fournisseur)
      ->queryOne();
      return $rslt;
    }

    /** Methode : Charger la liste des fournisseurs **/
    public function lister_fournisseurs($codeentite ='', $donneeRecherche='', $limit='')
    {
      $limit = Yii::$app->catalogClass->getRealLimit($limit);
      if(isset($limit) && $limit >0){
        $limit = 'LIMIT '.$limit;
      }

      $rslt = $this->connect->createCommand('select * from countbook.fournisseur where statut=:statut and codeentite=:codeentite AND (raison_sociale LIKE :donneerecherche
                                                          OR telephone LIKE :donneerecherche
                                                          OR email LIKE :donneerecherche) '.$limit)
      ->bindValues([':codeentite'=>$codeentite, ':statut'=>1, ':donneerecherche'=>'%'.$donneeRecherche.'%'])
      ->queryAll();
      return $rslt;
    }

        /** Methode : Charger la liste des fournisseurs **/
        public function allfournisseure($codeentite)
        {
          
          $rslt = $this->connect->createCommand('SELECT * from countbook.fournisseur 
                    where statut=:statut and codeentite=:codeentite ')
          ->bindValues([':codeentite'=>$codeentite, ':statut'=>1])
          ->queryAll();
          return $rslt;
        }

    /** Methode : Enregistrer un nouveau fournisseur **/
    public function enregisrer_fourn($code,$data='', $codeuser='', $codeentite='',$photo='')
    {
   
      try {
        $rslt = $this->connect->createCommand('insert into countbook.fournisseur (code,raison_sociale, telephone, email, codeentite, codeuser, ajouter_le,photo,adresse_physique) values (:code,:raison_sociale, :telephone, :email, :codeentite, :codeuser, :ajouter_le,:photo,:adresse_physique)')

        ->bindValues([':code'=>$code,':ajouter_le'=>date('Y-m-d'), ':codeuser'=>$codeuser , ':codeentite'=>$codeentite,':adresse_physique'=>$data['Adresse'],  ':email'=>$data['email'], ':telephone'=>$data['Tel'], ':raison_sociale'=>$data['rsociale'],':photo'=>$photo])
        ->execute();
        
        return true;
      } catch (\Throwable $th) {
         return  $th->getMessage();
      }
    }

    /** Methode : Check si les datas envoyees sont news **/
    public function fournisseur_est_nouveau($request='', $entreprise_id=null)
    {
      $rslt = $this->connect->createCommand('select * from countbook.fournisseur where entreprise_id=:entreprise_id and telephone=:telephone and denomination=:denomination')
      ->bindValues([':denomination'=>$request['denomination'], ':entreprise_id'=>$entreprise_id, ':telephone'=>$request['telephone']])
      ->queryOne();
      if(isset($rslt)) return '2604';
      return;
    }
  }