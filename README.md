# Grand Vista Hotel Management API 🏨

A robust, enterprise-grade Hotel Management API built with Laravel, featuring a modular architecture, multi-gateway payment integration, and advanced authentication.

## 🚀 Features

- **Modular Architecture**: Built using Laravel Modules for high maintainability.
- **Advanced Auth**: Laravel Passport for OAuth2 and JWT-compatible authentication.
- **Social Login**: Integrated Google and Facebook authentication via Socialite.
- **Multi-Gateway Payments**: 
  - 💳 Stripe
  - 🅿️ PayPal
  - 💳 Paymob (Local/International)
  - 💳 Kashier
- **Automated Documentation**: Interactive Swagger UI for API testing.
- **Email Notifications**: Automated transaction and booking status updates.
- **Multi-Tenancy Ready**: Pre-configured for multi-company support.
- **Health Monitoring**: Built-in system health checks for DB and Redis.

## 🛠 Tech Stack

- **Backend**: Laravel 11+
- **Database**: MySQL / PostgreSQL
- **Caching**: Redis
- **Authentication**: Laravel Passport & Socialite
- **API Docs**: L5-Swagger (OpenAPI 3.0)

## 📦 Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/MohammedTaha187/grand-vista-api.git
   cd grand-vista-api
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database & Migration**:
   ```bash
   php artisan migrate --seed
   php artisan passport:install
   ```

## 📖 API Documentation

Access the interactive Swagger documentation at:
`http://your-domain.com/api/documentation`

## 🧪 Testing

Run feature and contract tests:
```bash
php artisan test
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---
Developed with ❤️ by [Muhammad Taha](mailto:muhammad.taha.eng@gmail.com)
