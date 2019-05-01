<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ders Ekleme</title>

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
        }
        table {
        text-align: center;
        }
    </style>

</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "$birimAd, $bolumAd->BolumAd için Ders Ekleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("ders/index/$birimId/$bolumId")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>
    
    <div style="height:50px;"></div>

    <div style="font-size:20px; text-align:center;">
        <form action="" method="post">
                    <input type="text" placeholder="Ders Kodu" name="kod" required>
                    <input type="text" placeholder="Ders Adı" name="dersAd" required> <br><br>
                    <input type="text" placeholder="Uygulama Saati" name="uygulama" value="" required> 
                    <input type="text" placeholder="Teorik Saati" name="teorik" required> <br><br>
                    <input type="hidden" name="birim" value="<?php echo $birimId ?>">
                    <input type="hidden" name="bolum" value="<?php echo $bolumId ?>">
                    <input type="submit" class="buton" value="Dersi Ekle">
        </form>
    </div>

</body>
</html>