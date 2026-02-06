<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kirimwa extends CI_Model
{

    public function kirim($number,$message, $device){
        $link  =  "https://app.whacenter.com/api/send";
        $data = [
        'number' => $number,
        'message' => $message,
        'device_id' => $device
        ];
         
         
        $curl = curl_init();
        
 
        // curl_setopt($curl, CURLOPT_HTTPHEADER,
        //     array(
        //         "Authorization: $this->device_id",
        //     )
        // );
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl); 
        return $result;
    }

}
?>