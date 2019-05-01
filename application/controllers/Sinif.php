<?php 

class Sinif extends CI_Controller
{
    public function index()
    {
        if($this->session->yetki == "yonetici")
		{
            $siniflar = $this->db->query("select sinifId,sinifAd,kapasite,cinsi from sinif;")->result();
            $viewData = array("siniflar" => $siniflar);
            $this->load->view("sinif/sinif",$viewData);
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
            $sinifAd = $this->input->post("sinifAd");
            $kapasite = $this->input->post("kapasite");
            $cins = $this->input->post("cins");
            if(!is_null($sinifAd) && !is_null($kapasite) && !is_null($cins))
            {
                $ekle = $this->db->query("insert into sinif(sinifAd,kapasite,cinsi) values('$sinifAd','$kapasite','$cins');");
                if($ekle)
                {
                    echo "<title>Sınıf Ekleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:green;'>
                            $sinifAd Eklendi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("sinif"));
                    return;
                }
                else
                {
                    echo "<title>Öğretim Elemanı Ekleme</title>
                            <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            $sinifAd Eklenemedi.
                            </h3>
                            </div>";
                    header('refresh:1;url='.base_url("sinif"));
                    return;
                }
            }
            else
            {
                $this->load->view("sinif/sinifEkle");
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
            $sinifNo = $this->input->post("g_sinif");
            $sinif = $this->db->query("select * from sinif where sinifId = '$sinifNo';")->result()[0];
            if(!is_null($sinifNo))
            {
                $sil = $this->db->query("delete from sinif where sinifId = '$sinifNo';");
                if($sil)
                {
                    echo "<title>Sınıf Silme</title>
                    <div style='margin:100px;'>
                        <h3 style='color:green;'>
                            $sinif->sinifAd Silindi.
                        </h3>
                    </div>";
                    header('refresh:1;url='.base_url("sinif"));
                    return;
                }
                else
                {
                    echo "<title>Sınıf Silme</title>
                            <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            $sinif->sinifAd Silinemedi.
                            </h3>
                        </div>";
                    header('refresh:1;url='.base_url("sinif"));
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
            $g_sinifNo = $this->input->post("g_sinif");
            $sinif = $this->db->query("select * from sinif where sinifId = '$g_sinifNo';")->result()[0];
            $sinifAd = $this->input->post("sinifAd");
            $kapasite = $this->input->post("kapasite");
            $cins = $this->input->post("cins");
            if(!is_null($sinifAd) && !is_null($kapasite) && !is_null($cins) && !is_null($g_sinifNo))
            {
                $duzenle = $this->db->query("update sinif set sinifAd='$sinifAd', kapasite='$kapasite', cinsi='$cins' where sinifId='$g_sinifNo';");
                if($duzenle)
                {
                    echo "<title>Sınıf Güncelleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:green;'>
                            Sınıf <br></h3>
                            $sinifAd - $kapasite - $cins<br><h3 style='color:green;'> olarak güncellendi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("sinif"));
                    return;
                }
                else
                {
                    echo "<title>Sınıf Güncelleme</title>
                        <div style='margin:100px;'>
                            <h3 style='color:red;'>
                            Sınıf Güncellenemedi.
                            </h3>
                        </div>";
                        header('refresh:1;url='.base_url("sinif"));
                    return;
                }
            }
            else
            {
                $viewData = array("sinif" => $sinif , "g_sinif" => $g_sinifNo);
                $this->load->view("sinif/sinifDuzenle",$viewData);
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