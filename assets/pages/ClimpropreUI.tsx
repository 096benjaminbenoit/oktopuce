import Accordion from "react-bootstrap/Accordion";
import Page from "../components/Page";
import AccordionContext, { isAccordionItemSelected } from "react-bootstrap/AccordionContext";
import AccordionItemContext from "react-bootstrap/AccordionItemContext";
import { useContext } from "react";

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

export default function ClimpropreUI() {
    return (
        <Page.WithNavbar>
            <Interventions />
        </Page.WithNavbar>
    )
}

