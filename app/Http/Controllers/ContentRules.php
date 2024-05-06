<?php

namespace App\Http\Controllers;

class ContentRules
{
    public static function rules()
    {
        return [
            'Teknologi' => ['teknologi', 'program', 'internet', 'software', 'hardware', 'ai', 'robotik', 'data', 'cloud', 'jaringan'],
            'Olahraga' => ['olahraga', 'bola', 'tenis', 'basket', 'atlet', 'maraton', 'renang', 'fitness', 'gym', 'sepakbola'],
            'Kesehatan' => ['kesehatan', 'medis', 'dokter', 'penyakit', 'obat', 'rumah sakit', 'perawatan', 'farmasi', 'vaksin', 'operasi'],
            'Pendidikan' => ['pendidikan', 'sekolah', 'universitas', 'siswa', 'guru', 'belajar', 'kursus', 'pelajaran', 'akademik', 'tes'],
            'Bisnis' => ['bisnis', 'ekonomi', 'startup', 'perusahaan', 'investasi', 'saham', 'pasar', 'keuangan', 'manajemen', 'marketing'],
            'Seni' => ['seni', 'musik', 'lukis', 'pameran', 'tari', 'teater', 'film', 'fotografi', 'literatur', 'patung'],
            'Lingkungan' => ['lingkungan', 'pemanasan global', 'daur ulang', 'energi terbarukan', 'polusi', 'konservasi', 'flora', 'fauna', 'ekosistem', 'biodiversitas'],
            'Politik' => ['politik', 'pemerintahan', 'demokrasi', 'pemilu', 'kebijakan', 'legislatif', 'eksekutif', 'partai', 'politikus', 'negara'],
            'Agama' => ['agama', 'spiritual', 'ibadah', 'dewa', 'ritual', 'kepercayaan', 'gereja', 'masjid', 'sinagoga', 'kitab suci'],
            'Kuliner' => ['kuliner', 'masakan', 'resep', 'makanan', 'minuman', 'chef', 'restoran', 'kuliner khas', 'bumbu', 'diet'],
            'Wisata' => ['wisata', 'pariwisata', 'liburan', 'destinasi', 'pemandangan', 'resor', 'hotel', 'wisatawan', 'petualangan', 'paket wisata'],
            'Fashion' => ['fashion', 'pakaian', 'mode', 'desainer', 'tren', 'koleksi', 'busana', 'aksesoris', 'gaya', 'model'],
            'Teknologi Keuangan' => ['fintech', 'blockchain', 'cryptocurrency', 'bitcoin', 'bank digital', 'pembayaran', 'investasi digital', 'wallet', 'security', 'transaksi'],
            'Permainan' => ['permainan', 'game', 'gamer', 'konsol', 'mobile game', 'e-sports', 'turnamen', 'gameplay', 'developer game', 'platform game'],
            'Otomotif' => ['otomotif', 'mobil', 'motor', 'mesin', 'balapan', 'mobil listrik', 'bengkel', 'suku cadang', 'modifikasi', 'showroom'],
            'Hukum' => ['hukum', 'pengacara', 'peradilan', 'undang-undang', 'kasus', 'hakim', 'sidang', 'konstitusi', 'hukuman', 'hak asasi manusia'],
            'Kesejahteraan Sosial' => ['kesejahteraan sosial', 'bantuan sosial', 'asuransi sosial', 'program pemerintah', 'subsidi', 'donasi', 'nirlaba', 'volunteer', 'komunitas', 'fasilitas umum'],
            'Teknologi Informasi' => ['TI', 'data besar', 'analisis data', 'keamanan siber', 'cloud computing', 'networking', 'hardware', 'software', 'database', 'internet'],
            'Sejarah' => ['sejarah', 'peradaban', 'revolusi', 'artefak', 'museum', 'peninggalan', 'tokoh sejarah', 'chronology', 'arkeologi', 'paleontologi'],
            'Psikologi' => ['psikologi', 'mental', 'terapi', 'psikolog', 'motivasi', 'cognitive', 'behavior', 'mental health', 'stress', 'emo'],
            'Film dan Televisi' => ['film', 'televisi', 'sinema', 'serial tv', 'aktor', 'sutradara', 'skrip', 'produser', 'shooting', 'box office']
        ];
    }
}
