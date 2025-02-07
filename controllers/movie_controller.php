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

         public function home() {
            
            require_once("entities/movie_entity.php");
            require_once("models/movie_model.php");

            // object pour Movie Model
            $objMovieModel = new MovieModel();

            //Utilisation (création d'un tableau contenant les infos de la requête)
            $arrMovie = $objMovieModel->movieList();
            $arrRecentMovie = $objMovieModel->movieList(false);

            $this->_arrData['arrMovie'] = $arrMovie;
            $this->_arrData['arrRecentMovie'] = $arrRecentMovie;
            $this->_arrData['objMovieModel'] = $objMovieModel;

            $this->display('home');
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

            $objMovie->setId($_GET["id"]);
            $idMovie = $objMovie->getId();
            $arrMovieEntity = $objMovieModel->findMovie($objMovie->getId());
            $objMovie->hydrate($arrMovieEntity);
            
            $strTitle   = $_POST['title']??"";
            $strContent = $_POST['content']??"";

            // var_dump($_POST);

            // if (!$arrMovieEntity) {
            //    die("Erreur: Aucun film trouvé avec cet ID !");
            // }
      
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Page de une film";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "page_dun_film";

            $arrErrors = array();
            

            if(count($_POST) > 0){
               // var_dump('je suis la');
               // var_dump($objCommentEntity->getId());

               
               // duhet ti shkuash me dor keto setMovie sepse nuk i hidraton $_POST
               $objCommentEntity->hydrate($_POST);
               $objCommentEntity->setMovie_id($objMovie->getId());
               $objCommentEntity->setUser_id($_SESSION['user']->getId());
               // var_dump($objCommentEntity);
               $strTitle   = $_POST['title'];
               $strComment = $_POST['content'];

               
               if($strTitle == ""){
                  $arrErrors['title'] = "Le titre est obligatoire pour comment!";
               }
               if($strContent == ""){
                  $arrErrors['content'] = "Le contenu est obligatoire pour comment!";
               }
               // var_dump($strComment);
               // var_dump($strComment);
               if( $objCommentEntity->getContent()!='' && $objCommentEntity->getTitle()!='' ){
                  $objCommentModel->addComment($objCommentEntity);
               }
               
            }
            // if (isset($_GET['id']) && ($_GET['id'] != $_SESSION['movie']->getId())){
            // 	header("Location:error_403.php");
            // }
               //var_dump($arrMovieEntity);

            $this->_arrData['objMovie']   = $arrMovieEntity;
            $this->_arrData['objMovie']   = $objMovie;
            $this->_arrData['idMovie']    = $idMovie;
            $this->_arrData['title']      = $strTitle;
            $this->_arrData['content']    = $strContent;
            $this->_arrData['arrErrors']  = $arrErrors;
           
            //$this->_arrData[''] = $strDateFr

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