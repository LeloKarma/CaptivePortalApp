import React, { useState } from 'react';
import axios from 'axios';

const PaymentForm = ({ planId }) => {
    const [phoneNumber, setPhoneNumber] = useState('');
    const [loading, setLoading] = useState(false);
    const [errorMessage, setErrorMessage] = useState('');

    const handlePayment = async (event) => {
        event.preventDefault();
        setLoading(true);
        setErrorMessage('');

        try {
            const response = await axios.post('/payment', {
                planId: planId,
                phoneNumber: phoneNumber,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Get CSRF token from meta tag
            });

            if (response.status === 200) {
                window.location.href = '/thank-you'; // Redirect to thank you page
            }
        } catch (error) {
            setErrorMessage('Payment failed. Please try again.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="max-w-md mx-auto mt-8">
            <h2 className="text-2xl font-bold mb-4">Payment Details</h2>
            <form onSubmit={handlePayment} className="space-y-4">
                <input
                    type="hidden"
                    name="planId"
                    value={planId}
                />
                <input
                    type="text"
                    id="phoneNumber"
                    name="phoneNumber"
                    placeholder="Enter your phone number"
                    value={phoneNumber}
                    onChange={(e) => setPhoneNumber(e.target.value)}
                    className="w-full px-3 py-2 border rounded"
                    required
                />
                <button
                    type="submit"
                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    disabled={loading}
                >
                    {loading ? 'Processing...' : 'Initiate Payment'}
                </button>
                {loading && (
                    <div className="text-center">
                        <p>Loading...</p>
                        {/* Add loading animation or spinner here */}
                    </div>
                )}
                {errorMessage && (
                    <div className="text-red-500">
                        <p>{errorMessage}</p>
                    </div>
                )}
            </form>
        </div>
    );
};

export default PaymentForm;
