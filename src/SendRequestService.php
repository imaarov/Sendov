<?php
namespace Iman\Sendov;

use Iman\Sendov\Interface\ConverterInterface;

class SendRequestService {

    public array $msg = [];

    public function __construct(
        protected ConverterInterface $converter,
        protected string $url,
        protected string $key
    )
    {

    }

    /**
     * sending iterate array to api url
     * 
     * @param
     * @return void
     */
    public function send()
    {
        $arr = $this->key 
        ? $this->converter->file_content[$this->key]
        : $this->converter->file_content;
        foreach($arr as $key => $fields) {

            //url-ify the data for the POST
            $fields_string = http_build_query($fields);
            
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $this->url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
            
            //execute post
            $res = curl_exec($ch);
            var_dump([
                "Key of requested array"      =>      $key,
                "Value of requested array"    =>      $fields,
                "Response of requested array" =>      $res
            ]);
            array_push($this->msg,[
                "Key of requested array"      =>      $key,
                "Value of requested array"    =>      $fields,
                "Response of requested array" =>      $res
            ]);
        }
    }
}