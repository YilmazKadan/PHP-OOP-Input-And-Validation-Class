<?php


class formKontrol
{
    private $hatalar = array();


    // Kontrol metodu yazılacak
    public function kontrol($kaynak, $veriler = array())
    {
        foreach ($veriler as $veri => $kurallar) {
            $inputDegeri = $kaynak[$veri];
            foreach ($kurallar as $kural => $kuralDegeri) {
                if ($kural == "gerekli" && empty($inputDegeri)) {
                    $this->hataEkle("{$veri} alanı boş bırakılamaz");
                } else if (!empty($inputDegeri)) {
                    switch ($kural) {
                        case "min":
                            if (mb_strlen($inputDegeri) < $kuralDegeri) {
                                $this->hataEkle("{$veri} alanı {$kuralDegeri} karakterden küçük olamaz ");
                            }
                            break;
                        case "max":
                            if (mb_strlen($inputDegeri) > $kuralDegeri) {
                                $this->hataEkle("{$veri} alanı {$kuralDegeri} karakterden büyük  olamaz ");
                            }
                            break;
                        case 'mail':
                            if (!filter_var($inputDegeri, FILTER_VALIDATE_EMAIL))
                                $this->hataEkle("{$veri} alanı bir email adresi olmak zorundadır!");
                            break;
                        case 'eslesme':
                            if ($inputDegeri != $kaynak[$kuralDegeri])
                                $this->hataEkle("{$veri} alanı {$kuralDegeri} alanına eşit olmak zorundadır");
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }

    //  Hata ekleme metodu
    private function hataEkle($mesaj)
    {
        $this->hatalar[] = $mesaj;
    }

    // Hataları ekrana bastırma metodu
    public function hataYazdir()
    {
        if (count($this->hatalar) != 0) {
            foreach ($this->hatalar as $hata) {
                echo "{$hata} <br>";
            }
        }
    }
    public function olumlumu()
    {
        if (count($this->hatalar) == 0)
            return true;
        else
            return false;
    }
}
