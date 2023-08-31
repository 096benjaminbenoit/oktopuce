import React from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { useForm } from 'react-hook-form';
import { useQuery } from '@tanstack/react-query';
import { Spinner } from 'react-bootstrap';

type CreateInterForm = {
  entreprise: string;
  interventionType: string,
  technicien: string;
}

interface InterventionType {
  "@context": string,
  "id": 0,
  "type": string,
  "interventionQuestion": [
    string
  ],
  "interventions": [
    string
  ]
}

export default function CreateIntervention() {

  const { isLoading: isInterventionTypeLoading, error: interventionTypeError, data: interventionType } = useQuery({
    queryKey: ['intervention_types'],
    queryFn: ({ queryKey: [interventionTypes] }) =>
        fetch(`/api/${interventionTypes}.jsonld`).then(
          (res) => res.json(),
    ),
});

const {
  register,
  handleSubmit,
  watch,
  formState: { errors },
} = useForm<CreateInterForm>()

  if (isInterventionTypeLoading) {
    return <Spinner />;
  }

  const interventionTypes: InterventionType[] = interventionType["hydra:member"];

  return (<>
    {/* Picto du produit correspondant */}
    <hr />
    <h2>Intervenant</h2>

    <Input {...register("entreprise")} label="Nom de l'entreprise :" name=""></Input>
    <Input {...register("technicien")} label="Nom du technicien :" name=""></Input>

    <h2>Type d'intervention</h2>

    <Form.Group className="mb-3">
      <Select {...register("interventionType")} value="Type" 
        options={
          interventionTypes.map((interventionType) => ({ label: interventionType.type, value: interventionType['@id'] }))
          // [{value: 'Mise en service', label: 'Mise en service'}, {value: 'Entretien', label: 'Entretien'}, {value: 'Dépannage', label: 'Dépannage'}, {value: 'Dépose/Repose', label: 'Dépose/Repose Temporaire'}, {value: 'Dépose Définitive', label: 'Dépose Définitive'}]}
        }
      />
    </Form.Group>
  </>
  );
}