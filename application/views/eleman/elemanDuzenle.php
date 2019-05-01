<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Öğretim Elemanı Güncelleme</title>

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
        $viewData["baslik"] = "$eleman->unvan - $eleman->elemanAd için Güncelleme";
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
            <table align="center" class="duzenTablo">
                <tr>
                    <td>Adı-Soyadı : </td>
                    <td><input type="text" name="ad" value="<?php echo $eleman->elemanAd ?>" required></td>
                </tr>
                <tr>
                    <td>Ünvanı : </td>
                    <td><input type="text" name="unvan" value="<?php echo $eleman->unvan ?>" required></td>
                </tr>
                <tr>
                    <td>Telefon No : </td>
                    <td><input type="text" name="tel" value="<?php echo $eleman->telefon ?>" required></td>
                </tr>
                <tr>
                    <td>E-Posta : </td>
                    <td><input type="text" name="mail" value="<?php echo $eleman->eMail ?>" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="elemanId" value="<?php echo $elemanId; ?>">
                        <input type="submit" class="buton" value="Güncelle">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>