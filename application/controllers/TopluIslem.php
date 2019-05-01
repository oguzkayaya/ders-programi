<?php

class TopluIslem extends CI_Controller
{
    public function index()
    {
        if($this->session->yetki == "yonetici")
		{
            $this->load->view("TopluIslem/toplu");
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function ekle()
    {
        if($this->session->yetki == "yonetici")
		{
            $this->load->library("Excel");
            $hata = array();
            if($this->input->post("birim"))
            {
                $gelen = $this->input->post("birim");
                $file =  "./application/excel/" . $gelen;
                $obj = PHPExcel_IOFactory::load($file);
                $cell = $obj->getActiveSheet()->getCellCollection();
                foreach ($cell as $cl) 
                {
                    $column = $obj->getActiveSheet()->getCell($cl)->getColumn();
                    $row = $obj->getActiveSheet()->getCell($cl)->getRow();
                    $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
                    if($row == 1)
                    {
                        $header[$row][$column] = $data_value;
                    }
                    else
                    {
                        $arr_data[$row][$column] = $data_value;
                    }
                }//cell okuma foreach
                foreach ($arr_data as $vr)
                {
                    $birimAd =  $vr['A'];
                    $okulTur = $vr['B'];
                    $ekle = $this->db->query(
                        "insert into fakulte(fakulte.fakulteAd, fakulte.okulTuru)
                            select * from (select '$birimAd', '$okulTur') as tmp where not exists 
                            (select fakulteAd from fakulte where fakulteAd = '$birimAd') limit 1;"
                    );
                    if(!$ekle)
                    {
                        $hata["birim"][] = $birimAd;
                    }
                }//ekleme foreach
            }//birim

            if($this->input->post("bolum"))
            {
                $gelen = $this->input->post("bolum");
                $file =  "./application/excel/" . $gelen;
                $obj = PHPExcel_IOFactory::load($file);
                $cell = $obj->getActiveSheet()->getCellCollection();
                foreach ($cell as $cl) 
                {
                    $column = $obj->getActiveSheet()->getCell($cl)->getColumn();
                    $row = $obj->getActiveSheet()->getCell($cl)->getRow();
                    $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
                    if($row == 1)
                    {
                        $header[$row][$column] = $data_value;
                    }
                    else
                    {
                        $arr_data[$row][$column] = $data_value;
                    }
                }//cell okuma foreach
                foreach ($arr_data as $vr)
                {
                    $bolumAd =  $vr['A'];
                    $ortTur = $vr['B'];
                    $birimAd = $vr['C'];
                    $ekle = $this->db->query(
                        "insert into bolum(bolum.BolumAd, bolum.fakulteId)
                        select * from (select '$bolumAd' as 'bolumAd', (select fakulte.fakulteId from fakulte where fakulteAd = '$birimAd') as 'fakulteId') as tmp where not exists 
                        (select bolumAd from bolum where bolumAd = '$bolumAd' and fakulteId = (select fakulteId from fakulte where fakulteAd = '$birimAd')) limit 1"
                    );
                    if($ekle)
                    {
                        $ekle2 = $this->db->query(
                            "insert into btur(btur.bolumId, btur.tur)
                            select * from (select (select bolumId from bolum where bolum.BolumAd = '$bolumAd' and bolum.fakulteId = (select fakulteId from fakulte where fakulteAd = '$birimAd')) as 'bolumId', '$ortTur' as 'tur') as tmp where not exists 
                            (select bolumId from btur where bolumId = (select bolumId from bolum where bolum.BolumAd = '$bolumAd' and bolum.fakulteId = (select fakulteId from fakulte where fakulteAd = '$birimAd')) and btur.tur = '$ortTur') limit 1"
                        );
                        if(!$ekle2)
                        {
                            $hata["bolum"][] = "$bolumAd - $ortTur";
                        }
                    }
                    if(!$ekle)
                    {
                        $hata["bolum"][] = "$bolumAd - $ortTur";
                    }
                }//ekleme foreach
            }//bolum

            if($this->input->post("ders"))
            {
                $gelen = $this->input->post("ders");
                $file =  "./application/excel/" . $gelen;
                $obj = PHPExcel_IOFactory::load($file);
                $cell = $obj->getActiveSheet()->getCellCollection();
                foreach ($cell as $cl) 
                {
                    $column = $obj->getActiveSheet()->getCell($cl)->getColumn();
                    $row = $obj->getActiveSheet()->getCell($cl)->getRow();
                    $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
                    if($row == 1)
                    {
                        $header[$row][$column] = $data_value;
                    }
                    else
                    {
                        $arr_data[$row][$column] = $data_value;
                    }
                }//cell okuma foreach
                foreach ($arr_data as $vr)
                {
                    $dersKodu =  $vr['A'];
                    $dersAdi = $vr['B'];
                    $teorik = $vr['C'];
                    $uygulama = $vr['D'];
                    $birimAd = $vr['E'];
                    $bolumAd = $vr['F'];
                    $ekle = $this->db->query(
                        "insert into ders(ders.dersKodu, ders.dersAd, ders.teorik, ders.uygulama, ders.bolumId)
                        select * from (select '$dersKodu' as 'dKodu', 
                            '$dersAdi' as 'dAdi', 
                            '$teorik' as 'teo', 
                            '$uygulama' as 'uyg', 
                            (select bolumId from bolum where bolumAd = '$bolumAd' and fakulteId = (select fakulteId from fakulte where fakulteAd = '$birimAd')) as 'brm') as tmp 
                        where not exists (select ders.dersAd from ders where ders.dersAd = '$dersAdi') limit 1;
                    "
                    );
                    if(!$ekle)
                    {
                        $hata["ders"][] = "$dersKodu - $dersAdi";
                    }
                }//ekleme foreach
            }//birim

            if($this->input->post("eleman"))
            {
                $gelen = $this->input->post("eleman");
                $file =  "./application/excel/" . $gelen;
                $obj = PHPExcel_IOFactory::load($file);
                $cell = $obj->getActiveSheet()->getCellCollection();
                foreach ($cell as $cl) 
                {
                    $column = $obj->getActiveSheet()->getCell($cl)->getColumn();
                    $row = $obj->getActiveSheet()->getCell($cl)->getRow();
                    $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
                    if($row == 1)
                    {
                        $header[$row][$column] = $data_value;
                    }
                    else
                    {
                        $arr_data[$row][$column] = $data_value;
                    }
                }//cell okuma foreach
                foreach ($arr_data as $vr)
                {
                    $aPerNo =  $vr['A'];
                    $elemanAd = $vr['B'];
                    $unvan = $vr['C'];
                    $tel = $vr['D'];
                    $email = $vr['E'];
                    $ekle = $this->db->query(
                        "insert into eleman(aPerNo, elemanAd, unvan, telefon, eMail)
                        select * from (select '$aPerNo' as 'apno', '$elemanAd' as 'eAd', '$unvan' as 'un', '$tel' as 'tfln', '$email' as 'ema') as tmp
                        where not exists (select aPerNo from eleman where aPerNo = '$aPerNo') limit 1;"
                    );
                    if(!$ekle)
                    {
                        $hata["eleman"][] = $elemanAd;
                    }
                }//ekleme foreach
            }//eleman

            if($this->input->post("sinif"))
            {
                $gelen = $this->input->post("sinif");
                $file =  "./application/excel/" . $gelen;
                $obj = PHPExcel_IOFactory::load($file);
                $cell = $obj->getActiveSheet()->getCellCollection();
                foreach ($cell as $cl) 
                {
                    $column = $obj->getActiveSheet()->getCell($cl)->getColumn();
                    $row = $obj->getActiveSheet()->getCell($cl)->getRow();
                    $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
                    if($row == 1)
                    {
                        $header[$row][$column] = $data_value;
                    }
                    else
                    {
                        $arr_data[$row][$column] = $data_value;
                    }
                }//cell okuma foreach
                foreach ($arr_data as $vr)
                {
                    $sinifAd =  $vr['A'];
                    $kapasite = $vr['B'];
                    $cinsi = $vr['C'];
                    $ekle = $this->db->query(
                        "insert into sinif(sinifAd, kapasite, cinsi)
                        select * from (select '$sinifAd', '$kapasite', '$cinsi') as tmp where not exists 
                        (select sinifAd from sinif where sinifAd = '$sinifAd') limit 1;"
                    );
                    if(!$ekle)
                    {
                        $hata["sinif"][] = $sinifAd;
                    }
                }//ekleme foreach
            }//sinif
            $viewData["hata"] = $hata;
            $this->load->view("TopluIslem/toplu",@$viewData);
        }//yetki
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }
}

?>