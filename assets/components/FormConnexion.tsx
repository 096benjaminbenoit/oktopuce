import React from 'react';
import Form from 'react-bootstrap/Form';

function FormConnection() {
  return (
    <>
      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Numéro de téléphone</Form.Label>
        <Form.Control type="tel" placeholder="Exemple 0607080910" aria-describedby="phoneHelpBlock" />
        <Form.Text className='text-secondary' id="phoneHelpBlock">
        </Form.Text>
      </Form.Group>
      <Form.Group className="mb-3 text-primary" controlId="inputPassword">
        <Form.Label>Mot de passe</Form.Label>
        <Form.Control
          type="password"
          aria-describedby="passwordHelpBlock"
        />
        <Form.Text id="passwordHelpBlock" className='text-secondary'></Form.Text>
      </Form.Group>
    </>
  );
}

export default FormConnection;