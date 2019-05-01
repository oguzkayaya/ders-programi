<?php 

class Eleman extends CI_Controller
{
    public function index()
    {
        if($this->session->yetki == "yonetici")
		{
            $elemanlar = $this->db->query("select elemanId,elemanAd,eMail,telefon,unvan,aPerNo from eleman order by elemanAd;")->result();
            $viewData = array("elemanlar" => $elemanlar);
            $this->load->view("eleman/eleman",$viewData);
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
            $ad = $this->input->post("ad");
            $unvan = $this->input->post("unvan");
            $tel = $this->input->post("tel");
            $mail = $this->input->post("mail");
            $aPerNo = $this->input->post("aPerNo");
            if(!is_null($ad) && !is_null($unvan) && !is_null($tel) && !is_null($mail) && !is_null($aPerNo))
            {
                $ekle = $this->db->query("insert into eleman(elemanAd,eMail,telefon,unvan,aPerNo) values('$ad','$mail','$tel','$unvan','$aPerNo');");
                if($ekle)
                {
                    echo "<title>Öğretim Elemanı Ekleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:green;'>
                            ".$unvan."-".$ad." Eklendi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("eleman"));
                    return;
                }
                else
                {
                    echo "<title>Öğretim Elemanı Ekleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            ".$unvan."-".$ad." Eklenemedi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("eleman"));
                    return;
                }
            }
            $this->load->view("eleman/elemanEkle");
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

    public function  sil()
    {
        if($this->session->yetki == "yonetici")
		{
            $elemanId = $this->input->post("elemanId");
            if($elemanId)
            {
                $eleman = $this->db->query("select elemanAd,eMail,telefon,unvan from eleman where elemanId = '$elemanId'")->result()[0];
                $sil = $this->db->query("delete from eleman where elemanId = '$elemanId';");
                if($sil)
                {
                    echo "<title>Öğretim Elemanı Silme</title>
                            <div style='margin:100px;'>
                            <h3 style='color:green;'>
                            ".$eleman->unvan."-".$eleman->elemanAd." Silindi.
                            </h3>
                        </div>";
                    header('refresh:1;url='.base_url("eleman"));
                    return;
                }
                else
                {
                    echo "<title>Öğretim Elemanı Silme</title>
                            <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            ".$eleman->unvan."-".$eleman->elemanAd." Silinemedi.
                            </h3>
                        </div>";
                    header('refresh:1;url='.base_url("eleman"));
                    return;
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
            $elemanId = $this->input->post("elemanId");
            $eleman = $this->db->query("select elemanId,elemanAd,eMail,telefon,unvan from eleman where elemanId = '$elemanId'")->result()[0];
            $ad = $this->input->post("ad");
            $unvan = $this->input->post("unvan");
            $tel = $this->input->post("tel");
            $mail = $this->input->post("mail");
            $aPerNo = $this->input->post("aPerNo");
            if(!is_null($ad) && !is_null($unvan) && !is_null($tel) && !is_null($mail))
            {
                $guncelle = $this->db->query("update eleman set elemanAd='$ad', eMail='$mail', telefon='$tel', unvan='$unvan', aPerNo = '$aPerNo' where elemanId='$elemanId';");
                if($guncelle)
                {
                    echo "<title>Öğretim Elemanı Güncelleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:green;'>
                            Öğretim Elemanı <br></h3>
                            $unvan - $ad , $tel , $mail<br><h3 style='color:green;'> olarak güncellendi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("eleman"));
                    return;
                }
                else
                {
                    echo "<title>Öğretim Elemanı Güncelleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            Öğretim Elemanı Güncellenemedi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("eleman"));
                    return;
                }
            }
            
            $viewData = array("elemanId" => $elemanId , "eleman" => $eleman);
            $this->load->view("eleman/elemanDuzenle",$viewData);
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }

}

?>