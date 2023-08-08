import React from 'react';
import FormConnexion from '../components/FormConnexion';


export default function Connexion(){
    return (<>
      <h1 className="m-5">Connexion</h1>
        <section className='d-flex flex-column align-items-center'>
        <FormConnexion></FormConnexion>
        </section>
        </>
    );
}