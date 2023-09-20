import React, { useCallback, useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Button from './Button';

const Scan = () => {
    const [message, setMessage] = useState('');
    const [serialNumber, setSerialNumber] = useState('');
    const navigate = useNavigate();

    const scan = useCallback(async () => {
        if ('NDEFReader' in window) {
            try {
                const ndef = new NDEFReader();
                await ndef.scan();

                console.log("Scan started successfully.");
                ndef.onreadingerror = () => {
                    console.log("Cannot read data from the NFC tag. Try another one?");
                };

                ndef.onreading = event => {
                    console.log("NDEF message read.");
                    onReading(event);
                    for (const record of event.message.records) {
                        switch(record.recordType) {
                            case "url":
                                const decoded = decodeRecord(record);
                                const url = new URL(decoded);
                                if (url.origin == window.location.origin) {
                                    const match = url.pathname.match(/equipment\/([0-9a-f]{8}(?:-[0-9a-f]{4}){4}[0-9a-f]{8}$)$/i);
                                    if(match) {
                                        const uuid = match[1];
                                        navigate(`/equipment/${uuid}`);
                                    }
                                }
                        }
                    }
                };

            } catch (error) {
                console.log(`Error! Scan failed to start: ${error}.`);
            };
        }
    });

    const onReading = ({ message, serialNumber }) => {
        setSerialNumber(serialNumber);
        for (const record of message.records) {
            switch (record.recordType) {
                case "text":
                    const textDecoder = new TextDecoder(record.encoding);
                    setMessage(textDecoder.decode(record.data));
                    break;
                case "url":
                    record.data
                    break;
                default:
                // TODO: Handle other records with record data.
            }
        }
    };

    useEffect(() => {
        scan();
    }, [scan]);

    return (
        <>
            {actions.scan === 'scanned' ?
                <div>
                    <p>Serial Number: {serialNumber}</p>
                    <p>Message: {message}</p>
                </div>
                : <Scanner status={actions.scan}></Scanner>}
        </>
    );
};

export default Scan;

function decodeRecord(record: NDEFRecord) {
    const textDecoder = new TextDecoder(record.encoding);
    return textDecoder.decode(record.data);
}

