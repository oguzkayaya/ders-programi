<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fakülte</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <script>
    function yeni($fakulte,$url) 
    {
        window.location.href= $url + 'fakulte/index/' + $fakulte;
    }
    function fakulteDuzenle($fakulte,$url)
    {
        window.location.href= $url + 'fakulte/duzenle/' + $fakulte;
    }
    </script>
    <style>
        select{
            padding:6px 1px; text-align-last:center;
        }
    </style>

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Birim - Bölüm Ekleme";
        $this->load->view("ortak/main-ust" , $viewD); ?>


   
    <section class="content"  style="text-align:center;">
        <div  class="col-md-12">
            <div class="col-md-6"></div>
            <div class="col-md-6"><h3><?php if($bolumFakulte) echo "$bolumFakulte->fakulteAd Bölümleri"; else echo "Bölümleri Görmek İçin Birim Seçiniz."; ?></h3></div>
        </div>
        <div class="col-md-6">
            <form>
                <table align="center" class="table table-hover">
                    <thead>
                        <tr>
                            <td>Birim Adı</td>
                            <td>Okul Türü</td>
                            <td>İşlemler</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fakulteler as $fakulte) { ?>
                            <tr <?php if($fakulte->fakulteId == @$bolumFakulte->fakulteId) echo "style=background-color:#8b9f15;" ?>>
                                <td onclick="window.location.href='<?php echo base_url("fakulte/index/").$fakulte->fakulteId?>'">
                                    <?php echo $fakulte->fakulteAd; ?>
                                </td>
                                <td onclick="window.location.href='<?php echo base_url("fakulte/index/").$fakulte->fakulteId?>'">
                                    <?php echo $fakulte->okulTuru; ?>
                                </td>
                                <td>
                                    <input type="hidden" name="fakulteId" value=<?php echo $fakulte->fakulteId; ?>>
                                    <input type="button" class="btn btn-warning btn-flat islemButon" formaction="<?php echo base_url('fakulte/duzenle'); ?>" formmethod="post" value="Güncelle"
                                    onclick=" 
                                        var a = this.parentNode.parentNode;
                                        a.cells[0].innerHTML = '<input type=text class=\'col-md-12\' name=fakulteAd value=\'<?php echo $fakulte->fakulteAd; ?>\' placeholder=\'Birim Adı\' required>';
                                        a.cells[0].removeAttribute('onclick');
                                        a.cells[1].innerHTML = '<select name=okulTuru><option value=Y.O <?php if($fakulte->okulTuru == "Y.O") echo "selected"; ?>>Y.O</option><option value=M.Y.O <?php if($fakulte->okulTuru == "M.Y.O") echo "selected"; ?>>M.Y.O</option></select>';
                                        a.cells[1].removeAttribute('onclick');
                                        a.cells[2].innerHTML = 
                                        '<input type=hidden name=birimId value=<?php echo $fakulte->fakulteId; ?>>' +
                                        '<input type=submit value=Onayla formaction=<?php echo base_url("fakulte/duzenle"); ?> formmethod=post class=\'btn btn-primary btn-flat islemButon\'> ' +
                                        '<input type=button value=İptal class=\'btn btn-danger btn-flat islemButon\' onclick=window.location.reload()>';
                                        "
                                    >
                                    <input type="submit" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url('fakulte/sil'); ?>" formmethod="post" value="Sil">
                                </td>
                            </tr>
                            </form><form>
                        <?php } ?>
                            <tr>
                        </form> <form action="<?php echo base_url("fakulte/ekle"); ?>" method="post">
                                    <td>
                                        <input type="text" class="col-md-12" name="fakulteAd" placeholder="Eklenecek Birim" required>
                                    </td>
                                    <td>
                                    <select name="okulTuru" style="color:#757575;" onchange="this.style.color='inherit';">
                                        <option disabled selected hidden >Okul Türü</option>
                                        <option value="Y.O">Y.O</option>
                                        <option value="M.Y.O">M.Y.O</option>
                                    </select>
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-success btn-flat islemButon" value="Ekle">
                                    </td>
                                </form>
                            </tr>
                        
                    </tbody>
                </table>
            </form>
        </div>
        <?php if($bolumFakulte){ ?>
        <div class="col-md-6">
            <form>
                <table align="center" class="table table-hover" >
                    <thead>
                        <tr>
                            <td>Bölüm Adı</td>
                            <td>Öğretim Türü</td>
                            <td>İşlemler</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bolumler as $bolum) { ?>
                            <tr>
                                <td><?php echo $bolum->BolumAd; ?></td>
                                <td><?php if($bolum->ortTur == 1) echo "Normal Öğretim"; elseif($bolum->ortTur == 2) echo "İkinci Öğretim"; ?></td>
                                <td>
                                    <input type="hidden" name="bTurId" value=<?php echo $bolum->bTurId ?>>
                                    <input type="button" class="btn btn-warning btn-flat islemButon" formaction="<?php echo base_url('bolum/duzenle'); ?>" formmethod="post" value="Güncelle"
                                    onclick=" 
                                        var a = this.parentNode.parentNode;
                                        a.cells[0].innerHTML = '<input type=text name=bolumAd value=<?php echo $bolum->BolumAd; ?> placeholder=\'Bölüm Adı\' required>';
                                        a.cells[1].innerHTML = '<select name=tur><option value=1 <?php if($bolum->ortTur == 1) echo "selected"; ?>>Normal Öğretim</option><option value=2 <?php if($bolum->ortTur == 2) echo "selected"; ?>>İkinci Öğretim</option></select>';
                                        a.cells[2].innerHTML = 
                                        '<input type=hidden name=fakulte value=<?php echo $bolum->fakulteId; ?>>' +
                                        '<input type=hidden name=bolumId value=<?php echo $bolum->bTurId; ?>>' +
                                        '<input type=submit value=Onayla formaction=<?php echo base_url("bolum/duzenle"); ?> formmethod=post class=\'btn btn-primary btn-flat islemButon\'> ' +
                                        '<input type=button value=İptal class=\'btn btn-danger btn-flat islemButon\' onclick=window.location.reload()>';
                                        "
                                    > 
                                    <input type="submit" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url('bolum/sil'); ?>" formmethod="post" value="Sil">
                                </td>
                            </tr>
                            </form><form>
                        <?php } ?>
                            <tr>
                        </form> <form action="<?php echo base_url("bolum/ekle"); ?>" method="post">
                                    <td>
                                    <input type="text" class="col-md-12" placeholder="Eklenecek Bölüm" name="bolumAd" required>
                                    </td>
                                    <td>
                                    <select name="tur" style="color:#757575;" onchange="this.style.color='inherit';   ">
                                        <option disabled selected hidden >Öğretim Türü</option>
                                        <option value="1">Normal Öğretim</option>
                                        <option value="2">İkinci Öğretim</option>
                                    </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="fakulte" value="<?php echo $fakulte->fakulteId ?>">
                                        <button type="submit" class="btn btn-success btn-flat islemButon">Ekle</button>
                                    </td>
                                </form>
                            </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <?php } ?>
        
        <table class="table"></table>
    </section>

    
   
    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>

</body>
</html>