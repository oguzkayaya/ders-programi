<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sınıf Güncelleme</title>

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
        $viewData["baslik"] = "$sinif->sinifAd için Güncelleme";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("sinif")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>

    <div style="height:50px;"></div>

    <div style="font-size:20px; text-align:center;">
        <form action="" method="post">
            <table align="center" class="duzenTablo">
                <tr>
                    <td>Sınıf Adı : </td>
                    <td><input type="text" placeholder="Sınıf Adı" name="sinifAd" value="<?php echo $sinif->sinifAd ?>" required></td>
                </tr>
                <tr>
                    <td>Kapasite : </td>
                    <td><input type="text" placeholder="Sınıf Kapasitesi" name="kapasite" value="<?php echo $sinif->kapasite ?>" required></td>
                </tr>
                <tr>
                    <td>Sınıf Cinsi : </td>
                    <td><input type="text" placeholder="Sınıf Cinsi" name="cins" value="<?php echo $sinif->cinsi ?>" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="g_sinif" value="<?php echo $g_sinif; ?>">
                        <input type="submit" class="buton" value="Güncelle">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>