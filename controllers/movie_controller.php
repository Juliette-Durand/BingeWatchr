<?php
     /**
     * Controleur enfant de MotherController pour la gestion des films
     * @author Hugo Gomes
     * Créé le 31/01/2025 par Hugo Gomes
     * Dernière modification par Juliette le 14/02/2025
     */

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once("mother_controller.php");
   
   class MovieCtrl extends MotherCtrl{
     
      private object $_objMovieModel;
      private object $_objCatModel;
      /**
      * Constructeur
      */
      public function __construct() {
         parent::__construct();  
         require_once("entities/movie_entity.php");
         require_once("models/movie_model.php");
         require_once("entities/category_entity.php");
         require_once("models/category_model.php");

         // object pour Movie Model
         $this->_objMovieModel   = new MovieModel();
         $this->_objCatModel     = new CategoryModel();
      }
      
      /*
      * Méthode pour l'affichage de la page principale
      * @return l'affichage de la page d'accueil
      */
      public function home() {

         // Tableau de tableau - liste des films
         $arrMovies			   = $this->_objMovieModel->movieList();
         $arrRecentMovie      = $this->_objMovieModel->movieList(false);
      
         // Transmission des variables dans la vue
         $this->_arrData['strTitle']         = "Bienvenue sur BingeWatchr";

         $arrMoviesToDisplay 	      = array();
         $arrRecentMoviesToDisplay  = array();
         foreach ($arrMovies as $arrDetMovies) {
            $objMovie = new MovieEntity();  
            // hydrater l'objet
            $objMovie->hydrate($arrDetMovies);
            $arrMoviesToDisplay[] = $objMovie;
         }
         $this->_arrData['arrMovies']	= $arrMoviesToDisplay;

            foreach ($arrRecentMovie as $arrDetMovies) {
            $objMovie = new MovieEntity();  
            // hydrater l'objet
            $objMovie->hydrate($arrDetMovies);
            $arrRecentMoviesToDisplay[] = $objMovie;
         }
         $this->_arrData['arrRecentMovie']   = $arrRecentMoviesToDisplay;

         $this->display('home');

      }  
      
      
      /*
      * Méthode pour l'affichage de la page contenant tous les films de la BDD
      * @return l'affichage de la page 
      */
      public function allMovies() {

         $this->_objMovieModel->strKeyword    = $_POST['keywords']??"";
         $this->_objMovieModel->strStartDate  = $_POST['startdate']??"";
         $this->_objMovieModel->strEndDate    = $_POST['enddate']??"";
         $this->_objMovieModel->intStartTime  = $_POST['minduration']??0;
         $this->_objMovieModel->intEndTime    = $_POST['maxduration']??0;
         $this->_objMovieModel->arrCategory   = $_POST['cat']??[];

         //Utilisation
         $arrCat           = $this->_objCatModel->findCategory();
         $arrAdvMovie      = $this->_objMovieModel->advSearchMovie();

         $arrAdvMoviesToDisplay 	      = array();
         foreach ($arrAdvMovie as $arrDetMovies) {
            $objMovie = new MovieEntity();  
            // hydrater l'objet
            $objMovie->hydrate($arrDetMovies);
            $arrAdvMoviesToDisplay[] = $objMovie;
         }
         $this->_arrData['arrAdvMovie']	= $arrAdvMoviesToDisplay;

         $arrCatToDisplay  = array();
         foreach ($arrCat as $arrDetCat) {
            $objCat = new CategoryEntity();  
            // hydrater l'objet
            $objCat->hydrate($arrDetCat);
            $arrCatToDisplay[] = $objCat;
         }
         $this->_arrData['arrCat']	= $arrCatToDisplay;

         // Transmission des variables dans la vue
         $this->_arrData['objMovieModel']	= $this->_objMovieModel;
         $this->_arrData['strTitle']      = "Tous les films";

         $this->display('all_movies');
      }
         
      /**
      * Page "form movie"
      * @author Arlind Halimi
      * @date 04/02/2025 
      */
      public function form_movie(){
         // Variables d'affichage
         /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
         $this->_arrData['strTitle'] =  "Ajoute nouveau film";

         // Variables fonctionnelles
         $this->_arrData['refPage']  =  "form_movie";
            
         // Inclusion du ficher model et entity
         require_once("entities/movie_entity.php");
         require_once("models/movie_model.php");
         require_once("models/actor_model.php");
         require_once("entities/acteur_entity.php");
         require_once("entities/category_entity.php");
            
         // Instanciation
         $objMovie		      = new MovieModel();
         $objMovieEntity	   = new MovieEntity();
         //$objActorEntity      = new ActorEntity();
         $objActorModel 	   = new ActorModel();
         
            
         // selectionner les acteurs et les categories
         $arrActor      = $objActorModel->NameSurnameActors();
         $arrCategory   = $objMovie->infoCategory();

         // Récupérer les informations du $_POST
         // ?? Version PHP 7 (équivalent isset) => Valeur par défaut si l'indice n'existe pas dans le $_POST
         //$strPhoto 		= ;
         $strPhoto		= trim(strtolower($_FILES['fichier']['name']??""));
         $strTitleForm 	= $_POST['name']??"";
         $strDate 		= $_POST['release']??"";
         $strSynopsis	= $_POST['desc']??"";
         $strDuration	= $_POST['duration']??"";
         $strMovieDisplay = $_POST['display']??"";
         $idActor 		= $_POST["actor"]??"";
         $idCategory    = $_POST['category'] ?? "";

         $arrCategoryToDisplay = array();
         foreach ($arrCategory as $arrDetCategory) {
            $objCategoryEntity   = new CategoryEntity();
            $objCategoryEntity->hydrate($arrDetCategory);
            $arrCategoryToDisplay[] = $objCategoryEntity;
         }
         $this->_arrData['arrCategory'] = $arrCategoryToDisplay;

         $arrActorToDisplay = array();
         foreach ($arrActor as $arrDetActor) {
            $objActorEntity   = new ActorEntity();
            $objActorEntity->hydrate($arrDetActor);
            $arrActorToDisplay[] = $objActorEntity;
            }
         $this->_arrData['arrActor'] = $arrActorToDisplay;


         // Initialisation du tableau vide
         // Rederige si l'utilisateur n'est pas conecte
         if( !isset($_SESSION['user']) ){
            header("Location:future_index.php?ctrl=user&action=login");
            exit;
         }
         if(count($_POST) > 0){
            $objMovieEntity->hydrate($_POST);
            // Vérification du formulaire
            if($strTitleForm == ""){
               $this->_arrErrors['name'] = "Le titre est obligatoire";
            }
            if($strDate == "" ){
               $this->_arrErrors['release'] = "Le date est obligatoire";
            }
            if($idActor == "" || $idActor == 0){
               $this->_arrErrors['actor'] = "Le nom de l'acteur est obligatoire";
            }
            if ($idCategory == "" || $idCategory == 0){
               $this->_arrErrors['category'] = "La zone de  category est obligatoire";
            }
            if ($strSynopsis == ""){
               $this->_arrErrors['desc'] = "La zone de texte synopsis est obligatoire";
            }
            
            // Vérification du fichier
            // check si file existe                 
            $arrFichier = $_FILES['fichier']; // Récupération du tableau de l'élément 'fichier'
            if ($arrFichier['error'] == 4){
               $this->_arrErrors['fichier'] = "Le image est obligatoire";
            }else{
               if($arrFichier['error'] != 0){
                  $this->_arrErrors['fichier'] = "Le fichier a rencontré un problème lors de l'upload";
               }elseif($arrFichier['type'] != 'image/jpeg'){
                  $this->_arrErrors['fichier'] = "Le fichier doit être au format jpg";}	
               elseif ($arrFichier['size'] > 1024 * 1024) {
                  $this->_arrErrors['fichier'] = "Le fichier ne doit pas dépasser 1Mo";
               }
            }
                  
            if (!isset($this->_arrErrors['fichier'])){
                  // Fichier temporaire = source
               $strSource = $_FILES['fichier']['tmp_name'];
               // destination de fichier

               $arrFileExplode	= explode(".", $arrFichier['name']);
               $strFileExt		= $arrFileExplode[count($arrFileExplode)-1];
               $strFileName 	= bin2hex(random_bytes(10)).".webp";//.$strFileExt;
               $strDest	= "assets/img/movies/movie_posters/".$strFileName;
               // On déplace le fichier
               if (!move_uploaded_file($strSource, $strDest)){
                  $this->_arrErrors['fichier'] = "Le fichier ne s'est pas correctement téléchargé";
               }
               $objMovieEntity->setPoster($strFileName);
            }
            

            // Si aucune erreur, traitement 	
            if (count($this->_arrErrors) === 0){
               // => Formulaire OK
               // Appel une métgid dans le modéle, avec en paramétre l'objet
               $boolOK = $objMovie->addMovie($objMovieEntity);
               $boolOK = $objMovie->playActor($idActor);
               $boolOK = $objMovie->categoryMovie($idCategory);


               //Informer l'utilisateur si einsertion ok/pas ok
               if($boolOK){
                  $_SESSION['success'] 	= "L'insertion est passée avac succes.";
                  header( "Location:index.php", true);
                  exit();
               }else{
                  $this->_arrErrors[]="L'insertion s'est mal passée";
               }
            }
         }

         // besoin de déclarer toutes les variables utilisées dans le formulaire
         $this->_arrData['strPhoto']         = $strPhoto;
         $this->_arrData['strDate']          = $strDate;
         $this->_arrData['strMovieDisplay']  = $strMovieDisplay;
         $this->_arrData['strDuration']      = $strDuration;
         $this->_arrData["idActor"]          = $idActor;
         $this->_arrData["strSynopsis"]      = $strSynopsis ;
         $this->_arrData["strTitleForm"]     = $strTitleForm ;
         $this->_arrData["idCategory"]       = $idCategory;
         $this->_arrData["objActorEntity"]   = $objActorEntity ;
         $this->_arrData["objActorModel"]    = $objActorModel ;
         $this->_arrData["objMovie"]         = $objMovie;
      
            
            
         // est une méthode qui appelle une view nommée "form_movie" 
         $this->display("form_movie");
      }

      /**
       * Page d'un film
         * @author Arlind Halimi
         * 05/02/2025 par Arlind Halimi
         */
      public function page_dun_film(){
         require_once("entities/acteur_entity.php");
         require_once("entities/comment_entity.php");
         require_once("models/actor_model.php");
         require_once("models/comment_model.php");

         $objMovie         = new MovieEntity(); 
         $objCommentModel  = new CommentModel();

         $objMovie->setId($_GET["id"]);
         $idMovie = $objMovie->getId();
         $arrMovieEntity = $this->_objMovieModel->findMovie($objMovie->getId());
         $objMovie->hydrate($arrMovieEntity);
   
         /* Ce qui sert de h1 et/ou de nom dans le titre de la page */
         $this->_arrData['strTitle'] =  "Page de une film";
         // Variables fonctionnelles
         $this->_arrData['refPage']  =  "page_dun_film";


         
         $arrErrors = array();
         $arrComments = array();
         $arrComments = $objCommentModel->allComments();
         $arrCommentToDisplay = array();
         $strTitleCom = '';
         $strContentCom = '';
         $strTitleCom   = $_POST['title']??"";
         $strContentCom = $_POST['content']??"";


         // Récupération de l'id en URL
         $strId  =   $_GET['id']??"";
         // Vérification de la valeur de l'id en URL si exist
         if($strId == ""){
            // L'id est vide
            header("Location:future_index.php?ctrl=error&action=error404");
         }elseif($this->_objMovieModel->findMovie($strId) === false){
            // L'id est vide
            header("Location:future_index.php?ctrl=error&action=error404");
         }

         // Récupération des commentaires pour affichage
         foreach ($arrComments as $arrDetComment) {
            $objCommentEntity = new CommentEntity();  
            $objCommentEntity->hydrate($arrDetComment);
            $arrCommentToDisplay[] = $objCommentEntity;
         } 
         $this->_arrData['arrComments']	= $arrCommentToDisplay;

         // --> Fonctionnel pour les commentaires mais par pour les photos - auteur Arlind
         //    if(count($_POST) > 0){
            
         //       // besoin ecrire setMovie_id et setUser_id parce que pas hydrate avec $_POST $_POST
         //       $objCommentEntity->hydrate($_POST);
         //       $objCommentEntity->setMovie_id($objMovie->getId());
         //       $objCommentEntity->setUser_id($_SESSION['user']->getId());
            
         //       $strTitleCom   = $_POST['title']??"";
         //       $strContentCom = $_POST['content']??"";
         //       var_dump("ici");
         //       var_dump($objMovieModel->findMovie($objMovie->getId()));
            
         //       if($strTitleCom == ""){
         //          $arrErrors['title'] = "Le titre est obligatoire pour comment!";
         //       }
         //       if($strContentCom == ""){
         //          $arrErrors['content'] = "Le contenu est obligatoire pour comment!";
         //       }
         //       if( $objCommentEntity->getContent()!='' && $objCommentEntity->getTitle()!='' ){
         //          $objCommentModel->addComment($objCommentEntity);
         //       }
         // }
         // -- Fin fonction commentaires Arlind
         
         $objMovie->hydrate($arrMovieEntity);
   
         

         // if (!isset($_GET['id']) || !($objMovieModel->findMovie($_GET['id']) )){
         //    header("Location:future_index.php?ctrl=error&action=error404");
         // }          

         // pour qua comme parameter entre $arrMovieEntity 




         // --- Juliette - 13/02/2025 - Requête insertion commentaire + photos
         // Exécute la requête une première fois pour savoir si la limite de photos est déjà atteinte ou non
         $intNbTotalPic = $objCommentModel->countPictures($objMovie->getId());

         // À l'envoi du formulaire, je vérifie si un fichier a été importé ou non
         require_once("entities/picture_entity.php");
         if(count($_POST) > 0){ 
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
            if($_FILES['pictures']['error'][0] != 4){
               // Compte du nombre de fichiers importés
               $intImportedPic = count($_FILES['pictures']['name']);

               // Instancie l'entité Picture
               $objPicture = new PictureEntity;

               // Vérifie que le nombre de fichiers importé ne dépasse pas la limite max pour le film
               if(($intNbTotalPic + $intImportedPic) > 10){
                  $intRestPic = 10 - $intNbTotalPic;
                  $arrErrors['picture'] = "Vous dépassez la limite de photos accordées à ce film. Vous ne pouvez en ajouter que ".$intRestPic." maximum.";
               } else {
                  for ($i = 0; $i < $intImportedPic; $i++){
                     if ($_FILES['pictures']['error'][$i] == 1){
                        $arrErrors['import'] = $_FILES['pictures']['name'][$i]." est trop lourde.";
                        break;
                     }
                  }
                  $boolPicOk = true;
               }
            }
            
            // Pas d'erreur dans le formulaire -> on traite la donnée
            if(count($arrErrors) == 0){
               // Récupère le résultat de la requête d'ajout du commentaire (soit id du commentaire, sinon false)
               $idComment = $objCommentModel->addComment($objCommentEntity);

               // Insertion du commentaire réussie
               if($idComment !== false){
                  if((isset($boolPicOk)) && ($boolPicOk === true)){
                     // Pour chaque fichier importé, je récupère les infos et j'insère
                     for($i = 0; $i<$intImportedPic; $i++){
                        $strSource = $_FILES['pictures']['tmp_name'][$i]; // Récupération de l'image

                        // Traitement de l'image importée
                        // Création d'une imageGD
                        switch($_FILES['pictures']['type'][$i]){
                           case "image/webp":
                              $image = imagecreatefromwebp($strSource);
                              break;
                           case "image/jpeg":
                              $image = imagecreatefromjpeg($strSource);
                              break;
                           case "image/png":
                              $image = imagecreatefrompng($strSource);
                              break;
                        }

                        // -- TRAITEMENT DE L'IMAGE
                        $arrFileExplode	= explode(".", $_FILES['pictures']['name'][$i]);
                        $strFileName = bin2hex(random_bytes(10)).".webp"; // Génération d'un nom de fichier random en webp
                        $strDest = "assets/img/movies/movie_pictures/".$strFileName; // Définition de la destination du fichier et de son nom
                        
                        list($intWidth, $intHeight) = getimagesize($strSource); // Récupération des dimensions de l'image

                        $intShortSize   = 600; // Valeur du plus petit côté

                        // Calcul et redimensionnement proportionnel des dimensions de l'image selon l'orientation
                        if ($intWidth < $intHeight){
                           // Format portrait
                           $boolPortrait = true;
                           $intLongSize = round(($intShortSize*$intHeight)/$intWidth); // Produit en croix
                           $objMask = imagecreatetruecolor($intShortSize, $intLongSize); // Conteneur vide portrait;
                           imagecopyresized($objMask, $image, 0, 0, 0, 0, $intShortSize, $intLongSize, $intWidth, $intHeight); // Redimensionnement
                        } else {
                           // Format paysage
                           $boolPortrait = false;
                           $intLongSize = round(($intShortSize*$intWidth)/$intHeight); // Produit en croix
                           $objMask = imagecreatetruecolor($intLongSize, $intShortSize); // Conteneur vide paysage;
                           imagecopyresized($objMask, $image, 0, 0, 0, 0, $intLongSize, $intShortSize, $intWidth, $intHeight); // Redimensionnement
                        }
                        // Génération de l'image traitée dans le dossier
                        imagewebp($objMask,$strDest);

                        // Remplissage des données
                        $objPicture->setFile($strFileName);
                        $objPicture->setComment_id($idComment);
                        // Récupère le résultat de la requête d'insertion des photos
                        $boolPicQuery = $objCommentModel->addPicture($objPicture);

                        if($boolPicQuery===false){
                           $arrErrors['import']= "Erreur lors de l'importation des images";
                           break;
                        }
                     }

                     // Si erreur dans le traitement des données, on supprime le commentaire qui vient d'être inséré
                     if(count($arrErrors) != 0){
                        $objCommentModel->deleteComment($idComment);
                        $arrErrors['comment']= "Erreur lors de l'enregistrement du commentaire";
                     }
                  }

                  // Pas d'erreur -> On renvoie un message de validation
                  $_SESSION['success'] = "Commentaire enregistré. Il sera soumis à la modération avant publication.";

                  // Redirection sur la même page pour vider le $_POST
                  $strUrl = $_SERVER['QUERY_STRING'];
                  header("Location:future_index.php?".$strUrl);

               } else {
                  // Erreur lors de l'insertion du commentaire seul
                  $arrErrors['comment']= "Erreur lors de l'enregistrement du commentaire";
               }
            }
         }
         $this->_arrData['objCommentEntity'] = $objCommentEntity;
         $this->_arrData['intNbTotalPic'] = $intNbTotalPic;
         // --- Fin Juliette
         

         $this->_arrData['objMovie']         = $arrMovieEntity;
         $this->_arrData['objMovie']         = $objMovie;
         $this->_arrData['idMovie']          = $idMovie;
         $this->_arrData['strTitleCom']      = $strTitleCom;
         $this->_arrData['strContentCom']    = $strContentCom;
         $this->_arrData['arrErrors']        = $arrErrors;
         $this->_arrData['objCommentModel']  = $objCommentModel;
         
         $this->display('page_dun_film');
      }

      
      /**
       * Page "contact"
       * @author Arlind Halimi
       * @date
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
   }