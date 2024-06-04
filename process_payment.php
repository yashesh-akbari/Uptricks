$name = $_POST['name'];
$email = $_POST['email'];
$amount = $_POST['amount'];

$data = [
    'amount' => $amount * 100, // Razorpay accepts amount in paisa
    'currency' => 'INR',
    'receipt' => 'order_rcptid_' . time(),
    'payment_capture' => 1
];

$order = $razorpay->order->create($data);

$razorpayPaymentId = $_POST['razorpay_payment_id'];
$razorpayOrderId = $_POST['razorpay_order_id'];
$razorpaySignature = $_POST['razorpay_signature'];

$attributes = [
    'razorpay_order_id' => $razorpayOrderId,
    'razorpay_payment_id' => $razorpayPaymentId,
    'razorpay_signature' => $razorpaySignature
];

$razorpay->utility->verifyPaymentSignature($attributes);
$orderId = $order['id'];

$orderData = [
    'key' => $keyId,
    'amount' => $data['amount'],
    'name' => 'Your Company Name',
    'description' => 'Payment for Products',
    'order_id' => $orderId,
    'handler' => '',
    'prefill' => [
        'name' => $name,
        'email' => $email,
        'contact' => ''
    ],
    'notes' => [
        'address' => 'Address'
    ],
    'theme' => [
        'color' => '#3399cc'
    ]
];
