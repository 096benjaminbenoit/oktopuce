import React, { useState, useMemo } from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { SubmitHandler, UseFormRegisterReturn, useForm } from 'react-hook-form';
import { useMutation, useQuery } from '@tanstack/react-query';
import { FormGroup, Spinner } from 'react-bootstrap';
import Button from './Button';

type CreateInterForm = {
  entreprise: string;
  interventionType: string,
  technician: string;
  answers: string[];
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
  questionType: "checkbox" | "select" | "multiple" | "optionalText" | (string & {});
  choices: Record<string, string> | { [key: number]: string };
  required: boolean;
}

export default function CreateIntervention() {
  const { mutate } = useMutation({
    async mutationFn(form: CreateInterForm) {
      const res = await fetch("/", {
        method: "POST",
        body: JSON.stringify(form),
        headers: {
          "Content-Type": "json",
        },
      });
    },

  });
  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
    reset
  } = useForm<CreateInterForm>({ shouldUseNativeValidation: true, });


  const onSubmit: SubmitHandler<CreateInterForm> = data => mutate(data)

  const { isLoading: isInterventionTypeLoading, error: interventionTypeError, data: interventionTypeHydra } = useQuery({
    queryKey: ['intervention_types'],
    queryFn: ({ queryKey: [interventionTypes] }) =>
      fetch(`/api/${interventionTypes}.jsonld`).then(
        res => res.json(),
      ),
  });



  const [step, setStep] = useState(1);

  const interventionTypeForm = watch("interventionType");
  console.log(interventionTypeForm);


  const interventionTypes: InterventionType[] = interventionTypeHydra?.["hydra:member"];

  const choices = useMemo(() => {
    if (interventionTypes)
      return [{ label: "Sélectionner un type d'intervention", value: "" }].concat(
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
        <form onSubmit={handleSubmit(_ => setStep(2))}>
          <h2>Intervenant</h2>
          <Input {...register("entreprise")} label="Nom de l'entreprise :"></Input>
          <Input {...register("technician")} label="Nom du technicien :"></Input>

          <h2>Type d'intervention</h2>

          <Form.Group className="mb-3">
            <Select {...register(("interventionType"), { required: true })}
              options={choices}
            />
          </Form.Group>
          <div className="container text-center mt-3">
            <Button type="submit" className="text-uppercase btnHome mb-3" variant="primary">
              Valider
            </Button>
          </div>
        </form>
      </React.Fragment>;
    case 2:
      const interventionType = interventionTypes.find(({ ["@id"]: id }) => id == interventionTypeForm);

      return <form onSubmit={handleSubmit(onSubmit)}>
        {interventionType.questions.map(
          (q, i) => <QuestionField key={q['@id']} question={q} registration={register(`answers.${i}`)} />
        )}

        <div className='container text-center mt-3'>
          <Button type="submit" className='text-uppercase btnHome' variant="primary">Valider</Button>
        </div>
      </form>;
  }
}

function QuestionField(
  { question, registration }: { question: Question, registration: UseFormRegisterReturn<string> }
) {
  const choices = Object.values(question.choices);
  switch (question.questionType) {
    case "checkbox":
      return <Form.Check type="switch" label={question.question} {...registration} />;
    case "select":
      return <Form.Group>
        <Form.Label>{question.question}</Form.Label>
        <Select {...registration} options={choices.map(label => ({ label, value: label }))} />
      </Form.Group>;
    case "multiple":
      return <Form.Group>
        <Form.Label>{question.question}</Form.Label>
        {Object.keys(question.choices).map(choice => (
          <Form.Check {...registration} key={choice} type="checkbox" value={question.choices[choice]} label={question.choices[choice]} />
        ))}
      </Form.Group>;
    // TODO: optional text support ...
    case "optionalText":
      return;
  }
}