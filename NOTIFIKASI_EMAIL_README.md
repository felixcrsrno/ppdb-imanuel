# Panduan Notifikasi Email Status PPDB

## Ringkasan
Sistem notifikasi email telah diimplementasikan. Ketika admin mengubah status pendaftaran, calon peserta didik akan menerima email otomatis dengan informasi status terbaru mereka.

## ðŸ“§ Template Email
Email yang dikirim berisi:
- **Nomor Pendaftaran**: PPDB-2026-00125
- **Nama**: Nama pendaftar (dari profil siswa)
- **Program**: TK, SD, atau SMP
- **Status**: Dengan badge berwarna sesuai status
- **Tanggal Keputusan**: Tanggal pengiriman email (format Indonesia)
- **Batas Daftar Ulang**: 15 hari setelah pengiriman email

## âš™ï¸ Konfigurasi Email

### 1. Setup SMTP (Recommended untuk Production)

Edit file `.env`:
```env
# Menggunakan Mailtrap (untuk testing)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@ppdb-imanuel.id
MAIL_FROM_NAME="PPDB Imanuel"
```

### 2. Testing dengan Log Driver (Development)
```env
MAIL_DRIVER=log
```
Email akan dicatat di `storage/logs/laravel.log` alih-alih dikirim.

### 3. Menggunakan Mailgun atau SendGrid
```env
# Mailgun
MAIL_DRIVER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-secret-key

# SendGrid
MAIL_DRIVER=sendgrid
SENDGRID_API_KEY=your-api-key
```

## ðŸ”„ Cara Kerja

1. **Admin membuka halaman verifikasi** â†’ `/admin/verification`
2. **Admin memilih registrasi** dan mengubah status (verified, passed, rejected, dll)
3. **Sistem otomatis**:
   - Menyimpan status baru ke database
   - Mengirim event `RegistrationStatusChanged`
   - Listener `SendRegistrationStatusNotification` menangkap event
   - Email dikirim ke email pendaftar
4. **Calon peserta didik menerima email** dengan template yang sudah disiapkan

## ðŸ“ File yang Dibuat/Diubah

### Event System
- `app/Events/RegistrationStatusChanged.php` - Event class
- `app/Listeners/SendRegistrationStatusNotification.php` - Event listener
- `app/Providers/EventServiceProvider.php` - Event provider (baru)

### Email
- `app/Mail/RegistrationStatusNotification.php` - Mailable class
- `resources/views/emails/registration-status-notification.blade.php` - Email template

### Updated Files
- `app/Http/Controllers/VerificationController.php` - Menambah event dispatch
- `bootstrap/providers.php` - Mendaftarkan EventServiceProvider

## ðŸŽ¨ Customisasi Email

Untuk mengubah tampilan email, edit file:
```
resources/views/emails/registration-status-notification.blade.php
```

Edit bagian kontak sekolah (di footer):
```blade
<p>
    <strong>PPDB Imanuel 2026</strong><br>
    Jalan Imanuel No. 123, Kota Anda<br>
    Telepon: (021) 123-4567 | Email: info@ppdb-imanuel.id
</p>
```

## ðŸ“Š Status dan Pesan Email

| Status | Label | Pesan |
|--------|-------|-------|
| pending | Menunggu Verifikasi | Dokumen dalam proses verifikasi |
| verified | Terverifikasi | Data dan berkas telah melewati verifikasi |
| passed | Diterima | Selamat! Anda diterima di PPDB Imanuel |
| rejected | Ditolak | Pendaftaran tidak diterima periode ini |
| failed | Tidak Diterima | Pendaftaran tidak diterima periode ini |

## âœ… Testing Notifikasi Email

### Metode 1: Menggunakan Mail Log
1. Atur `.env` dengan `MAIL_DRIVER=log`
2. Ubah status pendaftaran di admin panel
3. Buka file `storage/logs/laravel.log` untuk melihat email yang "dikirim"

### Metode 2: Menggunakan Mailtrap
1. Buat akun gratis di [Mailtrap.io](https://mailtrap.io)
2. Dapatkan SMTP credentials
3. Masukkan ke `.env`
4. Ubah status di admin panel
5. Lihat email masuk di Mailtrap inbox

### Metode 3: Menggunakan Mail Preview di Development
Tambahkan route sementara di `routes/web.php` untuk preview:
```php
Route::get('/preview-email/{id}', function ($id) {
    $registration = \App\Models\Registration::find($id);
    return new \App\Mail\RegistrationStatusNotification($registration, 'pending', 'verified');
});
```

## ðŸ› Troubleshooting

**Email tidak terkirim?**
1. Cek konfigurasi `.env` - pastikan `MAIL_FROM_ADDRESS` dan `MAIL_FROM_NAME` terisi
2. Lihat log di `storage/logs/laravel.log`
3. Cek SMTP credentials jika menggunakan SMTP
4. Pastikan EventServiceProvider terdaftar di `bootstrap/providers.php`

**Email berisi HTML baku alih-alih template?**
- Pastikan konfigurasi `.env` sudah benar
- Restart server Laravel dengan `php artisan serve`

**Perubahan template tidak muncul?**
- Clear cache dengan command: `php artisan view:clear`

## ðŸ“ Catatan Penting

- Email hanya dikirim jika status **benar-benar berubah** (old status â‰  new status)
- Email dikirim **secara sinkron** (langsung) - jika ingin asinkron, gunakan queue
- Email menggunakan tampilan Blade, jadi bisa menggunakan semua Blade directives

## Implementasi Queue (Opsional)

Untuk mengirim email secara asinkron (tidak memblokir proses):

1. Update `app/Mail/RegistrationStatusNotification.php`:
```php
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationStatusNotification extends Mailable implements ShouldQueue
{
    // ... rest of code
}
```

2. Jalankan queue worker:
```bash
php artisan queue:work
```

---

**Support**: Jika ada pertanyaan atau masalah, silakan hubungi tim development.

