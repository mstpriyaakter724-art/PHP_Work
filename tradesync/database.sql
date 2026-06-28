-- =============================================
-- TradeSync - Smart Trade Management System
-- Full MySQL Database Schema
-- Based on ER Diagram
-- =============================================

CREATE DATABASE IF NOT EXISTS tradesync CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tradesync;

-- =============================================
-- USER MANAGEMENT
-- =============================================

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_name VARCHAR(100) NOT NULL,
  description TEXT,
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(20),
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  module_name VARCHAR(100) NOT NULL,
  permission_name VARCHAR(100) NOT NULL,
  description TEXT,
  status ENUM('active','inactive') DEFAULT 'active'
);

CREATE TABLE role_permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  permission_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id),
  FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

-- =============================================
-- IMPORT PROCESS
-- =============================================

CREATE TABLE suppliers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  contact_person VARCHAR(150),
  phone VARCHAR(20),
  email VARCHAR(150),
  address TEXT,
  country VARCHAR(100),
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchase_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  po_no VARCHAR(50) UNIQUE NOT NULL,
  supplier_id INT NOT NULL,
  po_date DATE NOT NULL,
  status ENUM('pending','approved','shipped','received','cancelled') DEFAULT 'pending',
  total_amount DECIMAL(15,2) DEFAULT 0,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
  FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE purchase_order_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  po_id INT NOT NULL,
  product_name VARCHAR(200) NOT NULL,
  description TEXT,
  quantity DECIMAL(12,3) NOT NULL,
  unit_price DECIMAL(12,2) NOT NULL,
  total_price DECIMAL(15,2) GENERATED ALWAYS AS (quantity * unit_price) STORED,
  FOREIGN KEY (po_id) REFERENCES purchase_orders(id) ON DELETE CASCADE
);

CREATE TABLE purforma_invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pi_no VARCHAR(50) UNIQUE NOT NULL,
  po_id INT NOT NULL,
  pi_date DATE NOT NULL,
  total_amount DECIMAL(15,2) NOT NULL,
  currency VARCHAR(10) DEFAULT 'USD',
  status ENUM('draft','sent','confirmed','cancelled') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (po_id) REFERENCES purchase_orders(id)
);

CREATE TABLE letters_of_credit (
  id INT AUTO_INCREMENT PRIMARY KEY,
  lc_no VARCHAR(50) UNIQUE NOT NULL,
  pi_id INT NOT NULL,
  bank_name VARCHAR(200),
  lc_amount DECIMAL(15,2) NOT NULL,
  currency VARCHAR(10) DEFAULT 'USD',
  open_date DATE,
  expiry_date DATE,
  status ENUM('draft','opened','amended','utilized','expired','cancelled') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pi_id) REFERENCES purforma_invoices(id)
);

CREATE TABLE import_shipments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shipment_no VARCHAR(50) UNIQUE NOT NULL,
  po_id INT NOT NULL,
  lc_id INT,
  tracking_no VARCHAR(100),
  shipping_company VARCHAR(200),
  etd DATE COMMENT 'Estimated Time of Departure',
  eta DATE COMMENT 'Estimated Time of Arrival',
  current_status ENUM('booked','in_transit','at_customs','delivered','returned') DEFAULT 'booked',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (po_id) REFERENCES purchase_orders(id),
  FOREIGN KEY (lc_id) REFERENCES letters_of_credit(id)
);

CREATE TABLE import_costs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shipment_id INT NOT NULL,
  product_cost DECIMAL(15,2) DEFAULT 0,
  shipping_cost DECIMAL(15,2) DEFAULT 0,
  duty_cost DECIMAL(15,2) DEFAULT 0,
  tax_cost DECIMAL(15,2) DEFAULT 0,
  other_cost DECIMAL(15,2) DEFAULT 0,
  total_cost DECIMAL(15,2) GENERATED ALWAYS AS (product_cost + shipping_cost + duty_cost + tax_cost + other_cost) STORED,
  cost_date DATE,
  FOREIGN KEY (shipment_id) REFERENCES import_shipments(id)
);

CREATE TABLE shipment_documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shipment_id INT NOT NULL,
  doc_type VARCHAR(100) NOT NULL,
  doc_no VARCHAR(100),
  doc_file VARCHAR(300),
  issue_date DATE,
  FOREIGN KEY (shipment_id) REFERENCES import_shipments(id)
);

CREATE TABLE shipment_tracking_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  shipment_id INT NOT NULL,
  status VARCHAR(100),
  location VARCHAR(200),
  remarks TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (shipment_id) REFERENCES import_shipments(id)
);

-- =============================================
-- INVENTORY PROCESS
-- =============================================

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(150) NOT NULL,
  description TEXT,
  status ENUM('active','inactive') DEFAULT 'active'
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  product_name VARCHAR(200) NOT NULL,
  sku VARCHAR(100) UNIQUE NOT NULL,
  unit VARCHAR(50),
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE warehouses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  warehouse_name VARCHAR(200) NOT NULL,
  location VARCHAR(300),
  status ENUM('active','inactive') DEFAULT 'active'
);

CREATE TABLE inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  quantity DECIMAL(12,3) DEFAULT 0,
  unit_cost DECIMAL(12,2) DEFAULT 0,
  total_cost DECIMAL(15,2) GENERATED ALWAYS AS (quantity * unit_cost) STORED,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY unique_product_warehouse (product_id, warehouse_id),
  FOREIGN KEY (product_id) REFERENCES products(id),
  FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
);

