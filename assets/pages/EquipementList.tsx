import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { Link } from 'react-router-dom';
import { useQuery } from '@tanstack/react-query';
import { Spinner } from 'react-bootstrap';

// import type { Equipment } from '../api/type';

function EquipmentList() {
  const { isLoading: isEquipmentLoading, error: equipmentError, data: equipment } = useQuery({
    queryKey: ['equipment'],
    queryFn: () => fetch('/api/equipment.jsonld').then(res => res.json()),
  });

  if (isEquipmentLoading) {
    return <Spinner />;
  }

  // const equipments: Equipment[] = equipment["hydra:member"];

  return (
    <>
      <NavBar />
      <div className="container text-center mt-4">
        <h1>Equipement</h1>
      </div>
      <div className="container mt-4">
        <div className="card mx-auto" style={{ maxWidth: "500px" }}>
          <div className="card-body">
            {/* {equipments.map(equipment => (
              <div key={equipment['@id']} className="equipment-item">
                <p>{equipment.equipmentType.type}</p>
              </div>
            ))} */}
            <div className="container text-center mt-3">
              <Button type="submit" className="text-uppercase btnHome mb-3" variant="primary">
                Valider
              </Button>
            </div>
            <Link to={''}></Link>
          </div>
        </div>
      </div>
    </>
  );
}

export default EquipmentList;