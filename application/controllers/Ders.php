<?php

class Ders extends CI_Controller
{
    public function index($g_fakulte=-1,$g_bolum=-1)
    {
        if($this->session->yetki == "yonetici")
		{
            $birimler = $this->db->query("select fakulteId,fakulteAd from fakulte")->result();
            $bolumler = $this->db->query("select bolumId,BolumAd,fakulteId as 'birimId' from bolum;")->result();
            $dersler = $this->db->query("select * from ders where bolumId = {$g_bolum}")->result();
            $dersler = array();
            $gBolum = NULL;
            $gBirim = NULL;
            if($g_fakulte != -1 && $g_bolum != -1)
            {
                $dersler = $this->db->query("select * from ders where bolumId = $g_bolum")->result();
            }
            $viewData = array("birimler" => $birimler , 
                            "bolumler" => $bolumler ,
                            "dersler" => $dersler,
                            "postBirim" => $g_fakulte,
                            "postBolum" => $g_bolum
                        );
            $this->load->view("ders/ders",$viewData);
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
            if($_POST)
            {
                if(
                    $this->input->post("dersAd") &&
                    $this->input->post("kod") &&
                    $this->input->post("uygulama") &&
                    $this->input->post("teorik") &&
                    $this->input->post("birim") &&
                    $this->input->post('bolum')
                    )
                {
                    $dersAd = $this->input->post("dersAd");
                    $dersKod = $this->input->post("kod");
                    $uyg = $this->input->post("uygulama");
                    $teo = $this->input->post("teorik");
                    $g_birim = $this->input->post("birim");
                    $g_bolum = $this->input->post('bolum');
                    if($dersAd && $dersKod && $g_bolum)
                    {
                        $ekle = $this->db->query("insert into ders(dersKodu,teorik,uygulama,bolumId,dersAd) values('{$dersKod}','{$teo}','{$uyg}','{$g_bolum}','{$dersAd}');");
                        if($ekle)
                        {
                            echo "<div style='margin:100px;'>
                                    <h3 style='color:green;'>
                                    ".$dersKod."-".$dersAd." Eklendi.
                                    </h3>
                                </div>";
                                header('refresh:1;url='.base_url("ders/index/").$g_birim."/".$g_bolum);
                            return;
                        }
                        else
                        {
                            echo "<div style='margin:100px;'>
                                    <h3 style='color:red;'>
                                    ".$dersKod."-".$dersAd." Eklenemedi.
                                    </h3>
                                </div>";
                            header('refresh:1;url='.base_url("ders/index/").$g_birim."/".$g_bolum);
                            return;
                        }
                    }
                    /*
                    $b = $this->db->query("select BolumAd from bolum where bolumId = '{$g_bolum}'")->result()[0];
                    $f = $this->db->query("select fakulteAd from fakulte where fakulteId = '{$g_birim}'")->result()[0]->fakulteAd;
                    $viewData = array(
                        "birimAd" => $f ,
                        "bolumAd" => $b,
                        "birimId" => $g_birim ,
                        "bolumId" => $g_bolum
                    );
                    $this->load->view("ders/dersEkle",$viewData);
                    */
                }
                else
                {
                    header('refresh:1;url='.base_url("ders/index/"));
                }
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
            $dersId = $this->input->post("dersId");
            $ders = $this->db->query("select dersAd,dersKodu,bolumId,(select fakulteId from bolum where bolumId = ders.bolumId) as fakulteId from ders where dersId = '{$dersId}';")->result()[0];
            $sil = $this->db->query("delete from ders where dersId = '{$dersId}';");
            if($sil)
            {
                echo "<div style='margin:100px;'>
                            <h3 style='color:green;'>
                            ".$ders->dersKodu."-".$ders->dersAd." Silindi.
                            </h3>
                        </div>";
                header('refresh:1;url='.base_url("ders/index/").$ders->fakulteId."/".$ders->bolumId);
                return;
            }
            else
            {
                echo "<div style='margin:100px;'>
                            <h3 style='color:red;'>
                            ".$ders->dersKodu."-".$ders->dersAd." Silinemedi.
                            </h3>
                        </div>";
                header('refresh:1;url='.base_url("ders/index/").$ders->fakulteId."/".$ders->bolumId);
                return;
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
            $dersId = $this->input->post("dersId");
            $kod = $this->input->post("kod");
            $dersAd = $this->input->post("dersAd");
            $uyg = $this->input->post("uygulama");
            $teo = $this->input->post("teorik");
            $ders = $this->db->query(
                "select 
                    dersId,
                    dersKodu,
                    teorik,
                    uygulama,
                    dersAd,
                    bolumId,
                    (select BolumAd from bolum where bolumId = ders.bolumId) as 'bolumAd',
                    (select fakulteId from bolum where bolumId = ders.bolumId) as 'fakulteId',
                    (select fakulteAd from fakulte where fakulteId = 
                        (select fakulteId from bolum where bolumId = ders.bolumId)) as 'fakulteAd'
                from ders where dersId = '{$this->input->post("dersId")}';"
                )->result()[0];
            if($kod && $dersAd && isset($uyg) && isset($teo))
            {
            $guncelle = $this->db->query("update ders set dersAd='$dersAd', teorik='$teo', uygulama='$uyg', dersKodu='$kod' where dersId='{$dersId}';");
            if($guncelle)
                {
                    echo "<div style='margin:100px;'>
                            <h3 style='color:green;'>
                            ".$kod."-".$dersAd." Olarak Güncellendi.
                            </h3>
                        </div>";
                    header('refresh:1;url='.base_url("ders/index/").$ders->fakulteId."/".$ders->bolumId);
                    return;
                }
                else
                {
                    echo "güncellenemedi.";
                    echo "<div style='margin:100px;'>
                            <h3 style='color:red;'>
                            ".$kod."-".$dersAd." Olarak Güncellenemedi.
                            </h3>
                        </div>";
                    header('refresh:1;url='.base_url("ders/index/").$ders->fakulteId."/".$ders->bolumId);
                    return;
                }
            }
            else
            {
                $viewData = array("ders" => $ders);
                $this->load->view("ders/dersDuzenle",$viewData);
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