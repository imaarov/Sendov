<?php
namespace Imaarov\Sendov;

class LogService {

  public function __construct(
    private string $error_path
  ) {}

  /*
   * Log content and ouput it if you want
   *
   * @param $log_content
   * @param bool $output
   * @return void
   */
  public function log($log_content, bool $output = false): void
  {
    $date = date('Y.m.d h:i:s');
    $log = $log_content;
    $log['Date: '] = $date;
    if(is_array($log_content)){
      foreach ($log_content as $key => $log) {
        error_log("$key : $log" . "\n", 3, $this->error_path);    
      }
    }
    
    if($output)
      print_r($log_content);
  }
}
