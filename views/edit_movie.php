<div class="container pt-5">
        <div class="row">
            <div class="col-md-4 card">
                
                <img src="assets/img/movies/movie_posters/<?php echo($objMovie->getPoster()); ?>" alt="photo de film">
                                                        
            </div>
            <div class="col-md-8">
            
                <form action="">
                    <h2><input type="text" value="<?php echo($objMovie->getName()); ?>"> </h2>
                    <p><input type="text" value="<?php echo($objMovie->getDesc()); ?>"> </p>
                    <p><input type="date" value=""> <?php echo($objMovie->getDateFr()); ?></p>
                    <!--<p><input type="date" value=""> <?php //echo($objMovie->getCreation_date()); ?> </p>-->
                    <?php if($objMovie->getPegi() != null){ ?>
                        <p><input type="text" value="<?php echo($objMovie->getPegi()); ?>"> </p>
                    <?php } ?>
                    <p><input type="text" value="<?php echo($objMovie->getDuration()); ?>"> </p>

                    <?php 
                        foreach($arrActors as $actor){
                            $objOneActor = new ActorEntity();
                            $objOneActor->hydrate($actor);
                            //var_dump($objOneActor);
                            ?> 
                            <p> <input type="text" value="<?php echo($objOneActor->getLast_name()." ".$objOneActor->getFirst_name()); ?>">  </p>
                        <?php }
                    ?>
                    <input class="btn" type="submit" name="edit" id="edit" value="Edit">
                </form>   
                
            </div>
        </div>
    </div>