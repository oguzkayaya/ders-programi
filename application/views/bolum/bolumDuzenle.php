<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bölüm Güncelle</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ozel.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/renkliTablo.css"); ?>">


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
    </style>
</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "{$bolum[0]->fakulteAd}, {$bolum[0]->BolumAd} için Güncelleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("fakulte/index/{$bolum[0]->fakulteId}")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>
    
    <div style="height:100px;"></div>

    <div style="font-size:20px; text-align:center;">
        <form action="" method="post">
            <select name="fakulte">
                <?php foreach($fakulteler as $fakulte)
                {
                    if($fakulte->fakulteAd == $bolum[0]->fakulteAd)
                        echo "<option selected value='{$fakulte->fakulteId}'>{$fakulte->fakulteAd}</option>";
                    else
                        echo "<option value='{$fakulte->fakulteId}'>{$fakulte->fakulteAd}</option>";
                } ?>
            </select>
            <br><br>
            <input type="text" placeholder="Bölüm Adı" name="bolumAd" value=<?php echo $bolum[0]->BolumAd; ?> style="font-size:20px;" required>
            <br><br>
            <input type="hidden" name="bolumId" value=<?php echo $bolum[0]->bTurId; ?>>
            <select name="tur">
                <option value="1" <?php if($bolum[0]->ortTur == 1) echo "selected"; ?> >Normal Öğretim</option>
                <option value="2" <?php if($bolum[0]->ortTur == 2) echo "selected"; ?> >İkinci Öğretim</option>
            </select>
            <br><br>
            <button type="submit" class="buton" style="padding:10px 50px;">Bölümü Güncelle</button>
        </form>
    </div>
</body>
</html>