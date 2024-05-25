<?php
namespace app\components;

use Yii;
use yii\base\component;
use yii\web\Controller;
use yii\base\InvalidConfigException;


class ProductClass extends Component
{

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

    // requette qui permet d'ajouter un produit
    public function addproduct($libelle,$prix,$desctiption,$photo,$dateajout,$motcle,$code,$cdegroupe,$codecategorie)
    {

        try {
            $req = $this->connect->createCommand('INSERT INTO icopub.produit(libelle, prixunitairevente, description, photo, dateajout, motcle,code, codegroupe, category)
        	VALUES (:libelle,:prixunitairevente,:description,:photo,:dateajout, :motcle, :code,:codegroupe,:category);')
          ->bindValues([':libelle' => $libelle,':prixunitairevente' => $prix, ':description' => $desctiption,'photo'=>$photo,'dateajout'=>$dateajout, ':motcle' => $motcle, ':code' => $code, ':codegroupe' => $cdegroupe, ':category' => $codecategorie])
          ->execute();

        } catch (\Throwable $th) {
            return ($th->getMessage());
        }

    }




 public function addrefproduit($code, $idprod, $idref, $contenue)
  {
    $query = null;
    $id = '19';
    try {
      $insertStmt = $this->connect->createCommand('INSERT INTO  icopub.reference_produit (code,codeprod, coderef, contenue) VALUES (:code,:idprod, :idref, :contenue)')
        ->bindValues(['code' => $code, ':idprod' => $idprod, ':idref' => $idref, ':contenue' => $contenue])
        ->execute();
    } catch (\PDOException $ex) {
      return $ex->getMessage();
    }
  }


    public function listeproduct()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.produit WHERE  statut=1 ORDER BY id DESC')
      ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }








    /* *************************************************************************************************************
                                FONCTION DE GROUPE DE PRODUIT
    ***************************************************************************************************************/

// fonction d'ajouter un groupe de produit
public function addGroupe($code, $productGroupName,$productGroupDesc)
{
 
  try {
    $req = $this->connect->createCommand('INSERT INTO icopub.groupe (code,libelle, description) VALUES (:code,:libelle, :description)')
      ->bindValues(['code' => $code, ':libelle' => $productGroupName, ':description' => $productGroupDesc])
      ->execute();
  } catch (\PDOException $ex) {
    return $ex->getMessage();
  }
}


    // fonction de modifier un groupe de produit
    public function updateProductgroup($libelle, $desctiption, $statut, $action_on_this)
    {
      $rslt = Null;
      if (isset($action_on_this)) {
        $req = $this->connect->createCommand('UPDATE icopub.groupe SET libelle=:libelle, description=:description,statut=:statut WHERE code=:code')
          ->bindValues([':libelle' => $libelle, ':description' => $desctiption, ':statut' => $statut, ':code' => $action_on_this])
          ->execute();
        if ($req) {
          $rslt = '2692';
        }
      }
      return $rslt;
    }


    // fonction  d'afficher la liste de groupe de produit
    public function listeGroupe()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.groupe WHERE  statut=1 ORDER BY id DESC')
      ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }



// fonction de recherche d'un groupe
   public function searchgroupe($donneeRecherche = '', $limit = '1'){
    $query = null;
    
      $limit = Yii::$app->productClass->getRealLimit($limit);
      if (isset($limit) && $limit > 0) {
        $limit = 'LIMIT ' . $limit;
      }
   
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.groupe where 
         	(groupe.libelle like :donnerechercher
                or groupe.description like :donnerechercher)
                ORDER BY groupe.id desc '.$limit)
      
         ->bindValues([':donnerechercher'=>'%'.$donneeRecherche.'%'])
         ->queryAll();
         return $req; 
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }

  
    /* *************************************************************************************************************
                                FONCTION DE CATEGORIE DE PRODUIT
    ***************************************************************************************************************/

    // fonction d'ajouter un groupe de produit
public function addCategorie($code,$productGroupName,$productGroupDesc,$photo)
{
 
  try {
    $req = $this->connect->createCommand('INSERT INTO icopub.categorie (code,libelle, description,photo) VALUES (:code,:libelle, :description, :photo)')
      ->bindValues(['code' => $code, ':libelle' => $productGroupName, ':description' => $productGroupDesc,':photo'=>$photo])
      ->execute();
  } catch (\PDOException $ex) {
    return $ex->getMessage();
  }
}


public function listeCategorie()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.categorie WHERE  statut=1 ORDER BY id DESC')
      ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }


  
// fonction de recherche d'une categorie
   public function searchcategorie($donneeRecherche = '', $limit = '1'){
    $query = null;
    
      $limit = Yii::$app->productClass->getRealLimit($limit);
      if (isset($limit) && $limit > 0) {
        $limit = 'LIMIT ' . $limit;
      }
   
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.categorie where 
         	(categorie.libelle like :donnerechercher
                or categorie.description like :donnerechercher)
                ORDER BY categorie.id desc '.$limit)
      
         ->bindValues([':donnerechercher'=>'%'.$donneeRecherche.'%'])
         ->queryAll();
         return $req; 
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }

  public function updateCategorie($libelle, $desctiption, $statut,$photo, $action_on_this){
    $rslt = Null;

    try {
    
      if (isset($action_on_this)) {
        $req = $this->connect->createCommand('UPDATE icopub.categorie SET libelle=:libelle, description=:description,statut=:statut,photo=:photo WHERE code=:code')
          ->bindValues([':libelle' => $libelle, ':description' => $desctiption, ':statut' => $statut,':photo' => $photo, ':code' => $action_on_this])
          ->execute();
        if ($req) {
          $rslt = '2692';
        }
      }
      return $rslt;
    } catch (\Throwable $th) {
      //throw $th;
    }

  }

   /* *************************************************************************************************************
                                FONCTION DE LA REFERENCE
    ***************************************************************************************************************/


    // fonction d'ajouter une reference de produit
