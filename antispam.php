<?php
$crypt_key='da5Ds65dlqpIdowMbcu09d0762';//ключ шифрования данных(для антиспама)


function addantispam($fieldtitle='',$note='')
    {
        $this->fieldname[]='antispam';
        $this->fieldtitle[]=$fieldtitle;
        $this->mandatory[]=true;
        $this->tip[]='antispam';
        $this->note[]=$note;
        $this->listvalue[] = 'uuuuu';
        $this->countrows[] = 2;
    }

 srand((float) microtime()*1000000);
                    $rand_num = rand(1000,9999);
                    $md5_num = md5(intval(substr(intval($rand_num*23-4),0,4))*0.56231);//зашифровать контрольное число

?>
