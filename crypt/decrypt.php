<?php 
class Decrypt {
    function __construct (){
    }
    public function aes_decrypt($encode) {
        $decrpyt = openssl_decrypt(base64_decode($encode), "AES-128-CBC", CRYPT_KEY , OPENSSL_RAW_DATA);
        return $decrpyt;
    }  
    public function sha_matching_chk($str) {
        // 단방향 암호화 매칭
        return $hashed;
    }    
}
?>