<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapor - Öğretim Elemanı</title>
    
    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <style>
    
    </style>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Öğretim Elemanı Ders Programı";
        $this->load->view("ortak/main-ust" , $viewD); ?>

    <section class="content"  style="text-align:center;">
        <div class="col-md-12" style="height:125px;">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <select class="form-control sBox" id="elS"
                onchange="
                    document.getElementById('gosB').disabled = false;
                ">
                    <option disabled selected hidden value="-1">Öğretim Elemanı Seçiniz...</option>
                    <?php foreach ($elemanlar as $eleman) { ?>
                        <option value="<?php echo $eleman->elemanId; ?>" <?php if($elId == $eleman->elemanId) echo "selected"; ?>><?php echo "$eleman->unvan - $eleman->elemanAd"; ?></option>
                    <?php } ?>
                </select>
                <br>
                <input type="button" disabled class="btn btn-primary btn-lg" id="gosB" style="padding:5px 50px; background-color:#52ade5;" value="Göster"
                onclick="
                    var elId = document.getElementById('elS').value;
                    location.href = '<?php echo base_url("rapor/eleman/"); ?>' + elId;
                ">
            </div>
        </div>
        <?php if(count($program) > 0){ ?>
            <div>
            <table class="table cerTablo" align="center">
                    <tbody>
                        <?php 
                        $g = -1;
                        $s = -1; 
                        foreach ($saatler as $saat) { $s = -1; ?>
                            <tr>
                                <?php foreach ($gunler as $gun) { 
                                    if($g == -1)
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>" class="tBaslik"><?php echo $gun; ?></td>
                                    <?php }
                                    else if($s == -1)
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>" class="tBaslik"><?php echo $saat; ?></td>
                                    <?php }
                                    else
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>"></td>
                                    <?php } 
                                    $s++;
                                } ?>
                            </tr>
                        <?php $g++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <table class="table"></table>   
    </section>

    <script>
        <?php foreach ($program as $prog) { 
            $gunIndex = array_keys($gunler , $prog->gun)[0]-1;
            $saatIndex = array_keys($saatler , $prog->saat)[0]-1;
            echo "var yer = document.getElementById($saatIndex + 'x' + $gunIndex);";
            if($prog->saatTur == 1) $tur="(T)";
            else if($prog->saatTur == 2) $tur="(U)";
            else $tur="( )";
            if($prog->tur == 1) $bTur = "N.Ö";
            else if($prog->tur == 2) $bTur = "İ.Ö";
            else $bTur = " ";
            echo "if(yer.innerHTML) yer.innerHTML = yer.innerHTML + '<hr>';";
            echo "
            yer.innerHTML = yer.innerHTML +
            '<div>' +
            '$prog->birim <br> $prog->bolum $bTur <br> $prog->dersKodu - $prog->dersAd $tur <br> $prog->sinif '+
            '</div>' ;
            "; 
            
        } ?>
    </script>
    
    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>


</body>
</html>