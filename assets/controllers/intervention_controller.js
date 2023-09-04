import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="intervention" attribute will cause
 * this controller to be executed. The name "intervention" comes from the filename:
 * intervention_controller.js -> "intervention"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        
        console.log('hello world')
    }

    onChange() {
        console.log(this.element.value)
        const body = document.querySelector('body');
        const form = document.querySelector('[name="Intervention"]');
        const formData = new FormData(form);
        formData.append('ea[newForm][btn]', 'saveAndContinue');

        fetch(window.location.href, {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(response => {
            const domParser = new DOMParser()
            const html = domParser.parseFromString(response, 'text/html')
            console.log(html)
            body.replaceWith(html.querySelector('body'))
        })

        // const input = document.createElement("input");
        // input.type = "submit";
        // input.name = "ea[newForm][btn]";
        // input.value = "saveAndContinue";
        // form.append(input)
        // input.click();
        // // form.submit();
    }
}