public function addRef($code, $productRefName,$productRefDesc)
{
 
  try {
    $req = $this->connect->createCommand('INSERT INTO icopub.reference (code,libelle, description) VALUES (:code,:libelle, :description)')
      ->bindValues(['code' => $code, ':libelle' => $productRefName, ':description' => $productRefDesc])
      ->execute();
  } catch (\PDOException $ex) {
    return $ex->getMessage();
  }
}


    // fonction de modifier un reference de produit
    public function updateProductref($libelle, $desctiption, $statut, $action_on_this)
    {
      $rslt = Null;
      if (isset($action_on_this)) {
        $req = $this->connect->createCommand('UPDATE icopub.reference SET libelle=:libelle, description=:description,statut=:statut WHERE code=:code')
          ->bindValues([':libelle' => $libelle, ':description' => $desctiption, ':statut' => $statut, ':code' => $action_on_this])
          ->execute();
        if ($req) {
          $rslt = '2692';
        }
      }
      return $rslt;
    }


    // fonction  d'afficher la liste de reference de produit
    public function listeRef()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.reference WHERE  statut=1 ORDER BY id DESC')
      ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }

  // fonction de recherche d'une reference
   public function searchreference($donneeRecherche = '', $limit = '1'){
    $query = null;
    
      $limit = Yii::$app->productClass->getRealLimit($limit);
      if (isset($limit) && $limit > 0) {
        $limit = 'LIMIT ' . $limit;
      }
   
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.reference where 
         	(reference.libelle like :donnerechercher
                or reference.description like :donnerechercher)
                ORDER BY reference.id desc '.$limit)
      
         ->bindValues([':donnerechercher'=>'%'.$donneeRecherche.'%'])
         ->queryAll();
         return $req; 
    } catch (\Throwable $th) {
      die($th->getMessage());
    }

  }


  
   /* *************************************************************************************************************
                                FONCTION DU BANNER
    ***************************************************************************************************************/


    // fonction d'ajouter le banner de produit
public function addBanner($code, $productBanerName, $titre,$soustitre,$photo)
{
 
  try {
    $req = $this->connect->createCommand('INSERT INTO icopub.banner (code,libelle, titre,sous_titre,photo) VALUES (:code,:libelle, :titre, :soustitre,:photo)')
      ->bindValues(['code' => $code, ':libelle' => $productBanerName, ':titre' => $titre,'soustitre'=>$soustitre,'photo'=>$photo])
      ->execute();
  } catch (\PDOException $ex) {
    return $ex->getMessage();
  }
}

// fonction de modifier du banner de produit

public function updateProductbanner($libelle, $titre,$soustitre,$photo,  $statut, $action_on_this)
    {

      try {
        $rslt = Null;
      if (isset($action_on_this)) {
        $req = $this->connect->createCommand('UPDATE icopub.banner SET libelle=:libelle, titre=:titre,sous_titre=:soustitre,photo=:photo,statut=:statut WHERE code=:code')
          ->bindValues([':libelle' => $libelle, ':titre' => $titre, ':soustitre' => $soustitre, ':photo' => $photo,':statut' => $statut, ':code' => $action_on_this])
          ->execute();
        if ($req) {
          $rslt = '2692';
        }
      }
      return $rslt;
      } catch (\Throwable $th) {
        return $th->getMessage();
      }
      
    }

    // fonction d'afficher
      public function listeBanner()
  {
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.banner WHERE  statut=1 ORDER BY id DESC')
      ->queryAll();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }

  }

  public function listeproductupdate($productId){
    try {
      $req = $this->connect->createCommand('SELECT * FROM icopub.produit WHERE icopub.produit.code =:slimproductid')
      ->bindValue(':slimproductid', $productId)
      ->queryOne();
      return $req;
    } catch (\Throwable $th) {
      return $th->getMessage();
    }
  }


  public function produitDtls($productId)
  {
    $produitDtls = Null;
    if (isset($productId)) {
      $productId = base64_decode($productId);
      $productTblElement = ',icopub.produit.libelle,prixunitairevente,description,photo,dateajout, category, codegroupe';
      $stmt = $this->connect->createCommand('SELECT descriptionprod,countbook.product.code as slimproductid ' . $productTblElement . ' , ' . $qtetbleElement . '
                                                    FROM countbook.product
                                                    JOIN countbook.stockentrepot ON countbook.stockentrepot.codeproduit = countbook.product.code
                                                    WHERE countbook.product.code=:slimproductid')
        ->bindValue(':slimproductid', $productId)
        ->queryOne();
      if ($stmt) {
        $produitDtls = $stmt;
      }
    }
    return $produitDtls;
  }

    
}