<?php
include 'header.php';
include 'rates.php';

// INFO VARIABLES
$customerName = 'Janrei D. Arceo';
$customerType = 'student';
$printType = 'colored';
$pages = 3;
$copies = 4;
$paymentMethod = 'cash';
$amountPaid = 150;

// PRICE CHECK PER PAGE
$pricePerPage = match ($printType) {
     'blackWhite' => $blackWhiteRate,
     'colored' => $coloredRate,
     'photo' => $photoRate,
     default => 0
};
$subtotal = $pricePerPage * $pages * $copies;
if ($customerType === 'student') {
    $discountRate = .10;
} elseif ($customerType === 'faculty') {
    $discountRate = .05;
} else {
    $discountRate = 0;
}
$discount = $subtotal * $discountRate;
$total = $subtotal - $discount;

// PAYMENT METHOD
switch ($paymentMethod) {
    case 'cash' : $paymentLabel = 'Cash Payment'; break;
    case 'gcash' : $paymentLabel = 'GCash Payment'; break;
    default: $paymentLabel = 'Unknown Payment Method';
}


echo '<h1>Campus Printing Service</h1>';
echo '<p>Customer: '. htmlspecialchars($customerName) . '</p>';
echo '<p>Service: '. htmlspecialchars($printType) . '</p>';
echo '<h3>Printing Breakdown</h3>';
for ($i = 1; $i <= $copies; $i++) {
    echo 'Copy ' . $i . ': PHP ' . 
        number_format($pricePerPage * $pages, 2) . '<br>';
}
echo '<h3>Preparation Status</h3>';
$counter = 1;
while ($counter <= $copies) {
    echo 'Preparing Copy ' . $counter . ' of ' . $copies . '<br>';
    $counter++;
}
echo '<p>Subtotal: PHP ' . number_format($subtotal, 2) . '</p>';
echo '<p>Discount: PHP ' . number_format($discount, 2) . '</p>';
echo '<h1>Total Bill: PHP ' . number_format($total, 2) . '</h1>';
echo '<p>Method: ' . $paymentLabel . '</p>';
if ($amountPaid >= $total) {
    echo '<p>Payment Successful! Change: PHP ' . number_format($amountPaid - $total, 2) . '</p>';
} else {
    echo '<p>Insufficient Payment! Shortage: PHP ' . number_format($total - $amountPaid, 2) . '</p>';
}
include 'footer.php';
?>