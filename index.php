<?php require_once "./partials/header.php"; 

$id = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = htmlspecialchars(trim($_GET['id'] ?? ''));

    if ($id==1){
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="" alt="test">
        <a href="index.php"><button class="submit">Retour</button></a>
        <?php
    } elseif ($id==2){
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="" alt="test2">
        <a href="index.php"><button class="submit">Retour</button></a>
        <?php
        
    } elseif ($id==3){
        echo "<style>.label{ display : none;}</style>";
        ?>
        <img src="" alt="test3">
        <a href="index.php"><button class="submit">Retour</button></a>
        <?php
    } 

}


?>
<style>


</style>


<form action="index.php" method="get" class="label">
    <div class="label-container">
        <div class="label-item">
            <label for="image1">1ère année</label>
            <a href="index.php?id=1">
                <img src="./image/WWE Jey Uso.jpg" alt="Logo 1ère année" class="img-size">
            </a>
        </div>
        <div class="label-item">
            <label for="image2">2ème année</label>
            <a href="index.php?id=2">
                <img src="./image/WWE Roman Reigns.jpg" alt="Logo 2ème année" class="img-size">
            </a>
        </div>
        <div class="label-item">
            <label for="image3">3ème année</label>
            <a href="index.php?id=3">
                <img src="./image/WWE Jimmy Uso.jpg" alt="Logo 3ème année" class="img-size">
            </a>
        </div>
    </div>
</form>
