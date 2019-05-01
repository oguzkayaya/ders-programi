<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program</title>

    <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    
    <script>
        function bolumDoldur() {
            var birim = document.getElementById("birimSelect").value;
            var bolumSelect = document.getElementById("bolumSelect");
            bolumSelect.innerHTML = "";
            
            <?php foreach ($bolumler as $bolum) { ?>
                if( <?php echo $bolum->birimId; ?> == birim)
                {
                    var option1 = document.createElement("option");
                    option1.text = "<?php echo $bolum->BolumAd . ' - ' . $bolum->ortTur; ?>";
                    option1.value = "<?php echo $bolum->bTurId; ?>";  
                    bolumSelect.add(option1);
                }

            <?php } ?>
        }
    </script>

    <style>
    select > option{
        color:#2f3542;
    }
    </style>

</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

    <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>


    <?php $viewD["baslik"] = "Ders Programı Anasayfa";
          $this->load->view("ortak/main-ust" , $viewD); ?>
        
        
        <section class="content"  style="text-align:center;">

            <div class="col-md-12"><h3>Programı Görmek için Birim ve Bölüm Seçiniz</h3></div><br><br>
            <hr>
            <form>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <select class="form-control sBox" style="background-color:#f4f4f5;" size="6" id="birimSelect" onchange="bolumDoldur()" required>
                        <option disabled selected hidden value="">Birim Seçiniz...</option>
                        <?php foreach ($birimler as $birim) { ?>
                        <option value="<?php echo $birim->fakulteId; ?>"><?php echo $birim->fakulteAd; ?></option>
                        <?php } ?>
                    </select>  
                </div> 
                <div class="col-md-4">
                    <select class="form-control sBox" style="background-color:#f4f4f5;"  size="6" name="bolum" id="bolumSelect" required>
                        <option disabled selected hidden value="">Bölüm Seçiniz...</option>
                    </select>  
                </div>
                
                <div class="col-md-12" style="padding:10px;">
                    <input type="submit" class="btn btn-primary btn-lg" value="Göster" 
                        style="padding:5px 50px; background-color:#52ade5;"
                        formaction="<?php echo base_url("program/goster"); ?>" formmethod="post">
                </div>
            </form>

        <table class="table"></table>    

        </section>

    <?php $this->load->view("ortak/main-alt"); ?>

<?php $this->load->view("ortak/javaS"); ?>


</body>
</html>