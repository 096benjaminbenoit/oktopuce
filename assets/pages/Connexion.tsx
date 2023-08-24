import React from 'react';
import FormConnexion from '../components/FormConnexion';
import Button from '../components/Button';

export default function Connexion() {
  return (<>
    <section className='d-flex flex-column align-items-center'>
      <h1 className='m-3  homeTitle text-uppercase'>Oktopuce</h1>
      <h2 className="m-5">Connexion</h2>
      <FormConnexion></FormConnexion>
    </section>
  </>
  );
}
