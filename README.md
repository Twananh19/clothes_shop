# 🛍️ Xây dựng ứng dụng web shop thời trang

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/SQLite-Database-lightblue?style=for-the-badge&logo=sqlite" alt="SQLite">
  <img src="https://img.shields.io/badge/Stripe-Payment-purple?style=for-the-badge&logo=stripe" alt="Stripe">
</p>

## 📋 Mục lục
- [Mở đầu](#mở-đầu)
- [Triển khai](#triển-khai)
- [Ưu nhược điểm](#ưu-nhược-điểm)
- [Tổng kết](#tổng-kết)

---

## 🚀 Mở đầu

### Đặt vấn đề
Trong thời đại số hóa hiện nay, thương mại điện tử đã trở thành xu hướng không thể thiếu trong kinh doanh. Đặc biệt trong lĩnh vực thời trang, việc có một nền tảng trực tuyến để bán hàng không chỉ giúp mở rộng thị trường mà còn nâng cao trải nghiệm mua sắm của khách hàng.

Các thách thức chính trong việc xây dựng một website thương mại điện tử bao gồm:
- Quản lý sản phẩm và danh mục hiệu quả
- Xử lý giỏ hàng và thanh toán an toàn
- Giao diện người dùng thân thiện và responsive
- Hệ thống quản trị cho admin
- Bảo mật thông tin khách hàng

### Hướng khắc phục
Để giải quyết các vấn đề trên, dự án đã sử dụng framework Laravel - một trong những framework PHP mạnh mẽ nhất hiện nay với các tính năng:
- Eloquent ORM cho việc quản lý cơ sở dữ liệu
- Blade template engine cho giao diện động
- Middleware cho bảo mật
- Session management cho giỏ hàng
- Integration với Stripe để thanh toán

### Giới thiệu dự án
**Clothes Shop** là một ứng dụng web thương mại điện tử chuyên về thời trang, được phát triển nhằm cung cấp một nền tảng mua bán online hoàn chỉnh. Dự án bao gồm hai phần chính:
- **Frontend**: Giao diện khách hàng với khả năng duyệt sản phẩm, thêm vào giỏ hàng và thanh toán
- **Backend**: Hệ thống quản trị cho admin quản lý sản phẩm, danh mục và đơn hàng

---

## 🏗️ Triển khai

### Sơ đồ Use Case

```
👤 Khách hàng (Customer)
├── Xem danh sách sản phẩm
├── Xem chi tiết sản phẩm  
├── Thêm sản phẩm vào giỏ hàng
├── Quản lý giỏ hàng
├── Thanh toán đơn hàng
└── Tìm kiếm và lọc sản phẩm

👨‍💼 Quản trị viên (Admin)
├── Quản lý danh mục sản phẩm
│   ├── Thêm danh mục
│   ├── Xóa danh mục
│   └── Xem danh sách danh mục
├── Quản lý sản phẩm
│   ├── Thêm sản phẩm
│   ├── Sửa sản phẩm
│   ├── Xóa sản phẩm
│   └── Xem danh sách sản phẩm
└── Quản lý đơn hàng
    ├── Xem danh sách đơn hàng
    ├── Xem chi tiết đơn hàng
    ├── Cập nhật trạng thái đơn hàng
    └── Xóa đơn hàng
```

**Mô tả sơ đồ Use Case:**
Sơ đồ trên thể hiện hai actor chính trong hệ thống:
1. **Khách hàng**: Có thể thực hiện các thao tác mua sắm cơ bản từ việc duyệt sản phẩm đến thanh toán
2. **Quản trị viên**: Có toàn quyền quản lý hệ thống từ sản phẩm, danh mục đến đơn hàng

### Sơ đồ lớp (Class Diagram)

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│      User       │    │    Category     │    │    Product      │
├─────────────────┤    ├─────────────────┤    ├─────────────────┤
│ - id            │    │ - id            │    │ - id            │
│ - name          │    │ - category_name │    │ - title         │
│ - email         │    │ - created_at    │    │ - description   │
│ - usertype      │    │ - updated_at    │    │ - price         │
│ - phone         │    └─────────────────┘    │ - quantity      │
│ - address       │                           │ - category      │
│ - password      │                           │ - image         │
│ - created_at    │                           │ - discount      │
│ - updated_at    │                           │ - created_at    │
└─────────────────┘                           │ - updated_at    │
                                             └─────────────────┘
                                                      │
                                                      │
┌─────────────────┐                                   │
│     Order       │                                   │
├─────────────────┤                                   │
│ - id            │                                   │
│ - customer_name │                                   │
│ - customer_email│                                   │
│ - customer_phone│                                   │
│ - customer_addr │                                   │
│ - total_amount  │                                   │
│ - payment_status│                                   │
│ - order_items   │◄──────────────────────────────────┘
│ - stripe_id     │   (JSON - contains product info)
│ - created_at    │
│ - updated_at    │
└─────────────────┘
```

**Mô tả sơ đồ lớp:**
- **User**: Lưu trữ thông tin người dùng với phân quyền thông qua trường `usertype`
- **Category**: Quản lý các danh mục sản phẩm
- **Product**: Lưu trữ thông tin chi tiết sản phẩm bao gồm giá, số lượng, hình ảnh
- **Order**: Quản lý đơn hàng với thông tin khách hàng và chi tiết sản phẩm dưới dạng JSON

### Các chức năng hiện có

#### 🛒 Chức năng cho khách hàng:
1. **Duyệt sản phẩm**
   - Xem danh sách tất cả sản phẩm
   - Xem 6 sản phẩm mới nhất trên trang chủ
   - Xem chi tiết từng sản phẩm

2. **Quản lý giỏ hàng**
   - Thêm sản phẩm vào giỏ hàng (AJAX)
   - Cập nhật số lượng sản phẩm
   - Xóa sản phẩm khỏi giỏ hàng
   - Hiển thị số lượng sản phẩm trong giỏ hàng

3. **Tìm kiếm và lọc**
   - Lọc theo danh mục
   - Lọc theo khoảng giá
   - Tìm kiếm theo tên sản phẩm
   - Sắp xếp theo giá và tên

4. **Thanh toán**
   - Nhập thông tin khách hàng
   - Thanh toán qua Stripe (demo mode)
   - Xử lý kết quả thanh toán

#### 👨‍💼 Chức năng cho Admin:
1. **Quản lý danh mục**
   - Thêm danh mục mới
   - Xóa danh mục
   - Xem danh sách danh mục

2. **Quản lý sản phẩm**
   - Thêm sản phẩm với hình ảnh
   - Sửa thông tin sản phẩm
   - Xóa sản phẩm
   - Xem danh sách sản phẩm

3. **Quản lý đơn hàng**
   - Xem danh sách đơn hàng
   - Xem chi tiết đơn hàng
   - Cập nhật trạng thái đơn hàng
   - Xóa đơn hàng
   - Lọc đơn hàng theo trạng thái, ngày

### Công nghệ và ngôn ngữ lập trình

#### Backend:
- **Framework**: Laravel 12.0
- **Ngôn ngữ**: PHP 8.2+
- **Cơ sở dữ liệu**: SQLite
- **Authentication**: Laravel Jetstream + Fortify
- **Payment**: Stripe API

#### Frontend:
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS
- **JavaScript**: jQuery, AJAX
- **Build Tool**: Vite

#### Packages chính:
```json
{
  "laravel/framework": "^12.0",
  "laravel/jetstream": "^5.3", 
  "laravel/sanctum": "^4.0",
  "livewire/livewire": "^3.0",
  "stripe/stripe-php": "^17.3"
}
```

---

## ⚖️ Ưu nhược điểm

### ✅ Ưu điểm

1. **Kiến trúc tốt**
   - Sử dụng Laravel framework ổn định
   - Áp dụng mô hình MVC chuẩn
   - Code được tổ chức rõ ràng theo từng module

2. **Tính năng đầy đủ**
   - Có đầy đủ chức năng cơ bản của một e-commerce
   - Hệ thống phân quyền rõ ràng
   - Giao diện admin và user riêng biệt

3. **Bảo mật**
   - Sử dụng Laravel Jetstream cho authentication
   - Validation đầu vào nghiêm ngặt
   - CSRF protection

4. **Trải nghiệm người dùng**
   - Giao diện responsive
   - AJAX cho các thao tác không reload trang
   - Thông báo phản hồi rõ ràng

### ❌ Nhược điểm

1. **Cơ sở dữ liệu**
   - Sử dụng SQLite không phù hợp cho production
   - Thiếu quan hệ foreign key giữa các bảng
   - Không có migration cho bảng Order relationships

2. **Quản lý state**
   - Giỏ hàng lưu trong session, dễ mất dữ liệu
   - Không có hệ thống backup cho cart

3. **Tính năng còn thiếu**
   - Chưa có hệ thống review/rating
   - Không có wishlist
   - Thiếu tính năng quản lý inventory
   - Chưa có báo cáo thống kê chi tiết

4. **Performance**
   - Chưa có caching
   - Chưa optimize cho SEO
   - Image optimization chưa được implement

### 🔮 Hướng phát triển trong tương lai

1. **Cải thiện cơ sở dữ liệu**
   - Chuyển sang MySQL/PostgreSQL
   - Thêm relationships đầy đủ
   - Implement indexing cho performance

2. **Nâng cấp tính năng**
   ```php
   // Thêm các model mới
   - Review/Rating system
   - Wishlist functionality  
   - Inventory management
   - Coupon/Discount system
   - Multi-language support
   ```

3. **Cải thiện performance**
   - Implement Redis caching
   - Image optimization với Laravel Intervention
   - Lazy loading cho sản phẩm
   - API pagination

4. **Mobile & PWA**
   - Develop mobile app với Laravel API
   - Progressive Web App support
   - Push notifications

5. **Analytics & Reports**
   - Sales reporting dashboard
   - Customer behavior tracking
   - Inventory analytics
   - Revenue forecasting

---

## 📊 Tổng kết

Dự án **Clothes Shop** đã xây dựng thành công một nền tảng thương mại điện tử cơ bản với đầy đủ các tính năng thiết yếu. Việc sử dụng Laravel framework đã giúp dự án có kiến trúc vững chắc và dễ bảo trì.

### Thành tựu đạt được:
- ✅ Hoàn thành hệ thống quản lý sản phẩm
- ✅ Xây dựng giỏ hàng với AJAX
- ✅ Tích hợp thanh toán Stripe
- ✅ Giao diện admin hoàn chỉnh
- ✅ Responsive design

### Kết luận:
Dự án thể hiện một level hiểu biết tốt về Laravel và web development. Mặc dù còn một số điểm cần cải thiện, nhưng foundation đã được xây dựng solid và có thể scale up dễ dàng trong tương lai.

Với roadmap phát triển rõ ràng, dự án có tiềm năng trở thành một platform thương mại điện tử hoàn chỉnh cho doanh nghiệp thời trang.

---

## 🚀 Hướng dẫn cài đặt

```bash
# Clone project
git clone <repository-url>
cd clothes-shop

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
touch database/database.sqlite
php artisan migrate

# Start development server
npm run dev
php artisan serve
```

## 📞 Liên hệ
Để biết thêm thông tin về dự án, vui lòng liên hệ qua email hoặc tạo issue trên repository.
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
