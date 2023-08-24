import Accordion from "react-bootstrap/Accordion";
import Page from "../components/Page";
import AccordionContext, { isAccordionItemSelected } from "react-bootstrap/AccordionContext";
import AccordionItemContext from "react-bootstrap/AccordionItemContext";
import { useContext } from "react";
import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router-dom";


function useIsSelected() {
    const { eventKey } = useContext(AccordionItemContext);
    const { activeEventKey } = useContext(AccordionContext);

    return isAccordionItemSelected(activeEventKey, eventKey);
}

const lorem = "Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato Potato";

function Interventions() {
    const interventions = [{
        type: "Hello",
        details: lorem,
        date: new Date(),
    }, {
        type: "Hello",
        details: lorem,
        date: new Date(),
    }];
    return <Accordion className="container">
        {interventions.map(({ type, details, date }, index) => (
            <Accordion.Item eventKey={index.toString()}>
                <Accordion.Header>{date.toLocaleDateString()} - {type}</Accordion.Header>
                <Accordion.Body>{details}</Accordion.Body>
            </Accordion.Item>
        ))}
    </Accordion>
}

function Example() {
    const params = useParams();
    const { isLoading, error, data } = useQuery({
        queryKey: ['nfc_tags', params.nfcTag],
        queryFn: ({ queryKey: [type, id] }) =>
            fetch(`/api/${type}/${id}.jsonld`).then(
                (res) => res.json(),
            ),
    })

    if (isLoading) return 'Loading...'
    // @ts-ignore
    if (error) return 'An error has occurred: ' + error.message

    return <>
        <pre>{JSON.stringify(params, null, 4)}</pre>
        <pre>{JSON.stringify(data, null, 4)}</pre>
    </>;
}

export default function ClimpropreUI() {

    return (
        <Page.WithNavbar>
            <Example />
            <Interventions />
        </Page.WithNavbar>
    )
}

