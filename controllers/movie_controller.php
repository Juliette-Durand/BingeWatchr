<?php
     /**
     * Controleur enfant de MotherController pour la gestion des films
     * @author Hugo Gomes
     * Créé le 31/01/2025 par Hugo Gomes
     */

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
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
            require_once("entities/category_entity.php");
               
               
            // Instanciation
            $objMovie		      = new MovieModel();
            $objMovieEntity	   = new MovieEntity();
            $objActorEntity      = new ActorEntity();
            $objActorModel 	   = new ActorModel();
            $objCategoryEntity   = new CategoryEntity();
               
            // selectionner les acteurs et les categories
            $arrActor      = $objActorModel->NameSurnameActors();
            $arrCategory   = $objMovie->infoCategory();

            // Récupérer les informations du $_POST
            // ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
            $strPhoto 		= $_FILES['fichier']['name']??"";
            $strPhoto		= strtolower($strPhoto);
            $strPhoto		= trim($strPhoto);
            $strTitleForm 	= $_POST['name']??"";
            $strDate 		= $_POST['release']??"";
            $strSynopsis	= $_POST['desc']??"";
            $strDuration	= $_POST['duration']??"";
            $strMovieDisplay = $_POST['display']??"";
            $idActor 		= $_POST["actor"]??"";
            $idCategory    = $_POST['category'] ?? "";


            // Initialisation du tableau vide
            $arrErrors = array();
            // Rederige si l'utilisateur n'est pas conecte
            if( !isset($_SESSION['user']) ){
               header("Location:future_index.php?ctrl=user&action=login");
               exit;
            }
            if(count($_POST) > 0){
               $objMovieEntity->hydrate($_POST);
               // Vérification du formulaire
               if($strTitleForm == ""){
                  $arrErrors['name'] = "Title est obligatoire";
               }
               if($strDate == "" ){
                  $arrErrors['release'] = "Le date est obligatoire";
               }
               if($idActor == "" || $idActor == 0){
                  $arrErrors['actor'] = "Le nom de l'acteur est obligatoire";
               }
               if ($idCategory == "" || $idCategory == 0){
                  $arrErrors['category'] = "La zone de  category est obligatoire";
               }
               if ($strSynopsis == ""){
                  $arrErrors['desc'] = "La zone de texte synopsis est obligatoire";
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

                  $arrFileExplode	= explode(".", $arrFichier['name']);
						$strFileExt		= $arrFileExplode[count($arrFileExplode)-1];
						$strFileName 	= bin2hex(random_bytes(10)).".webp";//.$strFileExt;
                  $strDest	= "assets/img/movies/movie_posters/".$strFileName;
                  // On déplace le fichier
                  if (!move_uploaded_file($strSource, $strDest)){
                     $arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
                  }
                  $objMovieEntity->setPoster($strFileName);
               }
               

               // Si aucune erreur, traitement 	
               if (count($arrErrors) === 0){
                  // => Formulaire OK
                  // Appel une métgid dans le modéle, avec en paramétre l'objet
                  $boolOK = $objMovie->addMovie($objMovieEntity);
                  $boolOK = $objMovie->playActor($idActor);
                  $boolOK = $objMovie->categoryMovie($idCategory);


                  //Informer l'utilisateur si einsertion ok/pas ok
                  if($boolOK){
                     $_SESSION['success'] 	= "L'insertion est passée avac succes.";
                     header( "Location:future_index.php", true);
                  }else{
                     $arrErrors[]="L'insertion s'est mal passée";
                  }
               }
            }

            // besoin de déclarer toutes les variables utilisées dans le formulaire
            $this->_arrData['strPhoto']         = $strPhoto;
            $this->_arrData['strDate']          = $strDate;
            $this->_arrData['strMovieDisplay']  = $strMovieDisplay;
            $this->_arrData['strDuration']      = $strDuration;
            $this->_arrData["idActor"]          = $idActor;
            $this->_arrData["arrActor"]         = $arrActor ;
            $this->_arrData["strSynopsis"]      = $strSynopsis ;
            $this->_arrData["strTitleForm"]     = $strTitleForm ;
            $this->_arrData["idCategory"]       = $idCategory;
            $this->_arrData["arrCategory"]      = $arrCategory;
            $this->_arrData['arrErrors']        = $arrErrors;
            $this->_arrData["objActorEntity"]   = $objActorEntity ;
            $this->_arrData["objActorModel"]    = $objActorModel ;
            $this->_arrData["objMovie"]         = $objMovie;
            $this->_arrData["objCategoryEntity"] = $objCategoryEntity;
               
               
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
            
            // Récupération de l'id en URL
            $strId  =   $_GET['id']??"";
            // Vérification de la valeur de l'id en URL si exist
            if($strId=="" || $objMovieModel->findMovie($strId)===false){
               header("Location:future_index.php?ctrl=error&action=error404");
               exit();
            }

            $objMovie->setId($strId);
            $idMovie = $objMovie->getId();
            $arrMovieEntity = $objMovieModel->findMovie($strId);
            $objMovie->hydrate($arrMovieEntity);
            
            /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
            $this->_arrData['strTitle'] =  "Page de une film";
            // Variables fonctionnelles
            $this->_arrData['refPage']  =  "page_dun_film";

            
            $arrErrors = array();
            $arrComments = array();
            $arrComments = $objCommentModel->allComments();
            $strTitleCom   = $_POST['title']??"";
            $strContentCom = $_POST['content']??"";           
               
            if(count($_POST) > 0 ){
               // besoin ecrire setMovie_id et setUser_id parce que pas hydrate avec $_POST $_POST
               $objCommentEntity->hydrate($_POST);
               $objCommentEntity->setMovie_id($objMovie->getId());
               $objCommentEntity->setUser_id($_SESSION['user']->getId());
               
               if($strTitleCom == ""){
                  $arrErrors['title'] = "Le titre est obligatoire pour comment!";
               }
               if($strContentCom == ""){
                  $arrErrors['content'] = "Le contenu est obligatoire pour comment!";
               }

               if(($strTitleCom !='') && ($strContentCom !='')){
                  $objCommentModel->addComment($objCommentEntity);
                  header("Location: future_index.php?ctrl=movie&action=page_dun_film&id=" . $strId);
                  exit();
               }
               
            }
            
            $objMovieEntity->hydrate($arrMovieEntity);
      

            // if (!isset($_GET['id']) || !($objMovieModel->findMovie($_GET['id']) )){
            //    header("Location:future_index.php?ctrl=error&action=error404");
            // }          

            // pour qua comme parameter entre $arrMovieEntity 

            $this->_arrData['arrMovieEntity']   = $arrMovieEntity;
            $this->_arrData['objMovie']         = $objMovieEntity;
            $this->_arrData['idMovie']          = $idMovie;
            $this->_arrData['strTitleCom']      = $strTitleCom;
            $this->_arrData['strContentCom']    = $strContentCom;
            $this->_arrData['arrErrors']        = $arrErrors;
            $this->_arrData['arrComments']      = $arrComments;
            $this->_arrData['objCommentModel']  = $objCommentModel;

            $this->display('page_dun_film');
      }

      
      /**
       * Page d'un film
       * @author Arlind Halimi
       */      
      public function contact(){
         // Variables d'affichage
         /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
         $this->_arrData['strTitle'] =  "Partage le film par email";

         // Variables fonctionnelles
         $this->_arrData['refPage']  =  "contact";
         
         // Création d'un tableau d'erreurs
         $arrErrors  =   array();
         $strName       = $_POST['name']??"";
         $strMail       = $_POST['mail']??"";
         $strMessage    = $_POST['message']??"";

         if( count($_POST) > 0){
            
            //$strContentA = file_get_contents('');
				$objMail = new PHPMailer(); 	// Nouvel objet Mail
				$objMail->IsSMTP();
				$objMail->Mailer 		   = "smtp";
				$objMail->CharSet 	   = PHPMailer::CHARSET_UTF8;	// uft-8

            // Si on veut afficher les messages de debug
				$objMail->SMTPDebug 	= 0;
				
				// Connection au serveur de Mail
				$objMail->SMTPAuth 		= TRUE;
				$objMail->SMTPSecure 	= "tls";
				$objMail->Port 			= 587;
				$objMail->Host 			= "smtp.gmail.com";
				$objMail->Username 		= 'christel.ceformation@gmail.com';
				$objMail->Password 		= 'cdbk mrjr aiqo tndi';
				
				// Comment envoyer le mail
				$objMail->IsHTML(true); // en HTML
				$objMail->setFrom("no-replay@bingeWatchr.fr", "BingeWatchr"); // Expéditeyr ex. no-replay@blog.fr
				// Destinataire(s)
				$objMail->addAddress($strMail, $strName);
				// $objMail->addAddress('autre@adresse-mail.com', 'Autre nom');
				
            $this->_arrData['name']       = $strName;
				$this->_arrData['mail']			= $strMail;
				$this->_arrData['message'] 	= $strMessage;
						
				// Contenu du mail
				//$objMail->Subject = $strSubjecte;
				$objMail->Body = $strMessage;
            
               // Vérification du nom
               if($strName == ""){
                  $arrErrors['name'] =  'Le Nom et Prénom est obligatoire';
               }
               // Vérification de l'adresse email
               if ($strMail == "") {
                  $arrErrors['mail'] =   "L'adresse email est obligatoire";
               } else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)){
                  $arrErrors['mail'] =   "L'adresse email n'est pas valide";
               }
                // Vérification du message
               if($strMessage == ""){
                  $arrErrors['message'] =  'Le champ message est obligatoire';
               }

               if(count($arrErrors) == 0){
                  if (!$objMail->send()) {
                     echo 'Erreur de Mailer : ' . $objMail->ErrorInfo;
                  } else {
                     $_SESSION['success'] 	= 'Le message a été envoyé.';
                     // Rediriger vers l'accueil
                     header("Location:future_index.php");
                     exit;
                  }
               }
         
         }
         $this->_arrData['arrErrors']  = $arrErrors;
         $this->_arrData['strName']    = $strName;
         $this->_arrData['strMail']    = $strMail;
         $this->_arrData['strMessage'] = $strMessage;

         // est une méthode qui appelle une view nommée "contact" 
         $this->display("contact");
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



         // $arrActors = $objActorsModel->findActor($idMovie); // cherche le ID de movie

         
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