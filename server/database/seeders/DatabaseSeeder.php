<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;
use App\Models\SolusiKerusakan;
use App\Models\Konsultasi;
use App\Models\GejalaKonsultasi;
use App\Models\Pelanggan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Gejala::create(['kode' => 'G01', 'nama' => 'Lampu power mati']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Alarm tidak hidup']);
        Gejala::create(['kode' => 'G03', 'nama' => 'Kipas CPU kadang berputar/kadang tidak']);
        Gejala::create(['kode' => 'G04', 'nama' => 'Tidak ada tampilan pada monitor/no signal']);
        Gejala::create(['kode' => 'G05', 'nama' => 'RAM sudah lemah/rusak']);
        Gejala::create(['kode' => 'G06', 'nama' => 'Sistem pembacaan motherboard pada RAM yang dipasang']);
        Gejala::create(['kode' => 'G07', 'nama' => 'Processor sudah lemah']);
        Gejala::create(['kode' => 'G08', 'nama' => 'Bad sector pada harddisk']);
        Gejala::create(['kode' => 'G09', 'nama' => 'Ada komponen elektronik yang rusak pada motherboard']);
        Gejala::create(['kode' => 'G10', 'nama' => 'Power supply tidak stabil']);
        Gejala::create(['kode' => 'G11', 'nama' => 'VGA sudah lemah']);
        Gejala::create(['kode' => 'G12', 'nama' => 'Sistem Operasi yang rusak']);
        Gejala::create(['kode' => 'G13', 'nama' => 'Overload dalam pengoperasian komputer']);
        Gejala::create(['kode' => 'G14', 'nama' => 'Chipset motherboard atau VGA terlalu panas(over)']);
        Gejala::create(['kode' => 'G15', 'nama' => 'Fan heatsink processor mati']);
        Gejala::create(['kode' => 'G16', 'nama' => 'Pengunci heatsink yang lepas atau patah']);
        Gejala::create(['kode' => 'G17', 'nama' => 'Voltase listrik yang tidak stabil(naik turun)']);
        Gejala::create(['kode' => 'G18', 'nama' => 'Harddisk yang rusak']);
        Gejala::create(['kode' => 'G19', 'nama' => 'Konektor USB rusak']);
        Gejala::create(['kode' => 'G20', 'nama' => 'Kabel yang rusak atau putus']);
        Gejala::create(['kode' => 'G21', 'nama' => 'Belum menyeting BIOS untuk keyboard USB']);
        Gejala::create(['kode' => 'G22', 'nama' => 'Pergerakan mouse patah-patah']);
        Gejala::create(['kode' => 'G23', 'nama' => 'Pergerakan mouse lambat']);
        Gejala::create(['kode' => 'G24', 'nama' => 'Mouse kadang bergerak kadang tidak']);
        Gejala::create(['kode' => 'G25', 'nama' => 'Mouse tidak bergerak sama sekali']);
        Gejala::create(['kode' => 'G26', 'nama' => 'Kesalahan memasang jumper sound pada saat merakit']);
        Gejala::create(['kode' => 'G27', 'nama' => 'Kesalahaan penginstallan driver sound']);
        Gejala::create(['kode' => 'G28', 'nama' => 'Sound card rusak']);
        Gejala::create(['kode' => 'G29', 'nama' => 'Bunyi beep dua kali']);
        Gejala::create(['kode' => 'G30', 'nama' => 'Bunyi satu beep panjang']);

        Kerusakan::create(['kode' => 'K01', 'nama' => 'Komputer Mati']);
        Kerusakan::create(['kode' => 'K02', 'nama' => 'Komputer Bunyi Alarm dan Tidak Tampil']);
        Kerusakan::create(['kode' => 'K03', 'nama' => 'Komputer Blue Screen']);
        Kerusakan::create(['kode' => 'K04', 'nama' => 'Komputer Hang']);
        Kerusakan::create(['kode' => 'K05', 'nama' => 'Komputer Mati Sendiri']);
        Kerusakan::create(['kode' => 'K06', 'nama' => 'Komputer Restart Sendiri']);
        Kerusakan::create(['kode' => 'K07', 'nama' => 'Keyboard Error']);
        Kerusakan::create(['kode' => 'K08', 'nama' => 'Mouse Error']);
        Kerusakan::create(['kode' => 'K09', 'nama' => 'Sound/Audio Tidak Bunyi']);

        SolusiKerusakan::create([
            'deskripsi' => 'Ganti kabel power dengan kabel power yang normal',
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil, cek kabel panel yang dipasang pada motherboard',
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil, ganti power supply yang bagus',
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil juga, langkah terakhir adalah dengan mengganti Motherboard dengan yang baru yang sesuai dengan prosessor',
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Lepaskan VGA Card / PCI Card dari motherboard',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Lepaskan RAM dan pastikan slot RAM bersih dari debu atau kotoran',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Bersihkan pin RAM menggunakan penghapus pensil atau tisu, usahakan pin tidak tersentuh oleh tangan karena dapat menyebabkan korosi atau karat',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Setelah RAM dan slotnya dibersihkan, pasang kembali RAM pada slotnya',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil, matikan komputer terlebih dahulu pindahkan RAM keslot RAM yang lain',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tetap tidak berhasil, maka ganti RAM dengan yang baru',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil, gantilah motherboard dengan yang baru sesuai dengan prosessor',
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Install ulang sistem operasi',
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Ganti RAM',
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Ganti Harddisk',
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Bersihkan bagian prosessor dari debu',
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Pastikan kipas berputar dengan 2200 Rpm keatas',
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Tambahkan thermal pasta pada bagian atas prosessor',
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Install ulang sistem operasi',
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Ganti harddisk',
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek power supply apakah berfungsi dengan baik atau tidak',
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak, ganti power supply dengan power supply yang bagus',
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Jika tidak berhasil, maka ganti motherboard dengan yang baru sesuai prosessor',
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Voltase listrik tidak stabil (gunakan stabilizer untuk menstabilkan daya listrik)',
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'RAM rusak (lepaskan RAM dari slotnya, kemudian berihkan RAM dengan penghapus pensil atau tisu, usahakan tangan tidak menyentuh bagian dari pin RAM karena akan menyebabkan korosi atau karat, lalu bersihkan slot RAM dengan kuas atau penyedot debu mini',
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Harddisk rusak (matikan komputer terlebih dahulu, ganti kabel power harddisk dan hidupkan kembali komputer, jika tidak berhasil, ganti kabel data IDE/SATA hardisk dan hidupkan kembali komputer, jika tidak berhasil juga, maka gantilah harddisk dengan yang baru)',
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Sistem operasi rusak (lalukan proses repair system atau lakukan instalasi ulang sistem operasi)',
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek RAM',
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek power supply',
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek driver apakah sudah terinstall atau belum',
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek RAM',
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek power supply',
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Cek driver apakah sudah terinstall atau belum',
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Install driver sound/audio',
            'kerusakan_id' => Kerusakan::where('kode', 'K09')->first()->id,
        ]);
        SolusiKerusakan::create([
            'deskripsi' => 'Pasang USB Sound',
            'kerusakan_id' => Kerusakan::where('kode', 'K09')->first()->id,
        ]);

        Rule::create([
            'kode' => 'R01',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G01')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R02',
            'mb' => 0.8,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G02')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R03',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G03')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R04',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G04')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R05',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K01')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R06',
            'mb' => 0.6,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G29')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R07',
            'mb' => 0.6,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G30')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R08',
            'mb' => 0.8,
            'md' => 0.02,
            'kerusakan_id' => Kerusakan::where('kode', 'K02')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G04')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R09',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G05')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R10',
            'mb' => 0.5,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G06')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R11',
            'mb' => 0.4,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G07')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R12',
            'mb' => 0.5,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G08')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R13',
            'mb' => 0.6,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G09')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R14',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R15',
            'mb' => 0.7,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G11')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R16',
            'mb' => 0.8,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K03')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G12')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R17',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G13')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R18',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G12')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R19',
            'mb' => 0.5,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G05')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R20',
            'mb' => 0.5,
            'md' => 0.08,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G06')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R21',
            'mb' => 0.8,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G08')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R22',
            'mb' => 0.8,
            'md' => 0.02,
            'kerusakan_id' => Kerusakan::where('kode', 'K04')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G14')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R23',
            'mb' => 0.7,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R24',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G15')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R25',
            'mb' => 0.5,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K05')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G16')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R26',
            'mb' => 0.4,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G17')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R27',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R28',
            'mb' => 0.4,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G05')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R29',
            'mb' => 0.5,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G18')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R30',
            'mb' => 0.6,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K06')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G12')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R31',
            'mb' => 0.5,
            'md' => 0.05,
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G19')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R32',
            'mb' => 0.4,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G20')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R33',
            'mb' => 0.8,
            'md' => 0.02,
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R34',
            'mb' => 0.5,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K07')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G21')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R35',
            'mb' => 0.6,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G22')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R36',
            'mb' => 0.8,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R37',
            'mb' => 0.5,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G23')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R38',
            'mb' => 0.7,
            'md' => 0.3,
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G24')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R39',
            'mb' => 0.8,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K08')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G25')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R40',
            'mb' => 0.7,
            'md' => 0.3,
            'kerusakan_id' => Kerusakan::where('kode', 'K09')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G26')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R41',
            'mb' => 0.9,
            'md' => 0.1,
            'kerusakan_id' => Kerusakan::where('kode', 'K09')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G27')->first()->id,
        ]);
        Rule::create([
            'kode' => 'R42',
            'mb' => 0.8,
            'md' => 0.2,
            'kerusakan_id' => Kerusakan::where('kode', 'K09')->first()->id,
            'gejala_id' => Gejala::where('kode', 'G28')->first()->id,
        ]);

        Pelanggan::create([
            'nama' => fake()->name(),
            'nohp' => fake()->numerify('08##########'),
            'alamat' => fake()->text(),
        ]);

        Konsultasi::create([
            'pelanggan_id' => Pelanggan::first()->id,
            'deskripsi' => fake()->text(),
            'kerusakan_id' => Kerusakan::first()->id,
            'cf' => 0.83,
        ]);

        GejalaKonsultasi::create([
            'konsultasi_id' => Konsultasi::first()->id,
            'gejala_id' => Gejala::where('kode', 'G01')->first()->id,
        ]);
        GejalaKonsultasi::create([
            'konsultasi_id' => Konsultasi::first()->id,
            'gejala_id' => Gejala::where('kode', 'G02')->first()->id,
        ]);
        GejalaKonsultasi::create([
            'konsultasi_id' => Konsultasi::first()->id,
            'gejala_id' => Gejala::where('kode', 'G03')->first()->id,
        ]);
        GejalaKonsultasi::create([
            'konsultasi_id' => Konsultasi::first()->id,
            'gejala_id' => Gejala::where('kode', 'G04')->first()->id,
        ]);
        GejalaKonsultasi::create([
            'konsultasi_id' => Konsultasi::first()->id,
            'gejala_id' => Gejala::where('kode', 'G10')->first()->id,
        ]);
    }
}
