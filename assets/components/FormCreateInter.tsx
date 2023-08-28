import React from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { useForm } from 'react-hook-form';
import Button from '../components/Button';

type CreateInterForm = {
  firstName: string;
  lastName: string;
  language: string;
  type: string;
  address: string;
  city: string;
  postCode: string;
  phoneNumber: string;
  email: string;
  entreprise: string;
  technicien: string;
  intervention: {
    type: string;
  }
  prestataire: {
    name: string;
    phoneNumber: string;
    email: string;
  }
}

export default function CreateIntervention() {

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<CreateInterForm>()

  return (<>
    {/* Picto du produit correspondant */}
    <hr />
    <h2>Intervenant</h2>

    <Form.Group className="mb-3">
      <Form.Label>Nom de l'entreprise :</Form.Label>
      <Select {...register("entreprise")} value="entreprise" options={[{value: 'ClimPropre', label: 'ClimPropre'}, {value: 'Autre', label: 'Autre'}]}></Select>

      <Form.Label>Nom du technicien :</Form.Label>
      <Select {...register("technicien")} value="technicien" options={[{value: 'John Doe', label: 'John Doe'}, {value: 'Bruno Barlier', label: 'Bruno Barlier'}, {value: 'Nouveau Technicien', label: 'Nouveau Technicien'}]}></Select>
    </Form.Group>

    <h2>Type d'intervention</h2>

    <Form.Group className="mb-3">
      <Select {...register("intervention.type")} value="Type" options={[{value: 'Mise en service', label: 'Mise en service'}, {value: 'Entretien', label: 'Entretien'}, {value: 'Dépannage', label: 'Dépannage'}, {value: 'Dépose/Repose', label: 'Dépose/Repose Temporaire'}, {value: 'Dépose Définitive', label: 'Dépose Définitive'}]}></Select>
    </Form.Group>

  </>
  );
}