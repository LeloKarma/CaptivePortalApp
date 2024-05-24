// frontend/src/components/Payment.js
import React, { useState } from 'react';
import axios from 'axios';

const Payment = () => {
    const [phoneNumber, setPhoneNumber] = useState('');
    const [amount, setAmount] = useState('');
    const [paymentResult, setPaymentResult] = useState(null);

    const handlePayment = async () => {
        const response = await axios.post('/api/initiate-payment', { amount, phoneNumber });
        setPaymentResult(response.data);
    };

    return (
        <div>
            <h1>Make a Payment</h1>
            <input
                type="text"
                placeholder="Phone Number"
                value={phoneNumber}
                onChange={(e) => setPhoneNumber(e.target.value)}
            />
            <input
                type="text"
                placeholder="Amount"
                value={amount}
                onChange={(e) => setAmount(e.target.value)}
            />
            <button onClick={handlePayment}>Pay</button>
            {paymentResult && <div>Payment Status: {paymentResult.status}</div>}
        </div>
    );
};

export default Payment;
