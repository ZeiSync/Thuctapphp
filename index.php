<?php include('./config/connect.php') ?>
<!DOCTYPE html>
<html lang="en">

        <?php include('temp/header.php'); ?>

        <h4 class="center grey-text">Pizza !</h4>
        <div class="container">
            <div class="row">
                <?php foreach($pizzas as $order) :?>

                    <div class="col s6 m4">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h5><?php echo htmlspecialchars($order['pizza']); ?></h5>
                                <ul>
                                    <?php foreach(explode(",",$order['ingerdient']) as $ing) :?>

                                        <li><?php echo htmlspecialchars($ing)?></li>

                                    <?php  endforeach; ?>
                                </ul>
                            </div>
                             <div class="card-action right-align">
                                <a class="brand-text p2" href="details.php?id=<?php echo $order['id']?>">More infro</a>
                             </div>
                        </div>
                    </div>
                
  
                <?php endforeach; ?>
            </div>
        </div>

        <?php include('temp/footer.php')?>
    </body>
</html>