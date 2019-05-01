<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ders Birleştirme</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <style>
    select{
        text-align-last:center;
    }
    tbody > tr{
    font-weight: normal;
    }
    </style>

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">
    
    <?php $this->load->view("ortak/ust"); ?>
    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Ders Birleştirme";
          $this->load->view("ortak/main-ust" , $viewD); ?>


    <section class="content"  style="text-align:center;">
        <div class="col-md-1"></div>
        <select name="ders" id="ders" class="col-md-4" onchange="
            window.location.href='<?php echo base_url("birlestir/grupla?ders="); ?>' + document.getElementById('ders').value;
            ">
                <option disabled selected hidden value="">Ders Seçiniz...</option>
                <?php foreach ($dersler as $ders) { ?>
                    <option value="<?php echo $ders->dersId; ?>" <?php if(isset($gelenDers)) if($gelenDers == $ders->dersId) echo "selected"; ?>><?php echo "$ders->dersKodu - $ders->dersAd"; ?></option>
                <?php } ?>
        </select>
        <div class="col-md-1"></div>
        <select name="okulTur" id="okulTur" class="col-md-2" onchange="
            window.location.href='<?php echo base_url("birlestir/grupla?ders=$gelenDers&oTur="); ?>' + document.getElementById('okulTur').value;
            ">
                <option disabled selected hidden value="">Okul Türü Seçiniz...</option>
                <?php foreach ($okulTurler as $okulTur) { ?>
                    <option value="<?php echo $okulTur->okulTuru; ?>" <?php if(isset($gelenOkulTur)) if($gelenOkulTur == $okulTur->okulTuru) echo "selected"; ?>><?php echo $okulTur->okulTuru; ?></option>
                <?php } ?>
        </select>
        <div class="col-md-1"></div>
        <select name="ortTur" id="ortTur" class="col-md-2" onchange="
            window.location.href='<?php echo base_url("birlestir/grupla?ders=$gelenDers&oTur=$gelenOkulTur&ortTur="); ?>' + document.getElementById('ortTur').value;
            ">
                <option disabled selected hidden value="">Öğretim Türü Seçiniz...</option>
                <?php foreach ($ortTurler as $ortTur) { ?>
                    <option value="<?php echo $ortTur->tur; ?>" <?php if(isset($gelenOrtTur)) if($gelenOrtTur == $ortTur->tur) echo "selected"; ?>><?php echo $ortTur->tur; ?></option>
                <?php } ?>
        </select>
        <br><br>
        <form action="<?php echo base_url("birlestir/grupla"); ?>" method="post">
            <input type="hidden" name="ders" value="<?php if(isset($gelenDers)) echo $gelenDers; ?>">
            <input type="hidden" name="oTur" value="<?php if(isset($gelenOkulTur)) echo @$gelenOkulTur;  ?>">
            <input type="hidden" name="ortTur" value="<?php if(isset($gelenOrtTur)) echo @$gelenOrtTur; ?>"> 
            <input type="submit" class="btn btn-block btn-info btn-flat" style="background-color:#019682; border-color:#019682;" value="Birleştir" <?php if(!isset($gelenOrtTur)) echo "disabled";    ?> >
        </form>
        <br>
        <?php if(isset($program)){ ?>
            <table align="center" class="table table-hover">
                <thead>
                    <tr>
                        <td>Birim</td>
                        <td>Bölüm</td>
                        <td>Öğrenci Sayısı</td>
                        <td>Birleştirme</td>
                        <td>Dersin Açılacağı Birim</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($program as $prog) { ?>
                        <tr>
                            <td><?php echo $prog->birimAd; ?></td>
                            <td><?php echo $prog->bolumAd; ?></td>
                            <td><?php echo isset($prog->ogrSay) ? $prog->ogrSay : '--'; ?></td>
                            <td><?php echo $prog->toplamOgrenci; ?></td>
                            <td><?php echo $prog->acilanBirim; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <form action="<?php echo base_url("birlestir/grupKaldir"); ?>" method="post">
            <input type="hidden" name="ders" value="<?php if(isset($gelenDers)) echo $gelenDers; ?>">
            <input type="hidden" name="oTur" value="<?php if(isset($gelenOkulTur)) echo @$gelenOkulTur;  ?>">
            <input type="hidden" name="ortTur" value="<?php if(isset($gelenOrtTur)) echo @$gelenOrtTur; ?>"> 
            <input type="submit" class="btn btn-block btn-info btn-flat" style="background-color:#ad3400; border-color:#ad3400;" value="Birleştirmeyi Kaldır" <?php if(!isset($gelenOrtTur)) echo "disabled";    ?> >
        </form>
        <table class="table"></table>
    </section>

    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>