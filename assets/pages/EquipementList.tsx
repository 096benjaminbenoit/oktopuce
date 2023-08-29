import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { Form, useForm } from 'react-hook-form';
import { Link } from 'react-router-dom';
import { useQuery } from '@tanstack/react-query';
import Select from '../components/Select';
import { Spinner } from 'react-bootstrap';

type Equipment = {
  "@context": string,
  "@id": string,
  "@type": string,
  "id": number,
  "installationDate": "2023-08-29T12:52:33.579Z",
  "serialNumber": string,
  "parent": string,
  "equipment": [
    string
  ],
  "nfcTag": {
    "@context": string,
    "@id": string,
    "@type": string,
    "equipment": string
  },
  "brand": string,
  "location": string,
  "locationDetail": string,
  "equipmentType": {
    "@context": "string",
    "@id": "string",
    "@type": "string",
    "type": "string"
  },  "placement": string,
  "remoteNumber": string,
  "gas": {
    "@context": string,
    "@id": string,
    "@type": string,
    "name": string
  },
  "gasWeight": number,
  "hasLeakDetection": true,
  "lastLeakDetection": "2023-08-29T12:52:33.580Z",
  "nextLeakDetection": "2023-08-29T12:52:33.580Z",
  "finality": [
    string
  ],
  "capacity": number,
  "picto": string,
  "interventions": [
    {
      "@context": string,
      "@id": string,
      "@type": string,
      "interventionDate": "2023-08-29T12:52:33.580Z"
    }
  ]
}

function EquipmentList() {
  const { isLoading: isEquipmentLoading, error: equipmentError, data: equipment } = useQuery({
    queryKey: ['equipment'],
    queryFn: () => fetch('/api/equipment.jsonld').then(res => res.json()),
  });

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<Equipment>();

  if (isEquipmentLoading) {
    return <Spinner />;
  }

  const equipments: Equipment[] = equipment["hydra:member"];

  return (
    <>
      <NavBar />
      <div className="container text-center mt-4">
        <h1>Equipement</h1>
      </div>
      <div className="container mt-4">
        <div className="card mx-auto" style={{ maxWidth: "500px" }}>
          <div className="card-body">
            {equipments.map(equipment => (
              <div key={equipment['@id']} className="equipment-item">
                <p>{equipment.equipmentType.type}</p>
              </div>
            ))}
            <div className="container text-center mt-3">
              <Button.Link path="/" className="text-uppercase btnHome mb-3" variant="primary">
                Valider
              </Button.Link>
            </div>
            <Link to={''}></Link>
          </div>
        </div>
      </div>
    </>
  );
}

export default EquipmentList;