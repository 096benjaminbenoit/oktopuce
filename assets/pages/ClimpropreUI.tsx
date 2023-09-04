import Accordion from "react-bootstrap/Accordion";
import Page from "../components/Page";
import AccordionContext, { isAccordionItemSelected } from "react-bootstrap/AccordionContext";
import AccordionItemContext from "react-bootstrap/AccordionItemContext";
import { useContext } from "react";
import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { getQueryKey } from "../utils/requests";
import { Spinner } from "react-bootstrap";


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
    interventionTypes: {type: string}[];
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
    })

    switch (status) {
        case "error": return "Haha you fucked up.";
        case "loading": return <Spinner />;
        case "success": // fallthrough
    }
    const equipment = data["equipment"];
    if (!equipment) {
        return <h2>Puce non associée</h2>;
    }
    const interventions = equipment["interventions"];
    console.log(data);

    return <Accordion className="container">
        {interventions.map(({ ["@id"]: key,/* type, details,*/ interventionDate, ...rest }, index) => (
            <Accordion.Item key={key} eventKey={index.toString()}>
                <Accordion.Header>{new Date(interventionDate).toLocaleDateString()} - {rest.interventionTypes[0].type}</Accordion.Header>
                <Accordion.Body>{""/* details */}</Accordion.Body>
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
            return ;
        case "success":
            return;
    }
}

export default function ClimpropreUI() {

    return (
        <Page.WithNavbar>
            <Interventions />
        </Page.WithNavbar>
    )
}

