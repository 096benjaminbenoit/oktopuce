import { useQuery } from "@tanstack/react-query";
import { ReactNode } from "react";
import { Spinner } from "react-bootstrap";
import Checkbox from "../components/Checkbox";
import Select from "../components/Select";
import { UseFormRegisterReturn, useForm } from "react-hook-form";
import { Form } from "react-bootstrap";
interface InterventionType {
    "@context": string;
    "@id": string;
    "@type": string;
    type: string;
    questions: Question[];
    equipmentTypes: any[];
}

type Question = {
    "@id": string;
    "@type": string;
    question: string;
    questionType: "checkbox" | "select" | "multiple";
    choices: Record<string, string>;
    required: boolean;
}

type InterventionForm = {
    "response": Record<string, string>,
}

export default function (): ReactNode {
    const { isLoading, data: interventionType } = useQuery({
        queryKey: ["intervention_types", "1"],
        queryFn: ({ queryKey: [type, id] }) =>
            fetch(`/api/${type}/${id}.jsonld`).then(async req => await req.json() as InterventionType),
    })

    const { register } = useForm<InterventionForm>()

    if (isLoading) return <Spinner />;


    return <>
        {interventionType.questions.map(
            (q, i) => <QuestionField question={q} registration={register(`response.${i}`)} />
        )}
    </>;
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