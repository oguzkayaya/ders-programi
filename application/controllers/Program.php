<?php 

class Program extends CI_Controller
{
    public function index()
    {
        if($this->session->yetki)
        {
            $birimler = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteAd != 'ORTAK';")->result();
            $viewData["birimler"] = $birimler;
            $bolumler = $this->db->query("select 
            (select fakulteId from fakulte where fakulteId = bolum.fakulteId) as 'birimId',
            BolumAd,
            tur as ortTur,
            bTurId
            from bolum,btur where bolumAd != 'ORTAK' and bolum.bolumId = btur.bolumId;")->result();
            $viewData["bolumler"] = $bolumler;
            $this->load->view("program/anaSayfa",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }


    public function gunBul($aranan,$vtGunler)
    {
        $m = 0;
        foreach ($vtGunler as $gun) {
            if($gun->gunAd == $aranan)
            {
                $m = 1;
                return $m;
            }
        }
        return $m;
    }

    public function goster($bTurId=-1)
    {
        if($this->session->yetki == "yonetici")
        {
            if($this->input->post("bolum"))
            {
                $bTurId = $this->input->post("bolum");
            }
            else
            {
                $bTurId = $bTurId;
            }
            $g_bolumAd = $this->db->query(
                "select 
                    bTurId,
                    tur as 'ortTur',
                    BolumAd,
                    (select fakulte.fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'birimAd' 
                from bolum,btur where bolum.bolumId = btur.bolumId and bTurId = '$bTurId';"
                    )->result()[0];
            $program = array();
            if($bTurId!=-1)
            {
                $program = $this->db->query(
                    "select 
                    progId,
                    (select ders.dersAd from ders where dersId = ders_prog.dersId) as 'dersAd',
                    (select ders.dersKodu from ders where dersId = ders_prog.dersId) as 'dersKod',
                    (select eleman.elemanAd from eleman where elemanId = ders_prog.elemanId) as 'elemanAd',
                    saat,
                    (select gunAd from gun where gunId = ders_prog.gun) as 'gun',
                    (select sinif.sinifAd from sinif where sinifId = ders_prog.sinifId) as 'sinifAd',
                    saatTur 
                    from ders_prog where bTurId = $g_bolumAd->bTurId;"
                )->result();
            }
            $fakulteler = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteAd != 'ORTAK';")->result();
            
            $tumGunler = array("Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");
            $vtGunler = $this->db->query("select gunAd from gun;")->result();
            $gunler = array(" ");
            foreach ($tumGunler as $gun) {
                if($this->gunBul($gun,$vtGunler))
                {
                    $gunler[] = $gun;
                }
            }

            if($g_bolumAd->ortTur == 1)
            {
                $saatler = array(
                    " ",
                    "08:00 - 09:00",
                    "09:00 - 10:00",
                    "10:00 - 11:00",
                    "11:00 - 12:00",
                    "12:00 - 13:00",
                    "13:00 - 14:00",
                    "14:00 - 15:00",
                    "15:00 - 16:00",
                    "16:00 - 17:00"
                );
            }
            else if($g_bolumAd->ortTur == 2)
            {
                $saatler = array(
                    " ",
                    "17:00 - 18:00",
                    "18:00 - 19:00",
                    "19:00 - 20:00",
                    "20:00 - 21:00",
                    "21:00 - 22:00",
                    "22:00 - 23:00",
                    "23:00 - 24:00"
                );
            }
            
            $viewData = array(
                "fakulteler" => $fakulteler,
                "gelen_b" => $bTurId,
                "program" => $program,
                "gunler" => $gunler,
                "saatler" => $saatler,
                "g_bolumAd" => $g_bolumAd
            );
            $this->load->view("program/program",$viewData);
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
            if($_POST) //kaydet
            {
                echo "post edildi";
                $saat = $this->input->post("saat");
                $gunAd = $this->input->post("gun");
                $gun = $this->db->query("select gunId from gun where gunAd = '$gunAd';")->result()[0]->gunId;
                $birim = $this->input->post("birim");
                $bolum = $this->input->post("bolum");
                $ders = $this->input->post("ders");
                $tur = $this->input->post("tur");
                $eleman = $this->input->post("org");
                $sinif = $this->input->post("sinif");
                echo "<hr/> $saat <hr/> $gun <hr/> $birim <hr/> $bolum <hr/> $ders <hr/> tür = $tur <hr/> $eleman <hr/> $sinif";
                $ekle = $this->db->query(
                    "insert into ders_prog(dersId,elemanId,saat,gun,sinifId,saatTur,bTurId) 
                        values('{$ders}','{$eleman}','{$saat}','{$gun}','{$sinif}','{$tur}','{$bolum}');"
                    
                    );
                if($ekle)
                {
                    echo "eklendi";
                    header('refresh:1;url='.base_url("program/goster/").$birim."/".$bolum."-".$tur);
                }
                else
                {
                    echo "eklenmedi";
                    header('refresh:1;url='.base_url("program/goster/").$birim."/".$bolum."-".$tur);
                }
                
            }
            else 
            {
                $birim = $this->input->get("birim");
                $bolum = $this->input->get("bolum");
                
                $g_bolumAd = $this->db->query(
                    "select 
                        bolum.bolumId,
                        tur as 'ortTur',
                        BolumAd,
                        (select fakulte.fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'birimAd' 
                    from bolum,btur where btur.bTurId = '$bolum' and bolum.bolumId = btur.bolumId;"
                    )->result()[0];
                $gun = $this->input->get("gun");
                $saat = $this->input->get("saat"); 
                $dersler = $this->db->query("select dersId,dersKodu,dersAd from ders where bolumId ='$g_bolumAd->bolumId'
                    or bolumId = (select bolumId from bolum where BolumAd = 'ORTAK' and fakulteId = 
                    (select fakulteId from fakulte where fakulteAd = 'ORTAK'));")->result();
                  
                $turler = array();
                $elemanlar = array();
                $siniflar = array();

                $gelenDers = -1;
                $gelenEleman = -1;
                $gelenTur = -1;


                if($this->input->get("ders"))
                {
                    $gelenDers = $this->input->get("ders");
                    $gelenDersBirim = $this->db->query(
                        "select fakulte.fakulteAd from fakulte where fakulteId = (select bolum.fakulteId from bolum where bolumId = (select ders.bolumId from ders where dersId = '$gelenDers'));"
                    )->result()[0]->fakulteAd;
                    if($gelenDersBirim == 'ORTAK')
                    {
                        $elemanlar = $this->db->query(
                        "
                        select elemanId,elemanAd,unvan from eleman where 
                        elemanId NOT IN
                        (select elemanId from
                        (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                        (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 1 and adet >= teorik))
                        or
                        elemanId NOT IN
                        (select elemanId from
                        (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                        (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 2 and adet >= uygulama));
                        "
                        )->result();
                    }
                    else
                    {
                        $elemanlar = $this->db->query(
                            "select elemanId,elemanAd,unvan from eleman where elemanId in
                            (select elemanId from eleman where elemanId NOT IN
                                (select elemanId from
                                (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                                (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 1 and adet >= teorik))
                                or
                                elemanId NOT IN
                                (select elemanId from
                                (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                                (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 2 and adet >= uygulama)))
                            and
                            elemanId in (select elemanId from eleman where elemanId not in 
                                (select elemanId from ders_prog where gun = 
                                    (select gunId from gun where gunAd = '$gun') and saat = '$saat'));"
                        )->result();
                    }

                    // $elemanlar = $this->db->query(
                    //     "
                    //     select elemanId,elemanAd,unvan from eleman where elemanId NOT IN
                    //     (select elemanId from
                    //     (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                    //     (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 1 and adet >= teorik))
                    //     or
                    //     elemanId NOT IN
                    //     (select elemanId from
                    //     (select elemanId,saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and bTurId = '$bolum' group by elemanId,saatTur) o1,
                    //     (select teorik,uygulama from ders where dersId = '$gelenDers') o2 where (o1.saatTur = 2 and adet >= uygulama));
                    //     "
                    // )->result();

                   

                    $siniflar = $this->db->query(
                        "select sinifId,sinifAd from sinif where  sinifId not in (select sinifId from ders_prog where gun = (select gunId from gun where gunAd = '$gun') and saat = '$saat');"
                    )->result();
                    
                    if($this->input->get("eleman"))
                    {
                        $gelenEleman = $this->input->get("eleman");
                        $dersSaat = $this->db->query("select teorik,uygulama from ders where dersId = '$gelenDers';")->result()[0];
                        $olanT = $this->db->query("select saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and elemanId = '$gelenEleman' and bTurId = '$bolum' group by saatTur having saatTur = 1;")->result();
                        $olanU = $this->db->query("select saatTur,count(*) as 'adet' from ders_prog where dersId = '$gelenDers' and elemanId = '$gelenEleman' and bTurId = '$bolum' group by saatTur having saatTur = 2;")->result();
                        //print_r($olanT);
                        //print_r($olanU);
                      
                        if(!$olanT)
                        {
                            $turler[] = 1;
                        }
                        if(!$olanU)
                        {
                            $turler[] = 2;
                        }
                        if($olanT and $olanT[0]->adet < $dersSaat->teorik)
                        {
                            $turler[] = 1;
                        }
                        if($olanU and $olanU[0]->adet < $dersSaat->uygulama)
                        {
                            $turler[] = 2;
                        }

                        if($this->input->get("tur"))
                        {
                            $gelenTur = $this->input->get("tur");
                        }
                        
                    }
                }
                



                $viewData = array(
                    "birimId" => $birim,
                    "bolumId" => $bolum,
                    "BolumBilgi" => $g_bolumAd,
                    "gun" => $gun,
                    "saat" => $saat,
                    "dersler" => $dersler,
                    "turler" => $turler,
                    "elemanlar" => $elemanlar,
                    "siniflar" => $siniflar,
                    "gelenDers" => $gelenDers,
                    "gelenEleman" => $gelenEleman,
                    "gelenTur" => $gelenTur
                );


                $this->load->view("program/ekle",$viewData);
                                                    /*
                //$siniflar = $this->db->query("select sinifId,sinifAd from sinif;")->result();
                //$siniflar = $this->db->query("select sinifId,sinifAd from sinif where sinifId not in(select sinifId from ders_prog where saat='$saat' and gun='$gun');")->result();
                $siniflar = array();
                                                    $viewData["siniflar"] = $siniflar;
                                                    $viewData["gelen_ders"] = -1;
                if($ders = $this->input->get("ders"))
                {
                    $viewData["gelen_ders"] = $ders; 
                    //$elemanlar = $this->db->query("select elemanId,unvan,elemanAd from eleman order by elemanAd ASC;")->result();
                    $elemanlar = $this->db->query("select elemanId,unvan,elemanAd from eleman where elemanId not in (select elemanId from ders_prog where saat='$saat' and gun='$gun') order by elemanAd ASC;")->result();
                                                    $viewData["elemanlar"] = $elemanlar;
                    if($eleman = $this->input->get("org"))
                    {
                        $viewData["gelen_org"] = $eleman;
                    }
                }
                //$siniflar = $this->db->query("select sinifId,sinifAd from sinif;")->result();
                /*$viewData = array(
                    //"elemanlar" => $elemanlar,
                    //"siniflar" => $siniflar,
                    "dersler" => $dersler,
                    "bolum" => $bolum,
                    "gun" => $gun,
                    "saat" => $saat,
                    "birim" => $birim
                );*/
                
                
            }
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function sil()
    {
        if($this->session->yetki == "yonetici")
        {
            $pId = $this->input->post("progId");
            $p = $this->db->query(
                "select 
                (select bolum.fakulteId from bolum where bolumId = 
                    (select bolumId from ders where dersId = ders_prog.dersId)) as 'birim',
                (select bolum.bolumId from bolum where bolumId = 
                    (select bolumId from ders where dersId = ders_prog.dersId)) as 'bolum',
                (select tur from btur where bTurId = ders_prog.bTurId) as 'tur'
            from ders_prog where progId = '{$pId}';")->result()[0];
            $birim = $p->birim;
            $bolum = $p->bolum;
            $tur = $p->tur;
            $sil = $this->db->query("delete from ders_prog where progId = '{$pId}';");
            if($sil)
            {
                echo "Silindi";
                header('refresh:1;url='.base_url("program/goster/").$birim."/".$bolum."-".$p->tur);
            }
            else
            {
                echo "Silinemedi";
                header('refresh:1;url='.base_url("program/goster/").$birim."/".$bolum."-".$p->tur);
            }
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function duzenle()
    {
        if($this->session->yetki == "yonetici")
        {
            $pId = $this->input->get("progId");
            $p = $this->db->query(
                "select 
                    progId,
                    dersId,
                    elemanId,
                    sinifId,
                    saatTur,
                    saat,
                    gun,
                    (select bolum.fakulteId from bolum where bolumId = 
                        (select bolumId from ders where dersId = ders_prog.dersId)) as 'birim',
                    (select bolum.bolumId from bolum where bolumId = 
                        (select bolumId from ders where dersId = ders_prog.dersId)) as 'bolum',
                    (select tur from btur where bTurId = ders_prog.bTurId) as 'tur'
                from ders_prog where progId = '{$pId}';")->result()[0];
            $g_bolumAd = $this->db->query(
                "select
                    BolumAd,
                    (select fakulte.fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'birimAd' 
                from bolum where bolumId = '$p->bolum';
                    ")->result()[0];
                    $viewData["g_bolumAd"] = $g_bolumAd;
                    $viewData["gun"] = $p->gun;
                    $viewData["saat"] = $p->saat;
                    $viewData["tur"] = $p->tur;
            if($_POST)
            {
                $ders = $this->input->post("ders");
                $tur = $this->input->post("tur");
                $org = $this->input->post("org");
                $sinif = $this->input->post("sinif");
                $guncelle = $this->db->query("update ders_prog set dersId='$ders', elemanId='$org', sinifId='$sinif', saatTur='$tur' where progId='$pId';");
                if($guncelle)
                {
                    echo "Güncellendi.";
                    header('refresh:1;url='.base_url("program/goster/").$p->birim."/".$p->bolum);
                }
                else
                {
                    echo "Güncellenemedi.";
                    header('refresh:1;url='.base_url("program/goster/").$p->birim."/".$p->bolum);
                }
                return;
            }
            else if($this->input->get("drs"))
            {
                if($a = $this->input->get("drs"))
                {
                    $viewData["gDers"] = $a;
                    $viewData["gTur"] = "-1";
                    $viewData["gEleman"] = "-1";
                    $viewData["gSinif"] = "-1";
                }
            }
            else
            {
                $viewData["gDers"] = $p->dersId;
                $viewData["gTur"] = $p->saatTur;
                $viewData["gEleman"] = $p->elemanId;
                $viewData["gSinif"] = $p->sinifId;
            }
            $dersler = $this->db->query("select dersId,dersKodu,dersAd from ders where bolumId ='$p->bolum';")->result();
            $siniflar = $this->db->query("select sinifId,sinifAd from sinif;")->result();
            $elemanlar = $this->db->query("select elemanId,unvan,elemanAd from eleman order by elemanAd ASC;")->result();
            $viewData["dersler"] =$dersler;
            $viewData["siniflar"] = $siniflar;
            $viewData["elemanlar"] = $elemanlar;
            $viewData["birim"] = $p->birim;
            $viewData["bolum"] = $p->bolum;
            $viewData["pId"] = $p->progId;
            $this->load->view("program/duzenle",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }
}


?>