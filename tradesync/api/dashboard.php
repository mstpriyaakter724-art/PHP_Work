<?php
// =============================================
// TradeSync – Dashboard Stats API
// api/dashboard.php
// =============================================

session_start();
header('Content-Type: application/json');

require_once '../includes/Database.php';

try {
    // Total Import Value (sum of all PO amounts)
    $totalImport = Database::fetchOne(
        "SELECT COALESCE(SUM(total_amount), 0) AS total FROM purchase_orders WHERE status != 'cancelled'"
    )['total'];

    // Total Inventory value
    $totalInventory = Database::fetchOne(
        "SELECT COALESCE(SUM(total_cost), 0) AS total, COALESCE(SUM(quantity), 0) AS units FROM inventory"
    );

    // Total Sales
    $totalSales = Database::fetchOne(
        "SELECT COALESCE(SUM(total_amount), 0) AS total FROM sales_orders WHERE status != 'cancelled'"
    )['total'];

    // Total Payments Received
    $totalPayments = Database::fetchOne(
        "SELECT COALESCE(SUM(amount), 0) AS total FROM customer_payments WHERE status = 'confirmed'"
    )['total'];

    // Open POs
    $openPOs = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM purchase_orders WHERE status IN ('pending','approved')"
    )['cnt'];

    // Active LCs
    $activeLCs = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM letters_of_credit WHERE status IN ('opened','amended')"
    )['cnt'];

    // In Transit Shipments
    $inTransit = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM import_shipments WHERE current_status = 'in_transit'"
    )['cnt'];

    // Low Stock (inventory < 50 units)
    $lowStock = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM inventory WHERE quantity < 50"
    )['cnt'];

    // Total Customers
    $customers = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM customers WHERE status = 'active'"
    )['cnt'];

    // Total Suppliers
    $suppliers = Database::fetchOne(
        "SELECT COUNT(*) AS cnt FROM suppliers WHERE status = 'active'"
    )['cnt'];

    // Monthly Sales (last 12 months)
    $monthlySales = Database::fetchAll(
        "SELECT DATE_FORMAT(so_date, '%Y-%m') AS month,
                SUM(total_amount) AS sales
         FROM sales_orders
         WHERE so_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
           AND status != 'cancelled'
         GROUP BY DATE_FORMAT(so_date, '%Y-%m')
         ORDER BY month ASC"
    );

    // Monthly Import Cost (last 12 months)
    $monthlyImport = Database::fetchAll(
        "SELECT DATE_FORMAT(po_date, '%Y-%m') AS month,
                SUM(total_amount) AS import_cost
         FROM purchase_orders
         WHERE po_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
           AND status != 'cancelled'
         GROUP BY DATE_FORMAT(po_date, '%Y-%m')
         ORDER BY month ASC"
    );

    // Sales by Category
    $salesByCategory = Database::fetchAll(
        "SELECT c.category_name,
                SUM(sod.total_price) AS total_sales
         FROM sales_order_details sod
         JOIN products p ON sod.product_id = p.id
         JOIN categories c ON p.category_id = c.id
         GROUP BY c.id
         ORDER BY total_sales DESC
         LIMIT 6"
    );

    // Recent Activities
    $recentActivities = Database::fetchAll(
        "(SELECT 'purchase_order' AS type, CONCAT('PO ', po_no, ' created') AS description, created_at FROM purchase_orders ORDER BY created_at DESC LIMIT 3)
         UNION ALL
         (SELECT 'invoice' AS type, CONCAT('Invoice ', invoice_no, ' created') AS description, created_at FROM invoices ORDER BY created_at DESC LIMIT 3)
         UNION ALL
         (SELECT 'payment' AS type, CONCAT('Payment of $', amount, ' received') AS description, created_at FROM customer_payments WHERE status = 'confirmed' ORDER BY created_at DESC LIMIT 3)
         ORDER BY created_at DESC LIMIT 10"
    );

    // Low Stock Products
    $lowStockProducts = Database::fetchAll(
        "SELECT p.product_name, p.sku, i.quantity, i.unit_cost, w.warehouse_name
         FROM inventory i
         JOIN products p ON i.product_id = p.id
         JOIN warehouses w ON i.warehouse_id = w.id
         WHERE i.quantity < 50
         ORDER BY i.quantity ASC
         LIMIT 10"
    );

    echo json_encode([
        'success' => true,
        'kpis' => [
            'total_import'    => (float)$totalImport,
            'total_inventory' => (float)$totalInventory['total'],
            'inventory_units' => (float)$totalInventory['units'],
            'total_sales'     => (float)$totalSales,
            'total_payments'  => (float)$totalPayments,
            'open_pos'        => (int)$openPOs,
            'active_lcs'      => (int)$activeLCs,
            'in_transit'      => (int)$inTransit,
            'low_stock'       => (int)$lowStock,
            'customers'       => (int)$customers,
            'suppliers'       => (int)$suppliers,
        ],
        'charts' => [
            'monthly_sales'   => $monthlySales,
            'monthly_import'  => $monthlyImport,
            'by_category'     => $salesByCategory,
        ],
        'widgets' => [
            'recent_activities' => $recentActivities,
            'low_stock_products' => $lowStockProducts,
        ]
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
