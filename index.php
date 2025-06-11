<?php
if (isset($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {

    if ($_FILES['image']['size'] <= 3000000) {

        $infoImage      = pathinfo($_FILES['image']['name']);
        $infoExtention  = $infoImage['extension'];
        $extentionArray = ['jpg', 'gif', 'png', 'jpeg'];

        if (in_array($infoExtention, $extentionArray)) {

            $newpicture = time() . rand() . rand() . '.' . $infoExtention;
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $newpicture);
            $send = 'ok';
        }
    }
}

?>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/default.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>ShareFiles - Hébergez gratuitement vos images et en illimité</title>
</head>

<body>

    <header>
        <a href="../">
            <span>ShareFiles</span>
        </a>
    </header>

    <section>

        <h1>
            <?php if (isset($send) && $send === 'ok') : ?>
                <img src=" uploads/<?= $newpicture ?>" alt="">
            <?php else: ?>
                <i class="fas fa-paper-plane"></i>
            <?php endif ?>
        </h1>

        <?php if (isset($send) && $send === 'ok') : ?>
            <h4 style="text-align: center; font-weight: 200;">image envoyez avec succés !</h4>
            <p style="text-align: center; font-weight: 100;">Retrouvez le lien ci-dessous vers votre fichier</p>
            <input type="text" class="link" value="http://localhost:8000/uploads/<?= $newpicture ?>" readonly>
        <?php else: ?>

            <form method="post" action="index.php" enctype="multipart/form-data">
                <p>
                    <label for="image">Sélectionnez votre fichier</label><br>
                    <input type="file" name="image" id="image">
                </p>
                <p id="send">
                    <button type="submit">Envoyer <i class="fas fa-long-arrow-alt-right"></i></button>
                </p>
            </form>
        <?php endif ?>
    </section>

</body>

</html>