# Daily Log System - Pemda X

Sistem manajemen log harian pegawai untuk Pemerintah Daerah dengan struktur hierarki kepegawaian.

## Fitur Utama

### 1. **Manajemen Log Harian**

-   ✅ CRUD log harian dengan status (Pending, Disetujui, Ditolak)
-   ✅ Upload attachment (PDF, DOC, DOCX, gambar)
-   ✅ Filter dan pencarian berdasarkan tanggal dan status
-   ✅ Validasi form dan file upload

### 2. **Sistem Hierarki**

-   ✅ Struktur kepegawaian: Kepala Dinas → Kepala Bidang → Staff
-   ✅ Sistem supervisor-subordinate
-   ✅ Verifikasi log oleh atasan langsung

### 3. **Dashboard & Analytics**

-   ✅ Dashboard interaktif dengan statistik
-   ✅ Chart aktivitas bulanan (Chart.js)
-   ✅ Notifikasi log pending untuk supervisor
-   ✅ Quick actions dan overview

### 4. **User Experience**

-   ✅ Responsive design dengan Tailwind CSS
-   ✅ UI modern dan intuitif
-   ✅ Font Awesome icons
-   ✅ Alert dan feedback system

## Demo Credentials

| Role            | Email                      | Password    | Akses                                |
| --------------- | -------------------------- | ----------- | ------------------------------------ |
| Kepala Dinas    | kepala.dinas@pemda.go.id   | password123 | Full access, dapat melihat semua log |
| Kepala Bidang 1 | kepala.bidang1@pemda.go.id | password123 | Verifikasi log staff bidang 1        |
| Kepala Bidang 2 | kepala.bidang2@pemda.go.id | password123 | Verifikasi log staff bidang 2        |
| Staff 1         | staff1@pemda.go.id         | password123 | Input log harian                     |
| Staff 2         | staff2@pemda.go.id         | password123 | Input log harian                     |

## Struktur Hierarki

```
Kepala Dinas (Ahmad)
├── Kepala Bidang 1 (Budi)
│   └── Staff 1 (Dani)
└── Kepala Bidang 2 (Citra)
    └── Staff 2 (Eka)
```

## Instalasi & Setup

### 1. Clone dan Install Dependencies

```bash
git clone <repository>
cd Soal-1
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup

```bash
# Konfigurasi database di .env
php artisan migrate:fresh --seed
php artisan storage:link
```

### 4. Run Application

```bash
# Development
php artisan serve
npm run dev

# Production
npm run build
```

## Fitur Tambahan & Inovasi

### 1. **Enhanced Security**

-   Middleware authentication
-   Authorization checks untuk setiap action
-   File upload validation dengan type dan size limits

### 2. **Modern UI/UX**

-   Responsive design untuk semua device
-   Loading states dan feedback
-   Modal confirmations untuk actions
-   Breadcrumb navigation

### 3. **Data Management**

-   Soft deletes untuk data integrity
-   Pagination untuk performance
-   Optimized queries dengan Eloquent relationships

### 4. **File Management**

-   Secure file storage dengan Laravel Storage
-   Preview untuk different file types
-   Download functionality

### 5. **Reporting & Analytics**

-   Interactive charts untuk trend analysis
-   Export capabilities (future enhancement)
-   Monthly activity summaries

## API Endpoints

| Method | Endpoint                  | Description               |
| ------ | ------------------------- | ------------------------- |
| GET    | `/dashboard`              | Dashboard utama           |
| GET    | `/daily-log`              | List log harian user      |
| POST   | `/daily-log`              | Create log baru           |
| GET    | `/daily-log/{id}`         | Detail log                |
| PUT    | `/daily-log/{id}`         | Update log                |
| DELETE | `/daily-log/{id}`         | Delete log                |
| GET    | `/daily-log-verification` | List log untuk verifikasi |
| PATCH  | `/daily-log/{id}/verify`  | Approve/reject log        |

## Technology Stack

-   **Backend**: Laravel 11, PHP 8.2+
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Database**: MySQL/PostgreSQL
-   **Icons**: Font Awesome 6
-   **Charts**: Chart.js
-   **File Storage**: Laravel Storage

## Workflow Log Harian

1. **Input Log** (Staff)

    - Pilih tanggal (max hari ini)
    - Isi deskripsi aktivitas
    - Upload attachment (opsional)
    - Status: Pending

2. **Verifikasi** (Supervisor)

    - Review log bawahan
    - Approve atau Reject
    - Tambah catatan (opsional)

3. **Tracking** (All Users)
    - Dashboard overview
    - Filter dan search
    - Export reports

## Database Schema

### Users Table

-   id, name, email, password
-   role (kepala_dinas, kepala_bidang, staff)
-   supervisor_id (self-reference)

### Daily Logs Table

-   id, user_id, log_date
-   activity_description, status, attachment
-   timestamps

## Future Enhancements

1. **Email Notifications**

    - Notifikasi ke supervisor untuk log baru
    - Reminder untuk log yang belum di-input

2. **Advanced Reporting**

    - Export PDF/Excel
    - Custom date range reports
    - Performance analytics

3. **Mobile App**

    - React Native/Flutter app
    - Push notifications
    - Offline capability

4. **Integration**
    - LDAP/Active Directory integration
    - API for third-party systems
    - Slack/Teams integration

## Support

Untuk pertanyaan atau dukungan teknis, hubungi developer atau buat issue di repository.

---

_Developed with ❤️ for Pemerintah Daerah X_

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
