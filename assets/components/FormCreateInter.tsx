import React, { useState, useMemo, useEffect } from 'react';
import Form from 'react-bootstrap/Form';
import Input from '../components/Input';
import Select from '../components/Select';
import { SubmitHandler, UseFormRegisterReturn, useForm } from 'react-hook-form';
import { useMutation, useQuery } from '@tanstack/react-query';
import { FormGroup, Spinner } from 'react-bootstrap';
import Button from './Button';
import { useNavigate, useParams } from 'react-router-dom';
import { useEquipment, Equipment } from '../api/NFCEquipment';
import { getId } from '../utils/requests';

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

function isCompatible(interventionType: InterventionType, equipment: Equipment) {
  return interventionType.equipmentTypes.some(
    (equipmentType) => getId(equipmentType) == getId(equipment.equipmentType) 
  )
}

export default function CreateIntervention() {
  const goBack = () => navigate(`/equipment/${nfcTag}`);
  const navigate = useNavigate();
  const { mutate, isLoading } = useMutation({
    async mutationFn(form: CreateInterForm) {
      const res = await fetch("/api/interventions.jsonld", {
        method: "POST",
        body: JSON.stringify({
          ...form,
          equipment: getId(equipment),
          answers: form.answers.map((value, index) => ({
            question: interventionType.questions[index],
            answer: value 
          })),
        }),
        headers: {
          "Content-Type": "application/ld+json",
        },
      });
      if (400 <= res.status) throw await res.json();
      return await res.json();
    },
    onSuccess() {
      goBack();
    }
  });
  const {
    register,
    handleSubmit,
    watch,
    formState: { errors },
    setValue,
  } = useForm<CreateInterForm>({ shouldUseNativeValidation: true, });


  const onSubmit: SubmitHandler<CreateInterForm> = data => mutate(data)
  
  const {nfcTag} = useParams();
  const { isLoading: isEquipmentLoading, error: equipmentError, data: equipment} = useEquipment(nfcTag);
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
    if (interventionTypes && equipment)
      return [{ label: "Sélectionner un type d'intervention", value: "" }].concat(
        interventionTypes
          .filter(interventionType => isCompatible(interventionType, equipment))
          .map((interventionType) => ({ label: interventionType.type, value: interventionType['@id'] }))
      );
  }, [interventionTypes, equipment])
  const interventionType = useMemo(
    () => interventionTypes?.find(({ ["@id"]: id }) => id == interventionTypeForm)
  , [interventionTypes, interventionTypeForm]);


  useEffect(() => {
    setValue("answers", []);
  }, [interventionTypeForm]);


  if (isInterventionTypeLoading || isEquipmentLoading) {
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
          <div className="container text-center my-3 d-flex gap-3 justify-content-center">
            <Button type="button" className="text-uppercase btnHome" variant="warning" onClick={goBack}>Retour au infos...</Button>
            <Button type="submit" className="text-uppercase btnHome" variant="primary">
              Valider
            </Button>
          </div>
        </form>
      </React.Fragment>;
    case 2:
      return <form onSubmit={handleSubmit(onSubmit)}>
        <h2>{interventionType.type}</h2>
        {interventionType.questions.map(
          (q, i) => <QuestionField key={q['@id']} question={q} registration={register(`answers.${i}`)} />
        )}

        <div className='container text-center my-3 d-flex gap-3 justify-content-center'>
          <Button disabled={isLoading} type="button" onClick={() => setStep(1)} className='text-uppercase btnHome' variant="warning">Retour</Button>
          <Button disabled={isLoading} type="submit" className='text-uppercase btnHome' variant="primary">Valider</Button>
        </div>
      </form>;
  }
}

function QuestionField(
  { question, registration }: { question: Question, registration: UseFormRegisterReturn<string> }
) {
  const choices = Object.values(question.choices ?? {});
  switch (question.questionType) {
    case "checkbox":
      return <Form.Check type="switch" value="oui" label={question.question} {...registration} />;
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