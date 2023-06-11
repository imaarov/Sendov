<?php
namespace Imaarov\Sendov;

use Iman\Sendov\Interface\ConverterInterface;
use Iman\Sendov\LogService;
class SendRequestService {

    public array $msg = [];

    public function __construct(
        protected ConverterInterface $converter,
        protected LogService $log_service,
        protected string $url,
        protected string $key
    )
    {
      echo PHP_EOL . "CHECKING INTERNET CONNECTION AND SERVER CONNECTION..." . PHP_EOL;
      [$net_status, $server_status] = [$this->check_internet_status(), $this->check_internet_status($this->url)];
      switch (true) {
        case is_array($net_status):
          $this->log_service->log($net_status, true);
          exit;
          break;
        case is_array($server_status):
          $this->log_service->log($server_status, true);
          exit;
      }
    }

    /**
     * Check for internet connection Or server conection
     *
     * @param ?string
     * @return bool
     */
    public function check_internet_status(?string $url = null): bool|array
    {
      $connection = @fsockopen(
        hostname: isset($url) && !empty($url) ? $url : "google.com",
        port: 80,
        error_code: $error_code,
        error_message: $error_message,
        timeout: 3
      );
      if($connection) {
        fclose($connection);
        return true;
      }
      return [
        "Err msg: "   =>  $error_message,
        "Err code: "  =>  $error_code
      ];
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
