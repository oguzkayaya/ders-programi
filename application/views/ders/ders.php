<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ders</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <script>
        function bolumDoldur() {
            var birim = document.getElementById("birimSelect").value;
            var bolumSelect = document.getElementById("bolumSelect");
            bolumSelect.innerHTML = "";
            
            <?php foreach ($bolumler as $bolum) { ?>
                if( <?php echo $bolum->birimId; ?> == birim)
                {
                    var option1 = document.createElement("option");
                    option1.text = "<?php echo $bolum->BolumAd; ?>";
                    option1.value = "<?php echo $bolum->bolumId; ?>";  
                    bolumSelect.add(option1);
                }

            <?php } ?>
        }
    </script>
    

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Ders Ekleme";
          $this->load->view("ortak/main-ust" , $viewD); ?>

    <?php if(count($dersler) == 0){ ?>
        <div style="height:50px;"></div>
    <?php } ?>
    

    <section class="content"  style="text-align:center;">

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <select class="form-control sBox" name="birim" id="birimSelect" onchange="bolumDoldur()" required>
                <option disabled selected hidden value="-1">Birim Seçiniz...</option>
                <?php foreach ($birimler as $birim) { ?>
                <option value="<?php echo $birim->fakulteId; ?>"
                <?php if($postBirim == $birim->fakulteId) echo "selected"; ?>
                ><?php echo $birim->fakulteAd; ?></option>
                <?php } ?>
            </select>  
        </div> 
        <div class="col-md-4">
            <select class="form-control sBox" name="bolum" id="bolumSelect" required>
                <option disabled selected hidden value="-1">Bölüm Seçiniz...</option>
                <?php foreach ($bolumler as $bolum) { ?>
                <option value="<?php echo $bolum->bolumId; ?>"
                <?php if($postBolum == $bolum->bolumId) echo "selected"; ?>
                ><?php echo $bolum->BolumAd; ?></option>
                <?php } ?>
            </select>  
        </div>
        <br><br><br>
        <input type="button" class="btn btn-primary btn-lg" value="Göster" 
               style="padding:5px 50px; background-color:#52ade5;"
               onclick="
               function git()
                {
                    var blm = document.getElementById('bolumSelect').value;
                    var brm = document.getElementById('birimSelect').value;
                    window.location.href='<?php echo base_url("ders/index/") ?>' + brm + '/' + blm;
                }
                git();
               ">
        
        <div style="height:50px;"></div>
                            
           


         <?php if(isset($dersler)){ ?>           
            <div>
                <form>
                    <table align="center" class="table table-hover">
                        <thead>
                            <tr>
                                <td>Ders Kodu</td>
                                <td>Ders Adı</td>
                                <td>Teorik Saati</td>
                                <td>Uygulama Saati</td>
                                <td>İşlemler</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dersler as $ders) { ?>
                            <tr>
                                <td><?php echo $ders->dersKodu; ?></td>
                                <td><?php echo $ders->dersAd; ?></td>
                                <td><?php echo $ders->teorik; ?></td>
                                <td><?php echo $ders->uygulama; ?></td>
                                <td>
                                        <input type="hidden" name="dersId" value=<?php echo $ders->dersId; ?>>
                                        <input type="button" class="btn btn-warning btn-flat islemButon" value="Güncelle"
                                        onclick=" 
                                        var a = this.parentNode.parentNode;
                                        a.cells[0].innerHTML = '<input type=text name=kod value=<?php echo $ders->dersKodu; ?> placeholder=\'Ders Kodu\' required>';
                                        a.cells[1].innerHTML = '<input type=text name=dersAd value=<?php echo $ders->dersAd; ?> placeholder=\'Ders Adı\' required>';
                                        a.cells[2].innerHTML = '<input type=text name=teorik style=width:100px; value=<?php echo $ders->teorik; ?> placeholder=\'Teorik\' required maxlength=2>';
                                        a.cells[3].innerHTML = '<input type=text name=uygulama style=width:100px; value=<?php echo $ders->uygulama; ?> placeholder=\'Uygulama\' required maxlength=2>';
                                        a.cells[4].innerHTML = 
                                        '<input type=hidden name=dersId value=<?php echo $ders->dersId; ?>>' +
                                        '<input type=submit value=Onayla formaction=<?php echo base_url("ders/duzenle"); ?> formmethod=post class=\'btn btn-primary btn-flat islemButon\'> ' +
                                        '<input type=button value=İptal class=\'btn btn-danger btn-flat islemButon\' onclick=window.location.reload()>';
                                        "> 
                                        <input type="submit" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url('ders/sil'); ?>" formmethod="post" value="Sil">
                                </td>
                            </tr>
                            </form><form>
                            <?php } ?>
                            <tr>
                            </form><form action="<?php echo base_url("ders/ekle"); ?>" method="post">
                                    <td><input type="text" class="col-md-12" placeholder="Ders Kodu" name="kod" required></td>
                                    <td><input type="text" class="col-md-12" placeholder="Ders Adı" name="dersAd" required></td>
                                    <td><input type="text" style="width:100px;" maxlength="2" required placeholder="Teorik" name="teorik"></td>
                                    <td><input type="text" style="width:100px;" maxlength="2" required placeholder="Uygulama" name="uygulama"></td>
                                    <td>
                                        <input type="hidden" name="birim" value="<?php echo $postBirim; ?>">
                                        <input type="hidden" name="bolum" value="<?php echo $postBolum; ?>">
                                        <input type="submit" value="Ekle" class="btn btn-success btn-flat islemButon">
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
         <?php }else
         { ?>
            <h3>Bölüm Seçiniz</h3>
         <?php } ?>
             
         <table class="table"></table>   
    </section>

    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
    
   
</body>
</html>