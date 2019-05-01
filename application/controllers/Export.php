<?php 

class Export extends CI_Controller
{

    public function index()
    {
       
        $this->load->view("export/index");
    }

    public function birim()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Birim Adı');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Okul Türü');

        $birimler = $this->db->query(
            "select fakulteAd,okulTuru from fakulte order by fakulteAd;"
        )->result();

        $rowCount = 2; 
        foreach ($birimler as $birim) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $birim->fakulteAd);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $birim->okulTuru);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Birimler.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }

    public function bolum()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Bölüm Adı');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Öğrenim Türü');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Birim Adı');

        $bolumler = $this->db->query(
            "select BolumAd,tur,(select fakulte.fakulteAd from fakulte where fakulteId = bolum.fakulteId) as 'birim' 
                from btur,bolum where btur.bolumId = bolum.bolumId order by birim,BolumAd;"
        )->result();

        $rowCount = 2; 
        foreach ($bolumler as $bolum) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $bolum->BolumAd);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $bolum->tur);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $bolum->birim);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Bölümler.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }


    public function ders()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Ders Kodu');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Ders Adı');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Teorik Saati');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Uygulama Saati');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Bölüm');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Birim');

        $dersler = $this->db->query(
            "select dersKodu,dersAd,teorik,uygulama,
            (select bolum.BolumAd from bolum where bolumId = ders.bolumId) as 'bolum',
            (select fakulte.fakulteAd from fakulte where fakulteId = 
            (select bolum.fakulteId from bolum where bolumId = ders.bolumId)) as 'birim'
            from ders order by birim,bolum,dersAd;"
        )->result();

        $rowCount = 2; 
        foreach ($dersler as $ders) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $ders->dersKodu);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $ders->dersAd);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $ders->teorik);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $ders->uygulama);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $ders->bolum);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, $ders->birim);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Dersler.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }


    public function eleman()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Akademik Personel No');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Öğretim Elemanı');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Ünvanı');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Telefon');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'E-Mail');

        $elemanlar = $this->db->query(
            "select elemanAd,eMail,telefon,unvan,aPerNo from dersprog.eleman order by elemanAd;"
        )->result();

        $rowCount = 2; 
        foreach ($elemanlar as $eleman) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $eleman->aPerNo);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $eleman->elemanAd);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $eleman->unvan);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $eleman->telefon);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $eleman->eMail);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Öğretim Elemanları.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }


    public function Sinif()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sınıf');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kapasite');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Cinsi');

        $siniflar = $this->db->query(
            "select sinifAd,kapasite,cinsi from sinif order by sinifAd;"
        )->result();

        $rowCount = 2; 
        foreach ($siniflar as $sinif) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $sinif->sinifAd);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $sinif->kapasite);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $sinif->cinsi);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Sınıflar.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }


    public function OgrSayi()
    {
        $this->load->library("Excel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sınıf');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Kapasite');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Cinsi');

        $siniflar = $this->db->query(
            "select sinifAd,kapasite,cinsi from sinif order by sinifAd;"
        )->result();

        $rowCount = 2; 
        foreach ($siniflar as $sinif) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $sinif->sinifAd);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $sinif->kapasite);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $sinif->cinsi);
            $rowCount++;
        }

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Sınıflar.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
        $objWriter->save('php://output');
    }
}