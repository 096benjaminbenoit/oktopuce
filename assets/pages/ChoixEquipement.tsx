import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import NavBar from '../components/NavBar';
import Input from '../components/Input';
import { Link, useParams } from "react-router-dom";
import Select from '../components/Select';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import { useQuery } from "@tanstack/react-query";
import { Spinner } from 'react-bootstrap';


type EquipementForm = {
    name: string;
    address: string;
    city: string;
    postCode: string;
    phoneNumber: string;
    email: string;
    site: string;
    equipement: string;
    unity: string;
    unityType: string;
    prestataire: {
        name: string;
        phoneNumber: string;
        email: string;
    }
}

interface Client {
    "@id": string;
    "@type": "Client";
    id: number;
    address: string;
    postCode: string;
    city: string;
    phone: string;
    email: string;
    sites: any[];
}

interface EquipementType {
    "@context": "string",
    "@id": "string",
    "@type": "string",
    id: 0;
    type: string;
    equipment: [
        string
    ]
}


function Equipement() {
    //const params = useParams();
    const { isLoading: isClientLoading, error: clientError, data: client } = useQuery({
        queryKey: ['clients'],
        queryFn: ({ queryKey: [type] }) =>
            fetch(`/api/${type}.jsonld`).then(
                (res) => res.json(),
            ),
    });

    const { isLoading: isEquipmentTypeLoading, error: equipmentTypeError, data: equipmentType } = useQuery({
        queryKey: ['equipment_types'],
        queryFn: ({ queryKey: [type] }) =>
            fetch(`/api/${type}.jsonld`).then(
                (res) => res.json(),
            ),
    });

    const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
    } = useForm<EquipementForm>();

    if (isClientLoading || isEquipmentTypeLoading) {
        return <Spinner />
    }
    const clients: Client[] = client["hydra:member"];

    const equipment_types: EquipementType[] = equipmentType["hydra:member"];

    // return <>
    //     <pre>{JSON.stringify(equipment_types, null, 4)}</pre>
    // </>;

    return (
        <>
            <NavBar />
            <div className="container text-center mt-4">
                <h1>Paramétrage Puce</h1>
            </div>
            <div className="container mt-4">
                <div className="card mx-auto" style={{ maxWidth: "500px" }}>
                    <div className="card-body">
                        <Form>
                            <Form.Group className="mb-3">
                                <Form.Label>Sur quel site est le produit ?</Form.Label>
                                <Select {...register("site")}
                                    options={
                                        clients.map(client => ({ label: client.address, value: client['@id'] }))
                                    }
                                />
                            </Form.Group>
                            <Form.Group className="mb-3">
                                <Form.Label>Sur quel site est installé la puce ?</Form.Label>
                                <Select {...register("equipement")}
                                    options={
                                        equipment_types.map(equipment_type => ({ label: equipment_type.type, value: equipment_type['@id'] }))
                                    }
                                />
                            </Form.Group>

                            <div className="container text-center mt-3">
                                <Button.Link path='/' className='text-uppercase btnHome mb-3' variant="primary">Valider</Button.Link>
                            </div>

                            <Link to={''}></Link>
                        </Form>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Equipement;