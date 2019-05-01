<?php  
class Oturum extends CI_Controller
{
    public function giris()
    {
        if($this->input->post("kullanici") && $this->input->post("sifre"))
        {
            $kulAd = $this->input->post("kullanici");
            $sifre = $this->input->post("sifre");

            @$yetki = $this->db->query("select kullaniciAdi,yetkiAd from yetki where kullaniciAdi = ? and sifre = ?;" , array($kulAd , $sifre))->result()[0];
            if($yetki)
            {
                echo "Giriş Başarılı<br>";
                $sessionData = array
                (
                    "kullaniciAdi" => $yetki->kullaniciAdi,
                    "yetki" => $yetki->yetkiAd
                );
                $this->session->set_userdata($sessionData);
                header('refresh:1;url='.base_url("program/"));
            }
            else
            {
                $viewData = array("hata" => "Kullanıcı adı veya paralo yanlış.");
                $this->load->view("oturum/giris", $viewData);
            }
        }
        else
        {
        $this->load->view("oturum/giris");
        }
    }
    
    public function cikis()
    {
        session_destroy();
        header('refresh:1;url='.base_url("oturum/giris"));
    }
}
?>