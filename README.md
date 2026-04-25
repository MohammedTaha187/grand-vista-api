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

## 🐳 Docker Setup (Recommended)

This project is fully dockerized using Laravel Sail/Docker Compose.

1. **Clone the repository**:
   ```bash
   git clone https://github.com/MohammedTaha187/grand-vista-api.git
   cd grand-vista-api
   ```

2. **Environment Setup**:
   ```bash
   cp .env.example .env
   ```
   *Make sure `DB_HOST` is set to `mysql` inside your `.env` for Docker.*

3. **Start the containers**:
   ```bash
   # Using Docker Compose
   docker-compose up -d
   ```

4. **Initialize the Application**:
   Execute these commands inside the app container:
   ```bash
   # Install dependencies
   docker-compose exec app composer install
   
   # Generate Key
   docker-compose exec app php artisan key:generate
   
   # Run Migrations & Seed
   docker-compose exec app php artisan migrate --seed
   
   # Install Passport Keys
   docker-compose exec app php artisan passport:install
   ```

## 📖 API Documentation

Once the containers are running, access the documentation at:
`http://localhost:8080/api/documentation`

## 🛠 Useful Commands

- **Stop containers**: `docker-compose down`
- **View logs**: `docker-compose logs -f app`
- **Run Tests**: `docker-compose exec app php artisan test`

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
