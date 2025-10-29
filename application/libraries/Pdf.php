<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        
        $this->dompdf = new Dompdf($options);
    }

    public function load_html($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function render()
    {
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
    }

    public function stream($filename, $options = array())
    {
        $this->dompdf->stream($filename, $options);
    }
}