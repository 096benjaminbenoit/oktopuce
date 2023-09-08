import React, { useCallback, useEffect, useState } from 'react';
import Button from './Button';

const Scan = () => {
    const [message, setMessage] = useState('');
    const [serialNumber, setSerialNumber] = useState('');

    const scan = useCallback(async () => {
        // Your scan logic here
    }, []);

    const onReading = event => {
        // Your onReading logic here
    };

    // Function to handle button click
    const handleButtonClick = () => {
        // Call the scan function when the button is clicked
        scan();
    };

    useEffect(() => {
        // Call the scan function when the component mounts
        scan();
    }, [scan]);

    return (
        <div>
            <p>Serial Number: {serialNumber}</p>
            <p>Message: {message}</p>
            <button onClick={handleButtonClick}>oui</button>
        </div>
    );
};

export default Scan;
