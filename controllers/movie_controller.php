<?php
     /**
     * Controleur enfant de MotherController pour la gestion des films
     * @author Hugo Gomes
     * Créé le 31/01/2025 par Hugo Gomes
     */

     require_once("mother_controller.php");
    
     class MovieCtrl extends MotherCtrl{
         /**
         * Constructeur
         */
         public function __construct() {
            parent::__construct();  
         }
         
         /*
         * Méthode pour l'affichage de la page principale
         * @return l'affichage de la page d'accueil
         */
         public function home() {
            
            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");

            // object pour Movie Model
            $objMovieModel = new MovieModel();

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie         = $objMovieModel->movieList();
            $arrRecentMovie   = $objMovieModel->movieList(false);

            // Transmission des variables dans la vue
            $this->_arrData['arrMovie'] = $arrMovie;
            $this->_arrData['arrRecentMovie'] = $arrRecentMovie;

            $this->display('home');
         }  
         
         /*
         * Méthode pour l'affichage de la page contenant tous les films de la BDD
         * @return l'affichage de la page 
         */
         public function allMovies() {

            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");
            require_once("entities/category_entity.php");
            require_once("models/category_model.php");

            // object pour Movie Model
            $objMovieModel                = new MovieModel();
            $objCatModel                  = new CategoryModel();
            $objMovieModel->strKeyword    = $_POST['keywords']??"";
            $objMovieModel->strStartDate  = $_POST['startdate']??"";
            $objMovieModel->strEndDate    = $_POST['enddate']??"";
            $objMovieModel->intStartTime  = $_POST['minduration']??0;
            $objMovieModel->intEndTime    = $_POST['maxduration']??0;
            $objMovieModel->arrCategory   = $_POST['cat']??[];

            //Utilisation
            $arrCat           = $objCatModel->findCategory();
            $arrAdvMovie      = $objMovieModel->advSearchMovie();

            // Transmission des variables dans la vue
            $this->_arrData['objMovieModel'] = $objMovieModel;
            $this->_arrData['arrCat']        = $arrCat;
            $this->_arrData['arrAdvMovie']   = $arrAdvMovie; 

            $this->display('all_movies');
         }
            
         /**
          * Form movie
          * @author Arlind Halimi
          * 04/02/2025 par Arlind Halimi
          */
         public function form_movie(){
            // var_dump($_GET);
            // Variables d'affichage
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Ajoute nouveau film";

            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "form_movie";

            // Variable fonctionalles 
            //$refPage="formuler_movie";
               
            // Variables d'affichage
            $strTitle="Ajoute nouveau film";
               
            // Inclusion du ficher model et entity
            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");
            require_once("models/actor_model.php");
            require_once("entities/acteur_entity.php");
               
               
            // Instanciation
            $objMovie		= new MovieModel();
            $objMovieEntity	= new MovieEntity();
            $objActorEntity = new ActorEntity();
            $objActorModel 	= new ActorModel();
               
            // Merr të gjithë aktorët
            $arrActor = $objActorModel->NameSurnameActors();
            //var_dump($arrActor);
            // Movie
            //$arrMovie 	= $objMovie->findMovie();
            
            //foreach ($arrMovie as $arrDetMovie){
               //$objMovie = new MovieEntity();
               //$objMovie->hydrate($arrDetMovie);
            //}

            // Récupérer les informations du $_POST
            // ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
            $strPhoto 		= $_FILES['fichier']["name"]??"";
            $strPhoto		= strtolower($strPhoto);
            $strTitleForm 		= $_POST['name']??"";
            $strDate 		= $_POST['release']??"";
            $strSynopsis	= $_POST['desc']??"";
            $strNotes 		= $_POST['notes']??"";
            $strDuration	= $_POST['duration']??"";
            $strMovieDisplay = $_POST['display']??"";
            $idActor 		= $_POST["actor"]??"";

         
               


               // Initialisation du tableau vide
            $arrErrors = array();

            if(count($_POST) > 0){
               $objMovieEntity->hydrate($_POST);
               $objMovieEntity->setPoster($strPhoto);
               // Vérification du formulaire
               // if($strPhoto == ""){
                // 	$arrErrors['fichier'] = "Image est obligatoire";
               // }
               if($strTitle == ""){
                  $arrErrors['name'] = "Title est obligatoire";
               }
               if($idActor == "" || $idActor == 0){
                  $arrErrors['actor'] = "Le nom de l'acteur est obligatoire";
               }
               if($strDate == "" ){
                  $arrErrors['release'] = "Le date est obligatoire";
               }
               if ($strSynopsis == ""){
                  $arrErrors['desc'] = "La zone de texte synopsis est obligatoire";
               }
               if ($strNotes == ""){
                  $arrErrors['notes'] = "La zone de texte notes est obligatoire";
               }
                  
                  
               // Vérification du fichier
               // check if file is exist
                  
                  
               $arrFichier = $_FILES['fichier']; // Récupération du tableau de l'élément 'fichier'
               if ($arrFichier['error'] == 4){
                  $arrErrors['fichier'] = "Le image est obligatoire";
               }else{
                  if($arrFichier['error'] != 0){
                     $arrErrors['fichier'] = "Le fichier a rencontré un problème lors de l'upload";
                  }elseif($arrFichier['type'] != 'image/jpeg'){
                     $arrErrors['fichier'] = "Le fichier doit être au format jpg";}	
                  elseif ($arrFichier['size'] > 5 * 1024 * 1024) {
                     $arrErrors['fichier'] = "Le fichier ne doit pas dépasser 5Mo";
                  }
               }
                     
                     
               if (!isset($arrErrors['fichier'])){
                   // Fichier temporaire = source
                  $strSource = $_FILES['fichier']['tmp_name'];
                  // destination de fichier
                     
                  $strDest	= "assets\img\movies\movie_posters\ ".$strPhoto;
                  // On déplace le fichier
                  if (!move_uploaded_file($strSource, $strDest)){
                     $arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
                  }
                  // $strNomFichier = $arrFichier['name'];
                  // $strNomTemporaire = $arrFichier['tmp_name'];
                  // $strChemin = "uploads/".$strNomFichier;
                  // move_uploaded_file($strNomTemporaire, $strChemin);
               }
                  

               // Si aucune erreur, traitement 	
               if (count($arrErrors) === 0){
                  // => Formulaire OK
                  // Appel une métgid dans le modéle, avec en paramétre l'objet
                  $boolOK = $objMovie->addMovie($objMovieEntity);
                  $boolOK = $objMovie->playActor($idActor);
                  //var_dump($objActorEntity->getId());

                  //Informer l'utilisateur si einsertion ok/pas ok
                  if($boolOK){
                     //var_dump('ok');
                     
                  }else{
                     $arrErrors[]="l'insertion s'est mal passée";
                  }
                  //header( "Location:future_index.php", true);
                  // => exemple Insertion en BDD
                     
               }
            }
            //var_dump($objActorEntity);
           // exit();

            // var_dump($objActorEntity->getFirst_name());
            // var_dump($objActorEntity->getId());

            // besoin de déclarer toutes les variables utilisées dans le formulaire
            $this->_arrData['strPhoto']  =   $strPhoto;
            $this->_arrData['strDate']  =   $strDate;
            $this->_arrData['arrErrors']  =   $arrErrors;
            $this->_arrData['strMovieDisplay']  =   $strMovieDisplay;
            $this->_arrData['strDuration']  =   $strDuration;
            $this->_arrData["actor"] = $idActor;
            $this->_arrData["objActorEntity"] = $objActorEntity ;
            $this->_arrData["objActorModel"] = $objActorModel ;
            $this->_arrData["arrActor"] = $arrActor ;
            $this->_arrData["strSynopsis"] = $strSynopsis ;
            $this->_arrData["strNotes"] = $strNotes ;
            $this->_arrData["strTitleForm"] = $strTitleForm ;
               
               
            // est une méthode qui appelle une view nommée "form_movie" 
            $this->display("form_movie");
      }

         /**
          * Page d'un film
          * @author Arlind Halimi
          * 05/02/2025 par Arlind Halimi
          */
         public function page_dun_film(){
            require_once("entities/movie_entity.php");
            require_once("entities/acteur_entity.php");
            require_once("entities/comment_entity.php");
            require_once("models/movie_model.php");
            require_once("models/actor_model.php");
            require_once("models/comment_model.php");
            
            
            // object pour Movie Model
            $objMovieModel    = new MovieModel(); 
            $objMovie         = new MovieEntity(); 
            $objCommentModel  = new CommentModel();
            $objCommentEntity = new CommentEntity();
            $objMovieEntity   = new MovieEntity();
            
            

            $objMovie->setId($_GET["id"]);
            $idMovie = $objMovie->getId();
            $arrMovieEntity = $objMovieModel->findMovie($objMovie->getId());
            $objMovie->hydrate($arrMovieEntity);
         

            // if (!$arrMovieEntity) {
            //    die("Erreur: Aucun film trouvé avec cet ID !");
            // }
      
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Page de une film";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "page_dun_film";

            $arrErrors = array();
            $arrComments = array();
            $arrComments = $objCommentModel->allComments();
            $strTitleCom = '';
            $strContentCom = '';
            $strTitleCom   = $_POST['title']??"";
            $strContentCom = $_POST['content']??"";

            // --> Fonctionnel pour les commentaires mais par pour les photos - auteur Arlind
            // if(count($_POST) > 0){
            //    // var_dump('je suis la');
            //    // var_dump($objCommentEntity->getId());

               
            //    // duhet ti shkuash me dor keto setMovie sepse nuk i hidraton $_POST
            //    $objCommentEntity->hydrate($_POST);
            //    $objCommentEntity->setMovie_id($objMovie->getId());
            //    $objCommentEntity->setUser_id($_SESSION['user']->getId());
            //    // var_dump($objCommentEntity);
            //    $strTitleCom   = $_POST['title']??"";
            //    $strContentCom = $_POST['content']??"";

               
            //    if($strTitleCom == ""){
            //       $arrErrors['title'] = "Le titre est obligatoire pour comment!";
            //    }
            //    if($strContentCom == ""){
            //       $arrErrors['content'] = "Le contenu est obligatoire pour comment!";
            //    }
            //    // var_dump($strComment);
            //    // var_dump($strComment);
            //    if( $objCommentEntity->getContent()!='' && $objCommentEntity->getTitle()!='' ){
            //       $idComment = $objCommentModel->addComment($objCommentEntity);
            //    }
               
            // }
            // -- Fin fonction commentaires Arlind
            
            

            
            $objMovieEntity->hydrate($arrMovieEntity);
            /**
             *       ATTENTION SAMARCHE PAS
             * Vérifier si l'id du film est dans la base de données
             * Si non, rediriger vers une page d'erreur
             * Si oui, continuer
             */
            
            if (!isset($_GET['id']) || !($objMovieModel->findMovie($_GET['id']) )){
               header("Location:error_404.php");
            }
            // var_dump($_GET['id']);
            // var_dump($objMovieEntity->getId());
            // var_dump("je suis la");
            // var_dump($objMovieModel->findMovie($_GET['id']));

            

            // pour qua comme parameter entre $arrMovieEntity 
            
            //var_dump($objMovieEntity->getId());

            // Juliette - 13/02/2025 - Requête insertion commentaire + photos
            // Exécute la requête une première fois pour savoir si la limite de photos est déjà atteinte ou non
            $intNbTotalPic = $objCommentModel->countPictures($objMovie->getId());

            // À l'envoi du formulaire, je vérifie si un fichier a été importé ou non
            require_once("entities/picture_entity.php");
            if(count($_POST)>0){
               $objCommentEntity->hydrate($_POST);
               $objCommentEntity->setMovie_id($objMovie->getId());
               $objCommentEntity->setUser_id($_SESSION['user']->getId());
               
               // Vérifie le contenu du titre
               if($objCommentEntity->getTitle() == ""){
                  $arrErrors['title'] = "Le champ Titre est obligatoire";
               }
               // Vérifie le contenu du contenu
               if($objCommentEntity->getContent() == ""){
                  $arrErrors['content'] = "Le champ Contenu est obligatoire";
               }
               // Vérifie si un fichier est importé et le nombre de fichiers importés
               if($_FILES['pictures']['error'] != 4){
                  // Compte du nombre de fichiers importés
                  $intImportedPic = count($_FILES['pictures']['name']);

                  $objPicture = new PictureEntity;

                  // Vérifie que le nombre de fichiers importé ne dépasse pas la limite max pour le film
                  if(($intNbTotalPic + $intImportedPic) > 10){
                     $intRestPic = 10 - $intNbTotalPic;
                     $arrErrors['picture'] = "Vous dépassez la limite de photos accordées à ce film. Vous ne pouvez en ajouter que ".$intRestPic." maximum.";
                  } else {
                     $boolPicOk = true;
                  }
               }
            
               if(count($arrErrors) == 0){
                  // Récupère le résultat de la requête d'ajout du commentaire (soit id du commentaire, sinon false)
                  $idComment = $objCommentModel->addComment($objCommentEntity);
                  if($idComment !== false){
                     if((isset($boolPicOk)) && ($boolPicOk === true)){

                        // Pour chaque fichier importé, je récupère les infos et j'insère
                        for($i = 0; $i<$intImportedPic; $i++){
                           $objPicture->setFile($_FILES['pictures']['name'][$i]);
                           $objPicture->setComment_id($idComment);

                           // Récupère le résultat de la requête d'insertion des photos
                           $boolPicQuery = $objCommentModel->addPicture($objPicture);

                           if($boolPicQuery===false){
                              $arrErrors['import']= "Erreur lors de l'importation des images";
                              break;
                           } else {
                              var_dump("Succès import des photos");
                           }
                        }
                     }
                  } else {
                     $arrErrors['comment']= "Erreur lors de l'enregistrement du commentaire";
                  }
               }
            }
            $this->_arrData['objCommentEntity'] = $objCommentEntity;
            $this->_arrData['intNbTotalPic'] = $intNbTotalPic;
            // Fin Juliette

            $this->_arrData['objMovie']         = $arrMovieEntity;
            $this->_arrData['objMovie']         = $objMovieEntity;
            $this->_arrData['idMovie']          = $idMovie;
            $this->_arrData['strTitleCom']      = $strTitleCom;
            $this->_arrData['strContentCom']    = $strContentCom;
            $this->_arrData['arrErrors']        = $arrErrors;
            $this->_arrData['arrComments']      = $arrComments;
            $this->_arrData['objCommentModel']  = $objCommentModel;

            $this->display('page_dun_film');
         }
      public function edit_movie(){

         // require_once("entities/movie_entity.php");
         // require_once("entities/acteur_entity.php");
         // require_once("models/movie_model.php");
         // require_once("models/actor_model.php");
         
         // // object pour Movie Model
         // $objMovieModel = new MovieModel(); 
         // $objMovie = new MovieEntity(); 

         // $objMovie->setId($_GET["id"]);
         // $idMovie = $objMovie->getId();
         // $arrMovieEntity = $objMovieModel->findMovie($objMovie->getId());
         // $objMovie->hydrate($arrMovieEntity);


         // /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
         // $this->_arrData['strTitle'] =  "Page de modifie film";

         // // Variables fonctionnelles
         // $this->_arrData['refPage']  =  "edit_movie";


         // $this->_arrData['objMovie']  = $arrMovieEntity;
         // $this->_arrData['objMovie'] = $objMovie;
         // $this->_arrData['idMovie'] = $idMovie;
         // //$this->_arrData[''] = $strDateFr


         // $this->display('edit_movie');
      }
   }