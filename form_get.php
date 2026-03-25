<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>POST Formu</title>
</head>
<body>
   <center><h1>İş Başvuru Formu </h1></center>
   <form method="get" action="sonuc.php">
      <input type="text" name="isim" placeholder="isminizi giriniz">
      <input type="text" name="soyisim" placeholder="soyisminizi giriniz"><br>
      <input type="text" name="il" placeholder="il giriniz">
      <input type="text" name="ilçe" placeholder="ilçe giriniz"><br>
      <input type="text" name="adres" placeholder="adres giriniz">
      <input type="text" name="telefon" placeholder="telefon giriniz"><br>
      <textarea name="cv" placeholder="CV'nizi giriniz" rows="6" cols="44"></textarea>
      <input type="submit" value="GET ile Gönder">
   </form>
</body>
</html>