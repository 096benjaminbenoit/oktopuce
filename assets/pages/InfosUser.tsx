import React from 'react';
import NavBar from '../components/NavBar';
import Button from '../components/Button';
import { useForm } from 'react-hook-form';
import FormInformations from '../components/FormInformations';

type InfosUserForm = {
  name: string;
  address: string;
  city: string;
  postCode: string;
  phoneNumber: string;
  email: string;
  type: string;
  prestataire: {
    name: string;
    phoneNumber: string;
    email: string;
  }
}

export default function Informations() {

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<InfosUserForm>()

  return (<>
    <NavBar></NavBar>
    <NavBar></NavBar>

    <h1>Nouveau Profil</h1>
    <Form.Group className="mb-3">
      <Form.Label>Langue</Form.Label>
      <Select {...register("type")} value="Type" options={[{ value: 'Français', label: 'Français' }]}></Select>
    </Form.Group>
    <Form.Group className="mb-3">
      <Form.Label>Type</Form.Label>
      <Select {...register("type")} value="Type" options={[{ value: 'Particulier', label: 'Particulier' }, { value: 'Professionnel', label: 'Professionnel' }]}></Select>
    </Form.Group>
    <Input {...register("name")} label="Nom" name=""></Input>
    <Input {...register("name")} label="Prénom" name=""></Input>
    <Input {...register("address")} label="N° et nom de la rue" name=""></Input>
    <Input {...register("postCode")} label="Code postal" name=""></Input>
    <Input {...register("city")} label="Ville" name=""></Input>
    <Input {...register("phoneNumber")} label="Téléphone" name=""></Input>
    <Input {...register("email")} label="Email" name=""></Input>

    <Button.Link path='/' className='text-uppercase btnHome mb-3' variant="primary">Valider</Button.Link>
  </>
  );
}