# Westforge Closet Co. — Custom Closet Manufacturer Website + ERP + AI

Production-ready Laravel 13 + Filament 3 platform for **Westforge Closet Co.**, a Portland, Oregon custom closet manufacturer. Includes a public marketing site, full SME ERP admin, AI chatbot/generators, and a business knowledge base.

## ✨ Features
- 🏠 Premium public website (hero, systems, about, dashboard preview, contact)
- 🧩 Service detail pages for walk-ins, reach-ins, wardrobe walls, mudrooms, pantries, CNC design
- 📰 Blog / journal with seeded manufacturing articles
- 📚 Knowledge base (common issues, guides, admin manual, troubleshooting)
- 💬 Contact form with DB storage + success flash
- 🟢 Floating WhatsApp button
- 🤖 Public AI chatbot with FAQ fallback
- 🗂️ Filament ERP at `/admin` (CRM, orders, inventory, invoices, payments, appointments)
- 📊 Reports dashboard with stats + charts
- 🧠 Admin AI content generator, automation suggestions, and shop troubleshooter
- ⚙️ Company settings page
- 👥 Roles: Admin, Manager, Staff

## 🛠️ Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind (Filament)
- MySQL or SQLite (demo)
- Spatie Laravel Permission
- OpenAI API with Gemini fallback keys (HTTP client)

## 🚀 Installation
```bash
git clone https://github.com/imranbru99/custom-closet-manufacturer.git
cd custom-closet-manufacturer
composer install
copy .env.example .env   # Windows
php artisan key:generate
# Optional: create database/database.sqlite for local demo
php artisan migrate --seed
php artisan serve
```

Visit:
- Public site: `http://127.0.0.1:8000`
- Admin ERP: `http://127.0.0.1:8000/admin`

### Admin login
- Email: `admin@example.com`
- Password: `password`

Optional AI keys in `.env`:
```
OPENAI_API_KEY=
OPENAI_MODEL=gpt-4o-mini
GEMINI_API_KEY=
GEMINI_MODEL=gemini-1.5-flash
```

## 🖼️ Screenshots / Visual Dashboard
![Westforge walk-in closet](https://images.unsplash.com/photo-1595428774223-ef52624120d2?auto=format&fit=crop&w=1200&q=80)

![Organized closet shelving system](https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1200&q=80)

![Wardrobe wall interior](https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80)

![CNC manufacturing workflow](https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1200&q=80)

## 🌐 Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP hosting with MySQL) and update this section with the live URL.

## 🔍 SEO-optimized GitHub repo description suggestion
`Westforge Closet Co. — Laravel 13 + Filament 3 custom closet manufacturer website, ERP, AI chatbot, and knowledge base for US SME automation.`

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
