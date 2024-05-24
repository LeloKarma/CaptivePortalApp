import React from 'react';
import PaymentForm from './PaymentForm';

function App() {
    // Assume you pass planId as a prop or fetch it from the backend
    const planId = 1; // Replace with actual planId

    return (
        <div className="App">
            <header className="bg-gray-800 py-4">
                <div className="max-w-6xl mx-auto flex items-center justify-center">
                    <img src="" alt="Logo" className="h-12 mr-2" />
                    <span className="text-xl font-semibold text-white">SDM Wi-Fi Portal</span>
                </div>
            </header>
            <main>
                <PaymentForm planId={planId} />
            </main>
        </div>
    );
}

export default App;
