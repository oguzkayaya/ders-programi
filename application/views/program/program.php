<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program</title>

     <?php $this->load->view("ortak/bootS"); ?>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/customTable.css"); ?>">
    
    <style>
    
    </style>
    
</head>
<body class="hold-transition skin-yellow-light sidebar-mini sidebar-collapse">

     <?php $this->load->view("ortak/ust"); ?>

    <?php $this->load->view("ortak/yan"); ?>

    <?php $viewD["baslik"] = "$g_bolumAd->birimAd, $g_bolumAd->BolumAd-$g_bolumAd->ortTur <br> Ders Programı";
          $this->load->view("ortak/main-ust" , $viewD); ?>

        <div style="height:25px;"></div>

        <section class="content"  style="text-align:center;">
            
            <div>
                <table class="table cerTablo" align="center">
                    <tbody>
                        <?php 
                        $g = -1;
                        $s = -1; 
                        foreach ($saatler as $saat) { $s = -1;  ?>
                            <tr>
                                <?php foreach ($gunler as $gun) { 
                                    if($g == -1)
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>" class="tBaslik"><?php echo $gun; ?></td>
                                    <?php }
                                    else if($s == -1)
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>" class="tBaslik"><?php echo $saat; ?></td>
                                    <?php }
                                    else
                                    { ?>
                                        <td id="<?php echo $g.'x'.$s; ?>" ondblclick="
                                        location.href = '<?php echo base_url('program/ekle?bolum='.$gelen_b.'&saat='.$saat.'&gun='.$gun); ?>';
                                        "></td>
                                    <?php } 
                                    $s++;
                                } ?>
                            </tr>
                        <?php $g++; } ?>
                    </tbody>
                </table>
            </div>
            
        <table class="table"></table>            
        </section>

        <div style="height:100px;"></div>

    <?php $this->load->view("ortak/main-alt"); ?>

    <?php $this->load->view("ortak/javaS"); ?>


    <script>
    <?php
        foreach ($program as $prog) {
            $gunIndex = array_keys($gunler , $prog->gun)[0]-1;
            $saatIndex = array_keys($saatler , $prog->saat)[0]-1;
            echo "var yer = document.getElementById($saatIndex + 'x' + $gunIndex);";
            if($prog->saatTur == 1) $tur="(T)";
            else if($prog->saatTur == 2) $tur="(U)";
            else $tur="( )";
            
            $url = base_url("program/duzenle/$prog->progId");
            echo "if(yer.innerHTML) yer.innerHTML = yer.innerHTML + '<hr>';";
            echo "yer.innerHTML = yer.innerHTML +
            '<div>' +
            '<div>' +
                '$prog->dersKod $prog->dersAd $tur<br/> $prog->elemanAd <br/> $prog->sinifAd ' +
            '</div>' +
            '<div>' +
                '<form>' +
                    '<input type=hidden name=progId value=$prog->progId>' +
                        '<a><input style=\"padding:0px;\" type=submit class=\"btn btn-danger btn-flat islemButon\" value=Sil formmethod=post formaction=".base_url("program/sil")."></a> ' +
                        '<a><input style=\"padding:0px;\" type=submit value=Düzenle class=\"btn btn-warning btn-flat islemButon\" formaction=".base_url("program/duzenle")."></a>' + 
                '</form>' +
            '</div>' +
            '</div>'
            ;"; 
        }
    ?>
    </script>
</body>
</html>