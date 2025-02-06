<div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()); ?>" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            

                    <h2><?php echo($objMovie->getName()); ?>  </h2>
                    <p><?php echo($objMovie->getDesc()); ?> </p>
                    <p><?php echo($objMovie->getDateFr()); ?> </p>
                    <p><?php echo($objMovie->getCreation_date()); ?>  </p>
                    <?php if($objMovie->getPegi() != null){ ?>
                        <p><?php echo($objMovie->getPegi()); ?> </p>
                    <?php } ?>
                    <p><?php echo($objMovie->getDuration()); ?> </p>

                    <?php 
                        $objActorsModel = new ActorModel();
                        
                        $arrActors = $objActorsModel->findActor($idMovie); // cherche le ID de movie

                        foreach($arrActors as $actor){
                            $objOneActor = new ActorEntity();
                            $objOneActor->hydrate($actor);
                            //var_dump($objOneActor);
                            
                            ?> 
                            <p> <?php echo($objOneActor->getLast_name()." ". $objOneActor->getFirst_name()); ?> </p>
                        <?php }
                        //var_dump($arrActors);
                    ?>
                    
                
            </div>
        </div>
    </div>