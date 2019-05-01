<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program Düzenleme</title>

    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/ozel.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/renkliTablo.css"); ?>">

    <style>
        input[type="submit"]{
            min-width:100px;
            border-radius:5px;
        }
        input[type="submit"]:disabled{
            background-color:#c9c9c9;
            border:#c9c9c9;
        }
    </style>

    <script>
        function buttonKont() 
        {
            if(
                document.getElementById("tur").value != "-1" &&
                document.getElementById("org").value != "-1" &&
                document.getElementById("sinif").value != "-1"
                )
            {
                document.getElementById("duzenButon").disabled = false;
            }
        }
    </script>
</head>

<body style="background-image:url('<?php echo base_url("assets/img/bg1.jpg"); ?>');">
    <?php 
        $viewData["baslik"] = "$g_bolumAd->birimAd, $g_bolumAd->BolumAd-$tur, $gun $saat Ders Düzenleme ";
        $this->load->view("ortak/ust",$viewData); 
        $this->load->view("ortak/ust2");
        $viewD3 = array(
            "birim" => 0,
            "bolum" => 0,
            "ders" => 0,
            "eleman" =>0,
            "sinif" => 0,
            "geri" => 1,
            "geriLink" => base_url("program/goster/$birim/$bolum")
        );
        $this->load->view("ortak/ust3",$viewD3);
    ?>
    <div style="margin:50px; float:left;">
        <table>
            <thead>
                <tr><td>Dersler</td></tr>
            </thead>
            <tbody>
                <?php foreach ($dersler as $ders) 
                { ?>
                    <tr onclick="window.location.href='<?php echo base_url("program/duzenle?progId=$pId?drs=$ders->dersId"); ?>'" 
                    <?php if($gDers == $ders->dersId) echo "style='background-color:#8b9f15;'" ?>>
                        <td>
                            <?php echo "$ders->dersKodu - $ders->dersAd"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <div style="margin:50px;float:left;">
        <table>
            <thead>
                <tr><td>Türü</td></tr>
            </thead>
            <tbody>
                <tr onclick="
                    var a = this.parentNode.children;
                    var i;
                    for(i=0;i<a.length;i++)
                    {
                        //a[i].style.backgroundColor = 'white';
                        a[i].removeAttribute('style');
                    }
                    this.setAttribute('style', 'background-color: #8b9f15;');
                    document.getElementById('tur').value='1';
                    buttonKont();
                    "
                    <?php if($gTur == 1) echo "style='background-color:#8b9f15;'" ?>><td>Teorik</td></tr>
                <tr onclick="
                    var a = this.parentNode.children;
                    var i;
                    for(i=0;i<a.length;i++)
                    {
                        //a[i].style.backgroundColor = 'white';
                        a[i].removeAttribute('style');
                    }
                    this.setAttribute('style', 'background-color: #8b9f15;');
                    document.getElementById('tur').value='2';
                    buttonKont();
                    "
                    <?php if($gTur == 2) echo "style='background-color:#8b9f15;'" ?>><td>Uygulama</td></tr>
            </tbody>
        </table>
    </div>

    <div style="margin:50px;float:left;">
        <table>
            <thead>
                <tr><td>Öğretim Elemanları</td></tr>
            </thead>
            <tbody>
            <?php foreach ($elemanlar as $eleman) { ?>
                <tr onclick="
                    var a = this.parentNode.children;
                    var i;
                    for(i=0;i<a.length;i++)
                    {
                        //a[i].style.backgroundColor = 'white';
                        a[i].removeAttribute('style');
                    }
                    this.setAttribute('style', 'background-color: #8b9f15;');
                    document.getElementById('org').value='<?php echo $eleman->elemanId; ?>';
                    buttonKont();
                    "
                    <?php if($gEleman == $eleman->elemanId) echo "style='background-color:#8b9f15;'" ?>>
                    <td>
                        <?php echo "$eleman->elemanAd - $eleman->unvan"; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div style="margin:50px;float:left;">
        <table>
            <thead>
                <tr><td>Sınıflar</td></tr>
            </thead>
            <tbody>
            <?php foreach ($siniflar as $sinif) { ?>
                <tr onclick="
                    var a = this.parentNode.children;
                    var i;
                    for(i=0;i<a.length;i++)
                    {
                        //a[i].style.backgroundColor = 'white';
                        a[i].removeAttribute('style');
                    }
                    this.setAttribute('style', 'background-color: #8b9f15;');
                    document.getElementById('sinif').value='<?php echo $sinif->sinifId; ?>';
                    buttonKont();
                    "
                <?php if($gSinif == $sinif->sinifId) echo "style='background-color:#8b9f15;'" ?>>
                    <td>
                        <?php echo $sinif->sinifAd; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div style="margin:50px;float:left;">
        <form>
            <input type="hidden" name="ders" value="<?php echo $gDers; ?>">
            <input type="hidden" name="tur" id="tur" value="<?php echo $gTur; ?>">
            <input type="hidden" name="org" id="org" value="<?php echo $gEleman; ?>">
            <input type="hidden" name="sinif" id="sinif" value="<?php echo $gSinif; ?>">
            <input type="submit" class="buton" formmethod="post" formaction="<?php echo base_url('program/duzenle/').$pId; ?>" value="Kaydet" id="duzenButon"
                <?php if($gTur==-1 || $gEleman==-1 || $gSinif==-1) echo "disabled"; ?>>
        </form>
    </div>

</body>
</html>