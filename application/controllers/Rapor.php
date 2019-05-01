<?php

class Rapor extends CI_Controller
{
    public function eleman($elId = -1)
    {
        if($this->session->yetki == "yonetici")
        {
            $elemanlar = $this->db->query("select elemanId,elemanAd,unvan from eleman order by elemanAd asc;")->result();
            $viewData["elemanlar"] = $elemanlar;
            $viewData["elId"] = $elId;
            $program = array();
            if($elId > 0)
            {
                $program = $this->db->query(
                    "select 
                    (select ders.dersKodu from ders where dersId = ders_prog.dersId) as 'dersKodu',
                    (select ders.dersAd from ders where dersId = ders_prog.dersId) as 'dersAd',
                    (select eleman.unvan from eleman where elemanId = ders_prog.elemanId) as 'unvan',
                    (select eleman.elemanAd from eleman where elemanId = ders_prog.elemanId) as 'elemanAd',
                    (select sinif.sinifAd from sinif where sinifId = ders_prog.sinifId) as 'sinif',
                    saat,
                    saatTur,
                    (select gun.gunAd from gun where gunId = ders_prog.gun) as 'gun',
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select fakulteId from bolum where bolumId = btur.bolumId)) as 'birim',
                    (select bolum.BolumAd from bolum where bolumId = btur.bolumId) as 'bolum',
                    btur.tur
                    from ders_prog,btur where ders_prog.bTurId = btur.bTurId and elemanId = '$elId';"
                )->result();
            }
            $viewData["saatler"] = array(
                " ",
                "08:00 - 09:00",
                "09:00 - 10:00",
                "10:00 - 11:00",
                "11:00 - 12:00",
                "12:00 - 13:00",
                "13:00 - 14:00",
                "14:00 - 15:00",
                "15:00 - 16:00",
                "16:00 - 17:00",
                "17:00 - 18:00",
                "18:00 - 19:00",
                "19:00 - 20:00",
                "20:00 - 21:00",
                "21:00 - 22:00",
                "22:00 - 23:00",
                "23:00 - 24:00"
            );
            $viewData["gunler"] = array(" ","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");
            $viewData["program"] = $program;
            $this->load->view("rapor/eleman",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function sinif($sinifId = -1)
    {
        if($this->session->yetki == "yonetici")
        {
            $siniflar = $this->db->query("select sinifId,sinifAd from sinif order by sinifAd asc;")->result();
            $viewData["siniflar"] = $siniflar;
            $viewData["sinifId"] = $sinifId;
            $program = array();
            if($sinifId > 0)
            {
                $program = $this->db->query(
                    "select 
                    (select ders.dersKodu from ders where dersId = ders_prog.dersId) as 'dersKodu',
                    (select ders.dersAd from ders where dersId = ders_prog.dersId) as 'dersAd',
                    (select eleman.unvan from eleman where elemanId = ders_prog.elemanId) as 'unvan',
                    (select eleman.elemanAd from eleman where elemanId = ders_prog.elemanId) as 'elemanAd',
                    (select sinif.sinifAd from sinif where sinifId = ders_prog.sinifId) as 'sinif',
                    saat,
                    saatTur,
                    (select gun.gunAd from gun where gunId = ders_prog.gun) as 'gun',
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select fakulteId from bolum where bolumId = btur.bolumId)) as 'birim',
                    (select bolum.BolumAd from bolum where bolumId = btur.bolumId) as 'bolum',
                    btur.tur
                    from ders_prog,btur where ders_prog.bTurId = btur.bTurId and sinifId = '$sinifId';"
                )->result();
            }
            $viewData["saatler"] = array(
                " ",
                "08:00 - 09:00",
                "09:00 - 10:00",
                "10:00 - 11:00",
                "11:00 - 12:00",
                "12:00 - 13:00",
                "13:00 - 14:00",
                "14:00 - 15:00",
                "15:00 - 16:00",
                "16:00 - 17:00",
                "17:00 - 18:00",
                "18:00 - 19:00",
                "19:00 - 20:00",
                "20:00 - 21:00",
                "21:00 - 22:00",
                "22:00 - 23:00",
                "23:00 - 24:00"
            );
            $viewData["gunler"] = array(" ","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");
            $viewData["program"] = $program;
            $this->load->view("rapor/sinif",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function bolum($bTurId = -1)
    {
        if($this->session->yetki == "yonetici")
        {
            $bolumler = $this->db->query("select 
            (select fakulteId from fakulte where fakulteId = bolum.fakulteId) as 'birimId',
            bTurId,
            BolumAd,
            tur as ortTur 
            from bolum,btur where bolumAd != 'ORTAK' and bolum.bolumId = btur.bolumId;")->result();
            $viewData["bolumler"] = $bolumler;
            $birimler = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteAd != 'ORTAK';")->result();
            $viewData["bolumler"] = $bolumler;
            $viewData["birimler"] = $birimler;
            $viewData["bTurId"] = $bTurId;
            $program = array();
            if($bTurId > 0)
            {
                $program = $this->db->query(
                    "select 
                    (select ders.dersKodu from ders where dersId = ders_prog.dersId) as 'dersKodu',
                    (select ders.dersAd from ders where dersId = ders_prog.dersId) as 'dersAd',
                    (select eleman.unvan from eleman where elemanId = ders_prog.elemanId) as 'unvan',
                    (select eleman.elemanAd from eleman where elemanId = ders_prog.elemanId) as 'elemanAd',
                    (select sinif.sinifAd from sinif where sinifId = ders_prog.sinifId) as 'sinif',
                    saat,
                    saatTur,
                    (select gun.gunAd from gun where gunId = ders_prog.gun) as 'gun',
                    (select fakulte.fakulteAd from fakulte where fakulteId = (select fakulteId from bolum where bolumId = btur.bolumId)) as 'birim',
                    (select bolum.BolumAd from bolum where bolumId = btur.bolumId) as 'bolum',
                    btur.tur
                    from ders_prog,btur where ders_prog.bTurId = btur.bTurId and btur.bTurId = '$bTurId';"
                )->result();
            }
            $viewData["saatler"] = array(
                " ",
                "08:00 - 09:00",
                "09:00 - 10:00",
                "10:00 - 11:00",
                "11:00 - 12:00",
                "12:00 - 13:00",
                "13:00 - 14:00",
                "14:00 - 15:00",
                "15:00 - 16:00",
                "16:00 - 17:00",
                "17:00 - 18:00",
                "18:00 - 19:00",
                "19:00 - 20:00",
                "20:00 - 21:00",
                "21:00 - 22:00",
                "22:00 - 23:00",
                "23:00 - 24:00"
            );
            $viewData["gunler"] = array(" ","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");
            $viewData["program"] = $program;
            $this->load->view("rapor/bolum",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }
}

?>