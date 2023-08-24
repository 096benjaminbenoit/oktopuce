import React, { useState } from 'react';
import Form from 'react-bootstrap/Form';
import Alert from 'react-bootstrap/Alert';
import { useForm } from 'react-hook-form';
import Button from './Button';
import { useContext } from 'react';
import { LoginDispatchContext } from '../context/LoginContext';
import { useNavigate } from 'react-router-dom';

function FormConnection() {
  const dispatch = useContext(LoginDispatchContext);
  const { register, handleSubmit } = useForm();
  const navigate = useNavigate();
  
  const [errorMessage, setErrorMessage] = useState('');

  const handleLogin = (data) => {
    fetch('/api/login_check', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    })
      .then(r => r.json())
      .then(d => {
        if (d.token) {
          dispatch({
            type: 'login',
            token: d.token,
          });
          navigate('/scan');
        } else {
          setErrorMessage('Login failed: Incorrect credentials');
        }
      })
      .catch(error => {
        console.error('An error occurred:', error);
      });
  };

  return (
    <Form className="d-contents" onSubmit={handleSubmit(handleLogin)}>
      {errorMessage && <Alert variant="danger">{errorMessage}</Alert>}
      <Form.Group className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Numéro de téléphone</Form.Label>
        <Form.Control
          {...register('username')}
          type="tel"
          placeholder="Exemple 0607080910"
          aria-describedby="phoneHelpBlock"
        />
        <Form.Text className="text-secondary" id="phoneHelpBlock"></Form.Text>
      </Form.Group>
      <Form.Group className="mb-3 text-primary" controlId="inputPassword">
        <Form.Label>Mot de passe</Form.Label>
        <Form.Control
          {...register('password')}
          type="password"
          aria-describedby="passwordHelpBlock"
        />
        <Form.Text id="passwordHelpBlock" className="text-secondary"></Form.Text>
      </Form.Group>
      <Button type="submit" className="mt-5" variant="primary">
        Connexion
      </Button>
    </Form>
  );
}

export default FormConnection;
