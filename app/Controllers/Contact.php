<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Contact extends BaseController
{
    function __construct()
    {
        $this->m_posts = new PostsModel();
        helper("global_fungsi_helper");
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar(); #mengembalikan data ke view

            $aturan = [
                'kontak_nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],
                'kontak_email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email yang kamu masukkan tidak valid'
                    ]
                ],
                'kontak_telp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor telphon harus diisi'
                    ]
                ],
                'kontak_pesan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Isi pesan harus diisi'
                    ]
                ],
            ];
            if (!$this->validate($aturan)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $attachment = '';
                $to = EMAIL_ALAMAT;
                $title = "[DARI HALAMAN KONTAK]";
                $message = "Berikut ini ada email baru yang masuk dengan detail sebagai berikut:<br/><br/>";
                $message .= "<b>Nama:</b><br/>";
                $message .= $data['kontak_nama'] . "<br/>";
                $message .= "<b>Email:</b><br/>";
                $message .= $data['kontak_email'] . "<br/>";
                $message .= "<b>Telphone:</b><br/>";
                $message .= $data['kontak_telp'] . "<br/>";
                $message .= "<b>Pesan:</b><br/>";
                $message .= $data['kontak_pesan'] . "<br/>";
                $message .= "----------------------------<br/>";
                $message .= "Silakan segera reply untuk pesan ini ke alamat pengirim";
                kirim_email($attachment, $to, $title, $message);
                session()->setFlashdata('success', "Pesan sudah kami terima, silakan tunggu balasan dari kami.");
                return redirect()->to('contact');
            }
        }

        /** dapatkan page_id dari konfigurasi untuk halaman depan */
        $konfigurasi_name = "set_halaman_kontak";
        $konfigurasi = konfigurasi_get($konfigurasi_name);
        $page_id = $konfigurasi['konfigurasi_value'];

        /** dapatkan data dari modelPosts untuk id page_id */
        $dataHalaman = $this->m_posts->getPost($page_id);
        $data['type'] = $dataHalaman['post_type'];
        $data['judul'] = $dataHalaman['post_title'];
        $data['deskripsi'] = $dataHalaman['post_description'];
        $data['thumbnail'] = $dataHalaman['post_thumbnail'];
        $data['konten'] = $dataHalaman['post_content'];

        echo view("depan/v_template_header", $data);
        echo view("depan/v_contact", $data);
        echo view("depan/v_template_footer", $data);
    }
}
