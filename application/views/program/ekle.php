<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program Ders Ekleme</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <script>
        function buttonKont() 
        {
            if(document.getElementById("ders").value != "-1" &&
            document.getElementById("tur").value != "-1" &&
            document.getElementById("org").value != "-1" &&
            document.getElementById("sinif").value != "-1")
            {
                document.getElementById("ekleButon").disabled = false;
            }
        }
    </script>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">
   
    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "$BolumBilgi->birimAd, $BolumBilgi->BolumAd-$BolumBilgi->ortTur, $gun $saat Ders Ekleme";
    $this->load->view("ortak/main-ust" , $viewD); ?>

    

    <section class="content"  style="text-align:center;">
        <div>
            <div>
                <form>
                    <input type="hidden" name="saat" value="<?php echo $saat; ?>">
                    <input type="hidden" name="gun" value="<?php echo $gun; ?>">
                    <input type="hidden" name="birim" value="<?php echo $birimId; ?>">
                    <input type="hidden" name="bolum" value="<?php echo $bolumId; ?>">
                    <input type="hidden" name="ders" id="ders" value="<?php echo $gelenDers; ?>">
                    <input type="hidden" name="tur" id="tur" value="<?php echo $gelenTur; ?>">
                    <input type="hidden" name="org" id="org" value="<?php echo $gelenEleman; ?>">
                    <input type="hidden" name="sinif" id="sinif" value="-1">
                    <input class="btn btn-success btn-flat islemButon" disabled type="submit" formmethod="post" value="EKLE" id="ekleButon">
                </form>
                <hr>
            </div>

            <div class="col-md-3">
                <table align="center" class="table table-hover">
                    <thead>
                        <tr><td>Dersler</td></tr>
                    </thead>
                    <tbody>
                    <?php if(count($dersler) > 0)
                    {
                        foreach ($dersler as $ders) { ?>
                            <tr onclick="window.location.href='<?php echo base_url("program/ekle?birim=$birimId&bolum=$bolumId&saat=$saat&gun=$gun&ders=$ders->dersId"); ?>'"
                            <?php if($ders->dersId == $gelenDers) echo "style='background-color:#8b9f15;'" ?>>
                                <td>
                                    <?php echo $ders->dersKodu . " - " .  $ders->dersAd; ?>
                                </td>
                            </tr>
                        <?php }
                        }else{ ?>
                            <tr>
                                <td>
                                    <b style="color:red;">Ders Bulunamadı.</b>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table align="center" class="table table-hover">
                    <thead>
                        <tr><td>Öğretim Elemanları</td></tr>
                    </thead>
                    <tbody>
                        <?php if(count($elemanlar) > 0)
                        {
                            foreach ($elemanlar as $eleman) { ?>
                                <tr onclick="window.location.href='<?php echo base_url("program/ekle?birim=$birimId&bolum=$bolumId&saat=$saat&gun=$gun&ders=$gelenDers&eleman=$eleman->elemanId"); ?>'"
                                <?php if($eleman->elemanId == $gelenEleman) echo "style='background-color:#8b9f15;'" ?>>
                                    <td>
                                        <?php echo $eleman->elemanAd . " - " . $eleman->unvan; ?>
                                    </td>
                                </tr>
                            <?php } 
                        }
                        else
                        { ?>
                            <tr>
                                <td>
                                    <b>Ders Seçiniz.</b> 
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
                            
            <div class="col-md-3">
                <table align="center" class="table table-hover">
                    <thead>
                        <tr><td>Ders Türü</td></tr>
                    </thead>
                    <tbody>
                        <?php if(count($turler) > 0)
                        { if(in_array(1, $turler)){ ?>
                            <tr onclick="window.location.href='<?php echo base_url("program/ekle?birim=$birimId&bolum=$bolumId&saat=$saat&gun=$gun&ders=$gelenDers&eleman=$gelenEleman&tur=1"); ?>'"
                                <?php if($gelenTur == 1) echo "style='background-color:#8b9f15;'" ?>>
                                <td>
                                    Teorik
                                </td>
                        </tr> <?php } if(in_array(2, $turler)){ ?>
                            <tr onclick="window.location.href='<?php echo base_url("program/ekle?birim=$birimId&bolum=$bolumId&saat=$saat&gun=$gun&ders=$gelenDers&eleman=$gelenEleman&tur=2"); ?>'"
                                <?php if($gelenTur == 2) echo "style='background-color:#8b9f15;'" ?>>
                                <td>
                                    Uygulama
                                </td>
                            </tr>
                        <?php } }else
                        { ?>
                            <tr>
                                <td>
                                    <b>Öğretim Elemanı Seçiniz.</b> 
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table align="center" class="table table-hover">
                    <thead>
                        <tr><td>Sınıf</td></tr>
                    </thead>
                    <tbody>
                        <?php if(count($turler) > 0)
                        {
                        foreach ($siniflar as $sinif) { ?>
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
                                ">
                                <td>
                                    <?php echo $sinif->sinifAd; ?>
                                </td>
                            </tr>
                            <?php }
                            }else
                            { ?>
                                <tr>
                                    <td>
                                        <b>Öğretim Elemanı Seçiniz.</b>
                                    </td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
                                
        <table class="table"></table>   

    </section>



    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>