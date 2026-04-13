<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceStep;
use App\Models\ServiceRequirement;
use App\Models\ServiceLegalBase;
use App\Models\ServiceFaq;
use App\Models\EligibilityCriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama agar seeder bisa dijalankan ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('eligibility_criteria')->truncate();
        DB::table('service_faqs')->truncate();
        DB::table('service_legal_bases')->truncate();
        DB::table('service_requirements')->truncate();
        DB::table('service_steps')->truncate();
        DB::table('services')->truncate();
        DB::table('service_categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ═══════════════════════════════════════
        // 1. Kategori Bidang
        // ═══════════════════════════════════════
        $ppks = ServiceCategory::create([
            'name'        => 'Bidang PPKS',
            'slug'        => 'bidang-ppks',
            'description' => 'Pemberdayaan Potensi Keluarga Sejahtera — Mengelola program perlindungan dan pemberdayaan keluarga miskin.',
            'icon'        => 'heroicon-o-clipboard-document-list',
            'sort_order'  => 1,
            'is_active'   => true,
        ]);

        $ppmks = ServiceCategory::create([
            'name'        => 'Bidang PPMKS',
            'slug'        => 'bidang-ppmks',
            'description' => 'Pelayanan & Penyuluhan Masalah Kesejahteraan Sosial — Mengelola program rehabilitasi, jaminan sosial, dan pemberdayaan usaha.',
            'icon'        => 'heroicon-o-users',
            'sort_order'  => 2,
            'is_active'   => true,
        ]);

        // ═══════════════════════════════════════
        // 2. Layanan Bidang PPKS
        // ═══════════════════════════════════════

        // --- 2a. SLRT GEMPITA SENA ---
        $slrt = Service::create([
            'category_id'       => $ppks->id,
            'name'              => 'SLRT Gempita Sena',
            'slug'              => 'slrt-gempita-sena',
            'short_description' => 'Sistem Layanan Rujukan Terpadu — Gerakan Masyarakat Pintar Ekonomi Sosial Nasional untuk pendataan dan pengusulan bantuan sosial.',
            'description'       => '<p>SLRT <strong>GEMPITA SENA</strong> (Gerakan Masyarakat Pintar Ekonomi Sosial Nasional) adalah mekanisme pengelolaan data dan rujukan layanan sosial terpadu di tingkat kabupaten.</p>
<h3>Edukasi DTSEN</h3>
<p>Data Tunggal Sosial Ekonomi Nasional (DTSEN) merupakan basis data tunggal yang menggantikan DTKS, digunakan sebagai acuan penyaluran seluruh bantuan sosial pemerintah pusat dan daerah.</p>
<h3>10 Variabel Pendataan</h3>
<ol>
<li>Identitas Kepala Keluarga</li>
<li>Keanggotaan Rumah Tangga</li>
<li>Kondisi Tempat Tinggal</li>
<li>Pendidikan</li>
<li>Kesehatan</li>
<li>Ketenagakerjaan</li>
<li>Aset Kepemilikan</li>
<li>Perlindungan & Jaminan Sosial</li>
<li>Sumber Penghasilan</li>
<li>Pengeluaran Rumah Tangga</li>
</ol>',
            'badge_text'        => 'Program Unggulan',
            'badge_color'       => 'yellow',
            'contact_info'      => 'Sekretariat SLRT Dinsos Kab. Semarang, Lt. 2 | Telp: (024) 76912203',
            'is_active'         => true,
            'is_featured'       => true,
            'sort_order'        => 1,
        ]);

        // Steps SLRT
        $slrtSteps = [
            ['step_number' => 1, 'title' => 'Pendataan Masyarakat', 'description' => 'Masyarakat yang belum terdaftar di DTSEN melaporkan diri ke RT/RW atau langsung ke kantor desa/kelurahan.'],
            ['step_number' => 2, 'title' => 'Musdes / Muskel', 'description' => 'Musyawarah Desa/Kelurahan untuk memverifikasi dan menyusun daftar usulan rumah tangga miskin.'],
            ['step_number' => 3, 'title' => 'Input Data SLRT', 'description' => 'Petugas SLRT (Pendamping Sosial) menginput data ke Sistem SLRT berdasarkan hasil musyawarah.'],
            ['step_number' => 4, 'title' => 'Verifikasi & Validasi Dinas', 'description' => 'Dinas Sosial kabupaten memverifikasi kelengkapan dan keakuratan data yang diusulkan.'],
            ['step_number' => 5, 'title' => 'Pengiriman ke Kemensos', 'description' => 'Data yang terverifikasi dikirimkan ke Kementerian Sosial RI untuk diintegrasikan ke DTSEN.'],
            ['step_number' => 6, 'title' => 'Penetapan & Penyaluran', 'description' => 'Setelah terverifikasi oleh pusat, penerima berhak mendapat bantuan sosial sesuai program yang tersedia.'],
        ];
        foreach ($slrtSteps as $step) {
            ServiceStep::create(array_merge($step, ['service_id' => $slrt->id]));
        }

        // Legal bases SLRT
        ServiceLegalBase::create(['service_id' => $slrt->id, 'regulation_number' => 'Kepmen No 79/HUK/2025', 'regulation_title' => 'Pedoman Pengelolaan Data Tunggal Sosial Ekonomi Nasional', 'regulation_type' => 'Kepmen', 'year' => 2025]);
        ServiceLegalBase::create(['service_id' => $slrt->id, 'regulation_number' => 'Permensos No 15 Tahun 2018', 'regulation_title' => 'Sistem Layanan dan Rujukan Terpadu untuk Penanganan Fakir Miskin dan Orang Tidak Mampu', 'regulation_type' => 'Permen', 'year' => 2018]);

        // Requirements SLRT
        ServiceRequirement::create(['service_id' => $slrt->id, 'title' => 'KTP/NIK', 'description' => 'Kartu Tanda Penduduk elektronik atau Nomor Induk Kependudukan.', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $slrt->id, 'title' => 'Kartu Keluarga (KK)', 'description' => 'Kartu Keluarga asli dan fotocopy.', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $slrt->id, 'title' => 'Surat Keterangan RT/RW', 'description' => 'Surat keterangan tidak mampu dari RT/RW setempat.', 'is_mandatory' => true, 'sort_order' => 3]);
        ServiceRequirement::create(['service_id' => $slrt->id, 'title' => 'Foto Kondisi Rumah', 'description' => 'Dokumentasi foto tampak depan dan kondisi dalam rumah (opsional).', 'is_mandatory' => false, 'sort_order' => 4]);

        // FAQs SLRT
        ServiceFaq::create(['service_id' => $slrt->id, 'question' => 'Apa perbedaan DTKS dan DTSEN?', 'answer' => 'DTSEN (Data Tunggal Sosial Ekonomi Nasional) adalah pengganti DTKS yang lebih komprehensif, mencakup 10 variabel pendataan dan digunakan sebagai basis data tunggal untuk seluruh program bantuan sosial nasional.', 'sort_order' => 1]);
        ServiceFaq::create(['service_id' => $slrt->id, 'question' => 'Bagaimana cara mengecek apakah saya terdaftar di DTSEN?', 'answer' => 'Anda dapat mengecek melalui website cekbansos.kemensos.go.id atau langsung datang ke kantor Dinas Sosial Kabupaten Semarang dengan membawa KTP.', 'sort_order' => 2]);
        ServiceFaq::create(['service_id' => $slrt->id, 'question' => 'Apa itu Desil dan berapa desil saya?', 'answer' => 'Desil adalah tingkat kemiskinan berdasarkan pendapatan. Desil 1 = paling miskin, Desil 10 = paling kaya. Desil Anda ditentukan oleh data survei BPS dan bisa dicek di DTSEN.', 'sort_order' => 3]);

        // Eligibility Criteria SLRT
        EligibilityCriteria::create(['service_id' => $slrt->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-5', 'display_label' => 'Desil 1-5 (Keluarga miskin dan rentan miskin)', 'sort_order' => 1]);

        // --- 2b. Bantuan PKH, BPNT & PBI-JK ---
        $pkh = Service::create([
            'category_id'       => $ppks->id,
            'name'              => 'Bantuan PKH, BPNT & PBI-JK',
            'slug'              => 'pkh-bpnt-pbi',
            'short_description' => 'Program perlindungan sosial untuk keluarga miskin melalui bantuan tunai bersyarat dan jaminan kesehatan pemerintah.',
            'description'       => '<p><strong>Program Keluarga Harapan (PKH)</strong> memberikan bantuan tunai bersyarat kepada keluarga miskin yang memiliki komponen kesehatan dan pendidikan.</p>
<p><strong>Bantuan Pangan Non Tunai (BPNT)</strong> memberikan bantuan pangan berupa beras dan telur melalui mekanisme non-tunai.</p>
<p><strong>PBI-JK (Penerima Bantuan Iuran - Jaminan Kesehatan)</strong> memberikan jaminan kesehatan BPJS gratis bagi masyarakat kurang mampu.</p>
<h3>Kriteria Desil</h3>
<ul>
<li><strong>PKH:</strong> Desil 1-4 (sangat miskin hingga rentan miskin)</li>
<li><strong>BPNT & PBI-JK:</strong> Desil 1-5 (termasuk menengah bawah)</li>
</ul>',
            'badge_text'        => null,
            'is_active'         => true,
            'is_featured'       => true,
            'sort_order'        => 2,
        ]);

        ServiceStep::create(['service_id' => $pkh->id, 'step_number' => 1, 'title' => 'Verifikasi Data DTSEN', 'description' => 'Periksa apakah keluarga Anda sudah terdaftar di DTSEN melalui kantor desa atau Dinas Sosial.']);
        ServiceStep::create(['service_id' => $pkh->id, 'step_number' => 2, 'title' => 'Pendampingan Sosial', 'description' => 'Pendamping PKH akan mengunjungi dan memverifikasi kondisi keluarga.']);
        ServiceStep::create(['service_id' => $pkh->id, 'step_number' => 3, 'title' => 'Penetapan Penerima', 'description' => 'Kemensos menetapkan daftar penerima berdasarkan data terverifikasi.']);
        ServiceStep::create(['service_id' => $pkh->id, 'step_number' => 4, 'title' => 'Penyaluran Bantuan', 'description' => 'Bantuan disalurkan melalui rekening bank yang terdaftar setiap triwulan.']);

        ServiceLegalBase::create(['service_id' => $pkh->id, 'regulation_number' => 'Perpres No 63 Tahun 2017', 'regulation_title' => 'Penyaluran Bantuan Sosial Secara Non Tunai', 'regulation_type' => 'Perpres', 'year' => 2017]);
        ServiceLegalBase::create(['service_id' => $pkh->id, 'regulation_number' => 'Permensos No 1 Tahun 2018', 'regulation_title' => 'Program Keluarga Harapan', 'regulation_type' => 'Permen', 'year' => 2018]);

        ServiceRequirement::create(['service_id' => $pkh->id, 'title' => 'Terdaftar di DTSEN/DTKS', 'description' => 'Harus terdaftar sebagai rumah tangga miskin di basis data nasional.', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $pkh->id, 'title' => 'KTP dan KK', 'description' => 'Kartu identitas dan kartu keluarga yang masih berlaku.', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $pkh->id, 'title' => 'Memiliki Komponen PKH', 'description' => 'Ibu hamil/menyusui, anak usia sekolah, lansia 70+, atau penyandang disabilitas berat.', 'is_mandatory' => true, 'sort_order' => 3]);

        ServiceFaq::create(['service_id' => $pkh->id, 'question' => 'Berapa besar bantuan PKH per keluarga?', 'answer' => 'Besaran bantuan bervariasi antara Rp 900.000 - Rp 3.000.000 per tahun tergantung komponen yang dimiliki (ibu hamil, anak SD, SMP, SMA, lansia, disabilitas).', 'sort_order' => 1]);
        ServiceFaq::create(['service_id' => $pkh->id, 'question' => 'Apakah BNPT bisa dicairkan tunai?', 'answer' => 'BPNT disalurkan melalui e-wallet yang hanya bisa digunakan untuk membeli bahan pangan di e-warong atau agen bank yang ditunjuk. Tidak bisa dicairkan tunai.', 'sort_order' => 2]);

        EligibilityCriteria::create(['service_id' => $pkh->id, 'criteria_name' => 'Desil (PKH)', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-4', 'display_label' => 'PKH: Desil 1-4 (Sangat miskin hingga rentan miskin)', 'sort_order' => 1]);
        EligibilityCriteria::create(['service_id' => $pkh->id, 'criteria_name' => 'Desil (BPNT & PBI-JK)', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-5', 'display_label' => 'BPNT & PBI-JK: Desil 1-5 (Termasuk menengah bawah)', 'sort_order' => 2]);

        // --- 2c. Rekomendasi PIP/KIP ---
        $pip = Service::create([
            'category_id'       => $ppks->id,
            'name'              => 'Rekomendasi PIP/KIP',
            'slug'              => 'pip-kip',
            'short_description' => 'Surat rekomendasi untuk Program Indonesia Pintar dan Kartu Indonesia Pintar bagi siswa dari keluarga kurang mampu.',
            'description'       => '<p><strong>Program Indonesia Pintar (PIP)</strong> memberikan bantuan tunai pendidikan kepada anak usia sekolah dari keluarga miskin/rentan. Dinas Sosial menerbitkan surat rekomendasi sebagai syarat pengajuan.</p>
<p><strong>Kartu Indonesia Pintar (KIP)</strong> adalah identitas penerima PIP yang diterbitkan oleh Kemendikbud.</p>',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 3,
        ]);

        ServiceStep::create(['service_id' => $pip->id, 'step_number' => 1, 'title' => 'Orang Tua Mengajukan ke Dinsos', 'description' => 'Datang ke kantor Dinas Sosial membawa persyaratan lengkap.']);
        ServiceStep::create(['service_id' => $pip->id, 'step_number' => 2, 'title' => 'Verifikasi Data Keluarga', 'description' => 'Petugas memverifikasi status keluarga di DTSEN.']);
        ServiceStep::create(['service_id' => $pip->id, 'step_number' => 3, 'title' => 'Penerbitan Surat Rekomendasi', 'description' => 'Jika memenuhi syarat, surat rekomendasi diterbitkan dalam 3 hari kerja.']);
        ServiceStep::create(['service_id' => $pip->id, 'step_number' => 4, 'title' => 'Penyerahan ke Sekolah', 'description' => 'Surat rekomendasi diserahkan ke pihak sekolah untuk diproses menjadi KIP.']);

        ServiceRequirement::create(['service_id' => $pip->id, 'title' => 'KTP Orang Tua', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $pip->id, 'title' => 'Kartu Keluarga', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $pip->id, 'title' => 'Surat Keterangan Tidak Mampu dari RT/RW', 'is_mandatory' => true, 'sort_order' => 3]);
        ServiceRequirement::create(['service_id' => $pip->id, 'title' => 'Fotocopy Rapor / Surat Keterangan Siswa Aktif', 'is_mandatory' => true, 'sort_order' => 4]);

        EligibilityCriteria::create(['service_id' => $pip->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-4', 'display_label' => 'Desil 1-4 (Keluarga miskin)', 'sort_order' => 1]);

        // --- 2d. Rekomendasi KKS ---
        $kks = Service::create([
            'category_id'       => $ppks->id,
            'name'              => 'Rekomendasi KKS',
            'slug'              => 'kks',
            'short_description' => 'Surat rekomendasi Kartu Keluarga Sejahtera untuk mengakses berbagai program bantuan sosial pemerintah.',
            'description'       => '<p><strong>Kartu Keluarga Sejahtera (KKS)</strong> adalah kartu identitas bagi keluarga kurang mampu yang terdaftar di DTSEN. KKS digunakan untuk mengakses program bantuan sosial seperti BPNT, BSU, dan program lainnya.</p>',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 4,
        ]);

        ServiceStep::create(['service_id' => $kks->id, 'step_number' => 1, 'title' => 'Pengajuan di Dinas Sosial', 'description' => 'Datang langsung ke loket pelayanan Dinas Sosial.']);
        ServiceStep::create(['service_id' => $kks->id, 'step_number' => 2, 'title' => 'Verifikasi DTSEN', 'description' => 'Petugas mengecek status keluarga dalam basis data.']);
        ServiceStep::create(['service_id' => $kks->id, 'step_number' => 3, 'title' => 'Penerbitan Rekomendasi', 'description' => 'Surat rekomendasi diterbitkan jika data valid.']);

        ServiceRequirement::create(['service_id' => $kks->id, 'title' => 'KTP & KK', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $kks->id, 'title' => 'SKTM dari kelurahan', 'is_mandatory' => true, 'sort_order' => 2]);

        EligibilityCriteria::create(['service_id' => $kks->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-5', 'display_label' => 'Desil 1-5 (Keluarga kurang mampu)', 'sort_order' => 1]);

        // ═══════════════════════════════════════
        // 3. Layanan Bidang PPMKS
        // ═══════════════════════════════════════

        // --- 3a. KUBE ---
        $kube = Service::create([
            'category_id'       => $ppmks->id,
            'name'              => 'KUBE (Kelompok Usaha Bersama)',
            'slug'              => 'kube',
            'short_description' => 'Program pemberdayaan ekonomi masyarakat miskin melalui kelompok usaha bersama dengan bantuan modal dan pendampingan.',
            'description'       => '<p><strong>Kelompok Usaha Bersama (KUBE)</strong> adalah program pemberdayaan ekonomi yang memfasilitasi warga miskin untuk membentuk kelompok usaha produktif. Di Dinas Sosial Kabupaten Semarang, KUBE termasuk dalam Bidang PPMKS.</p>
<p>Setiap kelompok terdiri dari 5-10 orang dan mendapatkan bantuan modal usaha serta pendampingan usaha.</p>',
            'badge_text'        => 'Pemberdayaan Ekonomi',
            'badge_color'       => 'green',
            'is_active'         => true,
            'is_featured'       => true,
            'sort_order'        => 1,
        ]);

        ServiceStep::create(['service_id' => $kube->id, 'step_number' => 1, 'title' => 'Pembentukan Kelompok', 'description' => 'Membentuk kelompok usaha 5-10 orang dari warga yang terdaftar di DTSEN.']);
        ServiceStep::create(['service_id' => $kube->id, 'step_number' => 2, 'title' => 'Pengajuan Proposal', 'description' => 'Mengajukan proposal usaha ke Dinas Sosial melalui TKSK kecamatan.']);
        ServiceStep::create(['service_id' => $kube->id, 'step_number' => 3, 'title' => 'Verifikasi & Seleksi', 'description' => 'Tim Dinsos melakukan verifikasi kelayakan proposal dan kelompok.']);
        ServiceStep::create(['service_id' => $kube->id, 'step_number' => 4, 'title' => 'Penyaluran Bantuan Modal', 'description' => 'Bantuan modal disalurkan sesuai dengan jenis usaha yang diajukan.']);
        ServiceStep::create(['service_id' => $kube->id, 'step_number' => 5, 'title' => 'Pendampingan & Monitoring', 'description' => 'Pendamping KUBE melakukan monitoring rutin dan konsultasi usaha.']);

        ServiceLegalBase::create(['service_id' => $kube->id, 'regulation_number' => 'Permensos No 2 Tahun 2019', 'regulation_title' => 'Bantuan Stimulan Usaha Ekonomi Produktif', 'regulation_type' => 'Permen', 'year' => 2019]);

        ServiceRequirement::create(['service_id' => $kube->id, 'title' => 'Terdaftar di DTSEN', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $kube->id, 'title' => 'Membentuk kelompok 5-10 orang', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $kube->id, 'title' => 'Proposal usaha', 'is_mandatory' => true, 'sort_order' => 3]);
        ServiceRequirement::create(['service_id' => $kube->id, 'title' => 'KTP & KK seluruh anggota', 'is_mandatory' => true, 'sort_order' => 4]);

        ServiceFaq::create(['service_id' => $kube->id, 'question' => 'Berapa besar bantuan modal KUBE?', 'answer' => 'Bantuan modal KUBE bervariasi antara Rp 15.000.000 - Rp 20.000.000 per kelompok tergantung jenis usaha dan jumlah anggota.', 'sort_order' => 1]);
        ServiceFaq::create(['service_id' => $kube->id, 'question' => 'Apakah bantuan KUBE harus dikembalikan?', 'answer' => 'Bantuan KUBE bersifat stimulan (tidak harus dikembalikan), namun kelompok diharapkan melakukan iuran keswadayaan untuk keberlanjutan usaha.', 'sort_order' => 2]);

        EligibilityCriteria::create(['service_id' => $kube->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-4', 'display_label' => 'Desil 1-4 (Keluarga miskin)', 'sort_order' => 1]);
        EligibilityCriteria::create(['service_id' => $kube->id, 'criteria_name' => 'Usia Produktif', 'criteria_type' => 'age', 'operator' => '>=', 'value' => '18', 'display_label' => 'Usia minimal 18 tahun (usia produktif)', 'sort_order' => 2]);

        // --- 3b. BLT Cukai (DBHCHT) ---
        $blt = Service::create([
            'category_id'       => $ppmks->id,
            'name'              => 'BLT Cukai (DBHCHT)',
            'slug'              => 'blt-cukai-dbhcht',
            'short_description' => 'Bantuan Langsung Tunai Dana Bagi Hasil Cukai Hasil Tembakau untuk buruh tani dan pekerja industri rokok terdampak.',
            'description'       => '<p><strong>BLT DBHCHT</strong> (Dana Bagi Hasil Cukai Hasil Tembakau) adalah bantuan langsung tunai yang diberikan kepada buruh tani tembakau, buruh pabrik rokok, dan pekerja yang terdampak kebijakan cukai.</p>
<p>Program ini dibiayai dari dana bagi hasil cukai hasil tembakau yang diterima oleh pemerintah daerah.</p>',
            'badge_text'        => 'Bantuan Terbaru',
            'badge_color'       => 'blue',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 2,
        ]);

        ServiceStep::create(['service_id' => $blt->id, 'step_number' => 1, 'title' => 'Pendataan oleh Desa/Kelurahan', 'description' => 'Desa/kelurahan mendata warga yang bekerja sebagai buruh tani tembakau atau buruh pabrik rokok.']);
        ServiceStep::create(['service_id' => $blt->id, 'step_number' => 2, 'title' => 'Verifikasi oleh Dinsos', 'description' => 'Dinas Sosial memverifikasi data penerima yang diusulkan.']);
        ServiceStep::create(['service_id' => $blt->id, 'step_number' => 3, 'title' => 'Penetapan SK Penerima', 'description' => 'Bupati menetapkan SK daftar penerima BLT DBHCHT.']);
        ServiceStep::create(['service_id' => $blt->id, 'step_number' => 4, 'title' => 'Penyaluran via Bank', 'description' => 'Bantuan disalurkan melalui rekening bank yang ditunjuk.']);

        ServiceLegalBase::create(['service_id' => $blt->id, 'regulation_number' => 'PMK No 215/PMK.07/2021', 'regulation_title' => 'Penggunaan, Pemantauan, dan Evaluasi Dana Bagi Hasil Cukai Hasil Tembakau', 'regulation_type' => 'Permen', 'year' => 2021]);

        ServiceRequirement::create(['service_id' => $blt->id, 'title' => 'KTP & KK', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $blt->id, 'title' => 'Surat Keterangan Kerja', 'description' => 'Surat keterangan bekerja sebagai buruh tani/pabrik rokok dari desa atau perusahaan.', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $blt->id, 'title' => 'Buku Rekening Bank', 'is_mandatory' => true, 'sort_order' => 3]);

        EligibilityCriteria::create(['service_id' => $blt->id, 'criteria_name' => 'Status Pekerjaan', 'criteria_type' => 'status', 'operator' => '==', 'value' => 'petani,buruh_pabrik', 'display_label' => 'Buruh tani tembakau atau buruh pabrik rokok', 'sort_order' => 1]);
        EligibilityCriteria::create(['service_id' => $blt->id, 'criteria_name' => 'Penghasilan Maksimal', 'criteria_type' => 'income', 'operator' => '<=', 'value' => '5000000', 'display_label' => 'Penghasilan ≤ Rp 5.000.000/bulan', 'sort_order' => 2]);

        // --- 3c. Rehabilitasi Sosial ---
        $rehab = Service::create([
            'category_id'       => $ppmks->id,
            'name'              => 'Rehabilitasi Sosial',
            'slug'              => 'rehabilitasi-sosial',
            'short_description' => 'Pelayanan pemulihan keberfungsian sosial bagi penyandang disabilitas, lansia terlantar, dan Pemerlu Pelayanan Kesejahteraan Sosial.',
            'description'       => '<p><strong>Rehabilitasi Sosial</strong> adalah proses pemulihan dan pengembangan kemampuan seseorang agar mampu melaksanakan fungsi sosialnya secara wajar dalam kehidupan masyarakat.</p>
<p>Sasaran meliputi penyandang disabilitas, lansia terlantar, anak terlantar, dan kelompok rentan lainnya.</p>',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 3,
        ]);

        ServiceStep::create(['service_id' => $rehab->id, 'step_number' => 1, 'title' => 'Laporan/Rujukan', 'description' => 'Keluarga atau masyarakat melapor ke Dinas Sosial atau mendapat rujukan dari instansi terkait.']);
        ServiceStep::create(['service_id' => $rehab->id, 'step_number' => 2, 'title' => 'Asesmen', 'description' => 'Pekerja sosial melakukan asesmen kebutuhan klien.']);
        ServiceStep::create(['service_id' => $rehab->id, 'step_number' => 3, 'title' => 'Rencana Intervensi', 'description' => 'Menyusun rencana rehabilitasi sesuai kebutuhan.']);
        ServiceStep::create(['service_id' => $rehab->id, 'step_number' => 4, 'title' => 'Pelayanan Rehabilitasi', 'description' => 'Bisa berupa pelayanan di panti, day care, atau home care.']);
        ServiceStep::create(['service_id' => $rehab->id, 'step_number' => 5, 'title' => 'Reintegrasi Sosial', 'description' => 'Pengembalian klien ke keluarga atau masyarakat.']);

        ServiceRequirement::create(['service_id' => $rehab->id, 'title' => 'KTP/NIK', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $rehab->id, 'title' => 'Surat Rujukan/Laporan', 'description' => 'Surat rujukan dari puskesmas/RS atau laporan dari masyarakat.', 'is_mandatory' => false, 'sort_order' => 2]);

        EligibilityCriteria::create(['service_id' => $rehab->id, 'criteria_name' => 'Usia Lansia', 'criteria_type' => 'age', 'operator' => '>=', 'value' => '60', 'display_label' => 'Usia 60+ tahun (untuk layanan lansia)', 'sort_order' => 1]);

        // --- 3d. Keringanan Pajak ---
        $pajak = Service::create([
            'category_id'       => $ppmks->id,
            'name'              => 'Keringanan Pajak',
            'slug'              => 'pajak',
            'short_description' => 'Surat rekomendasi keringanan pajak bumi dan bangunan untuk masyarakat kurang mampu.',
            'description'       => '<p>Dinas Sosial menerbitkan surat rekomendasi bagi masyarakat kurang mampu untuk mengajukan <strong>keringanan atau pengurangan Pajak Bumi dan Bangunan (PBB)</strong> ke Badan Pendapatan Daerah.</p>',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 4,
        ]);

        ServiceStep::create(['service_id' => $pajak->id, 'step_number' => 1, 'title' => 'Pengajuan ke Dinsos', 'description' => 'Datang ke kantor Dinas Sosial dengan persyaratan lengkap.']);
        ServiceStep::create(['service_id' => $pajak->id, 'step_number' => 2, 'title' => 'Verifikasi Data', 'description' => 'Petugas memverifikasi status ekonomi pemohon.']);
        ServiceStep::create(['service_id' => $pajak->id, 'step_number' => 3, 'title' => 'Terbit Surat Rekomendasi', 'description' => 'Surat rekomendasi keringanan pajak diterbitkan.']);
        ServiceStep::create(['service_id' => $pajak->id, 'step_number' => 4, 'title' => 'Serahkan ke Bapenda', 'description' => 'Surat diserahkan ke Badan Pendapatan Daerah untuk proses keringanan.']);

        ServiceRequirement::create(['service_id' => $pajak->id, 'title' => 'KTP & KK', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $pajak->id, 'title' => 'SPPT PBB', 'description' => 'Surat Pemberitahuan Pajak Terutang tahun berjalan.', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $pajak->id, 'title' => 'SKTM dari kelurahan', 'is_mandatory' => true, 'sort_order' => 3]);

        EligibilityCriteria::create(['service_id' => $pajak->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-4', 'display_label' => 'Desil 1-4 (Keluarga miskin dan rentan)', 'sort_order' => 1]);

        // --- 3e. Jaminan Sosial ---
        $jamsos = Service::create([
            'category_id'       => $ppmks->id,
            'name'              => 'Jaminan Sosial',
            'slug'              => 'jaminan-sosial',
            'short_description' => 'Penyaluran asuransi kesejahteraan bagi warga rentan dan perlindungan risiko ekonomi seperti santunan kematian.',
            'description'       => '<p><strong>Jaminan Sosial</strong> melalui Dinas Sosial mencakup program perlindungan bagi warga rentan terhadap risiko ekonomi, termasuk santunan kematian, bantuan bencana, dan program jaminan lainnya.</p>',
            'is_active'         => true,
            'is_featured'       => false,
            'sort_order'        => 5,
        ]);

        ServiceStep::create(['service_id' => $jamsos->id, 'step_number' => 1, 'title' => 'Pelaporan Kejadian', 'description' => 'Keluarga melapor kejadian (kematian, bencana) ke desa/kelurahan.']);
        ServiceStep::create(['service_id' => $jamsos->id, 'step_number' => 2, 'title' => 'Rekomendasi Desa', 'description' => 'Desa menerbitkan surat rekomendasi untuk pengajuan ke Dinsos.']);
        ServiceStep::create(['service_id' => $jamsos->id, 'step_number' => 3, 'title' => 'Pengajuan ke Dinsos', 'description' => 'Berkas pengajuan disampaikan ke Dinas Sosial.']);
        ServiceStep::create(['service_id' => $jamsos->id, 'step_number' => 4, 'title' => 'Penyaluran Santunan', 'description' => 'Santunan disalurkan setelah verifikasi selesai.']);

        ServiceRequirement::create(['service_id' => $jamsos->id, 'title' => 'KTP & KK almarhum/pemohon', 'is_mandatory' => true, 'sort_order' => 1]);
        ServiceRequirement::create(['service_id' => $jamsos->id, 'title' => 'Surat Kematian', 'description' => 'Dari RS/Puskesmas dan/atau desa.', 'is_mandatory' => true, 'sort_order' => 2]);
        ServiceRequirement::create(['service_id' => $jamsos->id, 'title' => 'SKTM dari kelurahan', 'is_mandatory' => true, 'sort_order' => 3]);

        EligibilityCriteria::create(['service_id' => $jamsos->id, 'criteria_name' => 'Desil Kemiskinan', 'criteria_type' => 'desil', 'operator' => 'between', 'value' => '1-5', 'display_label' => 'Desil 1-5 (Keluarga miskin dan menengah bawah)', 'sort_order' => 1]);

        $this->command->info('✅ Berhasil seed 2 kategori dan 8 layanan lengkap!');
    }
}
