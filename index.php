<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <title>BingeWatchr - Home</title>
        </head>
        <body>
            <?php
            class MotherModel{
		
                protected object $_db;
                
                public function __construct(){
                    try{
                        // Connexion à la base de données
                        $this->_db = new PDO(
                                        "mysql:host=localhost;dbname=BWR_home",  // Serveur et BDD
                                        "root",  		//Nom d'utilisateur de la base de données
                                        "",	 	// Mot de passe de la base de données
                                        array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC) // Mode de renvoi 
                                        ); 
                        // Pour résoudre les problèmes d’encodage
                        $this->_db->exec("SET CHARACTER SET utf8"); 	
                        // Configuration des exceptions
                        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                    } catch(PDOException $e) { 
                        echo "Échec : " . $e->getMessage(); 
                    }
                }
            }

            
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <a href="#">
                            <h2><?php  ?></h2>
                            <img src="" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-2">
                    
                    </div>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </html>