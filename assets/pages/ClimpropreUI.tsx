import Accordion from "react-bootstrap/Accordion";
import Page from "../components/Page";
import AccordionContext, { isAccordionItemSelected } from "react-bootstrap/AccordionContext";
import AccordionItemContext from "react-bootstrap/AccordionItemContext";
import { useContext } from "react";
import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { getQueryKey } from "../utils/requests";
import { Spinner } from "react-bootstrap";
import Button from "../components/Button";
import { useNFC } from "../api/NFCEquipment";
import { ErrorBoundary } from "react-error-boundary";


export interface InterventionFull {
    "@context": string;
    "@id": string;
    "@type": string;
    id: number;
    technician: string;
    equipment: string;
    interventionDate: Date;
    interventionType: string;
    answers: Answer[];
}

export interface Answer {
    question: Question;
    answer: boolean | string | string[] | null;
}

export interface Question {
    //    id:                number;
    type: "checkbox" | "select" | "multiple" | "optionalText" | (string & {});
    label: string;
    choices: null | string[];
    //    required:          boolean;
    //    intervention_type: number;
}



function useIsSelected() {
    const { eventKey } = useContext(AccordionItemContext);
    const { activeEventKey } = useContext(AccordionContext);

    return isAccordionItemSelected(activeEventKey, eventKey);
}

const lorem = "Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato";

function Interventions({ nfcTag }: { nfcTag: string }) {
    const { status, error, data } = useNFC(nfcTag);
    const { status: interventionType, data: interventionTypeData } = useQuery({
        queryKey: ["intervention_types"],
        queryFn: ({ queryKey: [type] }) =>
            fetch(`/api/${type}.jsonld`).then(
                async (res) => await res.json() /* as {"hydra:member": InterventionType[]} */
            ),
    });

    switch (status) {
        case "error": return "Oups, une erreur est survenue.";
        case "loading": return <Spinner />;
        case "success": // fallthrough
    }
    const equipment = data?.["equipment"];
    if (!equipment) {
        return (<>
            <div className="container text-center mt-4">
                <h1>Puce non associée</h1>
            </div>
        </>);
    }
    const interventions = equipment["interventions"];
    // console.log(data);

    return <>
        <Accordion className="container">
            {interventions.map(({ ["@id"]: key,/* type, details,*/ interventionDate, ...rest }, index) => (
                <Accordion.Item key={key} eventKey={index.toString()}>
                    <Accordion.Header>{new Date(interventionDate).toLocaleDateString()} - {rest.interventionType.type}</Accordion.Header>
                    <Accordion.Body>
                        <ErrorBoundary fallback={<>Erreur lors du chargement des details de l'intervention</>}>
                            <LazyLoadingIntervention url={key} />
                        </ErrorBoundary>
                    </Accordion.Body>
                </Accordion.Item>
            ))}
        </Accordion>
        <Button.Link path={`/create_inter/${nfcTag}`} className="px-3 py-2 fixed-bottom mx-auto mb-3 w-50" variant="primary">Ajouter une intervention</Button.Link>
    </>
}

function LazyLoadingIntervention({ url }: { url: string }) {


    const enabled = useIsSelected();

    const { status, error, data: intervention } = useQuery({
        queryKey: getQueryKey(url),
        queryFn: ({ queryKey: [type, id] }) =>
            fetch(`/api/${type}/${id}.jsonld`).then(
                async (res) => await res.json() as InterventionFull,
            ),
        enabled,
        cacheTime: 1000 * 60 * 5 // 5 minutes
    });

    switch (status) {
        case "loading":
            return <Spinner />;
        case "error":
            return "Impossible de charger les info de l'intervention";
        case "success":
            console.log(intervention);
            return <>
                Intervenant: {intervention.technician ?? "Inconnu"}<br />
                <h3>Interventions realisés</h3>
                {intervention.answers.map(({ answer, question }) => {
                    switch (question.type) {
                        case "checkbox":
                            if (answer)
                                return <>{question.label}<br /></>;
                            break;
                        case "multiple":
                        case "optionalText":
                        case "select":
                            if (answer)
                                return <>{question.label}: {answer}<br /></>; 
                            break;
                    }
                })}
            </>;
    }
}

export default function ClimpropreUI() {
    const { nfcTag } = useParams();

    return (
        <Page.WithNavbar>
            <Interventions nfcTag={nfcTag} />
        </Page.WithNavbar>
    )
}

