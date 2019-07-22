<?php 
    //connect
    include ('db_connect.php');

    //write query for all pizza
    $sql = 'SELECT  pizza, ingerdient, id FROM pizza_order ORDER BY create_at';
    //make query and get result
    $result = mysqli_query($connect, $sql);

    //fetch the resulting rows as an array;
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // echo '<pre>' , var_dump($pizzas) , '</pre>';
    
    //free result from database
    mysqli_free_result ($result);

    //close the connection
    mysqli_close($connect);

?>