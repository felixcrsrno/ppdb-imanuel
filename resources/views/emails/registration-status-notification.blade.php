<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Status Pendaftaran PPDB</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #334155;
            background-color: #f8fafc;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 30px;
        }
        .info-box {
            background-color: #f1f5f9;
            border-left: 4px solid #0f172a;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #1e293b;
            min-width: 180px;
        }
        .info-value {
            color: #334155;
            text-align: right;
            flex: 1;
            margin-left: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 10px;
        }
        .status-pending {
            background-color: #fef08a;
            color: #713f12;
        }
        .status-verified {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #7f1d1d;
        }
        .status-passed {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-failed {
            background-color: #fee2e2;
            color: #7f1d1d;
        }
        .footer-message {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.8;
        }
        .footer {
            background-color: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
        .footer a {
            color: #0f172a;
            text-decoration: none;
        }
        .action-button {
            display: inline-block;
            background-color: #1e293b;
            color: #ffffff;
            padding: 12px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>PPDB Imanuel</h1>
            <p>Pemberitahuan Status Pendaftaran</p>
        </div>

        <div class="content">
            <div class="greeting">
                Yth. {{ $registration->user->name }},
            </div>

            <p>
                Kami dengan senang hati memberitahukan bahwa ada pembaruan status pendaftaran Anda. 
                Silakan lihat detail pendaftaran Anda di bawah ini:
            </p>

            <div class="info-box">
                <div class="info-row">
                    <span class="info-label">Nomor Pendaftaran</span>
                    <span class="info-value">{{ $registration->registration_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $registration->studentProfile->full_name ?? $registration->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Program</span>
                    <span class="info-value">
                        @switch($registration->unit)
                            @case('TK')
                                Taman Kanak-Kanak
                                @break
                            @case('SD')
                                Sekolah Dasar
                                @break
                            @case('SMP')
                                Sekolah Menengah Pertama
                                @break
                            @default
                                {{ $registration->unit }}
                        @endswitch
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ $newStatus }}">
                            @switch($newStatus)
                                @case('pending')
                                    Menunggu Verifikasi
                                    @break
                                @case('verified')
                                    Terverifikasi
                                    @break
                                @case('rejected')
                                    Ditolak
                                    @break
                                @case('passed')
                                    Diterima
                                    @break
                                @case('failed')
                                    Tidak Diterima
                                    @break
                                @default
                                    {{ ucfirst($newStatus) }}
                            @endswitch
                        </span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Keputusan</span>
                    <span class="info-value">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Batas Daftar Ulang</span>
                    <span class="info-value">{{ \Carbon\Carbon::now()->addDays(15)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                </div>
            </div>

            @if($newStatus === 'passed')
                <div class="footer-message">
                    <strong>âœ“ SELAMAT!</strong>
                    <br><br>
                    Berdasarkan hasil seleksi PPDB Imanuel, Anda dinyatakan <strong>DITERIMA</strong> sebagai calon peserta didik baru.
                    <br><br>
                    Silakan melakukan proses daftar ulang sesuai jadwal yang telah ditentukan.
                </div>
            @elseif($newStatus === 'rejected' || $newStatus === 'failed')
                <div class="footer-message">
                    Kami ucapkan terimakasih atas antusiasme Anda mendaftar di PPDB Imanuel. 
                    Mohon maaf, pendaftaran Anda tidak dapat diterima pada periode ini. 
                    Silakan mencoba pada periode PPDB berikutnya.
                </div>
            @elseif($newStatus === 'verified')
                <div class="footer-message">
                    <strong>âœ“ Dokumen Anda Terverifikasi!</strong> Data dan berkas yang Anda kirimkan telah melewati tahap verifikasi. 
                    Tunggu pengumuman hasil akhir seleksi PPDB.
                </div>
            @else
                <div class="footer-message">
                    Dokumen dan data Anda sedang dalam proses verifikasi. Kami akan segera memberitahu Anda mengenai perkembangan pendaftaran.
                </div>
            @endif

            <center>
                <a href="{{ route('student.dashboard') }}" class="action-button">
                    Lihat Dashboard PPDB
                </a>
            </center>
        </div>

        <div class="footer">
            <p>
                <strong>PPDB Imanuel 2026</strong><br>
                Jalan Imanuel No. 123, Kota Anda<br>
                Telepon: (021) 123-4567 | Email: info@ppdb-imanuel.id
            </p>
            <p style="margin-top: 20px; color: #94a3b8;">
                Ini adalah email otomatis, mohon jangan membalas email ini. 
                Jika ada pertanyaan, hubungi kami melalui website.
            </p>
        </div>
    </div>
</body>
</html>

