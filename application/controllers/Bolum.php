<?php

class Bolum extends CI_Controller
{

    public function ekle()
    {
        if($this->session->yetki == "yonetici")
		{
            $bolum = $this->input->post("bolumAd");
            $tur = $this->input->post("tur");
            $fakulte=$this->input->post("fakulte");

            if(!$bolum)
            {
                $fakulteBilgi = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteAd = '$fakulte';")->result()[0];
                $viewData = array("fakulte" => $fakulteBilgi);
                $this->load->view("bolum/bolumEkle",$viewData);
            }
            else if($bolum && $tur && $fakulte)
            {
                $fakulteId = $fakulte;
                @$mevcutBolum = $this->db->query("select bolumId from btur where bolumId = (select bolumId from bolum where BolumAd = '$bolum');")->result()[0]->bolumId;
                if($mevcutBolum)
                {
                    $ekle = $this->db->query(
                        "insert into btur(bolumId,tur) values('$mevcutBolum','$tur');"
                    );
                    if($ekle)
                    {
                        echo "<h3>" . $bolum . " eklendi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$fakulteId);
                    }
                    else
                    {
                        echo "<h3>" . $bolum . " eklenemedi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$fakulteId);
                    }
                }
                else
                {
                    $ekle = $this->db->query(
                        "insert into bolum(BolumAd,fakulteId) values('$bolum','$fakulte');"
                    );
                    $mevcutBolum = $this->db->query(
                        "select bolumId from bolum where BolumAd = '$bolum';"
                    )->result()[0]->bolumId;
                    $ekle = $this->db->query(
                        "insert into btur(bolumId,tur) values('$mevcutBolum','$tur');"
                    );
                    if($ekle)
                    {
                        echo "<h3>" . $bolum . " eklendi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$fakulteId);
                    }
                    else
                    {
                        echo "<h3>" . $bolum . " eklenemedi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$fakulteId);  
                    }
                        
                    
                }
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
            $p_fakulteId = $this->input->post("fakulte");
            $p_bolumAd = $this->input->post("bolumAd"); 
            $p_tur = $this->input->post("tur");
            $p_bturId = $this->input->post("bolumId");
            if($p_fakulteId && $p_bolumAd && $p_tur && $p_bturId)
            {
                $p_bolumId = $this->db->query("select bolumId from btur where bTurId = '{$p_bturId}';")->result()[0]->bolumId;
                echo $p_tur;
                $guncelle = $this->db->query(
                    "update bolum set BolumAd='$p_bolumAd' where bolumId='$p_bolumId';"
                );
                if($guncelle)
                {
                    $guncelle = $this->db->query(
                        "update btur set tur = '$p_tur' where bTurId = '$p_bturId';"
                    );
                    if($guncelle)
                    {
                        echo "<title>Bölüm Güncelle</title>
                        <h3 style='margin:50px;'> {$p_bolumAd} olarak başarıyla güncellendi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$p_fakulteId);
                    }
                    else
                    {
                        echo "<title>Bölüm Güncelle</title>
                        <h3 style='margin:50px; color:red'> {$p_bolumAd} olarak güncellenemedi.</h3>";
                        header('refresh:1;url='.base_url("fakulte/index/").$p_fakulteId);
                    }
                }
                else
                {
                    echo "<title>Bölüm Güncelle</title>
                    <h3 style='margin:50px; color:red'> {$p_bolumAd} olarak güncellenemedi.</h3>";
                    header('refresh:1;url='.base_url("fakulte/index/").$p_fakulteId);
                }
            }
            else
            {
            $bolumId = $this->input->post("bTurId");
            $b = $this->db->query(
                "select
                    bTurId,
                    BolumAd,
                    fakulteId,
                    (select fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'fakulteAd',
                    tur as 'ortTur'
                from bolum,btur where bolum.bolumId = btur.bolumId and bTurId = '$bolumId';"
            )->result();
            $fakulteler = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteAd != 'ORTAK';")->result();
            $viewData = array("bolum" => $b , "fakulteler" => $fakulteler);
            $this->load->view("bolum/bolumDuzenle",$viewData);
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
            $bolumId = $this->input->post("bTurId");
            $bolum = $this->db->query(
                "select
                 BolumAd,
                 bolum.bolumId,
                 fakulteId,
                 (select fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'fakulteAd',
                 tur as 'ortTur'
                 from bolum,btur where bolum.bolumId = btur.bolumId and bTurId = '$bolumId';"
            )->result();
            $sil = $this->db->query("delete from bTur where bTurId = '$bolumId';");
            if($sil)
            {
                $kaldimi = $this->db->query(
                    "select bolumId from btur where bolumId = {$bolum[0]->bolumId};"
                );
                if($kaldimi)
                {
                    $sil = $this->db->query("delete from bolum where bolumId = '{$bolum[0]->bolumId}'");
                    if($sil)
                    {
                        echo "<h3 style='color:green; margin:70px;'>{$bolum[0]->fakulteAd}<br>{$bolum[0]->BolumAd} - {$bolum[0]->ortTur}<br>
                        Başarıyla Silindi.</h3>";
                    }
                    else
                    {
                        echo "<h3>{$bolum[0]->fakulteAd}<br>{$bolum[0]->BolumAd} - {$bolum[0]->ortTur}<br>
                        Silinemedi.</h3>";
                    }
                }
                header('refresh:1;url='.base_url("fakulte/index/").$bolum[0]->fakulteId);
            }
            else
            {
                echo "<h3>{$bolum[0]->fakulteAd}<br>{$bolum[0]->BolumAd} - {$bolum[0]->ortTur}<br>
                Silinemedi.</h3>";
                header('refresh:1;url='.base_url("fakulte/index/").$bolum[0]->fakulteId);
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