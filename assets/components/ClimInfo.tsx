import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import Alert from 'react-bootstrap/Alert';
import { useForm } from 'react-hook-form';
import Button from './Button';
import { useContext } from 'react';
import { LoginDispatchContext } from '../context/LoginContext';
import { useNavigate } from 'react-router-dom';
import { UseFormRegisterReturn } from 'react-hook-form';


function ClimInfo() {
  return (

    <Form className="d-contents">
        <img
        src="https://www.medicis-patrimoine.com/media/cache/post_show/uploads/post/climatisation-peut-on-l-installer-sans-rien-demander.jpg"
        alt="Image Alt Text"
        style={{ maxWidth: '50%', height: 'auto', margin: '8px' }}
        />
        <h2 className='m-3  homeTitle text-uppercase'>Clim test</h2>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                    <Form.Label>emplacement</Form.Label>
                        <Form.Control
                        type="tel"
                        value="test"
                        aria-describedby="phoneHelpBlock"
                        />
                    <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
            </Form.Group>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                    <Form.Label>Marque</Form.Label>
                        <Form.Control
                        type="tel"
                        value="test"
                        aria-describedby="phoneHelpBlock"
                        />
                    <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
            </Form.Group>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                    <Form.Label>modele</Form.Label>
                        <Form.Control
                        type="tel"
                        value="test"
                        aria-describedby="phoneHelpBlock"
                        />
                    <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
            </Form.Group>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                    <Form.Label>Numéro de serie</Form.Label>
                        <Form.Control
                        type="tel"
                        value="test"
                        aria-describedby="phoneHelpBlock"
                        />
                    <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
            </Form.Group>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                    <Form.Label>Telecomande</Form.Label>
                        <Form.Control
                        type="tel"
                        value="test"
                        aria-describedby="phoneHelpBlock"
                        />
                    <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
            </Form.Group>
            <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
                <Button type="submit" className="mt-5" variant="primary">
                    Modifier
                </Button>
            </Form.Group>
    </Form>
  );
}


export default ClimInfo;