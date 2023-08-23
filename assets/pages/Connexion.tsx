import React from 'react';
import FormConnexion from '../components/FormConnexion';
import Button from '../components/Button';
import { Form } from 'react-bootstrap';

export default function Connexion(){
  return (<>
    <section className='d-flex flex-column align-items-center'>
    <h1 className='m-3  homeTitle text-uppercase'>Oktopuce</h1>
      <h2 className="m-5">Connexion</h2>
      <FormConnexion></FormConnexion>
      <Button className='mt-5' variant="primary">Connexion</Button>
    </section>
  </>
  );
}


import { useForm, SubmitHandler } from "react-hook-form";

type FormValues = {
  firstName: string;
  lastName: string;
  email: string;
};

function App() {
  const { register, handleSubmit } = useForm<FormValues>();
  const onSubmit: SubmitHandler<FormValues> = data => console.log(data);

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <input {...register("firstName")} />
      <input {...register("lastName")} />
      <input type="email" {...register("email", {deps: ["firstame"]})} />

      <input type="submit" />
    </form>
  );
}