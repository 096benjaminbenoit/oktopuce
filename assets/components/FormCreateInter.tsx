import React, { useState, useMemo } from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { UseFormRegisterReturn, useForm } from 'react-hook-form';
import { useQuery } from '@tanstack/react-query';
import { Spinner } from 'react-bootstrap';
import Button from './Button';

type CreateInterForm = {
  entreprise: string;
  interventionType: string,
  technicien: string;
  response: string[];
}

interface InterventionType {
  "@id": string;
  "@type": string;
  type: string;
  questions: Question[];
  equipmentTypes: any[];
}

interface Question {
  "@id": string;
  "@type": string;
  question: string;
  questionType: string;
  choices: { [key: number]: string };
  required: boolean;
}


export default function CreateIntervention() {
  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
    reset
  } = useForm<CreateInterForm>({ shouldUseNativeValidation: true });

  const { isLoading: isInterventionTypeLoading, error: interventionTypeError, data: interventionTypeHydra } = useQuery({
    queryKey: ['intervention_types'],
    queryFn: ({ queryKey: [interventionTypes] }) =>
      fetch(`/api/${interventionTypes}.jsonld`).then(
        (res) => res.json(),
      ),
  });

  const [step, setStep] = useState(1);

  const interventionTypeForm = watch("interventionType");
  console.log(interventionTypeForm);


  const interventionTypes: InterventionType[] = interventionTypeHydra?.["hydra:member"];

  const choices = useMemo(() => {
    if (interventionTypes)
      return [{ label: "Selectioner un type d'intervention", value: "" }].concat(
        interventionTypes.map((interventionType) => ({ label: interventionType.type, value: interventionType['@id'] }))
      )
  }, [interventionTypes])

  if (isInterventionTypeLoading) {
    return <Spinner />;
  }

  switch (step) {
    case 1:
      return <React.Fragment key="1">
        {/* Picto du produit correspondant */}
        <hr />
        <form onSubmit={handleSubmit(() => setStep(2))}>
          <h2>Intervenant</h2>
          <Input {...register("entreprise")} label="Nom de l'entreprise :" name=""></Input>
          <Input {...register("technicien")} label="Nom du technicien :" name=""></Input>

          <h2>Type d'intervention</h2>

          <Form.Group className="mb-3">
            <Select {...register(("interventionType.0" as unknown as "interventionType"), { required: true })}
              options={choices
                // [{value: 'Mise en service', label: 'Mise en service'}, {value: 'Entretien', label: 'Entretien'}, {value: 'Dépannage', label: 'Dépannage'}, {value: 'Dépose/Repose', label: 'Dépose/Repose Temporaire'}, {value: 'Dépose Définitive', label: 'Dépose Définitive'}]}
              } />
          </Form.Group>
          <Button onClick={() => reset({ "interventionType": null })} variant="danger">Yeet</Button>
          <Button type="submit" className='text-uppercase btnInfosUser mb-3 ' variant="primary">Valider</Button>
        </form>
      </React.Fragment>;
    case 2:
      const interventionType = interventionTypes.find(({ ["@id"]: id }) => id == interventionTypeForm);
      
      return <>
        {interventionType.questions.map(
          (q, i) => <QuestionField question={q} registration={register(`response.${i}`)} />
        )}
      </>;
  }

}

function QuestionField(
  { question, registration }: { question: Question, registration: UseFormRegisterReturn<string> }
) {
  switch (question.questionType) {
    case "checkbox":
      return <Form.Check type="switch" label={question.question} {...registration} />
    case "select":
      return <Form.Group>
        <Form.Label>{question.question}</Form.Label>
        <Select {...registration} options={Object.values(question.choices).map(label => ({ label, value: label }))} />
      </Form.Group>
    case "multiple":
      return <Form.Group>
        <Form.Label>{question.question}</Form.Label>
        <Select multiple {...registration} options={Object.values(question.choices).map(label => ({ label, value: label }))} />
      </Form.Group>

  }
}