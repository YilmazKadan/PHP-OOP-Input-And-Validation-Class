# PHP-OOP-Input-And-Validation-Class
Bu repomda PHP programlama dilinde OOP kullanarak bir Input ve Form Validation sınıfı oluşturdum.
## Ne için kullanılacak ?

Sınıfın yazımındaki amaç html tarafından gelen form verilerini istediğimiz değerlere göre filtreden geçirmek ve tüm değerleri karşılıyorsa elemanlar gerekli kayıt, guncelleme gibi 
işlemleri yapmak. Eğer gereklilikler karşılanmıyorsa detaylı bir hata verdirmek.

# Kullanım
```php

include_once("classes/input.class.php");
include_once("classes/validate.class.php");
```
ile sınıfları dahil ediyoruz.
## Input Sınıfı
İnput sınıfı herhangi bir post veya get metodu var mı diye kontrol ediyor ve içerisinde bulunan **get** fonksiyonu sayesinde POST veya GET ile gelen veriyi alabiliyoruz.
Post veya Get isteği var mı yok mu aşağıdaki kod satırı ile kontrol edebilirsiniz.

```php
if (INPUT::exist()) {
}
```

```php
## Validation sınıfı

Bu sınıf içerisinde bulunan **check** fonksiyonu aracılığı ile tüm işlemleri hallediyor. 
Fonksiyona bir dizi veya POST , GET yolluyoruz. 
Ardından ikinci bir array ile form elemanlarımızın **name** değerlerini yolluyoruz(Aşağıdaki **name** değeri ile karıştırılmamalı).
Bunların ardından hata mesajları ekrana verdirilirken input'un name attr'si default olarak verilir , ama özelleştirmek istiyorsanız **name** adına bir değer yollamanız gerekmekte.

required = "Boş geçilemez"
min  =  minumum karakter
max = maksimum karakter
email = email formatı
matches  = eşit olmasını istediğimiz farklı bir input seçiyoruz.

### Genel kullanım
 <?php
if (INPUT::exist()) {
    $validate = new Validate();
    $validate->check($_POST, array(
        'ad' => array(
            'name' => "Kullanıcı Adı",
            'required' => true,
            'min' => 2,
            'max' => 50
        ),
        'mail' => array(
            'name' => "Email",
            'required' => true,
            'email' => true
        ),
        'sifre' => array(
            'name' => "Şifre",
            'required' => true,
            'min' => 8,
            'max' => 15
        ),
        'sifreTekrar' => array(
            'matches' => 'sifre'
        )
    ));
    if ($validate->passed())
        echo 'Tüm değerler uyuyor';
    else {
        $validate->showError();
    }
} else {
    echo 'Post yok';
}

```