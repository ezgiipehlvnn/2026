
<?php
// Not hesaplama fonksiyonu

function notHesapla(float $vize, float $final): array
{
/*
  notHesapla():
  - Vize ve final notlarını alır
  - Ortalama hesaplar (vize %40, final %60)
  - Ortalamaya göre harf notu belirler
  - Geçti/Kaldı sonucunu üretir
  - Hepsini dizi (array) olarak geri döndürür
*/
    $ortalama = ($vize * 0.40) + ($final * 0.60);
    if ($ortalama >= 90) {
        $harf = "AA";
    } elseif ($ortalama >= 85) {
        $harf = "BA";
    } elseif ($ortalama >= 80) {
        $harf = "BB";
    } elseif ($ortalama >= 70) {
        $harf = "CB";
    } elseif ($ortalama >= 60) {
        $harf = "CC";
    } elseif ($ortalama >= 50) {
        $harf = "DC";
    } else {
        $harf = "FF";
    }
    $durum = ($ortalama >= 50) ? "Gecti" : "Kaldi";
    return [
        "ortalama" => round($ortalama, 2),
        "harf" => $harf,
        "durum" => $durum
    ];
}
$hata = "";
$sonuc = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $adSoyad = trim($_POST["adsoyad"] ?? "");
    $ders = trim($_POST["ders"] ?? "");
    $vize = $_POST["vize"] ?? "";
    $final = $_POST["final"] ?? "";
    if ($adSoyad === "" || $ders === "" || $vize === "" || $final === "") {
        $hata = "Lutfen tum alanlari doldurunuz.";
    } elseif (!is_numeric($vize) || !is_numeric($final)) {
        $hata = "Notlar sayisal olmalidir.";
    } elseif ($vize < 0 || $vize > 100 || $final < 0 || $final > 100) {
        $hata = "Notlar 0 ile 100 arasinda olmalidir.";
    } else {
        $sonuc = notHesapla((float)$vize, (float)$final);
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Giris ve Hesaplama</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff, #f8fbff);
            min-height: 100vh;
        }

        .form-wrapper {
            max-width: 650px;
            margin: 50px auto;
        }

        .card-custom {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .card-header-custom {
            background: #4f46e5;
            color: #fff;
            text-align: center;
            padding: 18px;
            font-size: 22px;
            font-weight: 700;
        }

        .card-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 10px 12px;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        }

        .btn-calc {
            background-color: #4f46e5;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            color: #fff;
        }

        .btn-calc:hover {
            background-color: #4338ca;
            color: #fff;
        }

        .result-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 12px;
            background: #f3f4f6;
            border-left: 5px solid #4f46e5;
        }

        .result-box p {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-wrapper">
        <div class="card card-custom">
            <div class="card-header-custom">
                Ogrenci Not Giris Formu
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="adsoyad" class="form-label">Ad Soyad</label>
                        <input type="text" name="adsoyad" id="adsoyad" class="form-control"
                               value="<?= htmlspecialchars($_POST['adsoyad'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="ders" class="form-label">Ders Adi</label>
                        <input type="text" name="ders" id="ders" class="form-control"
                               value="<?= htmlspecialchars($_POST['ders'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="vize" class="form-label">Vize Notu</label>
                        <input type="number" name="vize" id="vize" class="form-control"
                               min="0" max="100" step="0.01"
                               value="<?= htmlspecialchars($_POST['vize'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="final" class="form-label">Final Notu</label>
                        <input type="number" name="final" id="final" class="form-control"
                               min="0" max="100" step="0.01"
                               value="<?= htmlspecialchars($_POST['final'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-calc w-100">Notu Hesapla</button>
                </form>

                <?php if ($sonuc): ?>
                    <div class="result-box">
                        <p><strong>Ortalama:</strong> <?= $sonuc["ortalama"] ?></p>
                        <p><strong>Harf Notu:</strong> <?= $sonuc["harf"] ?></p>
                        <p><strong>Durum:</strong> <?= $sonuc["durum"] ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($hata): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Hata',
        text: '<?= htmlspecialchars($hata, ENT_QUOTES, "UTF-8") ?>',
        confirmButtonColor: '#4f46e5'
    });
</script>
<?php endif; ?>

<?php if ($sonuc): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Hesaplama Basarili',
        html: `
            <b>Ortalama:</b> <?= $sonuc["ortalama"] ?><br>
            <b>Harf Notu:</b> <?= $sonuc["harf"] ?><br>
            <b>Durum:</b> <?= $sonuc["durum"] ?>
        `,
        confirmButtonColor: '#4f46e5'
    });
</script>
<?php endif; ?>

</body>
</html>
