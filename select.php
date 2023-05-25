<?php

$servername = "localhost";
$username = "root";
$password = "Zinedine020";
$dbname = "supermarkt";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kan geen verbinding maken met de database: " . $conn->connect_error);
}

// Hoe je alles selecteert in een query zonder variabele
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

echo "<h2>Alle Producten</h2>";

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Productnaam</th><th>Prijs per stuk</th><th>Omschrijving</th></tr>";

    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["product_naam"] . "</td>";
        echo "<td>" . $row["prijs_per_stuk"] . "</td>";
        echo "<td>" . $row["omschrijving"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Geen producten gevonden.";
}


$sql = "SELECT * FROM Products WHERE product_id = ?";
$productId = 1;

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

echo "<h2>Product met product_code 1</h2>";

if ($product) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Productnaam</th><th>Prijs per stuk</th><th>Omschrijving</th></tr>";
    echo "<tr>";
    echo "<td>" . $product["product_id"] . "</td>";
    echo "<td>" . $product["product_naam"] . "</td>";
    echo "<td>" . $product["prijs_per_stuk"] . "</td>";
    echo "<td>" . $product["omschrijving"] . "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "Product niet gevonden.";
}


$sql = "SELECT * FROM Products WHERE product_id = :productId";
$productId = 2;

$stmt = $conn->prepare($sql);
$stmt->bindParam(":productId", $productId);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

echo "<h2>Product met product_code 2</h2>";

if ($product) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Productnaam</th><th>Prijs per stuk</th><th>Omschrijving</th></tr>";
    echo "<tr>";
    echo "<td>" . $product["product_id"] . "</td>";
    echo "<td>" . $product["product_naam"] . "</td>";
    echo "<td>" . $product["prijs_per_stuk"] . "</td>";
    echo "<td>" . $product["omschrijving"] . "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "Product niet gevonden.";
}


$conn->close();
?>