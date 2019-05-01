<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Öğrenci Sayısı Ekleme</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <style>
    select{
        text-align-last:center;
    }tbody > tr{
    font-weight: normal;
    }
    </style>

    <script>

    function sayiGir(el,btur,ders,ogrSay)
    {
        var a = el.parentNode.parentNode;
        a.cells[5].innerHTML = '<div class="col-md-3"></div><div class="col-md-6"><form method="post" action="<?php echo base_url("birlestir/ekle"); ?>"><input type="hidden" name="ders" value="'+ders+'"><input type="hidden" name="bTur" value="'+btur+'"><input type="text" name="ogrSay" required value="'+ ogrSay +'" class="form-control"> <input type="submit" class="btn btn-block btn-success btn-flat" style="padding:0px;" value="Kaydet"></form></div>';
        a.cells[6].innerHTML = '<input type="button" class="btn btn-block btn-danger btn-flat" value="İptal" onclick="window.location.reload();">';
    }
    </script>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>
    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Öğrenci Sayısı Ekleme";
          $this->load->view("ortak/main-ust" , $viewD); ?>

    

    <section class="content"  style="text-align:center;">

        <table align="center" class="table table-hover">
            <thead>
                <tr>
                    <td>Ders</td>
                    <td>Okul Türü</td>
                    <td>Öğretim Türü</td>
                    <td>Birim</td>
                    <td>Bölüm</td>
                    <td>Öğrenci Sayısı</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="ders" id="ders" class="col-md-12" onchange="
                        window.location.href='<?php echo base_url("birlestir/ogrenciEkle?ders="); ?>' + document.getElementById('ders').value;
                        ">
                            <option disabled selected hidden value="">Ders Seçiniz...</option>
                            <?php foreach ($dersler as $ders) { ?>
                                <option value="<?php echo $ders->dersId; ?>" <?php if(isset($gelenDers)) if($gelenDers == $ders->dersId) echo "selected"; ?>><?php echo "$ders->dersKodu - $ders->dersAd"; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="okulTur" id="okulTur" class="col-md-12" onchange="
                        window.location.href='<?php echo base_url("birlestir/ogrenciEkle?ders=$gelenDers&oTur="); ?>' + document.getElementById('okulTur').value;
                        ">
                            <option disabled selected hidden value="">Okul Türü Seçiniz...</option>
                            <?php foreach ($okulTurler as $okulTur) { ?>
                                <option value="<?php echo $okulTur->okulTuru; ?>" <?php if(isset($gelenOkulTur)) if($gelenOkulTur == $okulTur->okulTuru) echo "selected"; ?>><?php echo $okulTur->okulTuru; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="ortTur" id="ortTur" class="col-md-12" onchange="
                        window.location.href='<?php echo base_url("birlestir/ogrenciEkle?ders=$gelenDers&oTur=$gelenOkulTur&ortTur="); ?>' + document.getElementById('ortTur').value;
                        ">
                            <option disabled selected hidden value="">Öğretim Türü Seçiniz...</option>
                            <?php foreach ($ortTurler as $ortTur) { ?>
                                <option value="<?php echo $ortTur->tur; ?>" <?php if(isset($gelenOrtTur)) if($gelenOrtTur == $ortTur->tur) echo "selected"; ?>><?php echo $ortTur->tur; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php foreach ($program as $prog) { ?>
                    <tr>
                        <td><?php echo "$prog->dersKodu - $prog->dersAd"; ?></td>
                        <td><?php echo $prog->okulTur; ?></td>
                        
                        <td><?php echo $prog->tur; ?></td>
                        <td><?php echo $prog->birimAd; ?></td>
                        <td><?php echo $prog->bolumAd; ?></td>
                        <td><?php echo isset($prog->ogrSay) ? $prog->ogrSay : '--'; ?></td>
                        <td><input type="button" class="btn btn-block btn-info btn-flat" value="Sayı Gir" onclick="
                        sayiGir(this,<?php echo $prog->bTurId; ?>,<?php echo $prog->dersId; ?>,<?php echo isset($prog->ogrSay) ? $prog->ogrSay : 0; ?>);
                        "></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <table class="table"></table>   
    </section>

    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>

</body>
</html>