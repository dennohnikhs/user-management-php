<?php
include './database/connection.php';
include './database/products-fetch.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include './includes/header.php'; ?>
    <main>
        <h1>Products</h1>
        <p>Below is a list of all products in the system:</p>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Line</th>
                        <th>Scale</th>
                        <th>Vendor</th>
                        <th>Description</th>
                        <th>Buying Price</th>
                        <th>Suggested Retail Price</th>
                        <th>In Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['productCode']); ?></td>
                        <td><?php echo htmlspecialchars($product['productName']); ?></td>
                        <td><?php echo htmlspecialchars($product['productLine']); ?></td>
                        <td><?php echo htmlspecialchars($product['productScale']); ?></td>
                        <td><?php echo htmlspecialchars($product['productVendor']); ?></td>
                        <td>
                            <p class="product-description">
                                <?php echo htmlspecialchars($product['productDescription']); ?>
                            </p>
                        </td>
                        <td><?php echo htmlspecialchars($product['buyPrice']); ?></td>
                        <td><?php echo htmlspecialchars($product['MSRP']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantityInStock']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

    <?php include './includes/footer.php'; ?>
    <script src="./assets/js/script.js"></script>
</body>

</html>