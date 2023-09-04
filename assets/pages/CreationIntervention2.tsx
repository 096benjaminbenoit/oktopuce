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


