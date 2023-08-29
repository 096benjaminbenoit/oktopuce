import React from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { useForm } from 'react-hook-form';
import { useQuery } from '@tanstack/react-query';

type CreateInterForm = {
  entreprise:{
    name: string;
  } 
  intervention: {
    type: string;
  }
  technicien: string;
}

interface Intervention {
  "@context": "string",
  "@id": "string",
  "@type": "string",
  id: 0,
  "technician": "string",
  "enterprise": "string",
  "person": "string",
  equipment: string,
  response: [
    string
  ],
  "interventionTypes": [
    "string"
  ],
  "interventionDate": "2023-08-29T08:49:15.923Z"
}

interface InterventionType {
  "@context": "string",
  "id": 0,
  "type": "string",
  "interventionQuestion": [
    "string"
  ],
  "interventions": [
    "string"
  ]
}

export default function CreateIntervention() {

  const { isLoading: isInterventionTypeLoading, error: interventionTypeError, data: interventionTypes } = useQuery({
    queryKey: ['intervention_types'],
    queryFn: ({ queryKey: [type] }) =>
        fetch(`/api/${type}.jsonld`).then(
          (res) => res.json(),
    ),
});

  // const { isLoading: isEquipmentTypeLoading, error: equipmentTypeError, data: equipmentType } = useQuery({
  //   queryKey: ['equipment_types'],
  //   queryFn: ({ queryKey: [type] }) =>
  //       fetch(`/api/${type}.jsonld`).then(
  //         (res) => res.json(),
  //   ),
  // });

  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
  } = useForm<CreateInterForm>()

  const equipment_types: InterventionType[] = interventionTypes["hydra:member"];

  return (<>
    {/* Picto du produit correspondant */}
    <hr />
    <h2>Intervenant</h2>

    <Input {...register("entreprise.name")} label="Nom de l'entreprise :" name=""></Input>
    <Input {...register("technicien")} label="Nom du technicien :" name=""></Input>

    <h2>Type d'intervention</h2>

    <Form.Group className="mb-3">
      <Select {...register("intervention.type")} value="Type" 
        options={
          interventionTypes.map((intervention_type: { [x: string]: any; type: any; }) => ({ label: intervention_type.type, value: intervention_type['@id'] }))
        }
      />
    </Form.Group>

  </>
  );
}

// [{value: 'Mise en service', label: 'Mise en service'}, {value: 'Entretien', label: 'Entretien'}, {value: 'Dépannage', label: 'Dépannage'}, {value: 'Dépose/Repose', label: 'Dépose/Repose Temporaire'}, {value: 'Dépose Définitive', label: 'Dépose Définitive'}]}