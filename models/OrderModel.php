<?php
    class OrderModel{
        public function select_order_id() {
            $sql = "SELECT order_id FROM orders ORDER BY date DESC LIMIT 1";

            return pdo_query_one($sql);
        }


        // Select thông tin đon hàng
        public function select_list_orders($user_id) {
            $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC";

            return pdo_query($sql, $user_id);
        }

        public function count_orders_by_user($user_id) {
            $sql = "SELECT COUNT(*) FROM orders WHERE user_id = ?";
            return (int) pdo_query_value($sql, $user_id);
        }

        public function select_list_orders_with_points($user_id, $limit = 10, $offset = 0) {
            $limit = max(1, min(100, (int) $limit));
            $offset = max(0, (int) $offset);

            $sql = "SELECT
                    o.order_id,
                    o.date,
                    o.total,
                    o.status,
                    pt.points_change,
                    (
                        SELECT p.image
                        FROM orderdetails od
                        INNER JOIN products p ON p.product_id = od.product_id
                        WHERE od.order_id = o.order_id
                        ORDER BY od.product_id ASC
                        LIMIT 1
                    ) AS thumb_image
                FROM orders o
                LEFT JOIN points_transactions pt
                    ON pt.order_id = o.order_id AND pt.reason = 'order_completed'
                WHERE o.user_id = ?
                ORDER BY o.order_id DESC
                LIMIT $limit OFFSET $offset";

            return pdo_query($sql, $user_id);
        }

        public function select_orderdetails_and_products($order_id) {
            $sql = "
                    SELECT
                    products.product_id,
                    products.name AS product_name,
                    products.image,
                    orderdetails.quantity,
                    orderdetails.price AS product_price
                FROM
                    products
                JOIN
                    orderdetails ON products.product_id = orderdetails.product_id
                WHERE order_id = ?;
            ";

            return pdo_query($sql, $order_id);
        }

        public function getFullOrderInformation($user_id, $order_id) {
            $sql = "
                    SELECT
                    orders.order_id,
                    orders.user_id,
                    orders.date AS order_date,
                    orders.total,
                    orders.address AS order_address,
                    orders.phone AS order_phone,
                    orders.note,
                    orders.status,
                    users.full_name,
                    users.email,
                    users.phone AS user_phone,
                    orderdetails.product_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name AS product_name,
                    products.image AS product_image
                FROM
                    orders
                JOIN
                    users ON orders.user_id = users.user_id
                JOIN
                    orderdetails ON orders.order_id = orderdetails.order_id
                JOIN
                    products ON orderdetails.product_id = products.product_id
                WHERE orders.user_id = ? AND orders.order_id = ?
                
            ";

            return pdo_query($sql, $user_id, $order_id);
        }


        public function insert_orders($user_id, $total, $address, $phone, $note) {
            $sql = "INSERT INTO orders(user_id, total, address, phone, note) VALUES(?,?,?,?,?)";

            pdo_execute($sql, $user_id, $total, $address, $phone, $note);
        }

        public function insert_orderdetails($order_id, $product_id, $quantity, $price) {
            $sql = "INSERT INTO orderdetails(order_id, product_id, quantity, price) VALUES(?,?,?,?)";

            pdo_execute($sql, $order_id, $product_id , $quantity, $price);
        }

        public function delete_cart_by_user_id($user_id) {
            $sql = "DELETE FROM carts WHERE user_id = ?";
            pdo_execute($sql, $user_id);
        }
    }

    $OrderModel = new OrderModel();
?>