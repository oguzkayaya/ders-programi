<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toplu İşlemler</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">
    <style>
    input[type="file"]{
        padding-left:20px;
        width:200px;
    }
    </style>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">
    
    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Toplu İşlemler";
        $this->load->view("ortak/main-ust" , $viewD); ?>

    

    <section class="content"  style="text-align:center;">
    
    <?php if(isset($hata)) if(count($hata) > 0)
        {
            foreach ($hata as $ht) 
            {
                foreach ($ht as $h) { ?>
                    <span class="label label-danger" style="font-size:13pt;"><?php echo $h; ?> eklenemedi.</span>
                    <br><br>
                <?php }
            }
        }
        else
        { ?>
            <div style="height:50px;">
                <span class="label label-success" style="font-size:13pt;">Başarıyla Eklendi.</span>
            </div>
        <?php }?>

        <div class="col-md-12">
            <form action="<?php echo base_url("TopluIslem/ekle"); ?>"  method="post">
                <table class="table" style="text-align:center;">
                    <thead>
                        <tr>
                            <td>Birim</td>
                            <td>Bölüm</td>
                            <td>Ders</td>
                            <td>Öğretim Elemanı</td>
                            <td>Sınıf</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="file" name="birim" class="btn btn-flat btn-warning" accept=".xls, .xlsx"></td>
                            <td><input type="file" name="bolum" class="btn btn-flat btn-warning" accept=".xls, .xlsx"></td>
                            <td><input type="file" name="ders" class="btn btn-flat btn-warning" accept=".xls, .xlsx"></td>
                            <td><input type="file" name="eleman" class="btn btn-flat btn-warning" accept=".xls, .xlsx"></td>
                            <td><input type="file" name="sinif" class="btn btn-flat btn-warning" accept=".xls, .xlsx"></td>
                        </tr>
                        <tr>
                            <td colspan="5"><input type="submit" class="btn btn-success btn-flat islemButon" value="Ekle"></td>
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