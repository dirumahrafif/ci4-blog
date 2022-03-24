<?php
function kirim_email($attachment, $to, $title, $message)
{
    $email = \Config\Services::email();
    $email_pengirim = EMAIL_ALAMAT;
    $email_nama = EMAIL_NAMA;

    $config['protocol'] = "smtp";
    $config['SMTPHost'] = "smtp.gmail.com";
    $config['SMTPUser'] = $email_pengirim;
    $config['SMTPPass'] = EMAIL_PASSWORD;
    $config['SMTPPort'] = 465;
    $config['SMTPCrypto'] = "ssl";
    $config['mailType'] = "html";

    $email->initialize($config);
    $email->setFrom($email_pengirim, $email_nama);
    $email->setTo($to);

    if ($attachment) {
        $email->attach($attachment);
    }

    $email->setSubject($title);
    $email->setMessage($message);

    if (!$email->send()) {
        $data = $email->printDebugger(['headers']);
        print_r($data);
        return false;
    } else {
        return true;
    }
}

function nomor($currentPage, $jumlahBaris)
{
    if (is_null($currentPage)) {
        $nomor = 1;
    } else {
        $nomor = 1 + ($jumlahBaris * ($currentPage - 1));
    }
    return $nomor;
}

function tanggal_indonesia($parameter)
{
    //2022-03-11 07:27:32
    //tahun-bulan-hari waktu
    $split1 = explode(" ", $parameter);
    $parameter1 = $split1[0]; //2022-03-11

    $bulan = [
        '1' => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'
    ];
    $hari = [
        '1' => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'
    ];

    $num = date('N', strtotime($parameter1)); //jumat => 5

    $split2 = explode("-", $parameter1); //2022, 03, 11
    return $hari[$num] . ", " . $split2[2] . " " . $bulan[(int)$split2[1]] . " " . $split2[0];
}

function purify($dirty_html)
{
    $config = HTMLPurifier_Config::createDefault();
    $config->set('URI.AllowedSchemes', array('data' => true));
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirty_html);
    return $clean_html;
}

/**
 * parameter $konfigurasi_name = bisa diisikan semisal set_halaman_depan, set_halaman_kontak
 */
function konfigurasi_get($konfigurasi_name)
{
    $model = new \App\Models\KonfigurasiModel;
    $filter = [
        'konfigurasi_name' => $konfigurasi_name
    ];
    $data = $model->getData($filter);
    return $data;
}

function konfigurasi_set($konfigurasi_name, $data_baru)
{
    $model = new \App\Models\KonfigurasiModel;
    $dataGet = konfigurasi_get($konfigurasi_name);
    $dataUpdate = [
        'id' => $dataGet['id'],
        'konfigurasi_name' => $konfigurasi_name,
        'konfigurasi_value' => $data_baru['konfigurasi_value']
    ];
    $model->updateData($dataUpdate);
}

function post_penulis($username)
{
    $model = new \App\Models\AdminModel;
    $data = $model->getData($username);
    return $data['nama_lengkap'];
}

function set_post_link($post_id)
{
    $model = new \App\Models\PostsModel;
    $data = $model->getPost($post_id);
    $type = $data['post_type']; #article / page
    $seo = $data['post_title_seo'];
    return site_url($type . "/" . $seo);
}
