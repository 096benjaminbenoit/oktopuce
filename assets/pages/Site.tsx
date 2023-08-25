import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import NavBar from '../components/NavBar';
import Input from '../components/Input';
import { Link } from "react-router-dom";
import Select from '../components/Select';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';

type SiteForm = {
    name: string;
    address: string;
    city: string;
    postCode: string;
    phoneNumber: string;
    email: string;
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

  return (
    <><NavBar></NavBar>
    <h1>Ajouter un site</h1>
    <Form>
            <Input {...register("name")} label="Nom" placeholder="Entez le nom du lieu" />
            <Input {...register("address")} label="Adresse" placeholder="Entrez l'adresse du lieu" />
            <Input {...register("postCode")} label="Code postal" placeholder="Entrez le code postale du lieu" />
            <Input {...register("city")} label="Ville" placeholder="Entrez le nom de la ville" />
            <Input {...register("phoneNumber")} label="Numéro de téléphone" placeholder="Entrez le numéro de téléphone" />
            <Input {...register("email")} label="Email" placeholder="Entez votre email" />
        <h2>Prestataire de maintenance</h2>
      <Form.Group className="mb-3">
          <Form.Label>Prestataire Maintenance</Form.Label>
          <Select {...register("prestataire")}
            options={[
              { label: 'Oui', value: 'oui' },
              { label: 'Non', value: 'non' }
            ]} 
          />
        </Form.Group>
        <Input {...register("prestataire.name")} label="Nom prestataire" placeholder="Entez le nom du prestataire" />
        <Input {...register("prestataire.phoneNumber")} label="Numéro prestataire" placeholder="Entez le numéro du prestataire" />
        <Input {...register("prestataire.email")} label="Numéro prestataire" placeholder="Entez le numéro du prestataire" />

          <Button.Link path='/' className='text-uppercase btnHome mb-3' variant="primary">Valider</Button.Link>

          <Link to={''}></Link>
      </Form></>
  );
}

export default CreateSite;