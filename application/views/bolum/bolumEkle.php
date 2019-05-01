<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bölüm Ekle</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ozel.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/renkliTablo.css"); ?>">

</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "$fakulte->fakulteAd için Bölüm Ekleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("fakulte/index/$fakulte->fakulteId")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>

    <div style="height:100px;"></div>

    <div style="font-size:20px; text-align:center;">
    <form action="" method="post">
        <input type="text" size="30px" placeholder="Bölüm Adı" name="bolumAd" style="font-size:17px; padding:10px;" required>
        <br><br>
        <select name="tur" style="width:330px;font-size:17px; padding:15px 0px;">
            <option value="1" >Normal Öğretim</option>
            <option value="2">İkinci Öğretim</option>
        </select>
        <br><br>
        <input type="hidden" name="fakulte" value="<?php echo $fakulte->fakulteId ?>"  >
        <button type="submit" class="buton" style="padding:10px 50px;">Birim Ekle</button>
    </form>
    </div>
</body>
</html>