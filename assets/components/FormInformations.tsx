import React from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { useForm } from 'react-hook-form';
import Button from '../components/Button';

type InfosUserForm = {
  firstName: string;
  lastName: string;
  language: string;
  type: string;
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

export default function FormInformations() {

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<InfosUserForm>()

  return (<>
  <Form.Group className="mb-3">
    <Form.Label>Langue</Form.Label>
    <Select {...register("language")} value="Langue" options={[{value: 'Français', label: 'Français'}]}></Select>
  </Form.Group>

  <Form.Group className="mb-3">
    <Form.Label>Type</Form.Label>
    <Select {...register("type")} value="Type" options={[{value: 'Particulier', label: 'Particulier'}, {value: 'Professionnel', label: 'Professionnel'}]}></Select>
  </Form.Group>
  
      <Input {...register("firstName")} label="Nom" name=""></Input>
      <Input {...register("lastName")} label="Prénom" name=""></Input>
      <Input {...register("address")} label="N° et nom de la rue" name=""></Input>
      <Input {...register("postCode")} label="Code postal" name=""></Input>
      <Input {...register("city")} label="Ville" name=""></Input>
      <Input {...register("phoneNumber")} label="Téléphone" name=""></Input>
      <Input {...register("email")} label="Email" name=""></Input>
    </>
  );
}