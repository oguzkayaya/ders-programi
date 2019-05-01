<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fakülte Ekle</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ozel.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/renkliTablo.css"); ?>">

    
</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "Birim Ekleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("fakulte")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>

    <div style="height:100px;"></div>

    <div style="font-size:20px; text-align:center;">
    <form action="" method="post">
    <input type="text" size="30px" name="fakulteAd" placeholder="Eklenecek Birim Adınız Giriniz" style="font-size:20px;" required>
    <br><br>
    <button type="submit" class="buton" style="padding:10px 50px;">Birim Ekle</button>
    </form>
    </div>
</body>
</html>