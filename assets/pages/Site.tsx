import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import NavBar from '../components/NavBar';
import Input from '../components/Input';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';

type SiteForm = {
    name: string;
    address: string;
    city: string;
    postCode: string;
    phoneNumber: string;
    email: string;
    hasPrestataire: boolean;
    prestataire: {
        name: string;
        phoneNumber: string;
        email: string;
    }
}

function CreateSite() {

    const {
        register,
        handleSubmit,
        watch,
        formState: { errors },
    } = useForm<SiteForm>()

    const hasPrestataire = watch("hasPrestataire");
    // const [hasPrestataire, setHasPrestataire] = useState(false);

    return (
        <>
            <NavBar />
            <div className="container text-center mt-4">
                <h1>Ajouter un site</h1>
            </div>
            <div className="container mt-4 mb-4">
                <div className="card mx-auto" style={{ maxWidth: "500px" }}>
                    <div className="card-body">
                        <Form>
                            <Input {...register("name")} label="Nom" placeholder="Entez le nom du lieu" />
                            <Input {...register("address")} label="Adresse" placeholder="Entrez l'adresse du lieu" />
                            <Input {...register("postCode")} label="Code postal" placeholder="Entrez le code postal du lieu" />
                            <Input {...register("city")} label="Ville" placeholder="Entrez le nom de la ville" />
                            <Input {...register("phoneNumber")} label="Numéro de téléphone" placeholder="Entrez le numéro de téléphone" />
                            <Input {...register("email")} label="Email" placeholder="Entez votre email" />

                            <div className="container text-center mt-5">
                                <h2>Prestataire de maintenance</h2>
                            </div>
                            <Form.Group className="mb-3 mt-5">
                                <Form.Check>
                                    <Form.Check.Input
                                        type="checkbox"
                                        {...register("hasPrestataire")}
                                    // onChange={() => setHasPrestataire(!hasPrestataire)}
                                    />
                                    <Form.Check.Label>Prestataire Maintenance</Form.Check.Label>
                                </Form.Check>
                            </Form.Group>
                            {hasPrestataire && (
                                <>
                                    <Input {...register("prestataire.name")} label="Nom prestataire" placeholder="Entez le nom du prestataire" />
                                    <Input {...register("prestataire.phoneNumber")} label="Numéro prestataire" placeholder="Entez le numéro du prestataire" />
                                    <Input {...register("prestataire.email")} label="Email prestataire" placeholder="Entez l'email du prestataire" />
                                </>
                            )}
                            <div className="container text-center mt-3">
                                <Button type="submit" className='text-uppercase btnHome mb-3' variant="primary">Valider</Button>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
        </>
    );
}

export default CreateSite;