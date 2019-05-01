<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Öğretim Elemanı Ekleme</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ozel.css"); ?>">

    <style>
        select{
            width:300px;
            font-size:20px;
            padding:11px 10px;
        }
        input{
            width:300px;
            font-size:20px;
            padding:10px;
            margin:10px;    
        }
        table {
        text-align: center;
        }
    </style>

</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "Öğretim Elemanı Ekleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("eleman")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>
    
    <div style="height:50px;"></div>

    <div style="font-size:20px; text-align:center;">
        <form action="" method="post">   
            <input type="text" placeholder="Ad-Soyad" name="ad" required><br>
            <input type="text" placeholder="Ünvan" name="unvan" required><br>
            <input type="text" placeholder="Telefon" name="tel" required><br>
            <input type="text" placeholder="E-Mail" name="mail" required><br>
            <input type="submit" class="buton" value="Ekle">
        </form>
    </div>
</body>
</html>