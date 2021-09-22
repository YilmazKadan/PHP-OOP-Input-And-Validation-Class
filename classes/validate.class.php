<?php


class Validate
{
    private $errors = array();



    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                // Get veya Post ile gelen değeri alıyoruz.
                $value = $source[$item];
                // Gönderilen input'un içerisinde  özel 'name' alanı  yok ise inputun kendi adı ile hata verdiriyoruz.
                $inputName = (isset($rules['name'])) ? $rules['name'] : $item;

                // Boş değer kontrolü
                if ($rule == 'required' && empty($value)) {
                    $this->addError("[{$inputName}] Alanı boş bırakılamaz");
                }else if(!empty($value)){

                    switch ($rule) {
                        case 'min':
                            if (strlen(trim($value)) < $rule_value)
                                $this->addError("[{$inputName}] Alanı minumum {$rule_value} karekter olmalı");
                            break;
                        case 'max':
                            if (strlen(trim($value)) > $rule_value)
                                $this->addError("[{$inputName}] Alanı maksimum {$rule_value} karekter olmalı");
                            break;
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                                $this->addError("[{$inputName}] Alanında gerçek bir email adresi girilmelidir!");
                            break;
                        case 'matches':
                            if($value != $source[$rule_value])
                                 $this->addError("[{$inputName}] alanı ile [{$rule_value}] alanı eşleşmiyor !");
                        default:
                            break;
                    }
                }
            }
        }
    }

    //  Hata ekleme fonksiyonu

    private function addError($message)
    {
        $this->errors[] =  $message;
    }
    public function showError()
    {
        foreach ($this->errors as $error) {
            echo '<pre>';
            echo "{$error}";
            echo '</pre>';
        }
    }
    public function passed()
    {
        return (empty($this->errors)) ? true : false;
    }
}
