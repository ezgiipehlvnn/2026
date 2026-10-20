<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Başvuru Sonucu</title>
</head>
<body>
    <h1>Gelen Başvuru Bilgileri</h1>

    <?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h3>Yöntem: <span style='color:red;'>POST</span></h3>";
        $veriler = $_POST; 
    } 
   
    elseif ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
        echo "<h3>Yöntem: <span style='color:blue;'>GET</span></h3>";
        $veriler = $_GET; 
        }

    echo "<strong>İsim: </strong>" . $veriler["isim"] . "<br>";
    echo "<strong>Soyisim: </strong>" . $veriler["soyisim"] . "<br>";
    echo "<strong>İl/İlçe: </strong>" . $veriler["il"] . " / " . $veriler["ilçe"] . "<br>";
    echo "<strong>Adres: </strong>" . $veriler["adres"] . "<br>";
    echo "<strong>Telefon: </strong>" . $veriler["telefon"] . "<br>";
    echo "<strong>CV: </strong><br>" . nl2br($veriler["cv"]) . "<br>";
    ?>

    <br>
    <a href="form_post.php">Geri Dön</a>
</body>
</html>