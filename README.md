# 🧠 AI Helpdesk Chat — Laravel 11 + OpenRouter

## 📌 Deskripsi Singkat
Aplikasi ini merupakan demo **AI Helpdesk Chat** berbasis **Laravel (versi 11+)** yang terintegrasi dengan **OpenRouter API** sebagai LLM provider.  
Pengguna dapat mengirim pesan ke model AI, dan AI akan memberikan balasan secara real‑time dalam UI chat sederhana.

---

## 🚀 Teknologi yang Digunakan
- Laravel 11+
- Blade Template Engine
- PHP 8+
- HTML + CSS + JavaScript
- GuzzleHTTP Client
- OpenRouter API

---

## 📁 Struktur Folder Utama
```
mst_test/
│
├── app/
│   └── Http/
│       └── Controllers/
│           └── ChatController.php
│
├── public/
│   └── index.php
│   └── index.html
│
├── resources/
│   └── views/
│       └── chat.blade.php
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── bootstrap/
│   └── app.php
│
└── .env
```

---

## 🔧 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/Seyaa20/mst_test.git
cd mst_test
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Copy File Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Server
```bash
php artisan serve
```

Akses di browser:
```
http://localhost:8000/
```

---

## 🔑 Konfigurasi `.env`

Tambahkan API Key OpenRouter milik Anda:

```
OPENROUTER_API_KEY=xxxxxxxxxxxxxxxxxxxx
```

> Dapatkan API Key di: https://openrouter.ai

---

## 🧩 Endpoint API

### POST `/api/chat`

**Request JSON**
```json
{ "message": "Hello" }
```

**Response JSON**
```json
{ "reply": "Hi! How can I assist you today?" }
```

---

## 🧠 ChatController (Backend AI)

Terletak di:
```
app/Http/Controllers/ChatController.php
```

Mengirim request ke OpenRouter:
- Model: `gpt-4o-mini`
- Metode: POST JSON
- Library: GuzzleHTTP

---

## 🖥️ UI Chat (Frontend)

File utama:
```
resources/views/chat.blade.php
```

Fitur:
✔ Send message  
✔ Bubble chat (user & AI)  
✔ Upload file, image, video  
✔ Responsive design (desktop, tablet, mobile)  
✔ Sticky header & footer  
✔ Scroll auto ke pesan terbaru  

---

## ⚠️ Troubleshooting

### 419 “Page Expired”
Tambahkan token CSRF:
```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### API tidak merespon
- Cek API key
- Cek limit OpenRouter
- Cek internet

### Guzzle error
```bash
composer require guzzlehttp/guzzle
```

---

## 👤 Author
**Teresa Fransciscus**
