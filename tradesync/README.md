# TradeSync – Smart Trade Management System
## Admin Panel Dashboard

A full-featured, professional admin panel built following the TradeSync ER diagram.

---

## 📁 File Structure

```
tradesync/
├── index.html              ← Main Dashboard
├── login.html              ← Login Page
├── database.sql            ← Full MySQL Schema + Seed Data
├── css/
│   └── style.css           ← Design System CSS
├── js/
│   └── main.js             ← Charts, Interactions, Dark Mode
├── pages/
│   └── purchase-orders.html ← Example inner page (template for all modules)
├── includes/
│   ├── config.php          ← DB Config (change credentials here)
│   └── Database.php        ← PDO Database Class
└── api/
    ├── dashboard.php        ← Dashboard KPI API
    └── purchase_orders.php  ← Purchase Orders CRUD API
```

---

## 🚀 Setup Instructions

### 1. Database Setup
```bash
# Import the database schema
mysql -u root -p < database.sql
```

### 2. Configure Database
Edit `includes/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_mysql_user');
define('DB_PASS', 'your_mysql_password');
define('DB_NAME', 'tradesync');
```

### 3. Web Server
- Place the folder in your web server root (e.g. `htdocs/tradesync` for XAMPP)
- Or use: `php -S localhost:8000` from the tradesync folder

### 4. Access the App
- Open: `http://localhost/tradesync/login.html`
- Demo credentials: `admin@tradesync.com` / `admin123`

---

## 📋 Modules Covered (from ER Diagram)

### Import Process
- ✅ Suppliers
- ✅ Purchase Orders (with CRUD API)
- ✅ Proforma Invoices
- ✅ Letters of Credit
- ✅ Shipments & Tracking
- ✅ Import Costs
- ✅ GRN (Goods Receive Notes)

### Inventory
- ✅ Products & Categories
- ✅ Warehouses
- ✅ Inventory Management
- ✅ Stock Movements

### Sales
- ✅ Customers
- ✅ Sales Orders
- ✅ Invoices
- ✅ Deliveries
- ✅ Customer Payments

### System
- ✅ Users & Roles
- ✅ Permissions
- ✅ Dashboard KPIs
- ✅ Reports

---

## 🔧 Tech Stack
- **Frontend:** HTML5, CSS3, Bootstrap 5.3, Chart.js 4, Bootstrap Icons
- **Backend:** PHP 8+ (PDO)
- **Database:** MySQL 8+
- **Typography:** Inter + Space Grotesk (Google Fonts)

## 🎨 Features
- ✅ Fully Responsive (Mobile, Tablet, Desktop)
- ✅ Dark / Light Mode Toggle
- ✅ Collapsible Sidebar
- ✅ Interactive Charts (Bar, Line, Donut)
- ✅ KPI Counter Animations
- ✅ Filter & Search Tables
- ✅ Modal Forms (Add/Edit)
- ✅ RESTful PHP API with PDO