CREATE TABLE goods_receive_notes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  grn_no VARCHAR(50) UNIQUE NOT NULL,
  shipment_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  grn_date DATE NOT NULL,
  status ENUM('draft','completed','cancelled') DEFAULT 'draft',
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (shipment_id) REFERENCES import_shipments(id),
  FOREIGN KEY (warehouse_id) REFERENCES warehouses(id),
  FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE warehouse_receives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  grn_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity_received DECIMAL(12,3) NOT NULL,
  receive_date DATE,
  received_by INT,
  remarks TEXT,
  FOREIGN KEY (grn_id) REFERENCES goods_receive_notes(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE stock_movements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  warehouse_id INT NOT NULL,
  movement_type ENUM('in','out','transfer','adjustment') NOT NULL,
  reference_type VARCHAR(50) COMMENT 'grn, sales_order, transfer, adjustment',
  reference_id INT,
  quantity DECIMAL(12,3) NOT NULL,
  remark TEXT,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES products(id),
  FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
);

-- =============================================
-- SALES PROCESS
-- =============================================

CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  phone VARCHAR(20),
  email VARCHAR(150),
  address TEXT,
  city VARCHAR(100),
  status ENUM('active','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sales_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  so_no VARCHAR(50) UNIQUE NOT NULL,
  customer_id INT NOT NULL,
  so_date DATE NOT NULL,
  status ENUM('pending','confirmed','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  total_amount DECIMAL(15,2) DEFAULT 0,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (customer_id) REFERENCES customers(id),
  FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE sales_order_details (
  id INT AUTO_INCREMENT PRIMARY KEY,
  so_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity DECIMAL(12,3) NOT NULL,
  unit_price DECIMAL(12,2) NOT NULL,
  discount DECIMAL(5,2) DEFAULT 0,
  total_price DECIMAL(15,2) GENERATED ALWAYS AS (quantity * unit_price * (1 - discount/100)) STORED,
  FOREIGN KEY (so_id) REFERENCES sales_orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_no VARCHAR(50) UNIQUE NOT NULL,
  so_id INT NOT NULL,
  invoice_date DATE NOT NULL,
  total_amount DECIMAL(15,2) NOT NULL,
  status ENUM('draft','sent','paid','overdue','cancelled') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (so_id) REFERENCES sales_orders(id)
);

CREATE TABLE customer_payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id INT NOT NULL,
  payment_date DATE NOT NULL,
  amount DECIMAL(15,2) NOT NULL,
  payment_method ENUM('cash','bank_transfer','cheque','mobile_banking','card') NOT NULL,
  transaction_no VARCHAR(150),
  status ENUM('pending','confirmed','failed','refunded') DEFAULT 'pending',
  remark TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (invoice_id) REFERENCES invoices(id)
);

CREATE TABLE deliveries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id INT NOT NULL,
  delivery_date DATE,
  delivery_man VARCHAR(150),
  status ENUM('pending','out_for_delivery','delivered','failed','returned') DEFAULT 'pending',
  remarks TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (invoice_id) REFERENCES invoices(id)
);

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================

CREATE INDEX idx_po_supplier ON purchase_orders(supplier_id);
CREATE INDEX idx_po_status ON purchase_orders(status);
CREATE INDEX idx_po_date ON purchase_orders(po_date);
CREATE INDEX idx_shipment_po ON import_shipments(po_id);
CREATE INDEX idx_inventory_product ON inventory(product_id);
CREATE INDEX idx_inventory_warehouse ON inventory(warehouse_id);
CREATE INDEX idx_so_customer ON sales_orders(customer_id);
CREATE INDEX idx_so_status ON sales_orders(status);
CREATE INDEX idx_invoice_so ON invoices(so_id);
CREATE INDEX idx_invoice_status ON invoices(status);
CREATE INDEX idx_stock_product ON stock_movements(product_id);

-- =============================================
-- SEED DATA
-- =============================================

INSERT INTO roles (role_name, description) VALUES
('Super Admin', 'Full system access'),
('Manager', 'Management level access'),
('Sales Officer', 'Sales module access'),
('Import Officer', 'Import module access'),
('Warehouse Staff', 'Inventory and warehouse access');

INSERT INTO users (role_id, name, email, password, phone) VALUES
(1, 'Admin User', 'admin@tradesync.com', '$2y$10$examplehashedpassword', '+8801700000001'),
(2, 'Reza Ahmed', 'reza@tradesync.com', '$2y$10$examplehashedpassword2', '+8801700000002'),
(2, 'Karim Hossain', 'karim@tradesync.com', '$2y$10$examplehashedpassword3', '+8801700000003');

INSERT INTO categories (category_name, description) VALUES
('Electronics', 'Electronic goods and components'),
('Textiles', 'Fabrics, garments and textile products'),
('Auto Parts', 'Automobile spare parts and accessories'),
('Plastics', 'Plastic products and raw materials'),
('Steel & Metal', 'Steel rods, sheets and metal products');

INSERT INTO warehouses (warehouse_name, location) VALUES
('Main Warehouse Dhaka', 'Tejgaon Industrial Area, Dhaka'),
('Chittagong Warehouse', 'Agrabad, Chittagong'),
('Narsingdi Depot', 'Narsingdi, Dhaka Division');
