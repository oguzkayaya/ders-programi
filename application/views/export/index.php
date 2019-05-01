<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>
    
    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">

    <style>
        tbody > tr{
            font-weight: normal;
        }
    </style>
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">
    
    <?php $this->load->view("ortak/ust"); ?>
    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "Excel Kayıt Etme";
          $this->load->view("ortak/main-ust" , $viewD); ?>

    <section class="content"  style="text-align:center;">

    <table align="center" class="table table-hover">
        <thead>
            <tr>
                <td>Birimler</td>
                <td>Bölümler</td>
                <td>Dersler</td>
                <td>Öğretim Elemanları</td>
                <td>Sınıflar</td>
                <td>Öğrenci Sayıları</td>
                <td>Birleştirilen Dersler</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
                <td><input type="button" value="Kaydet" class="btn btn-primary btn-flat"></td>
            </tr>
        </tbody>
    </table>

    <table class="table"></table>
    </section>
    
    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>
</body>
</html>