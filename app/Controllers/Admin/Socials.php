<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostsModel;

class Socials extends BaseController
{
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->m_posts = new PostsModel();
        helper("global_fungsi_helper");
        /** untuk konfigurasi internal */
        $this->halaman_controller = "socials";
        $this->halaman_label = "Social Media";
    }
    function index()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            //kombinasi antara nama value
            //nama=set_socials_twitter value=linknya
            $konfigurasi_name = 'set_socials_twitter';
            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_twitter')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            $konfigurasi_name = 'set_socials_facebook';
            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_facebook')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            $konfigurasi_name = 'set_socials_github';
            $dataSimpan = [
                'konfigurasi_value' => $this->request->getVar('set_socials_github')
            ];
            konfigurasi_set($konfigurasi_name, $dataSimpan);

            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('admin/' . $this->halaman_controller);
        }

        $konfigurasi_name = 'set_socials_twitter';
        $data['set_socials_twitter'] = konfigurasi_get($konfigurasi_name)['konfigurasi_value'];

        $konfigurasi_name = 'set_socials_facebook';
        $data['set_socials_facebook'] = konfigurasi_get($konfigurasi_name)['konfigurasi_value'];

        $konfigurasi_name = 'set_socials_github';
        $data['set_socials_github'] = konfigurasi_get($konfigurasi_name)['konfigurasi_value'];

        $data['templateJudul'] = "Halaman " . $this->halaman_label;
        /** header */
        echo view('admin/v_template_header', $data);
        echo view('admin/v_socials', $data);
        echo view('admin/v_template_footer', $data);
        /** footer */
    }
}
