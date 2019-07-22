<?php 
	
    //connect
    include ('./config/db_connect.php');

	$email = $pizza = $ingerdient = "";
	$errors = ["email" => " ", "pizza" => " ", "ingerdient"=>""];


    if(isset($_POST['submit'])){

        //check email
        if(empty($_POST['email'])) {
            $errors ["email"] = "Give me sum mail ?";
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors ["email"] = "your email look weird... :doubt:";
            }
        }
        //check pizza
        if(empty($_POST['pizza'])) {
            $errors["pizza"] = "where is your pizza ?";
        } else {
			$pizza = $_POST["pizza"];
			if(!preg_match('/^[a-zA-Z\s]+$/', $pizza)) {
				$errors["pizza"] = "is thiz pizza ?";
			}		
        }
        //check ingerdient
        if(empty($_POST['ingerdient'])) {
			$errors["ingerdient"] = "Errh? Hello ! I cant make a pizza without anything on it";
        } else {
			$ingerdient =$_POST['ingerdient'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingerdient )) {
				$errors["ingerdient"] =  "... u sure ? u want to push these thing to ur pizza ?";
			}
        }

        //if have an errors  then DO sunmthing
        if(array_filter($errors)) {
            //true
            //escape sql chars
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $pizza = mysqli_real_escape_string($connect, $_POST['pizza']);
            $ingerdient = mysqli_real_escape_string($connect, $_POST['ingerdient']);
            //create sql
            $sql = "INSERT INTO pizza_order(email, pizza, ingerdient) VALUES ('".$email."', '".$pizza."', '".$ingerdient."')";

                //save and check
            if (mysqli_query($connect, $sql)) {
                //success
                header ('Location: index.php');
            } else {
                //errors
                echo "query_error";
            }
        } else {
             
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Document</title>
    </head>
            <?php include('temp/header.php'); ?>
            <section class="container center grey-text ">
                <h4>Tell me what u want >:(</h4>
                <form class="white" action="addPizza.php" method="POST">
                    <label class="left">Your email:</label>
                    <input type="text" name="email" value="<?php  echo htmlspecialchars($email);?>">
					<div class="red-text "> <?php  echo $errors ["email"];?></div>

                    <label class="left">Your Pizza:</label>
                    <input type="text" name="pizza" value="<?php  echo htmlspecialchars($pizza);?>">
					<div class="red-text"> <?php  echo $errors ["pizza"];?></div>

                    <label class="left">Ingredient:</label>
                    <input type="text" name="ingerdient" value="<?php  echo htmlspecialchars($ingerdient);?>">
					<div class="red-text "> <?php  echo $errors ["ingerdient"];?></div>

                    <button type="submit" value="submit" name="submit" class="btn brand center z-depth-0 ">
                        Submit
                    </button>
                </form>
            </section>

            
            <?php include('temp/footer.php')?>
    </body>
</html>