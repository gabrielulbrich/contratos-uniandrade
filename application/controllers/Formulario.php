<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulario extends CI_Controller {

	public $nome;
	public $cep;
	public $endereco;
	public $bairro;
	public $cidade;
	public $estado;
	public $cnpj;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{

		$data['view'] = 'formulario_view';

		$this->load->view('_layout', $data);
		//redirect()
	}

	public function consultaCep($cep)
    {
        $this->load->library('curl');
        echo $this->curl->consulta($cep);   
    }

	public function gerarPdf()
	{
		$this->load->library('pdf_helper');
		$data = $this->input->post();
		$html = $this->load->view('PDF/pdf_layout', $data, true);
		$filename = 'pdf_'.time();//NOME DO PDF
		$this->pdf_helper->generate($html, $filename, true, 'A4', 'portrait');
		$this->db->insert('contratos', $data); //insere dados no banco.
	}
}
