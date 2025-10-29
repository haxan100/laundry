<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('permission');
    }

    public function transactions()
    {
        if ($this->session->userdata('user_type') === 'admin' && !check_access_sidebar('master_transaksi')) {
            redirect('admin');
        }
        
        $type = $this->input->get('type');
        $start_date = $this->input->get('start_date') ?: date('Y-m-d');
        $end_date = $this->input->get('end_date') ?: date('Y-m-d');
        
        // Get transactions data
        $this->db->select('t.*, c.nama as nama_customer, c.tier_level as customer_tier, k.nama_lengkap as kasir_nama');
        $this->db->from('transaksi t');
        $this->db->join('customers c', 't.id_customer = c.id_customer', 'left');
        $this->db->join('kasir k', 't.id_kasir = k.id_kasir', 'left');
        $this->db->where('DATE(t.created_at) >=', $start_date);
        $this->db->where('DATE(t.created_at) <=', $end_date);
        $this->db->order_by('t.created_at', 'DESC');
        $transactions = $this->db->get()->result();
        
        if ($type === 'excel') {
            $this->export_excel($transactions, $start_date, $end_date);
        } elseif ($type === 'pdf') {
            $this->export_pdf($transactions, $start_date, $end_date);
        }
    }

    private function export_excel($transactions, $start_date, $end_date)
    {
        require_once APPPATH . '../vendor/autoload.php';
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $sheet->setCellValue('A1', 'Laporan Transaksi');
        $sheet->setCellValue('A2', 'Periode: ' . date('d/m/Y', strtotime($start_date)) . ' - ' . date('d/m/Y', strtotime($end_date)));
        
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Kode Transaksi');
        $sheet->setCellValue('C4', 'Customer');
        $sheet->setCellValue('D4', 'Kasir');
        $sheet->setCellValue('E4', 'Berat (kg)');
        $sheet->setCellValue('F4', 'Total');
        $sheet->setCellValue('G4', 'Status');
        $sheet->setCellValue('H4', 'Tanggal');
        
        $row = 5;
        $no = 1;
        foreach ($transactions as $trx) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $trx->kode_transaksi);
            $sheet->setCellValue('C' . $row, $trx->nama_customer ?: 'Tamu');
            $sheet->setCellValue('D' . $row, $trx->kasir_nama ?: 'N/A');
            $sheet->setCellValue('E' . $row, $trx->berat_kg ?: 0);
            $sheet->setCellValue('F' . $row, $trx->total);
            $sheet->setCellValue('G' . $row, strtoupper($trx->status));
            $sheet->setCellValue('H' . $row, date('d/m/Y H:i', strtotime($trx->created_at)));
            $row++;
        }
        
        $filename = 'Transaksi_' . date('Y-m-d', strtotime($start_date)) . '_' . date('Y-m-d', strtotime($end_date)) . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    private function export_pdf($transactions, $start_date, $end_date)
    {
        $this->load->library('pdf');
        
        $html = '<h2 style="text-align: center;">Laporan Transaksi</h2>';
        $html .= '<p style="text-align: center;">Periode: ' . date('d/m/Y', strtotime($start_date)) . ' - ' . date('d/m/Y', strtotime($end_date)) . '</p>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
        $html .= '<thead><tr style="background-color: #f8f9fa;"><th>No</th><th>Kode</th><th>Customer</th><th>Kasir</th><th>Berat</th><th>Total</th><th>Status</th><th>Tanggal</th></tr></thead><tbody>';
        
        $no = 1;
        foreach ($transactions as $trx) {
            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . $trx->kode_transaksi . '</td>';
            $html .= '<td>' . ($trx->nama_customer ?: 'Tamu') . '</td>';
            $html .= '<td>' . ($trx->kasir_nama ?: 'N/A') . '</td>';
            $html .= '<td>' . ($trx->berat_kg ?: 0) . ' kg</td>';
            $html .= '<td>' . number_format($trx->total, 0, ',', '.') . '</td>';
            $html .= '<td>' . strtoupper($trx->status) . '</td>';
            $html .= '<td>' . date('d/m/Y H:i', strtotime($trx->created_at)) . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table>';
        $total_pendapatan = array_sum(array_column($transactions, 'total'));
        $html .= '<p style="margin-top: 20px;"><strong>Total Transaksi: ' . count($transactions) . '</strong></p>';
        $html .= '<p><strong>Total Pendapatan: Rp ' . number_format($total_pendapatan, 0, ',', '.') . '</strong></p>';
        
        $filename = 'Transaksi_' . date('Y-m-d', strtotime($start_date)) . '_' . date('Y-m-d', strtotime($end_date));
        $this->pdf->load_html($html);
        $this->pdf->render();
        $this->pdf->stream($filename . '.pdf', array('Attachment' => 1));
    }
}