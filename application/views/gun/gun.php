<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Günler</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Günler";
        $this->load->view("ortak/main-ust" , $viewD); ?>
    <div style="height:50px;"></div>
    <section class="content"  style="text-align:center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            
        
            
            <table align="center" class="table table-hover">
                <thead>
                    <tr>
                        <td>Günler</td>
                        <td>İşlemler</td>
                     </tr>
                </thead>
                <tbody>
                    <?php foreach ($tumGunler as $gun) { ?>
                        <tr>
                            <form method="post">
                            <td><?php echo $gun["gunAd"]; ?></td>
                            <td>
                                <input type="hidden" name="gun" value="<?php echo $gun["gunAd"]; ?>">
                                <?php if($gun["mevcut"]){ ?>
                                    <input type="submit" value="Sil" class="btn btn-danger btn-flat islemButon" formaction="<?php echo base_url("gun/sil"); ?>">
                                <?php } else{ ?>
                                    <input type="submit" class="btn btn-success btn-flat islemButon" value="Ekle" formaction="<?php echo base_url("gun/ekle"); ?>">
                                <?php } ?>
                            </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <table class="table"></table>   
    </section>
    
    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>