import React from 'react';
import Form from 'react-bootstrap/Form';
import { useForm } from "react-hook-form";
import Button from './Button';
import { useState, useContext } from 'react';
import { LoginContext, LoginDispatchContext } from '../context/LoginContext';

function FormConnection() {

  
  const dispatch = useContext(LoginDispatchContext);
  const { register, handleSubmit } = useForm();
  const onSubmit = data => console.log(data);

  // const [email, setEmail] = useState('');
  // const [password, setPassword] = useState('');

  // const handleLogin = () => {
  //   fetch('http://127.0.0.1:8000/api/login_check', {
  //     method: 'POST',
  //     headers: {
  //       'Content-Type': 'application/json',
  //     },
  //     body: JSON.stringify({
  //       email: email,
  //       password: password,
  //     }),
  //   })
  //     .then(response => response.json())
  //     .then(data => {
  //       localstorage.multiSet([
  //         ['token', data.token],
  //         ['email', email],
  //       ])


    const handleLogin = (data) => {

      fetch('http://127.0.0.1:8000/api/login_check', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
      .then(r => r.json())
      .then(d => {
        const {token} = d;
        dispatch({
          type: 'login', 
          token: token,
        });
      });
  }

  return (
    <Form onSubmit={handleSubmit(handleLogin)}>
      <Form.Group  className="mb-3 text-primary" controlId="Form.ControlInput">
        <Form.Label>Numéro de téléphone</Form.Label>
        <Form.Control {...register("username")} type="tel" placeholder="Exemple 0607080910" aria-describedby="phoneHelpBlock" />
        <Form.Text className='text-secondary' id="phoneHelpBlock">
        </Form.Text>
      </Form.Group>
      <Form.Group className="mb-3 text-primary" controlId="inputPassword">
        <Form.Label>Mot de passe</Form.Label>
        <Form.Control
          {...register("password")}
          type="password"
          aria-describedby="passwordHelpBlock"
        />
        <Form.Text id="passwordHelpBlock" className='text-secondary'></Form.Text>
        <Button className='mt-5' variant="primary">Connexion</Button>

      </Form.Group >
    </Form>
  );
}

export default FormConnection;