<?php

class Fakulte extends CI_Controller
{
    public function index($a='-1')
    {
        if($this->session->yetki == "yonetici")
		{ 
            /*
            $this->db->select("fakulteId,fakulteAd");
            $this->db->from("fakulte");
            $this->db->where("fakulteAd != 'ORTAK'");
            $rows = $this->db->get()->result();
            */
            $fakulteler = $this->db->query("select fakulteId,fakulteAd,okulTuru from fakulte where fakulteAd != 'ORTAK';")->result();
            $bolumler = $this->db->query("select bTurId,bolum.bolumId,tur as 'ortTur',BolumAd,fakulteId from btur,bolum where btur.bolumId in (select bolumId from bolum where fakulteId = '$a') and btur.bolumId = bolum.bolumId;")->result();
            @$bolumFakulte = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteId = '$a';")->result()[0];
            $viewData = array( 
            "fakulteler" => $fakulteler,
            "bolumler" => $bolumler,
            "bolumFakulte" => $bolumFakulte);
            $this->load->view("fakulte",$viewData);
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
            $fakulte=$this->input->post("fakulteAd");
            $birimId = $this->input->post("birimId");
            $okulTuru = $this->input->post("okulTuru");
            if($fakulte)
            {
                $guncelle = $this->db->query("update fakulte set fakulteAd = '$fakulte', okulTuru = '$okulTuru' where fakulteId ='$birimId';");
                if( $guncelle)
                {
                    echo "<h3>" . $fakulte . " Güncellendi.</h3>";
                    header('refresh:1;url='.base_url("fakulte"));
                }
                else
                {
                    echo "<h3>Birim Güncellenemedi.</h3>";
                    header('refresh:1;url='.base_url("fakulte"));
                }
            }
            else
            {
                $fakulte = $this->db->query("select fakulteId,fakulteAd from fakulte where fakulteId = '$birimId';")->result();
                $viewData = array("fakulte" => $fakulte);
                $this->load->view("fakulteDuzenle",$viewData);
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
            $fakulte=$this->input->post("fakulteAd");
            $okulTuru = $this->input->post("okulTuru");
            if($fakulte && $okulTuru)
            {
            $ekle = $this->db->query("insert into fakulte(fakulteAd,okulTuru) values('$fakulte','$okulTuru');");
            if($ekle)
            {
            echo "<h3>" . $fakulte . " Eklendi</h3>";
            header('refresh:1;url='.base_url("fakulte"));
            }
            else
            {
            echo "<h3>Birim Eklenemedi.</h3>";
            header('refresh:1;url='.base_url("fakulte"));
            }
            }
            else
            {
            $this->load->view("fakulteEkle");
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
            $a = $this->input->post("fakulteId");
            $fakulte = $this->db->query("select fakulteAd,fakulteId from fakulte where fakulteId = $a")->result();
            if($fakulte)
            {
                if(!$this->db->query("delete from fakulte where fakulteId = $a;"))
                {
                    ?>
                    <div>
                        <h3>
                            Birim Silinemedi.<br>
                            <?php echo $fakulte[0]->fakulteAd; ?> Birimine bağlı bölümler olabilir.<br>
                            Devam ederseniz <?php echo $fakulte[0]->fakulteAd; ?> birimine bağlı bölüm ve dersler de silinecektir.<br>
                            Devam etmek istiyor musunuz?
                        </h3>
                        <input type='button' value='Evet' onclick="window.location.href='<?php echo base_url("fakulte/sil/").$a."/Evet"?>'">
                        <input type='button' value='Hayır' onclick="window.location.href='<?php echo base_url("fakulte/sil/").$a."/Hayir"?>'">
                    </div>
                    <?php
                }
                else
                {
                    $a  = "oguz";
                    echo "<h3>".$fakulte[0]->fakulteAd." Başarıyla Silindi.</h3>";
                    header('refresh:1;url='.base_url("fakulte"));
                }
            }
            else
            {
                echo "<h3>Böyle bir birim bulunmamaktadır.</h3>";
                header('refresh:1;url='.base_url("fakulte"));
            }
        }
        else
        {
            echo "Yetkiniz Bulunmamaktadır. Giriş Yapınız.";
            header('refresh:1;url='.base_url('oturum/giris'));
        }
    }


}