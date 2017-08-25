<?php

class Draw extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->view('layouts/header');
  }
  
  public function honeycomb() {
    $n = $this->uri->segment(3);
    $m = $this->uri->segment(4);
    $str = '';

    for ($i = 0; $i < $m*6; $i++) {
      for ($j = 0; $j < $n; $j++) {

        // head and bottom
        // write only if divisble by 6 and last
        if ($i % 6 == 0 || $i + 1 == $m*6)
          $str .= '&nbsp;&nbsp;** ';

        // body 1
        // write only if their pos is divisble by 6
        if (($i - 1) % 6 == 0 || ($i - 4) % 6 == 0)
          $str .= '&nbsp;* &nbsp;*';

        // body 2
        // write only if their pos is divisble by 6
        // also write if last
        if (($i - 2) % 6 == 0 || ($i - 3) % 6 == 0) {
          $str .= '* &nbsp; &nbsp;';
          $str .= $j + 1 == $n ? '*' : '';
        }

      }

      // next line
      // write only if not bottom
      if (($i - 5) % 6 != 0)
        $str .= '<br/>';
    }

    $data['str'] = $str;

    $this->load->view('pages/render', $data);
    $this->load->view('layouts/footer');
  }
  
  public function hourglass() {

    $n = $this->uri->segment(3);
    $str = '';

    // loop from n
    for ($i = $n; $i >= -1 * abs($n); $i--) {

      $m = abs($i);

      if ($m == 0 || $i == -1)
        continue;

      // spaces
      for ($k = $n - $m; $k > 0; $k--)
        $str .= '&nbsp;';

      // asterisks
      for ($j = $m; $j > 0; $j--)
        $str .= '* ';

      // next line
      $str .= '<br/>';
    }

    $data['str'] = $str;
    
    $this->load->view('pages/render', $data);
    $this->load->view('layouts/footer');
  }

}

?>