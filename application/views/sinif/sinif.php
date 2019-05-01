<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sınıflar</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Sınıf Ekleme";
        $this->load->view("ortak/main-ust" , $viewD); ?>

    <div style="height:50px;"></div>

    <section class="content"  style="text-align:center;">
        <form >
            <table align="center" class="table table-hover">
                <thead>
                    <tr>
                        <td>Sınıf</td>
                        <td>Kapasite</td>
                        <td>Cinsi</td>
                        <td>İşlemler</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siniflar as $sinif) { ?>
                        <tr>
                            <td><?php echo $sinif->sinifAd; ?></td>
                            <td><?php echo $sinif->kapasite; ?></td>
                            <td><?php echo $sinif->cinsi; ?></td>
                            <td>
                                <input type="hidden" name="g_sinif" value=<?php echo $sinif->sinifId; ?>>
                                <input type="button" class="btn btn-warning btn-flat islemButon" formaction="<?php echo base_url('sinif/duzenle'); ?>" formmethod="post" value="Güncelle"
                                onclick=" 
                                        var a = this.parentNode.parentNode;
                                        a.cells[0].innerHTML = '<input type=text name=sinifAd value=<?php echo $sinif->sinifAd; ?> placeholder=\'Sınıf Adı\' required>';
                                        a.cells[1].innerHTML = '<input type=text name=kapasite value=<?php echo $sinif->kapasite; ?> placeholder=\'Sınıf Kapasitesi\' required>';
                                        a.cells[2].innerHTML = '<input type=text name=cins  value=<?php echo $sinif->cinsi; ?> placeholder=\'Sınıf Cinsi\' required>';
                                        a.cells[3].innerHTML = 
                                        '<input type=hidden name=g_sinif value=<?php echo $sinif->sinifId; ?>>' +
                                        '<input type=submit value=Onayla formaction=<?php echo base_url("sinif/duzenle"); ?> formmethod=post class=\'btn btn-primary btn-flat islemButon\'> ' +
                                        '<input type=button value=İptal class=\'btn btn-danger btn-flat islemButon\' onclick=window.location.reload()>';
                                        "
                                > 
                                <input type="submit" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url('sinif/sil'); ?>" formmethod="post" value="Sil">
                            </td>
                        </tr>
                    </form><form>
                    <?php } ?>
                        <tr>
                     </form><form action="<?php echo base_url("sinif/ekle"); ?>" method="post">
                                <td><input type="text" placeholder="Sınıf Adı" name="sinifAd" required></td>
                                <td><input type="text" placeholder="Sınıf Kapasitesi" name="kapasite" required></td>
                                <td><input type="text" placeholder="Sınıf Cinsi" name="cins" required></td>
                                <td><input type="submit" class="btn btn-success btn-flat islemButon" value="Ekle"></td>
                            </form>
                        </tr>
                </tbody>
            </table>
        </form>
        <table class="table"></table>   
    </section>

    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>