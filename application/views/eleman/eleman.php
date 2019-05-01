<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Öğretim Elemanları</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Öğretim Elemanı Ekleme";
        $this->load->view("ortak/main-ust" , $viewD); ?>

    <div style="height:50px;"></div>

    <section class="content"  style="text-align:center;">

        <div>
            <form>
                <table align="center" class="table table-hover">
                    <thead>
                        <tr>
                            <td>Aka. Per. No.</td>
                            <td>Öğretim Elemanı</td>
                            <td>Ünvanı</td>
                            <td>Telefon No</td>
                            <td>E-Posta</td>
                            <td>İşlemler</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($elemanlar as $eleman) { ?>
                            <tr>
                                <td><?php echo $eleman->aPerNo; ?></td>
                                <td><?php echo $eleman->elemanAd; ?></td>
                                <td><?php echo $eleman->unvan; ?></td>
                                <td><?php echo $eleman->telefon; ?></td>
                                <td><?php echo $eleman->eMail; ?></td>
                                <td>
                                    <input type="hidden" name="elemanId" value=<?php echo $eleman->elemanId; ?>>
                                    <input type="button" class="btn btn-warning btn-flat islemButon" value="Güncelle"
                                    onclick=" 
                                        var a = this.parentNode.parentNode;
                                        a.cells[0].innerHTML = '<input type=text name=aPerNo value=<?php echo $eleman->aPerNo; ?> placeholder=\'Aka. Per. No\' required>';
                                        a.cells[1].innerHTML = '<input type=text name=ad value=<?php echo $eleman->elemanAd; ?> placeholder=\'Ad-Soyad\' required>';
                                        a.cells[2].innerHTML = '<input type=text name=unvan value=<?php echo $eleman->unvan; ?> placeholder=\'Ünvan\' required>';
                                        a.cells[3].innerHTML = '<input type=text name=tel  value=<?php echo $eleman->telefon; ?> placeholder=\'Telefon\' required>';
                                        a.cells[4].innerHTML = '<input type=text name=mail value=<?php echo $eleman->eMail; ?> placeholder=\'E-Mail\' required>';
                                        a.cells[5].innerHTML = 
                                        '<input type=hidden name=elemanId value=<?php echo $eleman->elemanId; ?>>' +
                                        '<input type=submit value=Onayla formaction=<?php echo base_url("eleman/duzenle"); ?> formmethod=post class=\'btn btn-primary btn-flat islemButon\'> ' +
                                        '<input type=button value=İptal class=\'btn btn-danger btn-flat islemButon\' onclick=window.location.reload()>';
                                        ">
                                    <input type="submit" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url('eleman/sil'); ?>" formmethod="post" value="Sil">
                                </td>
                            </tr>
                        </form><form>
                        <?php } ?>
                            <tr>
                        </form><form action="<?php echo base_url("eleman/ekle"); ?>" method="post">
                                    <td><input type="text" placeholder="Ak. Per. No." name="aPerNo" required></td>
                                    <td><input type="text" placeholder="Ad-Soyad" name="ad" required></td>
                                    <td><input type="text" placeholder="Ünvan" name="unvan" required></td>
                                    <td><input type="text" placeholder="Telefon" name="tel" required></td>
                                    <td><input type="text" placeholder="E-Mail" name="mail" required></td>
                                    <td><input type="submit" class="btn btn-success btn-flat islemButon" value="Ekle"></td>
                                </form>
                            </tr>
                    </tbody>
                </table>
            </form>
        </div>
        
        <table class="table"></table>   
    </section>
    
    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>