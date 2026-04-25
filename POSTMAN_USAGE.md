# 🚀 Grand Vista API - Complete Postman Reference

This is a comprehensive guide for all available endpoints across all modules.

**Base URL**: `http://localhost:8000/api`  
**Standard Headers**: 
- `Accept: application/json`
- `Content-Type: application/json`
- `Authorization: Bearer {{TOKEN}}`

---

## 🔐 1. Authentication Module (`routes/api.php`)

### Register
`POST` → `/v1/auth/register`
```json
{
  "name": "Full Name",
  "email": "user@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### Login
`POST` → `/v1/auth/login`
```json
{
  "email": "user@example.com",
  "password": "password"
}
```

### Get My Profile
`GET` → `/v1/auth/me`

### Logout
`POST` → `/v1/auth/logout`

---

## 🏨 2. Hotel Module (`Modules/Hotel/routes/api.php`)

### [Admin] Dashboard
- **Insights Summary**: `GET` → `/v1/hotel/admin/dashboard/insights`
- **Occupancy Stats**: `GET` → `/v1/hotel/admin/dashboard/occupancy`
- **Revenue Report**: `GET` → `/v1/hotel/admin/dashboard/revenue?period=month`
- **Maintenance Summary**: `GET` → `/v1/hotel/admin/dashboard/maintenance`

### [Admin] Resource Management (CRUDs)
- **Amenities**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/amenities`
- **Room Types**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/room-types`
- **Rooms**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/rooms`
- **Payments**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/payments`
- **Invoices**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/invoices`
- **Reviews**: `GET|POST|PUT|DELETE` → `/v1/hotel/admin/reviews`

### [Admin] Booking Management
- **List/Create**: `GET|POST` → `/v1/hotel/admin/bookings`
- **Status Transitions**:
    - `POST` → `/v1/hotel/admin/bookings/{id}/confirm`
    - `POST` → `/v1/hotel/admin/bookings/{id}/check-in`
    - `POST` → `/v1/hotel/admin/bookings/{id}/check-out`
    - `POST` → `/v1/hotel/admin/bookings/{id}/cancel` (Body: `{"reason": "text"}`)
    - `POST` → `/v1/hotel/admin/bookings/{id}/refund` (Body: `{"amount": 100.0}`)

### [Client] Public & Private
- **List Room Types**: `GET` → `/v1/hotel/client/room-types`
- **View Room Type Details**: `GET` → `/v1/hotel/client/room-types/{id}`
- **List Reviews**: `GET` → `/v1/hotel/client/reviews`
- **My Bookings**: `GET|POST` → `/v1/hotel/client/bookings`

---

## 📝 3. CMS Module (`Modules/Cms/routes/api.php`)

### [Admin] Management
- **Offers**: `GET|POST|PUT|DELETE` → `/v1/cms/admin/offers`
- **Blog Posts**: `GET|POST|PUT|DELETE` → `/v1/cms/admin/blog-posts`
- **Galleries**: `GET|POST|PUT|DELETE` → `/v1/cms/admin/galleries`
- **FAQs**: `GET|POST|PUT|DELETE` → `/v1/cms/admin/faqs`
- **Testimonials**: `GET|POST|PUT|DELETE` → `/v1/cms/admin/testimonials`
- **Contact Messages**: `GET|DELETE` → `/v1/cms/admin/contact-messages`

### [Client] Content
- **Offers**: `GET` → `/v1/cms/client/offers`
- **Blog**: `GET` → `/v1/cms/client/blog-posts`
- **Blog Detail**: `GET` → `/v1/cms/client/blog-posts/{id}`
- **Gallery**: `GET` → `/v1/cms/client/galleries`
- **FAQs**: `GET` → `/v1/cms/client/faqs`
- **Testimonials**: `GET` → `/v1/cms/client/testimonials`
- **Send Message**: `POST` → `/v1/cms/client/contact-messages`
```json
{
  "name": "Guest Name",
  "email": "guest@example.com",
  "subject": "Inquiry",
  "message": "Message content"
}
```

---

## ⚙️ 4. Settings Module (`Modules/Setting/routes/api.php`)

### [Admin] Settings
- **Hotel Settings**: `GET|POST|PUT` → `/v1/settings/admin/hotel-settings`
- **Activity Logs**: `GET` → `/v1/settings/admin/activity-logs`

### [Client] Public Info
- **Public Settings**: `GET` → `/v1/settings/client/public-settings`

---

## 🛠️ 5. Operations Module (`Modules/Operations/routes/api.php`)

### [Admin/Staff] Management
- **Housekeeping Tasks**: `GET|POST|PUT|DELETE` → `/v1/operations/admin/housekeeping`
- **Maintenance Logs**: `GET|POST|PUT|DELETE` → `/v1/operations/admin/maintenance`

---

## 📦 Sample Data for Main POST Requests

### Create Room
`POST` → `/v1/hotel/admin/rooms`
```json
{
  "room_type_id": "uuid",
  "room_number": "205",
  "floor": 2,
  "status": "available"
}
```

### Create Booking (Admin)
`POST` → `/v1/hotel/admin/bookings`
```json
{
  "room_id": "uuid",
  "user_id": "uuid",
  "guest_name": "Taha",
  "guest_email": "taha@example.com",
  "check_in_date": "2026-06-01",
  "check_out_date": "2026-06-05",
  "adults": 1,
  "children": 0
}
```

### Create Blog Post
`POST` → `/v1/cms/admin/blog-posts`
```json
{
  "title": "Summer Offers",
  "slug": "summer-offers-2026",
  "content": "Full content here...",
  "is_published": true
}
```
