import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import NavBar from '../components/NavBar';
import Input from '../components/Input';
import { Link, useParams } from "react-router-dom";
import Select from '../components/Select';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import { useQuery } from "@tanstack/react-query";


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

function Equipement() {
    //const params = useParams();
    const { isLoading, error, data } = useQuery({
        queryKey: ['clients'],
        queryFn: ({ queryKey: [type] }) =>
            fetch(`/api/${type}.jsonld`).then(
                (res) => res.json(),
            ),
    })

    return <>
        {/* <pre>{JSON.stringify(params, null, 4)}</pre> */}
        <pre>{JSON.stringify(data, null, 4)}</pre>
    </>;


    const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
    } = useForm<EquipementForm>()

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
                                    options={[
                                        { label: 'Oui', value: 'oui' },
                                        { label: 'Non', value: 'non' }
                                    ]}
                                />
                            </Form.Group>
                            <Form.Group className="mb-3">
                                <Form.Label>Sur quel site est installé la puce ?</Form.Label>
                                <Select {...register("equipement")}
                                    options={[
                                        { label: 'Climatisation', value: 'climatisation' },
                                        { label: 'Pompe à chaleur', value: 'pompe a chaleur' },
                                        { label: 'Chauffe-eau thermodynamique', value: 'chauffe-eau thermodynamique' },
                                    ]}
                                />
                            </Form.Group>
                            <Form.Group className="mb-3">
                                <Form.Label>A quel endroit ?</Form.Label>
                                <Select {...register("unity")}
                                    options={[
                                        { label: 'Unité intérieure', value: 'unite interieur' },
                                        { label: 'Unité extérieur', value: 'unite exterieur' },
                                    ]}
                                />
                            </Form.Group>
                            <Form.Group className="mb-3">
                                <Form.Label>Type d'unité ?</Form.Label>
                                <Select {...register("unityType")}
                                    options={[
                                        { label: 'Cassette', value: 'cassette' },
                                        { label: 'Console', value: 'console' },
                                        { label: 'Gainable', value: 'gainable' },
                                        { label: 'Monobloc', value: 'monobloc' },
                                        { label: 'Mural', value: 'mural' },
                                        { label: 'Plafonnier', value: 'plafonnier' },
                                    ]}
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