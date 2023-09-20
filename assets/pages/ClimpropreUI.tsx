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


export interface NfcTag {
    "@context": string;
    "@id":      string;
    "@type":    string;
    equipment:  Equipment;
}

export interface Equipment {
    "@id":            string;
    "@type":          string;
    id:               number;
    serialNumber:     string;
    // equipment:        any[];
    nfcTag:           string;
    brand:            string;
    gas:              Gas;
    hasLeakDetection: boolean;
    finality:         any[];
    interventions:    Intervention[];
}

export interface Gas {
    "@id":   string;
    "@type": string;
    name:    string;
}

export interface Intervention {
    "@id":            string;
    "@type":          string;
    interventionDate: Date;
    interventionType: {type: string};
}

export interface InterventionFull {
    "technician": string,
    "enterprise": string,
    "person": string,
    "equipment": string,
    "interventionDate": Date,
    "interventionType": string,
    "answers": [{}] 
}


function useIsSelected() {
    const { eventKey } = useContext(AccordionItemContext);
    const { activeEventKey } = useContext(AccordionContext);

    return isAccordionItemSelected(activeEventKey, eventKey);
}

const lorem = "Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato";

function Interventions() {
    const params = useParams();
    console.log(params);

    const { status, error, data } = useQuery({
        queryKey: ['nfc_tags', params.nfcTag],
        queryFn: ({ queryKey: [type, id] }) =>
            fetch(`/api/${type}/${id}.jsonld`).then(
                async (res) => await res.json() as NfcTag
            ),
    })
    const { status: interventionType, data: interventionTypeData } = useQuery({
        queryKey: ["intervention_types"],
        queryFn: ({queryKey: [type]}) =>
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

    return <Accordion className="container">
        {interventions.map(({ ["@id"]: key,/* type, details,*/ interventionDate, ...rest }, index) => (
            <Accordion.Item key={key} eventKey={index.toString()}>
                <Accordion.Header>{new Date(interventionDate).toLocaleDateString()} - {rest.interventionType.type}</Accordion.Header>
                <Accordion.Body><LazyLoadingIntervention url={key} /></Accordion.Body>
            </Accordion.Item>
        ))}
    </Accordion>
}

function LazyLoadingIntervention({url}: {url: string}) {    
    const enabled = useIsSelected();

    const { status, error, data } = useQuery({
        queryKey: getQueryKey(url),
        queryFn: ({ queryKey: [type, id] }) =>
            fetch(`/api/${type}/${id}.jsonld`).then(
                (res) => res.json(),
            ),
        enabled,
        cacheTime: 1000*60*5 // 5 minutes
    });

    switch (status) {
        case "loading":
            return <Spinner />;
        case "error":
            return "Impossible de charger les info de l'intervention";
        case "success":
            console.log(data);
            return data.technician; 
    }
}

export default function ClimpropreUI() {

    return (
        <Page.WithNavbar>
            <Interventions />
            <Button.Link path='/create_inter' className="px-3 py-2 fixed-bottom mx-auto mb-3 w-50" variant="primary">PLUS</Button.Link>
        </Page.WithNavbar>
    )
}

