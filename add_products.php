<?php
include 'db_connect.php';

// Przykładowe produkty
$products = [
    [
        'name' => 'Produkt 1',
        'description' => 'Opis produktu 1',
        'price' => 99.99,
        'image' => 'images/product1.jpg'
    ],
    [
        'name' => 'Produkt 2',
        'description' => 'Opis produktu 2',
        'price' => 149.99,
        'image' => 'images/product2.jpg'
    ],
    [
        'name' => 'Produkt 3',
        'description' => 'Opis produktu 3',
        'price' => 199.99,
        'image' => 'images/product3.jpg'
    ]
];

foreach ($products as $product) {
    $name = $product['name'];
    $description = $product['description'];
    $price = $product['price'];
    $image = $product['image'];

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Produkt $name został dodany pomyślnie.<br>";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error . "<br>";
    }
}

$conn->close();
?>
