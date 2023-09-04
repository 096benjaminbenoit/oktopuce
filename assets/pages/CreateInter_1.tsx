import React from 'react'
import FormCreateInter from '../components/FormCreateInter';
import NavBar from '../components/NavBar';
import Button from '../components/Button';

export default function CreateInterEtape1() {
  return (<>
    <NavBar/>
    
    <section className='infosUser d-flex flex-column'>
      <h1 className='titleInfosUser m-2'>Nouvelle Intervention</h1>

      <div className='formInfosContainer m-3'>
        <FormCreateInter/>
      </div>
    </section>
  </>
  );
}