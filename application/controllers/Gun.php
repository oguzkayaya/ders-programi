<?php

class Gun extends CI_Controller
{
    private function ara($aranan,$gunler)
    {
        $bul = 0;
        foreach ($gunler as $gun) {
            if($gun->gunAd == $aranan)
            {
                $bul = 1;
                return $bul;
            }
        }
        return $bul;
    }


    public function index()
    {
        if($this->session->yetki == "yonetici")
        {
            $gunler = $this->db->query("select gunAd from gun;")->result();
            $tumGunler = array(
                "0" => array("gunAd" => "Pazartesi","mevcut" => 1),
                "1" => array("gunAd" => "Salı","mevcut" => 1),
                "2" => array("gunAd" => "Çarşamba","mevcut" => 1),
                "3" => array("gunAd" => "Perşembe","mevcut" => 1),
                "4" => array("gunAd" => "Cuma","mevcut" => 1),
                "5" => array("gunAd" => "Cumartesi","mevcut" => 1),
                "6" => array("gunAd" => "Pazar","mevcut" => 1),
            );
            for($i=0 ; $i<count($tumGunler) ; $i++)
            {
                if($this->ara($tumGunler[$i]["gunAd"],$gunler))
                {
                    $tumGunler[$i]["mevcut"] = 1;
                }
                else
                {
                    $tumGunler[$i]["mevcut"] = 0;
                }
            }
            $viewData["gunler"] = $gunler;
            $viewData["tumGunler"] = $tumGunler;
            $this->load->view("gun/gun",$viewData);
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
            $gelenGun = $this->input->post("gun");
            $sil = $this->db->query("delete from gun where gunAd = '$gelenGun';");
            if($sil)
            {
                echo "Silindi";
                // header('refresh:1;url='.base_url('gun'));
                header('Location:'.base_url('gun'));
            }
            else
            {
                echo "Silinemedi";
                // header('refresh:1;url='.base_url('gun'));
                header('Location:'.base_url('gun'));
            }
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
            $gelenGun = $this->input->post("gun");
            $ekle = $this->db->query("insert into gun(gunAd) values('$gelenGun');");
            if($ekle)
            {
                echo "eklendi";
                //header('refresh:0;url='.base_url('gun'));
                header('Location:'.base_url('gun'));
            }
            else
            {
                echo "eklenemedi";
                //header('refresh:0;url='.base_url('gun'));
                header('Location:'.base_url('gun'));
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