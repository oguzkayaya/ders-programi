<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ders Güncelleme</title>
    
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
        .duzenTablo td{
            padding:10px;
            text-align:right;
        }
        .duzenTablo tr{
            font-weight: bold;
        }
        .duzenTablo tr td:last-child{
            font-weight: normal;
        }
    </style>

</head>
<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">

    <?php 
        $viewData["baslik"] = "$ders->fakulteAd, $ders->bolumAd, $ders->dersKodu $ders->dersAd dersi için Güncelleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("ders/index/$ders->fakulteId/$ders->bolumId")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>

    <div style="height:50px;"></div>

    <div style="font-size:20px; text-align:center;">
        <form action="" method="post">
            <table align="center" class="duzenTablo">
                <tr>
                    <td>Dersin Kodu : </td>
                    <td><input type="text" placeholder="Ders Kodu" name="kod" value="<?php echo $ders->dersKodu ?>" required></td>
                </tr>
                <tr>
                    <td>Dersin Adı : </td>
                    <td><input type="text" placeholder="Ders Adı" name="dersAd" value="<?php echo $ders->dersAd ?>" required></td>
                </tr>
                <tr>
                    <td>Uygulama Saati : </td>
                    <td><input type="text" placeholder="Uygulama Saati" name="uygulama"  value="<?php echo $ders->uygulama ?>" required></td>
                </tr>
                <tr>
                    <td>Teorik Ders Saati : </td>
                    <td><input type="text" placeholder="Teorik Saati" name="teorik" value="<?php echo $ders->teorik ?>" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input type="hidden" name="dersId" value="<?php echo $ders->dersId ?>">
                        <input type="submit" class="buton" value="Dersi Güncelle">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>