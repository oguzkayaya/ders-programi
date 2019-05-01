<?php 

class Birlestir extends CI_Controller
{
    
    public function ogrenciEkle()
    {
        if($this->session->yetki == "yonetici")
		{
            $dersler = $this->db->query(
                "select dersId,dersKodu,dersAd,bolumId from ders where bolumId = (select bolumId from bolum where BolumAd = 'ORTAK' and bolum.fakulteId = (select fakulteId from fakulte where fakulteAd = 'ORTAK'));"
            )->result();
            $viewData["dersler"] = $dersler;

            if(!$this->input->get("ders"))
            {
                $program = $this->db->query(
                    "select
                    btur.bTurId,
                    ders.dersId,
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                    (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                    (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                    btur.tur,
                    ders.dersAd,
                    ders.dersKodu,
                    (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay'
                from btur,ders where ders.bolumId = (select bolumId from bolum where bolum.BolumAd = 'ORTAK' and bolum.fakulteId = (select fakulteId from fakulte where fakulteAd = 'ORTAK')) 
                    group by ders.dersId,btur.bTurId order by birimAd,bolumAd,tur,dersAd;"
                )->result();
                $viewData["program"] = $program;
            }
            else
            {
                $gelenDers = $this->input->get("ders");
                $viewData["gelenDers"] = $gelenDers;

                $okulTurler = $this->db->query(
                    "select distinct(okulTuru) from fakulte where okulTuru != 'ORTAK';"
                )->result();
                $viewData["okulTurler"] = $okulTurler;

                if(!$this->input->get("oTur"))
                {
                $program = $this->db->query(
                    "select
                    btur.bTurId,
                    ders.dersId,
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                    (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                    (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                    btur.tur,
                    ders.dersAd,
                    ders.dersKodu,
                    (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay'
                    from btur,ders where ders.dersId = '$gelenDers'
                    group by ders.dersId,btur.bTurId order by birimAd,bolumAd,tur,dersAd;"
                )->result();
                $viewData["program"] = $program;
                }
                else
                {
                    $gelenOkulTur = $this->input->get("oTur");
                    $viewData["gelenOkulTur"] = $gelenOkulTur;

                    $ortTurler = $this->db->query(
                        "select distinct(tur) from btur where bolumId in (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur'));"
                    )->result();
                    $viewData["ortTurler"] = $ortTurler;

                    if(!$this->input->get("ortTur"))
                    {
                    $program = $this->db->query(
                        "select
                        btur.bTurId,
                        ders.dersId,
                        (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                        (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                        (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                        btur.tur,
                        ders.dersAd,
                        ders.dersKodu,
                        (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay'
                        from btur,ders where ders.dersId = '$gelenDers' and btur.bolumId in (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur'))
                        group by ders.dersId,btur.bTurId order by birimAd,bolumAd,tur,dersAd;"
                    )->result();
                    $viewData["program"] = $program;
                    }
                    else
                    {
                        $gelenOrtTur = $this->input->get("ortTur");
                        $viewData["gelenOrtTur"] = $gelenOrtTur;

                        $program = $this->db->query(
                            "select
                            btur.bTurId,
                            ders.dersId,
                            (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                            (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                            (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                            btur.tur,
                            ders.dersAd,
                            ders.dersKodu,
                            (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay'
                            from btur,ders where ders.dersId = '$gelenDers' and 
                            btur.bolumId in (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur')) and
                            btur.tur = '$gelenOrtTur'
                            group by ders.dersId,btur.bTurId order by birimAd,bolumAd,tur,dersAd;"
                        )->result();
                        $viewData["program"] = $program;
                    }
                }
            }
            $this->load->view("birlestir/ogrenci", $viewData);
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
            $ders = $this->input->post("ders");
            $bTur = $this->input->post("bTur");
            $ogrSay = $this->input->post("ogrSay");

            $bolum = $this->db->query(
                "select 
                (select fakulte.okulTuru from fakulte where fakulteId = (select fakulteId from bolum where bolumId = btur.bolumId)) as 'oTur',
                btur.tur
                from btur where bTurId = $bTur;"
            )->result()[0];

            $ekle = $this->db->query(
                "INSERT INTO ders_ogrenci (bturId, dersId, ogrenciSayi) VALUES ('$bTur', '$ders', '$ogrSay')
                ON DUPLICATE KEY UPDATE ogrenciSayi = '$ogrSay';"
            );

            // if($ekle)
            // {
            //     echo "Eklendi";
            // }
            // else
            // {
            //     echo "Eklenemedi";
            // }

            $url = base_url("birlestir/ogrenciEkle?ders=$ders&oTur={$bolum->oTur}&ortTur={$bolum->tur}");
            //header("Location: $url ");
            header('refresh:0;url='.$url); 
            die();
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }
    
    public function grupla()
    {
        if($this->session->yetki == "yonetici")
		{
            $dersler = $this->db->query(
                "select dersId,dersKodu,dersAd,bolumId from ders where bolumId = (select bolumId from bolum where BolumAd = 'ORTAK' and bolum.fakulteId = (select fakulteId from fakulte where fakulteAd = 'ORTAK'));"
            )->result();
            $viewData["dersler"] = $dersler;

            if($this->input->get("ders"))
            {
                $gelenDers = $this->input->get("ders");
                $viewData["gelenDers"] = $gelenDers;

                $okulTurler = $this->db->query(
                    "select distinct(okulTuru) from fakulte where okulTuru != 'ORTAK';"
                )->result();
                $viewData["okulTurler"] = $okulTurler;

                if($this->input->get("oTur"))
                {
                    $gelenOkulTur = $this->input->get("oTur");
                    $viewData["gelenOkulTur"] = $gelenOkulTur;

                    $ortTurler = $this->db->query(
                        "select distinct(tur) from btur where bolumId in (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur'));"
                    )->result();
                    $viewData["ortTurler"] = $ortTurler;

                    if($this->input->get("ortTur"))
                    {
                        $gelenOrtTur = $this->input->get("ortTur");
                        $viewData["gelenOrtTur"] = $gelenOrtTur;
                    }
                }
            }

            if($this->input->get("ders") && $this->input->get("oTur") && $this->input->get("ortTur"))
            {
                $program = $this->db->query(
                    "select
                    btur.bTurId,
                    ders.dersId,
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                    (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                    (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                    btur.tur,
                    ders.dersAd,
                    ders.dersKodu,
                    (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay',
                    (select toplamOgrenci from ders_birlestir where grupId = (select ders_ogrenci.grupId from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId)) as 'toplamOgrenci',
                    (select fakulte.fakulteAd from fakulte where fakulteId =  (select acilanBirim from ders_birlestir where grupId = (select ders_ogrenci.grupId from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId))) as 'acilanBirim'
                    from btur,ders where ders.dersId = '$gelenDers' and 
                    btur.bolumId in (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur')) and
                    btur.tur = '$gelenOrtTur'
                    group by ders.dersId,btur.bTurId order by birimAd,bolumAd,tur,dersAd,ogrSay;"
                )->result();
                $viewData["program"] = $program;
            }

            
            if($this->input->post("ders") && $this->input->post("oTur") && $this->input->post("ortTur"))
            {
                $gelenDers = $this->input->post("ders");
                $gelenOkulTur = $this->input->post("oTur");
                $gelenOrtTur = $this->input->post("ortTur");
                $program = $this->db->query(
                    "select
                    btur.bTurId,
                    ders.dersId,
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'birimAd',
                    (select fakulte.okulTuru from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = btur.bolumId)) as 'okulTur',
                    (select bolum.BolumAd from bolum where bolum.bolumId = btur.bolumId) as 'bolumAd',
                    btur.tur,
                    ders.dersAd,
                    ders.dersKodu,
                    (select ders_ogrenci.ogrenciSayi from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'ogrSay',
                    (select ders_ogrenci.grupId from ders_ogrenci where bturId = btur.bTurId and dersId = ders.dersId) as 'grup',
                    (select ders_ogrenci.Id from ders_ogrenci where bTurId = btur.bTurId and dersId = ders.dersId) as 'Id'
                    from btur,ders where ders.dersId = '$gelenDers' and btur.bolumId in 
                        (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where okulTuru = '$gelenOkulTur'))
                    and btur.tur = $gelenOrtTur
                    group by ders.dersId,btur.bTurId order by birimAd,bolumAd,ogrSay;"
                )->result();
                $toplam = 0;
                $eklenecek = [];
                for($i = 0; $i < count($program) ; $i++)
                {
                    if($program[$i]->grup == null && $program[$i]->ogrSay != null)
                    { 
                        if(($toplam + $program[$i]->ogrSay) >= 220)
                        {
                            echo "<br>".$toplam." ";
                            print_r($eklenecek);

                            //
                            $grupAc = $this->db->query(
                                "insert into ders_birlestir(toplamOgrenci) value($toplam);"
                            );
                            if($grupAc)
                            {
                                $columns = implode(", ",array_values($eklenecek));
                                $id = $this->db->insert_id();
                                $ogrGuncelle = $this->db->query(
                                    "update ders_ogrenci set grupId = '$id' where Id in ($columns);"
                                );
                                $grupGuncelle = $this->db->query(
                                    "update ders_birlestir set acilanBirim = 
                                            (select birim from
                                            (select birim,sum(ogrenciSayi) as 'Sayi' from
                                            (select (select (select bolum.fakulteId from bolum where bolumId = btur.bolumId) from btur 
                                                where bTurId = ders_ogrenci.bturId) as 'birim',ders_ogrenci.ogrenciSayi from ders_ogrenci where grupId = $id) o1
                                            group by birim order by Sayi desc limit 1) o2)
                                    where grupId = $id"
                                );
                            }
                            //

                            $toplam = 0;
                            $eklenecek = [];
                            $eklenecek[] = $program[$i]->Id;
                        }
                        else
                        {
                            $toplam = $toplam + $program[$i]->ogrSay;
                            $eklenecek[] = $program[$i]->Id;
                            
                        }
                    }
                }
                if(count($eklenecek) > 0)
                    if($toplam < 220)
                    {
                        echo "<br>".$toplam." ";
                        print_r($eklenecek);

                        //
                        $grupAc = $this->db->query(
                            "insert into ders_birlestir(toplamOgrenci) value($toplam);"
                        );
                        if($grupAc)
                        {
                            $columns = implode(", ",array_values($eklenecek));
                            $id = $this->db->insert_id();
                            $ogrGuncelle = $this->db->query(
                                "update ders_ogrenci set grupId = '$id' where Id in ($columns);"
                            );
                            $grupGuncelle = $this->db->query(
                                "update ders_birlestir set acilanBirim = 
                                        (select birim from
                                        (select birim,sum(ogrenciSayi) as 'Sayi' from
                                        (select (select (select bolum.fakulteId from bolum where bolumId = btur.bolumId) from btur 
                                            where bTurId = ders_ogrenci.bturId) as 'birim',ders_ogrenci.ogrenciSayi from ders_ogrenci where grupId = $id) o1
                                        group by birim order by Sayi desc limit 1) o2)
                                where grupId = $id"
                            );
                        }
                        //
                    }
                header('refresh:0;url='.base_url("birlestir/grupla?ders=$gelenDers&oTur=$gelenOkulTur&ortTur=$gelenOrtTur"));
            }

            $this->load->view("birlestir/birlestir",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        } 
    }


    public function grupKaldir()
    {
        if($this->session->yetki == "yonetici")
		{
            if($this->input->post("ders") && $this->input->post("oTur") && $this->input->post("ortTur"))
            {
                $gelenDers = $this->input->post("ders");
                $gelenOkulTur = $this->input->post("oTur");
                $gelenOrtTur = $this->input->post("ortTur");

                $silinenGrup = $this->db->query(
                    "(select ders_ogrenci.grupId from ders_ogrenci where dersId = '$gelenDers' and bturId in
                    (select bturId from btur where btur.tur = '$gelenOrtTur' and btur.bolumId in 
                    (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where fakulte.okulTuru ='$gelenOkulTur'))) group by grupId);"
                )->result();

                $ogrenciGrupSil = $this->db->query(
                    "update ders_ogrenci set grupId = null where dersId = '$gelenDers' and bturId in
                    (select bturId from btur where btur.tur = '$gelenOrtTur' and btur.bolumId in 
                    (select bolumId from bolum where fakulteId in (select fakulteId from fakulte where fakulte.okulTuru ='$gelenOkulTur')));"
                );

                foreach ($silinenGrup as $sil) {
                    $sil = $this->db->query(
                        "delete from ders_birlestir where grupId = '$sil->grupId';"
                    );
                }
            }
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }
    
}

?>