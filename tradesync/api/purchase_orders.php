<?php
// =============================================
// TradeSync – Purchase Orders API
// api/purchase_orders.php
// =============================================

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../includes/Database.php';

// Auth check (uncomment in production)
// if (!isset($_SESSION['user_id'])) { http_response_code(401); die(json_encode(['error' => 'Unauthorized'])); }

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch ($method) {

    // ── GET: List or single PO
    case 'GET':
        if (!empty($_GET['id'])) {
            // Single PO with details
            $po = Database::fetchOne(
                "SELECT po.*, s.name AS supplier_name, s.country, u.name AS created_by_name
                 FROM purchase_orders po
                 JOIN suppliers s ON po.supplier_id = s.id
                 LEFT JOIN users u ON po.created_by = u.id
                 WHERE po.id = ?",
                [(int)$_GET['id']]
            );
            if (!$po) { http_response_code(404); echo json_encode(['error' => 'PO not found']); break; }

            $po['items'] = Database::fetchAll(
                "SELECT * FROM purchase_order_details WHERE po_id = ?",
                [(int)$_GET['id']]
            );
            echo json_encode(['success' => true, 'data' => $po]);
        } else {
            // Filtered list
            $where = ['1=1'];
            $params = [];

            if (!empty($_GET['status'])) {
                $where[] = 'po.status = ?';
                $params[] = $_GET['status'];
            }
            if (!empty($_GET['supplier_id'])) {
                $where[] = 'po.supplier_id = ?';
                $params[] = (int)$_GET['supplier_id'];
            }
            if (!empty($_GET['date_from'])) {
                $where[] = 'po.po_date >= ?';
                $params[] = $_GET['date_from'];
            }
            if (!empty($_GET['date_to'])) {
                $where[] = 'po.po_date <= ?';
                $params[] = $_GET['date_to'];
            }
            if (!empty($_GET['search'])) {
                $where[] = '(po.po_no LIKE ? OR s.name LIKE ?)';
                $params[] = '%' . $_GET['search'] . '%';
                $params[] = '%' . $_GET['search'] . '%';
            }

            $limit  = (int)($_GET['limit']  ?? 25);
            $offset = (int)($_GET['offset'] ?? 0);
            $whereStr = implode(' AND ', $where);

            $total = Database::fetchOne(
                "SELECT COUNT(*) AS cnt FROM purchase_orders po JOIN suppliers s ON po.supplier_id = s.id WHERE $whereStr",
                $params
            )['cnt'];

            $rows = Database::fetchAll(
                "SELECT po.id, po.po_no, s.name AS supplier, po.po_date, po.total_amount, po.status, u.name AS created_by
                 FROM purchase_orders po
                 JOIN suppliers s ON po.supplier_id = s.id
                 LEFT JOIN users u ON po.created_by = u.id
                 WHERE $whereStr
                 ORDER BY po.po_date DESC
                 LIMIT $limit OFFSET $offset",
                $params
            );
            echo json_encode(['success' => true, 'total' => (int)$total, 'data' => $rows]);
        }
        break;

    // ── POST: Create PO
    case 'POST':
        $body = json_decode(file_get_contents('php://input'), true);
        if (!$body) { http_response_code(400); echo json_encode(['error' => 'Invalid JSON']); break; }

        // Generate PO number
        $year  = date('Y');
        $last  = Database::fetchOne("SELECT MAX(id) AS max_id FROM purchase_orders")['max_id'] ?? 0;
        $po_no = "PO-$year-" . str_pad((int)$last + 1, 4, '0', STR_PAD_LEFT);

        $pdo = Database::connect();
        $pdo->beginTransaction();
        try {
            $po_id = Database::execute(
                "INSERT INTO purchase_orders (po_no, supplier_id, po_date, status, created_by) VALUES (?, ?, ?, ?, ?)",
                [$po_no, $body['supplier_id'], $body['po_date'], $body['status'] ?? 'pending', $_SESSION['user_id'] ?? 1]
            );

            $total = 0;
            foreach ($body['items'] ?? [] as $item) {
                Database::execute(
                    "INSERT INTO purchase_order_details (po_id, product_name, description, quantity, unit_price) VALUES (?, ?, ?, ?, ?)",
                    [$po_id, $item['product_name'], $item['description'] ?? '', $item['quantity'], $item['unit_price']]
                );
                $total += $item['quantity'] * $item['unit_price'];
            }

            Database::execute("UPDATE purchase_orders SET total_amount = ? WHERE id = ?", [$total, $po_id]);
            $pdo->commit();
            echo json_encode(['success' => true, 'id' => $po_id, 'po_no' => $po_no, 'message' => 'Purchase Order created successfully']);
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    // ── PUT: Update PO
    case 'PUT':
        $id   = (int)($_GET['id'] ?? 0);
        $body = json_decode(file_get_contents('php://input'), true);
        if (!$id || !$body) { http_response_code(400); echo json_encode(['error' => 'Invalid request']); break; }

        Database::execute(
            "UPDATE purchase_orders SET supplier_id = ?, po_date = ?, status = ? WHERE id = ?",
            [$body['supplier_id'], $body['po_date'], $body['status'], $id]
        );
        echo json_encode(['success' => true, 'message' => 'Purchase Order updated successfully']);
        break;

    // ── DELETE
    case 'DELETE':
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'Invalid ID']); break; }
        Database::execute("DELETE FROM purchase_orders WHERE id = ?", [$id]);
        echo json_encode(['success' => true, 'message' => 'Purchase Order deleted']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
